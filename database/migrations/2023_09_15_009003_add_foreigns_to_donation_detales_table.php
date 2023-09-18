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
        Schema::table('donation_detales', function (Blueprint $table) {
            $table
                ->foreign('donation_entity_id')
                ->references('id')
                ->on('donation_entities')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_detales', function (Blueprint $table) {
            $table->dropForeign(['donation_entity_id']);
        });
    }
};
