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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->longText('description')->nullable();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreignId('role_id')->constrained();
        });

        Schema::create('permission_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('permission_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
