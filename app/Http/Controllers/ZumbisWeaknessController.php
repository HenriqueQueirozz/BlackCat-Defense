<?php

namespace App\Http\Controllers;

use App\Models\ZumbiWeakness;
use Illuminate\Http\Request;

class ZumbisWeaknessController extends Controller
{
    public function index(){
        $fraquezas = ZumbiWeakness::all();
        return response()->json(["message" => "Listando todas as fraquezas zumbi.", "data" => $fraquezas], 200);
    }

    public function show($id){
        $fraqueza = ZumbiWeakness::find($id);

        if(!$fraqueza){
            return response()->json(
                ["error" => 'Fraqueza zumbi não encontrada.', 'message' => 'O identificador fornecido não se refere a nenhuma fraqueza zumbi registrada.'], 404
            );
        }

        return response()->json(["message" => "Fraqueza localizada.", "data" => $fraqueza], 200);
    }
}
