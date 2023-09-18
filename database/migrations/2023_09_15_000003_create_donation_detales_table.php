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
        Schema::create('donation_detales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('donation_entity_id');
            $table->string('name');
            $table->string('person');
            $table->binary('logo');
            $table->bigInteger('number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_detales');
    }
};
