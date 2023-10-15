<?php

namespace App\Http\Controllers;

use App\Models\ZombieCounter;
use Illuminate\Http\Request;

class ZombiesCounterController extends Controller
{
    public function index(){
        $contra_ataques = ZombieCounter::all();
        return response()->json($contra_ataques);
    }

    public function create(){}

    public function store(Request $request){
        $contra_ataques = new ZombieCounter;
        $contra_ataques->fill($request->all());
        $contra_ataques->save();

        return response()->json($contra_ataques, 201);
    }

    public function show($id){
        $contra_ataque = ZombieCounter::find($id);

        if(!$contra_ataque){
            return response()->json(
                ['message' => 'Manobra de ataque não encontrada'], 404
            );
        }

        return response()->json($contra_ataque);
    }

    public function edit($id){}

    public function update(Request $request, $id){
        $contra_ataque = ZombieCounter::find($id);

        if(!$contra_ataque){
            return response()->json(
                ['message' => 'Manobra de ataque não encontrada'], 404
            );
        }

        $contra_ataque->fill($request->all());
        $contra_ataque->save();

        return response()->json($contra_ataque);
    }

    public function destroy($id){
        $contra_ataque = ZombieCounter::find($id);

        if(!$contra_ataque){
            return response()->json(
                ['message' => 'Manobra de ataque não encontrada'], 404
            );
        }

        $contra_ataque->delete();

        return response()->json($contra_ataque);
    }
}
