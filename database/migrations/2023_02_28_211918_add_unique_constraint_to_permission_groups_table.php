<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permission_groups', function (Blueprint $table) {
            $table->string('unique_name')->nullable();
            $table->unique(['application_id', 'unique_name']);
        });

        $permissionGroups = \App\Models\PermissionGroup::all();
        foreach ($permissionGroups as $permissionGroup) {
            $permissionGroup->unique_name = $permissionGroup->name;
            $permissionGroup->save();
        }

        Schema::table('permission_groups', function (Blueprint $table) {
            $table->string('unique_name')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permission_groups', function (Blueprint $table) {

        });
    }
};
