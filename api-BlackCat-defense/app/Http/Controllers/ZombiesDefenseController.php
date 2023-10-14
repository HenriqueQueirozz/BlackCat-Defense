<?php

namespace App\Http\Controllers;

use App\Models\ZombieDefense;
use Illuminate\Http\Request;

class ZombiesDefenseController extends Controller
{
    public function index(){
        $defesas = ZombieDefense::all();
        return response()->json($defesas);
    }

    public function create(){}

    public function store(Request $request){
        $defesa = new ZombieDefense();
        $defesa->fill($request->all());
        $defesa->save();

        return response()->json($defesa, 201);
    }

    public function show($id){
        $defesa = ZombieDefense::find($id);

        if(!$defesa){
            return response()->json(
                ['message' => 'Tática de defesa contra zombie não encontrada'], 404
            );
        }

        return response()->json($defesa);
    }

    public function edit($id){}

    public function update(Request $request, $id){
        $defesa = ZombieDefense::find($id);

        if(!$defesa){
            return response()->json(
                ['message' => 'Tática de defesa contra zombie não encontrada'], 404 
            );
        }

        $defesa->fill($request->all());
        $defesa->save();

        return response()->json($defesa);
    }

    public function destroy($id){
        $defesa = ZombieDefense::find($id);

        if(!$defesa){
            return response()->json(
                ['message' => 'Tática de defesa contra zombie não encontrada'], 404 
            );
        }

        $defesa->delete();

        return response()->json($defesa);
    }
}
