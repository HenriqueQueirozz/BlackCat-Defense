<?php

namespace App\Http\Controllers;

use App\Models\ZumbiStrenghness;
use Illuminate\Http\Request;

class ZumbisStrenghnessController extends Controller
{
    public function index(){
        $pontos_fortes = ZumbiStrenghness::all();
        return response()->json(["message" => "Listando todos os pontos fortes de zumbis.", "data" => $pontos_fortes], 200);
    }

    public function show($id){
        $ponto_forte = ZumbiStrenghness::find($id);

        if(!$ponto_forte){
            return response()->json(
                ["error" => 'Ponto forte de zumbi não encontrado.', 'message' => 'O identificador fornecido não se refere a nenhum ponto forte de zumbi registrado.'], 404
            );
        }

        return response()->json(["message" => "Ponto forte de zumbi localizado.", "data" => $ponto_forte], 200);
    }
}
