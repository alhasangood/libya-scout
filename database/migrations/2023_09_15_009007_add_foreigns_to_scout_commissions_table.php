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
        Schema::table('scout_commissions', function (Blueprint $table) {
            // $table
            //     ->foreign('store_house_id')
            //     ->references('id')
            //     ->on('store_houses')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('CASCADE');

            // $table
            //     ->foreign('order_id')
            //     ->references('id')
            //     ->on('orders')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('CASCADE');

            // $table
            //     ->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('CASCADE');

            // $table
            //     ->foreign('scout_regiment_id')
            //     ->references('id')
            //     ->on('scout_regiments')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scout_commissions', function (Blueprint $table) {
            // $table->dropForeign(['store_house_id']);
            // $table->dropForeign(['order_id']);
            // $table->dropForeign(['user_id']);
            // $table->dropForeign(['scout_regiment_id']);
        });
    }
};
