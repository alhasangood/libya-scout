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
        Schema::create('scout_regiments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('phone_number');
            $table->unsignedBigInteger('scout_regimentable_id');
            $table->string('scout_regimentable_type');
            $table->unsignedBigInteger('scout_commission_id');

            $table->index('scout_regimentable_id');
            $table->index('scout_regimentable_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scout_regiments');
    }
};
