<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;


class Usuarios extends Authenticatable 
{
    use hasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre', 
        'apellido', 
        'email', 
        'password',
        'is_admin', // Agregar el campo is_admin a los campos asignables
    ];

    protected $casts = [
        'is_admin' => 'boolean', // Asegurar que is_admin se trate como booleano
    ];

    
    public static function rules($isUpdate = false, $id = null)
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email' . ($isUpdate ? ",$id" : ""),
            'password' => $isUpdate ? 'nullable|min:8' : 'required|min:8',
        ];
    }

   
    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }
}