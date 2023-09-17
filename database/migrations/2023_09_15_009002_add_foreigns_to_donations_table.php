<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table
                ->foreign('donation_detales_id')
                ->references('id')
                ->on('donation_detales')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('store_house_id')
                ->references('id')
                ->on('store_houses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['donation_detales_id']);
            $table->dropForeign(['item_id']);
            $table->dropForeign(['store_house_id']);
        });
    }
};
