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
        Schema::table('permissions', function (Blueprint $table) {
            // Add on delete cascade to permission_group_id
            $table->dropForeign('permissions_permission_group_id_foreign');
            $table->foreign('permission_group_id')->references('id')->on('permission_groups')->onDelete('cascade');
        });

        Schema::table('permission_role', function (Blueprint $table) {
            // Add on delete cascade to permission_id
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
};
