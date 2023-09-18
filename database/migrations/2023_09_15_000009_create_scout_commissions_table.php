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
        Schema::create('scout_commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('phone');
            $table->bigInteger('status');
            // $table->unsignedBigInteger('store_house_id');
            // $table->unsignedBigInteger('order_id');
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('scout_regiment_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scout_commissions');
    }
};
