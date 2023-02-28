<?php

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
            $table->string('unique_name')->nullable();
            $table->unique(['permission_group_id', 'unique_name']);
        });

        $permissions = \App\Models\Permission::all();
        foreach ($permissions as $permission) {
            $permission->unique_name = $permission->name;
            $permission->save();
        }

        Schema::table('permissions', function (Blueprint $table) {
            $table->string('unique_name')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
};
