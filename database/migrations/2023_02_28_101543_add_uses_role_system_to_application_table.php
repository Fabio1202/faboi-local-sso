<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Application::class);
            $table->dropColumn('application_id');
            $table->foreignId('permission_group_id')->change()->nullable(false);
        });

        Schema::table('permission_groups', function (Blueprint $table) {
            $table->foreignUuid('application_id')->constrained()->onDelete('cascade');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->boolean('uses_role_system')->default(false);
        });

        \App\Models\Application::all()->each(function ($application) {
            $application->uses_role_system = true;
            $permissionGroup = $application->permissionGroups()->create([
                'name' => 'Application',
                'description' => 'Application permissions',
            ]);
            $permission = $permissionGroup->permissions()->create([
                'name' => 'view',
                'description' => 'View the application',
            ]);
            $role = Role::where('name', 'admin')->first();
            $role->permissions()->attach($permission);
            $application->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application', function (Blueprint $table) {
            //
        });
    }
};
