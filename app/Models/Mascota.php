<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas';

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'edad',
        'genero',
        'tamano',
        'descripcion',
        'estado',
        'foto',
        'user_id',
    ];

    public static function rules($isUpdate = false, $id = null)
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:100',
            'raza' => 'required|string|max:100',
            'edad' => 'required|integer|min:0|max:50',
            'genero' => 'required|in:Macho,Hembra',
            'tamano' => 'required|in:Pequeño,Mediano,Grande',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:Disponible,Adoptada',
            'foto' => 'nullable|string|max:255',
        ];

        if (!$isUpdate) {
            // No additional for create
        }

        return $rules;
    }
}
