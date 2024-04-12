<?php

namespace App\Http\Controllers;

use App\Models\Digimon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DigimonController extends Controller
{
    public function consulta()
    {
        try {
            $response = Http::get('https://digimon-api.vercel.app/api/digimon');

            if($response->successful()) {
                $responseData = $response->json();
                
                foreach($responseData as $digimon) {
                    $image = file_get_contents($digimon['img']); // Change from $digimon->img to $digimon['img']
                    $image_name = $digimon['name'] . '.jpg';
                    
                
                    if (!file_exists('img')) {
                        mkdir('img', 0777, true);
                    }

                    file_put_contents('img/' . $image_name, $image);

                    $dadosDigimon = Digimon::firstOrCreate([
                        'name'          => $digimon['name'],
                        'level'         => $digimon['level'],
                        'img'           => $digimon['img'],
                        'imgBaixada'    => 'img/'.$image_name,
                    ]);
                }

                return response()->json($dadosDigimon);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }  
    }

    public function baixarImagens()
    {
        $digimons = Digimon::all();

        foreach($digimons as $digimon) {
            $image = file_get_contents($digimon->img);
            $image_name = $digimon->name . '.jpg';
            
            // Verifica se o diretório 'img' existe, senão cria
            if (!file_exists('img')) {
                mkdir('img', 0777, true);
            }
            // Salva a imagem no diretório
            file_put_contents('img/' . $image_name, $image);
        }


        
        return response()->json(['message' => 'Imagens baixadas com sucesso!']);
    }


    public function index()
    {
        $digimons = Digimon::all();

        return view('Digimon.Index')->with('digimons', $digimons);
    }
}
