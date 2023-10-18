<?php

namespace App\Http\Controllers;

use App\Models\Zumbi;
use App\Models\ZumbiCounter;
use App\Models\ZumbiWeakness;
use App\Models\ZumbiDefense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ZumbisController extends Controller
{
    public function index(){
        $zumbis = Zumbi::all();
        return response()->json(["message" => "Listando todos os zumbis.", "data" => $zumbis], 200);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'idade' => ['required','numeric','min:1','max:130'],
            'sexo' => ['required', Rule::in(['M', 'F'])],
            'tipo_sanguineo' => ['required', Rule::in(['AB+', 'AB-', 'O+', 'O-', 'A+', 'A-', 'B+', 'B-'])],
            'peso' => ['required','decimal:0,2','min:1','max:700'],
            'altura' => ['required','decimal:0,2','min:1','max:3'],
            'estilo_musical' => ['required', Rule::in(['Pop', 'Rock', 'Pagode', 'Sertanejo', 'Hip-Hop/Rap', 'Eletronica', 'Funk', 'Metal', 'Outros'])],
            'esporte' => ['required', Rule::in(['Futebol', 'Basquete', 'Volei', 'Luta', 'Atletismo', 'eSports', 'Nada'])],
            'jogo' => ['required', Rule::in(['Counter-Strike', 'Minecraft', 'Fortnite', 'The Witcher', 'Valorant', "Assassin's Creed", 'Warcraft', 'FIFA', 'League of Legends', 'Dota', 'Rocket League', 'Outros'])]
        ],[
            'peso.decimal' => "O campo peso deve apresentar um formato semelhante a este '75.50'",
            'altura.decimal' => "O campo altura deve apresentar um formato semelhante a este '1.80'",
        ]);

        if($validator->fails()){
            return response()->json(["error" => 'Informação inválida.', "message" => $validator->errors()], 422);
        }
            
        $zumbi = new Zumbi();
        $zumbi->fill($request->all());

        if($zumbi->gender == 'M'){
            $imagemZumbi = 'zumbiMasculino'.random_int(0,4).'.jpg';
        }else{
            $imagemZumbi = 'zumbiFeminino'.random_int(0,4).'.jpg';
        }

        $zumbi->image = $imagemZumbi;

        $resposta = $this->analiseDeAtributos($zumbi);
        if($resposta == 'S'){
            return response()->json(["error" => 'Ocorreu um erro ao calcular os atributos do zumbi. Tente Novamente.', "message" => $resposta['message']], 400);
        }

        $this->analiseDePerigo($zumbi);
        if($resposta == 'S'){
            return response()->json(["error" => 'Ocorreu um erro ao calcular o nível de perigo do zumbi. Tente Novamente.', "message" => $resposta['message']], 400);
        }

        $zumbi->save();
        return response()->json(["message" => "Zumbi cadastrado com sucesso.", "data" => $zumbi], 201);
    }

    public function show($id){
        $zumbi = Zumbi::find($id);

        if(!$zumbi){
            return response()->json(
                ["error" => 'Zumbi não encontrado.', 'message' => 'O identificador fornecido não se refere a nenhum zumbi já catalogado.'], 404
            );
        }

        return response()->json(["message" => "Zumbi localizado.", "data" => $zumbi], 200);
    }

    public function analiseDeAtributos($zumbi){
        //Calculo de Atríbutos
        $pesoTotal = 2;
        $arrayPontuacao = $this->faixaDePontosPorAtributos($zumbi);

        //Força
        $mutacaoForca = $this->fatorMutagenico($zumbi->blood_type) * 0.1;
        $pesoTotalForca = $pesoTotal + $mutacaoForca;
            // -> Idade
            $valorIdade = $arrayPontuacao['age']['strength'] * 0.5;
            // -> Sexo
            $valorSexo = $arrayPontuacao['gender']['strength'] * 0.3;
            // -> Imc
            $valorImc = $arrayPontuacao['Imc']['strength'] * 0.6;
            // -> Esporte
            $valorEsporte = $arrayPontuacao['sport']['strength'] * 0.4;
            // -> Musica
            $valorMusica = $arrayPontuacao['music_style']['strength'] * 0.2;
            // -> Sanguineo
            $valorSangue = $arrayPontuacao['blood_type']['strength'] * $mutacaoForca;

        $atributoForca = (($valorIdade + $valorSexo + $valorImc + $valorEsporte + $valorMusica + $valorSangue)/$pesoTotalForca) * 10;

        //Velocidade
        $mutacaoVelocidade = $this->fatorMutagenico($zumbi->tipo_sanguineo) * 0.1;
        $pesoTotalVelocidade = $pesoTotal + $mutacaoVelocidade;
            // -> Idade
            $valorIdade = $arrayPontuacao['age']['velocity'] * 0.4;
            // -> Sexo
            $valorSexo = $arrayPontuacao['gender']['velocity'] * 0.3;
            // -> Imc
            $valorImc = $arrayPontuacao['Imc']['velocity'] * 0.6;
            // -> Esporte
            $valorEsporte = $arrayPontuacao['sport']['velocity'] * 0.5;
            // -> Musica
            $valorMusica = $arrayPontuacao['music_style']['velocity'] * 0.2;
            // -> Sanguineo
            $valorSangue = $arrayPontuacao['blood_type']['velocity'] * $mutacaoVelocidade;

        $atributoVelocidade = (($valorIdade + $valorSexo + $valorImc + $valorEsporte + $valorMusica + $valorSangue)/$pesoTotalVelocidade) * 10;

        //Inteligência
        $mutacaoInteligencia = $this->fatorMutagenico($zumbi->tipo_sanguineo) * 0.1;
        $pesoTotalInteligencia = $pesoTotal + $mutacaoInteligencia;
            // -> Idade
            $valorIdade = $arrayPontuacao['age']['intelligence'] * 0.5;
            // -> Sexo
            $valorSexo = $arrayPontuacao['gender']['intelligence'] * 0.2;
            // -> Jogo
            $valorJogo = $arrayPontuacao['favorite_game']['intelligence'] * 0.3;
            // -> Esporte
            $valorEsporte = $arrayPontuacao['sport']['intelligence'] * 0.4;
            // -> Musica
            $valorMusica = $arrayPontuacao['music_style']['intelligence'] * 0.6;
            // -> Sanguineo
            $valorSangue = $arrayPontuacao['blood_type']['intelligence'] * $mutacaoInteligencia;

        $atributoInteligencia = (($valorIdade + $valorSexo + $valorJogo + $valorEsporte + $valorMusica + $valorSangue)/$pesoTotalInteligencia) * 10;
        
        $zumbi->strength = round($atributoForca);
        $zumbi->velocity = round($atributoVelocidade);
        $zumbi->intelligence = round($atributoInteligencia);

        return ['error' => 'N', 'Análise de atributos finalizada.'];
    }

    public function analiseDePerigo($zumbi){
        $ZumbiDefense = new ZumbiDefense;
        $ZumbiCounter = new ZumbiCounter;
        $ZumbiWeakness = new ZumbiWeakness;

        $resultadoCalculos = $this->calculoDePeculiaridades($zumbi);

        $perigo = ($resultadoCalculos['total'])/3;
        $faixaPerigo = '';

        switch($perigo){
            case $perigo >= 0 && $perigo <= 20:
                $faixaPerigo = 'Muito Baixa';
                break;

            case $perigo >= 21 && $perigo <= 40:
                $faixaPerigo = 'Baixa';
                break;

            case $perigo >= 41 && $perigo <= 60:
                $faixaPerigo = 'Media';
                break;

            case $perigo >= 61 && $perigo <= 80:
                $faixaPerigo = 'Alta';
                break;

            case $perigo >= 81 && $perigo <= 100:
                $faixaPerigo = 'Muita Alta';
                break;
        }

        // $pontoFraco = $ZumbiWeakness->analisandoFraquezas($resultadoCalculos['desvantagem']);
        // $defesa = $ZumbiDefense->selecionarManobrasDeDefesa($resultadoCalculos['vantagem']);
        // $contraAtaque = $ZumbiCounter->selecionarManobrasDeAtaque($resultadoCalculos['desvantagem']);

        $zumbi->dangerousness = $faixaPerigo;

        return ['error' => 'N', 'Análise de perigo finalizada.'];
    }

    //Métodos de apoio
    public function fatorMutagenico($bloodType){
        switch($bloodType){
            case'AB+':
                $fatorMutagenico = random_int(1, 10);
                break;

            case'AB-':
            case'A+':
            case'A-':
            case'B+':
            case'B-':
                $fatorMutagenico = random_int(2, 4);
                break;

            case'O-':
                $fatorMutagenico = 1;
                break;

            default:
                $fatorMutagenico = random_int(1, 10);
                break;
        }

        return $fatorMutagenico;
    }

    public function calculoIndiceMassaCorporal($weight, $height){
        $Imc = $weight / ($height**2);

        switch($Imc){
            case $Imc < 13:
                $faixaDeClassificacao = 'Desnutrição Grau IV';
                break;

            case $Imc < 16:
                $faixaDeClassificacao = 'Desnutrição Grau III';
                break;  

            case $Imc < 17:
                $faixaDeClassificacao = 'Desnutrição Grau II';
                break;

            case $Imc < 18.5:
                $faixaDeClassificacao = 'Desnutrição Grau I';
                break;

            case $Imc < 25:
                $faixaDeClassificacao = 'Normal';
                break;

            case $Imc < 30:
                $faixaDeClassificacao = 'Pré-obesidade';
                break;

            case $Imc < 35:
                $faixaDeClassificacao = 'Obesidade Grau I';
                break;

            case $Imc < 40:
                $faixaDeClassificacao = 'Obesidade Grau II';
                break;

            default:
                $faixaDeClassificacao = 'Obesidade Grau III';
                break;
        }

        return $faixaDeClassificacao;
    }

    public function faixaDePontosPorAtributos($zumbi){
        $arrayPontuacao = [];
        $faixaImc = $this->calculoIndiceMassaCorporal($zumbi->weight, $zumbi->height);

        //Idade        
        if($zumbi->age <= 6){
            $arrayPontuacao['age']['strength'] = 1;
            $arrayPontuacao['age']['velocity'] = 1;
            $arrayPontuacao['age']['intelligence'] = 1;
        }else if(($zumbi->age <= 9) || ($zumbi->age >= 91 && $zumbi->age <= 100)){
            $arrayPontuacao['age']['strength'] = 2;
            $arrayPontuacao['age']['velocity'] = 2;
            $arrayPontuacao['age']['intelligence'] = 2;
        }else if(($zumbi->age <= 11) || ($zumbi->age >= 81 && $zumbi->age <= 90)){
            $arrayPontuacao['age']['strength'] = 3;
            $arrayPontuacao['age']['velocity'] = 3;
            $arrayPontuacao['age']['intelligence'] = 3;
        }else if(($zumbi->age <= 14) || ($zumbi->age >= 71 && $zumbi->age <= 80)){
            $arrayPontuacao['age']['strength'] = 5;
            $arrayPontuacao['age']['velocity'] = 5;
            $arrayPontuacao['age']['intelligence'] = 5;
        }else if(($zumbi->age <= 16) || ($zumbi->age >= 61 && $zumbi->age <= 70)){
            $arrayPontuacao['age']['strength'] = 6;
            $arrayPontuacao['age']['velocity'] = 6;
            $arrayPontuacao['age']['intelligence'] = 6;
        }else if(($zumbi->age <= 20) || ($zumbi->age >= 33 && $zumbi->age <= 40)){
            $arrayPontuacao['age']['strength'] = 9;
            $arrayPontuacao['age']['velocity'] = 9;
            $arrayPontuacao['age']['intelligence'] = 9;
        }else if($zumbi->age <= 50){
            $arrayPontuacao['age']['strength'] = 8;
            $arrayPontuacao['age']['velocity'] = 8;
            $arrayPontuacao['age']['intelligence'] = 8;
        }else if($zumbi->age <= 60){
            $arrayPontuacao['age']['strength'] = 7;
            $arrayPontuacao['age']['velocity'] = 7;
            $arrayPontuacao['age']['intelligence'] = 7;
        }else if($zumbi->age <= 32){
            $arrayPontuacao['age']['strength'] = 10;
            $arrayPontuacao['age']['velocity'] = 10;
            $arrayPontuacao['age']['intelligence'] = 10;
        }

        //Imc
        switch($faixaImc){
            case'Desnutrição Grau IV':
                $arrayPontuacao['Imc']['strength'] = 1;
                $arrayPontuacao['Imc']['velocity'] = 10;
                break;

            case'Desnutrição Grau III':
                $arrayPontuacao['Imc']['strength'] = 2;
                $arrayPontuacao['Imc']['velocity'] = 9;
                break;

            case'Desnutrição Grau II':
                $arrayPontuacao['Imc']['strength'] = 3;
                $arrayPontuacao['Imc']['velocity'] = 8;
                break;

            case'Desnutrição Grau I':
                $arrayPontuacao['Imc']['strength'] = 4;
                $arrayPontuacao['Imc']['velocity'] = 7;
                break;

            case'Normal':
                $arrayPontuacao['Imc']['strength'] = 6;
                $arrayPontuacao['Imc']['velocity'] = 6;
                break;

            case'Pré-obesidade':
                $arrayPontuacao['Imc']['strength'] = 7;
                $arrayPontuacao['Imc']['velocity'] = 4;
                break;

            case'Obesidade Grau I':
                $arrayPontuacao['Imc']['strength'] = 8;
                $arrayPontuacao['Imc']['velocity'] = 3;
                break;

            case'Obesidade Grau II':
                $arrayPontuacao['Imc']['strength'] = 9;
                $arrayPontuacao['Imc']['velocity'] = 2;
                break;

            case'Obesidade Grau III':
                $arrayPontuacao['Imc']['strength'] = 10;
                $arrayPontuacao['Imc']['velocity'] = 1;
                break;
        }

        //Sexo
        if($zumbi->gender == 'M'){
            $arrayPontuacao['gender']['strength'] = random_int(3,10);
            $arrayPontuacao['gender']['velocity'] = random_int(3,10);
            $arrayPontuacao['gender']['intelligence'] = random_int(3,7);
        }else{
            $arrayPontuacao['gender']['strength'] = random_int(3,8);
            $arrayPontuacao['gender']['velocity'] = random_int(3,8);
            $arrayPontuacao['gender']['intelligence'] = random_int(3,10);
        }

        //Tipo sanguíneo
        $arrayPontuacao['blood_type']['strength'] = random_int(1,10);
        $arrayPontuacao['blood_type']['velocity'] = random_int(1,10);
        $arrayPontuacao['blood_type']['intelligence'] = random_int(1,10);

        //Esporte
        switch($zumbi->sport){
            case'Futebol':
                $arrayPontuacao['sport']['strength'] = 6;
                $arrayPontuacao['sport']['velocity'] = 7;
                $arrayPontuacao['sport']['intelligence'] = 5;
                break;

            case'Basquete':
                $arrayPontuacao['sport']['strength'] = 8;
                $arrayPontuacao['sport']['velocity'] = 6;
                $arrayPontuacao['sport']['intelligence'] = 7;
                break;

            case'Volei':
                $arrayPontuacao['sport']['strength'] = 7;
                $arrayPontuacao['sport']['velocity'] = 5;
                $arrayPontuacao['sport']['intelligence'] = 9;
                break;

            case'Luta':
                $arrayPontuacao['sport']['strength'] = 10;
                $arrayPontuacao['sport']['velocity'] = 9;
                $arrayPontuacao['sport']['intelligence'] = 7;
                break;

            case'Atletismo':
                $arrayPontuacao['sport']['strength'] = 7;
                $arrayPontuacao['sport']['velocity'] = 10;
                $arrayPontuacao['sport']['intelligence'] = 6;
                break;

            case'eSports':
                $arrayPontuacao['sport']['strength'] = 0;
                $arrayPontuacao['sport']['velocity'] = 0;
                $arrayPontuacao['sport']['intelligence'] = 10;
                break;

            case'Nada':
                $arrayPontuacao['sport']['strength'] = 0;
                $arrayPontuacao['sport']['velocity'] = 0;
                $arrayPontuacao['sport']['intelligence'] = 0;
                break;
        }

        //Jogo
        switch($zumbi->favorite_game){
            case'Counter-Strike':
                $arrayPontuacao['favorite_game']['intelligence'] = 6;
                break;
            case'Minecraft':
                $arrayPontuacao['favorite_game']['intelligence'] = 10;
                break;
            case'Fortnite':
                $arrayPontuacao['favorite_game']['intelligence'] = 9;
                break;
            case'The Witcher':
                $arrayPontuacao['favorite_game']['intelligence'] = 8;
                break;
            case'Valorant':
                $arrayPontuacao['favorite_game']['intelligence'] = 6;
                break;
            case"Assassin's Creed":
                $arrayPontuacao['favorite_game']['intelligence'] = 7;
                break;
            case'Warcraft':
                $arrayPontuacao['favorite_game']['intelligence'] = 7;
                break;
            case'FIFA':
                $arrayPontuacao['favorite_game']['intelligence'] = 4;
                break;
            case'League of Legends':
                $arrayPontuacao['favorite_game']['intelligence'] = 2;
                break;
            case'Dota':
                $arrayPontuacao['favorite_game']['intelligence'] = 9;
                break;
            case'Rocket League':
                $arrayPontuacao['favorite_game']['intelligence'] = 8;
                break;
            case'Outros':
                $arrayPontuacao['favorite_game']['intelligence'] = 5;
                break;
        }

        //Música
        switch($zumbi->music_style){
            case'Pop':
                $arrayPontuacao['music_style']['strength'] = 3;
                $arrayPontuacao['music_style']['velocity'] = 6;
                $arrayPontuacao['music_style']['intelligence'] = 8;
                break;

            case'Rock':
                $arrayPontuacao['music_style']['strength'] = 9;
                $arrayPontuacao['music_style']['velocity'] = 4;
                $arrayPontuacao['music_style']['intelligence'] = 6;
                break;

            case'Pagode':
                $arrayPontuacao['music_style']['strength'] = 2;
                $arrayPontuacao['music_style']['velocity'] = 8;
                $arrayPontuacao['music_style']['intelligence'] = 8;
                break;

            case'Sertanejo':
                $arrayPontuacao['music_style']['strength'] = 1;
                $arrayPontuacao['music_style']['velocity'] = 6;
                $arrayPontuacao['music_style']['intelligence'] = 7;
                break;

            case'Hip-Hop/Rap':
                $arrayPontuacao['music_style']['strength'] = 7;
                $arrayPontuacao['music_style']['velocity'] = 7;
                $arrayPontuacao['music_style']['intelligence'] = 10;
                break;

            case'Eletronica':
                $arrayPontuacao['music_style']['strength'] = 6;
                $arrayPontuacao['music_style']['velocity'] = 10;
                $arrayPontuacao['music_style']['intelligence'] = 6;
                break;

            case'Funk':
                $arrayPontuacao['music_style']['strength'] = 6;
                $arrayPontuacao['music_style']['velocity'] = 7;
                $arrayPontuacao['music_style']['intelligence'] = 2;
                break;

            case'Metal':
                $arrayPontuacao['music_style']['strength'] = 10;
                $arrayPontuacao['music_style']['velocity'] = 3;
                $arrayPontuacao['music_style']['intelligence'] = 4;
                break;

            case'Outros':
                $arrayPontuacao['music_style']['strength'] = 5;
                $arrayPontuacao['music_style']['velocity'] = 5;
                $arrayPontuacao['music_style']['intelligence'] = 5;
                break;
        }

        return $arrayPontuacao;
    }

    public function calculoDePeculiaridades($zumbi){
        $arrayNivelPerigo = [];
        $arrayNivelPerigo['strength'] = $zumbi->strength;
        $arrayNivelPerigo['velocity'] = $zumbi->velocity;
        $arrayNivelPerigo['intelligence'] = $zumbi->intelligence;

        $somaAtributos = 0;
        $somaBonus = 0;
        $atributosVantagem = '';
        $atributosDesvantagem = '';

        foreach($arrayNivelPerigo as $key => $value){
            $somaAtributos += $value;

            if($value <= 40){
                //Desvantagem
                $somaBonus -= 10;

                if($key == 'strength'){
                    $atributosDesvantagem .= 'S';
                }else if($key == 'velocity'){
                    $atributosDesvantagem .= 'V';
                }else{
                    $atributosDesvantagem .= 'I';
                }
            }else if($value >= 80){
                //Vantagem
                $somaBonus += 10;

                if($key == 'strength'){
                    $atributosVantagem .= 'S';
                }else if($key == 'velocity'){
                    $atributosVantagem .= 'V';
                }else{
                    $atributosVantagem .= 'I';
                }
            }
        }

        return [
            'vantagem' => $atributosVantagem,
            'desvantagem' => $atributosDesvantagem,
            'somaBonus' => $somaBonus,
            'somaAtributos' => $somaAtributos,
            'total' => $somaAtributos + $somaBonus
        ];
    }
}
