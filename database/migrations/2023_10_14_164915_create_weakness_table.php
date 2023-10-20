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
        Schema::create('weakness', function (Blueprint $table) {
            $table->id('weakness_id');
            $table->string('name', 60);
            $table->longText('description');
            $table->string('image', 100)->nullable();
            $table->enum('weakness_point', ['S', 'V', 'I', '-']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weakness');
    }
};
