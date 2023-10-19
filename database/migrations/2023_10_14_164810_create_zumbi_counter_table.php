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
        Schema::create('zumbi_counter', function (Blueprint $table) {
            $table->id('counter_id');
            $table->string('name', 60);
            $table->longText('description');
            $table->string('image', 100)->nullable();
            $table->integer('weakness_id')->unsigned();
            $table->foreign('weakness_id')
                ->references('weakness_id')
                ->on('zumbi_weakness')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zumbi_counter');
    }
};
