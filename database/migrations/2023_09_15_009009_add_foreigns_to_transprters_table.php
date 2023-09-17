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
        Schema::table('transprters', function (Blueprint $table) {
            $table
                ->foreign('transprter_type_id')
                ->references('id')
                ->on('transprter_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transprters', function (Blueprint $table) {
            $table->dropForeign(['transprter_type_id']);
        });
    }
};