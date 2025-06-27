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
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        // Parse a YAML file into a PHP array
        $permissions = Yaml::parseFile(base_path('permissions.yml'));

        // Find this application
        $application = Application::where('name', 'auth')->first();

        // if groups do not contain application, throw error
        if (! array_key_exists('application', $permissions['groups'])) {
            throw new \Exception("No group 'application' found in permissions.yml");
        }

        if (! array_key_exists('view', $permissions['groups']['application']['permissions'])) {
            throw new \Exception("permissions.yml must contain permission 'view' in 'application' group");
        }

        // Check if multiple permissions in the file have the same unique_name
        $uniqueNames = [];
        foreach ($permissions['groups'] as $data) {
            foreach ($data['permissions'] as $permission => $permissionData) {
                if (in_array($permission, $uniqueNames)) {
                    throw new \Exception('Multiple permissions with the same unique_name found in permissions.yml');
                }
                $uniqueNames[] = $permission;
            }
        }

        // Loop through the permissions
        foreach ($permissions['groups'] as $group => $data) {
            $foundGroup = $application->permissionGroups()->updateOrCreate([
                'unique_name' => $group,
            ], [
                'description' => $data['description'],
                'name' => $data['name'],
            ]);

            // Cast to Model
            if (! $foundGroup instanceof \App\Models\PermissionGroup) {
                throw new \Exception('Failed to cast found group to PermissionGroup model');
            }

            $foundNames = [];

            foreach ($data['permissions'] as $permission => $permissionData) {
                $foundGroup->permissions()->updateOrCreate([
                    'unique_name' => $permission,
                ], [
                    'description' => $permissionData['description'],
                    'name' => $permissionData['name'],
                ]);

                // Remove unique name from array
                $foundNames[] = $permission;

                echo $foundGroup->unique_name.' '.$permission;
            }

            // Delete all permissions that are not in the file
            $delPermissions = $foundGroup->permissions()->get()->filter(function ($permission) use ($foundNames) {
                // Cast to Model
                if (! $permission instanceof \App\Models\Permission) {
                    throw new \Exception('Failed to cast permission to Permission model');
                }

                return ! in_array($permission->unique_name, $foundNames);
            });

            foreach ($delPermissions as $permission) {
                $permission->delete();
            }
        }

        $groups = $application->permissionGroups()->get()->filter(function ($group) use ($permissions) {
            // Cast to Model
            if (! $group instanceof PermissionGroup) {
                throw new \Exception('Failed to cast group to PermissionGroup model');
            }

            return ! array_key_exists($group->unique_name, $permissions['groups']);
        });

        // Delete all groups that are not in the file
        foreach ($groups as $group) {
            $group->delete();
        }
    }
}
