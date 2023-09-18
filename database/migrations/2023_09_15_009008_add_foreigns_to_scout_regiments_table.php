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
        Schema::table('scout_regiments', function (Blueprint $table) {
            $table
                ->foreign('scout_commission_id')
                ->references('id')
                ->on('scout_commissions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scout_regiments', function (Blueprint $table) {
            $table->dropForeign(['scout_commission_id']);
        });
    }
};
