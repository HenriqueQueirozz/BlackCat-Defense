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
        Schema::create('zumbi', function (Blueprint $table) {
            $table->id('zumbi_id');
	        $table->enum('dangerousness', ['Muito Baixa', 'Baixa', 'Media', 'Alta', 'Muita Alta'])->nullable();
	        $table->integer('strength')->nullable();
	        $table->integer('velocity')->nullable();
	        $table->integer('intelligence')->nullable();
	        $table->string('image', 100)->nullable();
            $table->integer('age');
            $table->enum('gender', ['M', 'F']);
            $table->float('weight', 5,2);
            $table->float('height', 3,2);
            $table->enum('blood_type', ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']);
            $table->enum('music_style', ['Pop', 'Rock', 'Pagode', 'Sertanejo', 'Hip-Hop/Rap', 'Eletronica', 'Funk', 'Metal', 'Outros']);
            $table->enum('sport', ['Futebol', 'Basquete', 'Volei', 'Luta', 'Atletismo', 'eSports', 'Nada']);
            $table->enum('favorite_game', ['Counter-Strike', 'Minecraft', 'Fortnite', 'The Witcher', 'Valorant', 'Assassin s Creed', 'Warcraft', 'FIFA', 'League of Legends', 'Dota', 'Rocket League', 'Outros']);
            $table->unsignedBigInteger('strength_id')->unsigned()->nullable();;
            $table->foreign('strength_id')
                ->references('strength_id')
                ->on('strength')
                ->onDelete('cascade');
            $table->unsignedBigInteger('weakness_id')->unsigned()->nullable();;
            $table->foreign('weakness_id')
                ->references('weakness_id')
                ->on('weakness')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zumbi');
    }
};
