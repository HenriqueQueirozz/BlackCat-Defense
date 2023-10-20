<?php

namespace App\Http\Controllers;

use App\Models\Weakness;
use Illuminate\Http\Request;

class WeaknessController extends Controller
{
    public function index(){
        $pontos_fracos = Weakness::all();
        return response()->json(["message" => "Listando todos os pontos fracos de zumbi.", "data" => $pontos_fracos], 200);
    }

    public function show($id){
        $ponto_fraco = Weakness::find($id);

        if(!$ponto_fraco){
            return response()->json(
                ["error" => 'Ponto fraco de zumbi não encontrado.', 'message' => 'O identificador fornecido não se refere a nenhum ponto fraco de zumbi registrado.'], 404
            );
        }

        return response()->json(["message" => "Ponto fraco de zumbi localizado.", "data" => $ponto_fraco], 200);
    }
}
