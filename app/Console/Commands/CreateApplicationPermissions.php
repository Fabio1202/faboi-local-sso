<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\PermissionGroup;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;

class CreateApplicationPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        // Parse a YAML file into a PHP array
        $permissions = Yaml::parseFile(base_path('permissions.yml'));

        // Find this application
        $application = Application::where('name', 'auth')->first();

        // if groups do not contain application, throw error
        if (!array_key_exists("application", $permissions["groups"])) {
            throw new \Exception("No group 'application' found in permissions.yml");
        }

        if(!array_key_exists("view", $permissions["groups"]["application"]["permissions"])) {
            throw new \Exception("permissions.yml must contain permission 'view' in 'application' group");
        }

        $permissionGroups = $application->permissionGroups()->get();

        // Check if multiple permissions in the file have the same unique_name
        $uniqueNames = [];
        foreach ($permissions["groups"] as $group => $data) {
            foreach ($data["permissions"] as $permission => $permissionData) {
                if (in_array($permission, $uniqueNames)) {
                    throw new \Exception("Multiple permissions with the same unique_name found in permissions.yml");
                }
                $uniqueNames[] = $permission;
            }
        }



        // Loop through the permissions
        foreach ($permissions["groups"] as $group => $data) {
            $foundGroup = $application->permissionGroups()->updateOrCreate([
                'unique_name' => $group,
            ], [
                'description' => $data["description"],
                'name' => $data["name"]
            ]);

            $permissionGroups->forget($foundGroup);

            foreach ($data["permissions"] as $permission => $permissionData) {
                $foundGroup->permissions()->updateOrCreate([
                    'unique_name' => $permission,
                ], [
                    'description' => $permissionData["description"],
                    'name' => $permissionData["name"]
                ]);

                // Remove unique name from array
                $uniqueNames = array_diff($uniqueNames, [$permission]);

                echo $foundGroup->unique_name . " " . $permission;
            }
        }

        foreach ($permissionGroups as $permissionGroup) {
            $permissionGroup->delete();
        }

        // Delete all permissions that are not in the file
        foreach ($uniqueNames as $uniqueName) {
            $permission = $application->permissions()->where('unique_name', $uniqueName)->first();
            if ($permission) {
                $permission->delete();
            }
        }
    }
}
