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
        Schema::table('order_store_house', function (Blueprint $table) {
            $table
                ->foreign('order_id')
                ->references('orederNumber')
                ->on('orders')
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
        Schema::table('order_store_house', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['store_house_id']);
        });
    }
};
