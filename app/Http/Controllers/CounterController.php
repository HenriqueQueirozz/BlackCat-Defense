<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index(){
        $contra_ataques = Counter::all();
        return response()->json(["message" => "Listando todas as manobras de ataque.", "data" => $contra_ataques], 200);
    }

    public function show($id){
        $contra_ataque = Counter::find($id);

        if(!$contra_ataque){
            return response()->json(
                ["error" => 'Manobra de ataque não encontrada.', 'message' => 'O identificador fornecido não se refere a nenhuma manobra de ataque registrada.'], 404
            );
        }

        return response()->json(["message" => "Manobra de ataque localizada.", "data" => $contra_ataque], 200);
    }
}
