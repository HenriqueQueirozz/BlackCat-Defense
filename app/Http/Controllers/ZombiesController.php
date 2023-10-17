<?php

namespace App\Http\Controllers;

use App\Models\Zombie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ZombiesController extends Controller
{
    public function index(){
        $zombies = Zombie::all();
        return response()->json(["message" => "Listando todos os zumbis.", "data" => $zombies], 200);
    }

    // public function create(){}
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'idade' => 'required|numeric|min:1|max:130',
            'sexo' => ['required', Rule::in(['M', 'F'])],
            'tipo_sanguineo' => ['required', Rule::in(['AB+', 'AB-', 'O+', 'O-', 'A+', 'A-', 'B+', 'B-'])],
            'peso' => 'required|decimal:0,2|min:1|max:700',
            'altura' => 'required|decimal:0,2|min:1|max:3',
            'estilo_musical' => ['required', Rule::in(['Pop', 'Roc', 'Pag', 'Ser', 'Hip', 'Ele', 'Fun', 'Met', 'Out'])],
            'esporte' => ['required', Rule::in(['Fut', 'Bas', 'Vol', 'Lut', 'Atl', 'Esp', 'Nad'])],
            'jogo' => ['required', Rule::in(['Cs', 'Mine', 'Fort', 'Witch', 'Val', 'Ac', 'Wow', 'Fifa', 'Lol', 'Dota', 'Rocket', 'Out'])]
        ],[
            'peso.decimal' => "O campo peso deve apresentar um formato semelhante a este '75.50'",
            'altura.decimal' => "O campo altura deve apresentar um formato semelhante a este '1.80'",
        ]);

        if($validator->fails()){
            return response()->json(["error" => 'Informação inválida.', "message" => $validator->errors()], 422);
        }
            
        $zombie = new Zombie();
        $zombie->fill($request->all());
        $zombie->save();

        $this->analiseDeAtributos($zombie);
        $this->analiseDePericulosidade($zombie);

        return response()->json(["message" => "Zumbi cadastrado com sucesso.", "data" => $zombie], 201);
    }

    public function show($id){
        $zombie = Zombie::find($id);

        if(!$zombie){
            return response()->json(
                ['message' => 'Zombie catalogado não encontrado'], 404
            );
        }

        return response()->json(["message" => "Zumbi localizado.", "data" => $zombie], 200);
    }

    public function edit($id){}

    // public function update(Request $request, $id){
    //     $zombie = Zombie::find($id);

    //     if(!$zombie){
    //         return response()->json(
    //             ['message' => 'Zombie catalogado não encontrado'], 404
    //         );
    //     }

    //     $zombie->fill($request->all());
    //     $zombie->save();

    //     return response()->json($zombie, 201);
    // }

    // public function destroy($id){
    //     $zombie = Zombie::find($id);

    //     if(!$zombie){
    //         return response()->json(
    //             ['message' => 'Zombie catalogado não encontrado'], 404
    //         );
    //     }

    //     $zombie->delete();

    //     return response()->json($zombie);
    // }

    public function analiseDeAtributos($zombie){
        //Calculo de Atríbutos
        $pesoTotal = 2;
        $pontos_atributos = $this->faixaDePontosPorAtributos($zombie);


        //Força
        $mutacaoForca = $this->fatorMutagenico($zombie->tipo_sanguineo) * 0.1;
        $pesoTotal_forca = $pesoTotal + $mutacaoForca;
            // -> Idade
            $valor_idade = $pontos_atributos['idade']['forca'] * 0.5;
            // -> Sexo
            $valor_sexo = $pontos_atributos['sexo']['forca'] * 0.3;
            // -> IMC
            $valor_imc = $pontos_atributos['imc']['forca'] * 0.6;
            // -> Esporte
            $valor_esporte = $pontos_atributos['esporte']['forca'] * 0.4;
            // -> Musica
            $valor_musica = $pontos_atributos['musica']['forca'] * 0.2;
            // -> Sanguineo
            $valor_sangue = $pontos_atributos['tipoSanguineo']['forca'] * $mutacaoForca;

        $atributoForca = (($valor_idade + $valor_sexo + $valor_imc + $valor_esporte + $valor_musica + $valor_sangue)/$pesoTotal_forca) * 10;

        //Velocidade
        $mutacaoVelocidade = $this->fatorMutagenico($zombie->tipo_sanguineo) * 0.1;
        $pesoTotal_velocidade = $pesoTotal + $mutacaoVelocidade;
            // -> Idade
            $valor_idade = $pontos_atributos['idade']['velocidade'] * 0.4;
            // -> Sexo
            $valor_sexo = $pontos_atributos['sexo']['velocidade'] * 0.3;
            // -> IMC
            $valor_imc = $pontos_atributos['imc']['velocidade'] * 0.6;
            // -> Esporte
            $valor_esporte = $pontos_atributos['esporte']['velocidade'] * 0.5;
            // -> Musica
            $valor_musica = $pontos_atributos['musica']['velocidade'] * 0.2;
            // -> Sanguineo
            $valor_sangue = $pontos_atributos['tipoSanguineo']['velocidade'] * $mutacaoVelocidade;

        $atributoVelocidade = (($valor_idade + $valor_sexo + $valor_imc + $valor_esporte + $valor_musica + $valor_sangue)/$pesoTotal_velocidade) * 10;

        //Inteligência
        $mutacaoInteligencia = $this->fatorMutagenico($zombie->tipo_sanguineo) * 0.1;
        $pesoTotal_inteligencia = $pesoTotal + $mutacaoInteligencia;
            // -> Idade
            $valor_idade = $pontos_atributos['idade']['inteligencia'] * 0.5;
            // -> Sexo
            $valor_sexo = $pontos_atributos['sexo']['inteligencia'] * 0.2;
            // -> Jogo
            $valor_jogo = $pontos_atributos['jogo']['inteligencia'] * 0.3;
            // -> Esporte
            $valor_esporte = $pontos_atributos['esporte']['inteligencia'] * 0.4;
            // -> Musica
            $valor_musica = $pontos_atributos['musica']['inteligencia'] * 0.6;
            // -> Sanguineo
            $valor_sangue = $pontos_atributos['tipoSanguineo']['inteligencia'] * $mutacaoInteligencia;

        $atributoInteligencia = (($valor_idade + $valor_sexo + $valor_jogo + $valor_esporte + $valor_musica + $valor_sangue)/$pesoTotal_inteligencia) * 10;
        
        $zombie->forca = round($atributoForca);
        $zombie->velocidade = round($atributoVelocidade);
        $zombie->inteligencia = round($atributoInteligencia);
        $zombie->save();

        return response()->json($zombie);
    }

    public function analiseDePericulosidade($zombie){
        $array_periculosidade = [];
        $array_periculosidade['forca'] = $zombie->forca;
        $array_periculosidade['velocidade'] = $zombie->velocidade;
        $array_periculosidade['inteligencia'] = $zombie->inteligencia;

        $soma_atributos = 0;

        foreach($array_periculosidade as $key => $value){
            $soma_atributos += $value;

            if($value <= 40){
                //Desvantagem
                $soma_atributos -= 10;

            }else if($value >= 70){
                //Vantagem
                $soma_atributos += 10;
            }
        }

        $periculosidade = ($soma_atributos)/3;
        $faixa_periculosidade = '';

        switch($periculosidade){
            case $periculosidade >= 0 && $periculosidade <= 20:
                $faixa_periculosidade = 'Muito Baixa';
                break;

            case $periculosidade >= 21 && $periculosidade <= 40:
                $faixa_periculosidade = 'Baixa';
                break;

            case $periculosidade >= 41 && $periculosidade <= 60:
                $faixa_periculosidade = 'Media';
                break;

            case $periculosidade >= 61 && $periculosidade <= 80:
                $faixa_periculosidade = 'Alta';
                break;

            case $periculosidade >= 81 && $periculosidade <= 100:
                $faixa_periculosidade = 'Muita Alta';
                break;
        }

        $zombie->periculosidade = $faixa_periculosidade;
        $zombie->save();

        return response()->json($zombie);
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

        if($imc < 13){
            $faixa_imc = 'Desnutrição Grau IV';
        }else if($imc < 16){
            $faixa_imc = 'Desnutrição Grau III';
        }else if($imc < 17){
            $faixa_imc = 'Desnutrição Grau II';
        }else if($imc < 18.5){
            $faixa_imc = 'Desnutrição Grau I';
        }else if($imc < 25){
            $faixa_imc = 'Normal';
        }else if($imc < 30){
            $faixa_imc = 'Pré-obesidade';
        }else if($imc < 35){
            $faixa_imc = 'Obesidade Grau I';
        }else if($imc < 40){
            $faixa_imc = 'Obesidade Grau II';
        }else{
            $faixa_imc = 'Obesidade Grau III';
        }

        return $faixa_imc;
    }

    public function faixaDePontosPorAtributos($dados){
        $pontos_atributos = [];
        $faixa_imc = $this->calculoIndiceMassaCorporal($dados->peso, $dados->altura);

        //Idade        
        if($dados->idade <= 6){
            $pontos_atributos['idade']['forca'] = 1;
            $pontos_atributos['idade']['velocidade'] = 1;
            $pontos_atributos['idade']['inteligencia'] = 1;
        }else if(($dados->idade <= 9) || ($dados->idade >= 91 && $dados->idade <= 100)){
            $pontos_atributos['idade']['forca'] = 2;
            $pontos_atributos['idade']['velocidade'] = 2;
            $pontos_atributos['idade']['inteligencia'] = 2;
        }else if(($dados->idade <= 11) || ($dados->idade >= 81 && $dados->idade <= 90)){
            $pontos_atributos['idade']['forca'] = 3;
            $pontos_atributos['idade']['velocidade'] = 3;
            $pontos_atributos['idade']['inteligencia'] = 3;
        }else if(($dados->idade <= 14) || ($dados->idade >= 71 && $dados->idade <= 80)){
            $pontos_atributos['idade']['forca'] = 5;
            $pontos_atributos['idade']['velocidade'] = 5;
            $pontos_atributos['idade']['inteligencia'] = 5;
        }else if(($dados->idade <= 16) || ($dados->idade >= 61 && $dados->idade <= 70)){
            $pontos_atributos['idade']['forca'] = 6;
            $pontos_atributos['idade']['velocidade'] = 6;
            $pontos_atributos['idade']['inteligencia'] = 6;
        }else if(($dados->idade <= 20) || ($dados->idade >= 33 && $dados->idade <= 40)){
            $pontos_atributos['idade']['forca'] = 9;
            $pontos_atributos['idade']['velocidade'] = 9;
            $pontos_atributos['idade']['inteligencia'] = 9;
        }else if($dados->idade <= 50){
            $pontos_atributos['idade']['forca'] = 8;
            $pontos_atributos['idade']['velocidade'] = 8;
            $pontos_atributos['idade']['inteligencia'] = 8;
        }else if($dados->idade <= 60){
            $pontos_atributos['idade']['forca'] = 7;
            $pontos_atributos['idade']['velocidade'] = 7;
            $pontos_atributos['idade']['inteligencia'] = 7;
        }else if($dados->idade <= 32){
            $pontos_atributos['idade']['forca'] = 10;
            $pontos_atributos['idade']['velocidade'] = 10;
            $pontos_atributos['idade']['inteligencia'] = 10;
        }

        //IMC
        switch($faixa_imc){
            case'Desnutrição Grau IV':
                $pontos_atributos['imc']['forca'] = 1;
                $pontos_atributos['imc']['velocidade'] = 10;
                break;

            case'Desnutrição Grau III':
                $pontos_atributos['imc']['forca'] = 2;
                $pontos_atributos['imc']['velocidade'] = 9;
                break;

            case'Desnutrição Grau II':
                $pontos_atributos['imc']['forca'] = 3;
                $pontos_atributos['imc']['velocidade'] = 8;
                break;

            case'Desnutrição Grau I':
                $pontos_atributos['imc']['forca'] = 4;
                $pontos_atributos['imc']['velocidade'] = 7;
                break;

            case'Normal':
                $pontos_atributos['imc']['forca'] = 6;
                $pontos_atributos['imc']['velocidade'] = 6;
                break;

            case'Pré-obesidade':
                $pontos_atributos['imc']['forca'] = 7;
                $pontos_atributos['imc']['velocidade'] = 4;
                break;

            case'Obesidade Grau I':
                $pontos_atributos['imc']['forca'] = 8;
                $pontos_atributos['imc']['velocidade'] = 3;
                break;

            case'Obesidade Grau II':
                $pontos_atributos['imc']['forca'] = 9;
                $pontos_atributos['imc']['velocidade'] = 2;
                break;

            case'Obesidade Grau III':
                $pontos_atributos['imc']['forca'] = 10;
                $pontos_atributos['imc']['velocidade'] = 1;
                break;
        }

        //Sexo
        if($dados->sexo == 'M'){
            $pontos_atributos['sexo']['forca'] = random_int(3,10);
            $pontos_atributos['sexo']['velocidade'] = random_int(3,10);
            $pontos_atributos['sexo']['inteligencia'] = random_int(3,7);
        }else{
            $pontos_atributos['sexo']['forca'] = random_int(3,8);
            $pontos_atributos['sexo']['velocidade'] = random_int(3,8);
            $pontos_atributos['sexo']['inteligencia'] = random_int(3,10);
        }

        //Tipo sanguíneo
        $pontos_atributos['tipoSanguineo']['forca'] = random_int(1,10);
        $pontos_atributos['tipoSanguineo']['velocidade'] = random_int(1,10);
        $pontos_atributos['tipoSanguineo']['inteligencia'] = random_int(1,10);

        //Esporte
        switch($dados->esporte){
            case'Fut':
                $pontos_atributos['esporte']['forca'] = 6;
                $pontos_atributos['esporte']['velocidade'] = 7;
                $pontos_atributos['esporte']['inteligencia'] = 5;
                break;

            case'Bas':
                $pontos_atributos['esporte']['forca'] = 8;
                $pontos_atributos['esporte']['velocidade'] = 6;
                $pontos_atributos['esporte']['inteligencia'] = 7;
                break;

            case'Vol':
                $pontos_atributos['esporte']['forca'] = 7;
                $pontos_atributos['esporte']['velocidade'] = 5;
                $pontos_atributos['esporte']['inteligencia'] = 9;
                break;

            case'Lut':
                $pontos_atributos['esporte']['forca'] = 10;
                $pontos_atributos['esporte']['velocidade'] = 9;
                $pontos_atributos['esporte']['inteligencia'] = 7;
                break;

            case'Atl':
                $pontos_atributos['esporte']['forca'] = 7;
                $pontos_atributos['esporte']['velocidade'] = 10;
                $pontos_atributos['esporte']['inteligencia'] = 6;
                break;

            case'Esp':
                $pontos_atributos['esporte']['forca'] = 0;
                $pontos_atributos['esporte']['velocidade'] = 0;
                $pontos_atributos['esporte']['inteligencia'] = 10;
                break;

            case'Nad':
                $pontos_atributos['esporte']['forca'] = 0;
                $pontos_atributos['esporte']['velocidade'] = 0;
                $pontos_atributos['esporte']['inteligencia'] = 0;
                break;
        }

        //Jogo
        switch($dados->jogo){
            case'Cs':
                $pontos_atributos['jogo']['inteligencia'] = 6;
                break;
            case'Mine':
                $pontos_atributos['jogo']['inteligencia'] = 10;
                break;
            case'Fort':
                $pontos_atributos['jogo']['inteligencia'] = 9;
                break;
            case'Witch':
                $pontos_atributos['jogo']['inteligencia'] = 8;
                break;
            case'Val':
                $pontos_atributos['jogo']['inteligencia'] = 6;
                break;
            case'Ac':
                $pontos_atributos['jogo']['inteligencia'] = 7;
                break;
            case'Wow':
                $pontos_atributos['jogo']['inteligencia'] = 7;
                break;
            case'Fifa':
                $pontos_atributos['jogo']['inteligencia'] = 4;
                break;
            case'Lol':
                $pontos_atributos['jogo']['inteligencia'] = 2;
                break;
            case'Dota':
                $pontos_atributos['jogo']['inteligencia'] = 9;
                break;
            case'Rocket':
                $pontos_atributos['jogo']['inteligencia'] = 8;
                break;
            case'O':
                $pontos_atributos['jogo']['inteligencia'] = 5;
                break;
        }

        //Música
        switch($dados->estilo_musical){
            case'Pop':
                $pontos_atributos['musica']['forca'] = 3;
                $pontos_atributos['musica']['velocidade'] = 6;
                $pontos_atributos['musica']['inteligencia'] = 8;
                break;

            case'Roc':
                $pontos_atributos['musica']['forca'] = 9;
                $pontos_atributos['musica']['velocidade'] = 4;
                $pontos_atributos['musica']['inteligencia'] = 6;
                break;

            case'Pag':
                $pontos_atributos['musica']['forca'] = 2;
                $pontos_atributos['musica']['velocidade'] = 8;
                $pontos_atributos['musica']['inteligencia'] = 8;
                break;

            case'Ser':
                $pontos_atributos['musica']['forca'] = 1;
                $pontos_atributos['musica']['velocidade'] = 6;
                $pontos_atributos['musica']['inteligencia'] = 7;
                break;

            case'Hip':
                $pontos_atributos['musica']['forca'] = 7;
                $pontos_atributos['musica']['velocidade'] = 7;
                $pontos_atributos['musica']['inteligencia'] = 10;
                break;

            case'Ele':
                $pontos_atributos['musica']['forca'] = 6;
                $pontos_atributos['musica']['velocidade'] = 10;
                $pontos_atributos['musica']['inteligencia'] = 6;
                break;

            case'Fun':
                $pontos_atributos['musica']['forca'] = 6;
                $pontos_atributos['musica']['velocidade'] = 7;
                $pontos_atributos['musica']['inteligencia'] = 2;
                break;

            case'Met':
                $pontos_atributos['musica']['forca'] = 10;
                $pontos_atributos['musica']['velocidade'] = 3;
                $pontos_atributos['musica']['inteligencia'] = 4;
                break;

            case'Out':
                $pontos_atributos['musica']['forca'] = 5;
                $pontos_atributos['musica']['velocidade'] = 5;
                $pontos_atributos['musica']['inteligencia'] = 5;
                break;
        }

        return $pontos_atributos;
    }
}

