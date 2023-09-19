<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\PermissionRegistrar;

class CreateStoreHousesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up(): void
    {
        Schema::table('store_houses', function (Blueprint $table) {
            $table->foreign('scout_regiment_id')
            ->references('id')
            ->on('scout_regiments')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('store_houses', function (Blueprint $table) {
            $table->dropForeign(['scout_regiment_id']);
        });
    }
};