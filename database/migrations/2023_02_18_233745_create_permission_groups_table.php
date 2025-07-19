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
        Schema::create('permission_groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->longText('description')->nullable();
        });

        // Update permissions table
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignId('permission_group_id')->references('id')->on('permission_groups')->onDelete('cascade');
        });

        // Give users an unique uuid
        Schema::table('users', function (Blueprint $table) {
            $table->uuid()->unique()->default("");
        });

        \App\Models\User::all()->each(function ($user) {
            $user->uuid = Str::uuid();
            $user->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_groups');
    }
};
