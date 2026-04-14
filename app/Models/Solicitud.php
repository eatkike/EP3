<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = ['usuario_id', 'mascota_id', 'motivo', 'estado'];

public function usuario() { return $this->belongsTo(Usuarios::class, 'usuario_id'); }
public function mascota() { return $this->belongsTo(Mascota::class, 'mascota_id'); }
}
