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
        Schema::create('zombie_defense', function (Blueprint $table) {
            $table->id('id_defense');
            $table->string('nome', 60);
            $table->longText('descricao');
            $table->string('imagem', 100)->nullable();
            $table->enum('ponto_explorado', ['F', 'V', 'I', 'FV', 'FI', 'VI', 'FVI']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zombie_defense');
    }
};
