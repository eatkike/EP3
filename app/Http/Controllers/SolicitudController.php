<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;


class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            
            $solicitudes = Solicitud::with(['usuario', 'mascota'])->latest()->get();
        } else {
            
            $solicitudes = Solicitud::where('usuario_id', Auth::id())
                ->with('mascota')
                ->latest()
                ->get();
        }

        return view('solicitud.index', compact('solicitudes'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $mascota_id = $request->query('mascota_id');
        $mascota = Mascota::findOrFail($mascota_id);

        return view('solicitud.create', compact('mascota'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'motivo' => 'required|string|max:1000',
        ]);

        Solicitud::create([
            'usuario_id' => Auth::id(),
            'mascota_id' => $request->mascota_id,
            'motivo' => $request->motivo,
            'estado' => 'Pendiente',
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud enviada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'No autorizado');
        }

    $request->validate([
            'estado' => 'required|in:Pendiente,Aprobada,Rechazada',
        ]);

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update(['estado' => $request->estado]);

        return redirect()->route('solicitudes.index')
            ->with('success', 'El estado de la solicitud ha sido actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        
        // Solo el dueño de la solicitud o el admin pueden borrarla
        if (Auth::id() !== $solicitud->usuario_id && !Auth::user()->is_admin) {
            return abort(403);
        }

        $solicitud->delete();

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud eliminada correctamente.');
    }
}
