<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuarios extends Authenticatable 
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre', 
        'apellido', 
        'email', 
        'password',
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
}