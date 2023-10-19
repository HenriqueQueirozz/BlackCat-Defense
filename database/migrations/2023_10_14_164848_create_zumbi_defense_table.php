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
        Schema::create('zumbi_defense', function (Blueprint $table) {
            $table->id('defense_id');
            $table->string('name', 60);
            $table->longText('description');
            $table->string('image', 100)->nullable();
            $table->integer('strengthness_id')->unsigned();
            $table->foreign('strengthness_id')
                ->references('strengthness_id')
                ->on('zumbi_strengthness')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zumbi_defense');
    }
};
