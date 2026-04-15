<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Mascota;

class HomeController extends Controller
{
    public function index()
    {
        
        // Obtener las 3 mascotas más recientes
        $mascotas = Mascota::latest()->take(3)->get();

         // Elegir animal aleatorio
        $animalR = rand(0,1) ? 'dog' : 'cat';

        // Obtener dato curioso DE LA API DE SOME RANDOM API
        $respuesta = Http::get("https://some-random-api.com/animal/{$animalR}");
        $datoCurioso = $respuesta->json();

        // Traducir el dato curioso
        $datoTraducido = null;

        if (isset($datoCurioso['fact'])) {

            $texto = $datoCurioso['fact'];

            // API de traducción libre
            $traduccion = Http::get("https://api.mymemory.translated.net/get", [
                'q' => $texto,
                'langpair' => 'en|es'
            ]);

            $data = $traduccion->json();

            $datoTraducido = $data['responseData']['translatedText'] ?? $texto;

            }

        // Enviar todo a la vista
        return view('welcome', compact('mascotas', 'animalR', 'datoCurioso', 'datoTraducido'));
        
    }
}
