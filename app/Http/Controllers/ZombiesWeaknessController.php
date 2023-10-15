<?php

namespace App\Http\Controllers;

use App\Models\ZombieWeakness;
use Illuminate\Http\Request;

class ZombiesWeaknessController extends Controller
{
    public function index(){
        $fraquezas = ZombieWeakness::all();
        return response()->json($fraquezas);
    }

    public function create(){}

    public function store(Request $request){
        $fraqueza = new ZombieWeakness;
        $fraqueza->fill($request->all());
        $fraqueza->save();

        return response()->json($fraqueza, 201);
    }

    public function show($id){
        $fraqueza = ZombieWeakness::find($id);

        if(!$fraqueza){
            return response()->json(
                ['message' => 'Fraqueza zombistica não encontrada'], 404
            );
        }

        return response()->json($fraqueza);
    }

    public function edit($id){}

    public function update(Request $request, $id){
        $fraqueza = ZombieWeakness::find($id);

        if(!$fraqueza){
            return response()->json(
                ['message' => 'Fraqueza zombistica não encontrada'], 404
            );
        }

        $fraqueza->fill($request->all());
        $fraqueza->save();

        return response()->json($fraqueza);
    }

    public function destroy($id){
        $fraqueza = ZombieWeakness::find($id);

        if(!$fraqueza){
            return response()->json(
                ['message' => 'Fraqueza zombistica não encontrada'], 404
            );
        }

        $fraqueza->delete();

        return response()->json($fraqueza);
    }
}
