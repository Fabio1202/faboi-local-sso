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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->longText('description')->nullable();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('role_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });

        // Create default role
        $role = new \App\Models\Role;
        $role->name = 'Admin';
        $role->description = 'Default Admin Role';
        $role->save();

        // Assign default role to default user
        $user = \App\Models\User::where('email', 'fabio.boi@icloud.com')->first();
        $user->roles()->attach($role);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
    }
};
