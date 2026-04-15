<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Mascota;

class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mascotas = Mascota::all();
        // aleatorio entre perro y gato
        $animalRandom = rand(0, 1) ? 'dog' : 'cat';
        
        //Para animales aleatorios de la API de API Ninjas, se puede usar el siguiente código:
        //$animalRandom = ['dog', 'cat', 'fox', 'rabbit'][array_rand(['dog', 'cat', 'fox', 'rabbit'])];
        
        // consumir API
        $respuesta = Http::withHeaders([
            'X-Api-Key' => config('services.api_ninjas.key')
        ])->get("https://api.api-ninjas.com/v1/animals?name={$animalRandom}");

        $datos = $respuesta->json();
        $animalApi =  !empty($datos) ? $datos[array_rand($datos)] : null;

        return view('mascotas.index', compact('mascotas', 'animalApi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mascotas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Mascota::rules());

        Mascota::create($request->all());

        return redirect()->route('mascotas.index')->with('success', 'Mascota registrada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mascota = Mascota::findOrFail($id);
        return view('mascotas.show', compact('mascota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mascota = Mascota::findOrFail($id);
        return view('mascotas.edit', compact('mascota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mascota = Mascota::findOrFail($id);
        
        $request->validate(Mascota::rules(true, $id));

        $mascota->update($request->all());
        
        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->delete();
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada exitosamente!');
    }
}
