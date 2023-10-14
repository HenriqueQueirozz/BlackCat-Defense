<?php

namespace App\Http\Controllers;

use App\Models\Zombie;
use Illuminate\Http\Request;

class ZombiesController extends Controller
{
    public function index(){
        $zombies = Zombie::all();
        return response()->json($zombies);
    }

    public function create(){}
    
    public function store(Request $request){
        $zombie = new Zombie();
        $zombie->fill($request->all());
        $zombie->save();

        return response()->json($zombie, 201);
    }

    public function show($id){
        $zombie = Zombie::find($id);

        if(!$zombie){
            return response()->json(
                ['message' => 'Zombie catalogado não encontrado'], 404
            );
        }

        return response()->json($zombie);
    }

    public function edit($id){}

    public function update(Request $request, $id){
        $zombie = Zombie::find($id);

        if(!$zombie){
            return response()->json(
                ['message' => 'Zombie catalogado não encontrado'], 404
            );
        }

        $zombie->fill($request->all());
        $zombie->save();

        return response()->json($zombie, 201);
    }

    public function destroy($id){
        $zombie = Zombie::find($id);

        if(!$zombie){
            return response()->json(
                ['message' => 'Zombie catalogado não encontrado'], 404
            );
        }

        $zombie->delete();

        return response()->json($zombie);
    }

    public function analiseDeAtributos($id){
        $zombie = Zombie::find($id);

        if(!$zombie){
            return response()->json(
                ['message' => 'Zombie catalogado não encontrado'], 404
            );
        }

        //Calculo de Atríbutos
        $pesoTotal = 2;
        $imc = $this->calculoIndiceMassaCorporal($zombie->peso, $zombie->altura);

        //Força
        $mutacaoForca = $this->fatorMutagenico($zombie->tipo_sanguineo) * 0.1;
        $pesoTotal_forca = $pesoTotal + $mutacaoForca;
        // -> Idade
        // -> Sexo
        // -> IMC
        // -> Esporte
        // -> Musica
        // -> Sanguineo

        $atributoForca = ((10)/$pesoTotal_forca) * 10;

        //Velocidade
        $mutacaoVelocidade = $this->fatorMutagenico($zombie->tipo_sanguineo) * 0.1;
        $pesoTotal_velocidade = $pesoTotal + $mutacaoVelocidade;
        // -> Idade
        // -> Sexo
        // -> IMC
        // -> Esporte
        // -> Musica
        // -> Sanguineo

        $atributoVelocidade = ((10)/$pesoTotal_velocidade) * 10;

        //Inteligência
        $mutacaoInteligencia = $this->fatorMutagenico($zombie->tipo_sanguineo) * 0.1;
        $pesoTotal_inteligencia = $pesoTotal + $mutacaoInteligencia;
        // -> Idade
        // -> Sexo
        // -> Esporte
        // -> Jogo
        // -> Musica
        // -> Sanguineo
        $atributoInteligencia = ((10)/$pesoTotal_inteligencia) * 10;

        
        $zombie->forca = $atributoForca;
        $zombie->velocidade = $atributoVelocidade;
        $zombie->inteligencia = $atributoInteligencia;
    }


    //Métodos de apoio
    public function fatorMutagenico($tipoSanguineo){
        switch($tipoSanguineo){
            case'AB+':
                $fator_mutagenico = random_int(1, 10);
                break;

            case'AB-':
            case'A+':
            case'A-':
            case'B+':
            case'B-':
                $fator_mutagenico = random_int(2, 4);
                break;

            case'O-':
                $fator_mutagenico = 1;
                break;

            default:
                $fator_mutagenico = random_int(1, 10);
                break;
        }

        return $fator_mutagenico;
    }

    public function calculoIndiceMassaCorporal($peso, $altura){
        $imc = $peso / ($altura**2);
        return $imc;
    }

    public function faixaDePontosPorAtributos($atributo, $caracteristica, $valor){
        switch($caracteristica){    
            case 'idade';
                switch($atributo){    
                    case 'forca';
                        if($valor <= 6){
                            return 1;
                        }else if(($valor <= 9) || ($valor >= 91 && $valor <= 100)){
                            return 2;
                        }else if(($valor <= 11) || ($valor >= 81 && $valor <= 90)){
                            return 3;
                        }else if(($valor <= 14) || ($valor >= 71 && $valor <= 80)){
                            return 5;
                        }else if(($valor <= 16) || ($valor >= 61 && $valor <= 70)){
                            return 6;
                        }else if(($valor <= 20) || ($valor >= 33 && $valor <= 40)){
                            return 9;
                        }else if($valor <= 50){
                            return 8;
                        }else if($valor <= 60){
                            return 7;
                        }else if($valor <= 32){
                            return 10;
                        }
                }
        }
    }
}
