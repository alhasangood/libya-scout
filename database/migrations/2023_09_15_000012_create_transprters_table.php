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
        Schema::create('transprters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('identity');
            $table->binary('photo')->nullable();
            $table->string('address');
            $table->unsignedBigInteger('transprter_type_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transprters');
    }
};
