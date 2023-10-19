<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zumbi_strengthness', function (Blueprint $table) {
            $table->id('strengthness_id');
            $table->string('name', 60);
            $table->longText('description');
            $table->string('image', 100)->nullable();
            $table->enum('fortification_point', ['S', 'V', 'I', '-']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zumbi_strengthness');
    }
};
