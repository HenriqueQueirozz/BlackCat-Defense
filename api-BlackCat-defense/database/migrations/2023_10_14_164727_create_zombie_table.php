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
        Schema::create('zombie', function (Blueprint $table) {
            $table->increments('id');
	        $table->enum('periculosidade', ['Muito Baixa', 'Baixa', 'Media', 'Alta', 'Muita Alta'])->nullable();
	        $table->integer('forca')->nullable();
	        $table->integer('velocidade')->nullable();
	        $table->integer('inteligencia')->nullable();
	        $table->string('imagem', 100)->nullable();
            $table->integer('idade');
            $table->enum('sexo', ['M', 'F']);
            $table->float('peso', 5,2);
            $table->float('altura', 3,2);
            $table->enum('tipo_sanguineo', ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']);
            $table->enum('estilo_musical', ['Pop', 'Roc', 'Pag', 'Ser', 'Hip', 'Ele', 'Fun', 'Met', 'Out']);
            $table->enum('esporte', ['Fut', 'Bas', 'Vol', 'Lut', 'Atl', 'Esp', 'Nad']);
            $table->enum('jogo', ['Cs', 'Mine', 'Fort', 'Witch', 'Val', 'Ac', 'Wow', 'Fifa', 'Lol', 'Dota', 'Rocket', 'O']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zombies');
    }
};
