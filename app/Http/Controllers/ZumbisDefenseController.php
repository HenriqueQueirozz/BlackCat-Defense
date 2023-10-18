<?php

namespace App\Http\Controllers;

use App\Models\ZumbiDefense;
use Illuminate\Http\Request;

class ZumbisDefenseController extends Controller
{
    public function index(){
        $defesas = ZumbiDefense::all();
        return response()->json(["message" => "Listando todas as manobras de defesa.", "data" => $defesas], 200);
    }

    public function show($id){
        $defesa = ZumbiDefense::find($id);

        if(!$defesa){
            return response()->json(
                ["error" => 'Manobra de defesa não encontrada.', 'message' => 'O identificador fornecido não se refere a nenhuma manobra de defesa registrada.'], 404
            );
        }

        return response()->json(["message" => "Manobra de defesa localizada.", "data" => $defesa], 200);
    }
}
