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
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(\Illuminate\Support\Str::uuid());
            $table->string('name');
            $table->boolean('first_party')->default(false);
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignUuid('application_id')->constrained();
            $table->boolean('force_authorization_screen')->default(false);
        });

        // Save Auth Application
        $application = new \App\Models\Application();
        $application->name = 'Auth';
        $application->first_party = true;
        $application->description = 'This is the default auth application. It is used to manage users, roles and permissions.';
        $application->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
