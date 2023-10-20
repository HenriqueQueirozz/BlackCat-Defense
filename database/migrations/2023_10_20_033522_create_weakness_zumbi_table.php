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
        Schema::create('weakness_zumbi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zumbi_zumbi_id');
            $table->unsignedBigInteger('weakness_weakness_id');
            $table->timestamps();
    
            $table->foreign('zumbi_zumbi_id')->references('zumbi_id')->on('zumbi')->onDelete('cascade');
            $table->foreign('weakness_weakness_id')->references('weakness_id')->on('weakness')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weakness_zumbi');
    }
};
