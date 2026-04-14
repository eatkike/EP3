<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    protected $fillable = ['usuario_id', 'mascota_id', 'motivo', 'estado'];

public function usuario() { return $this->belongsTo(Usuarios::class, 'usuario_id'); }
public function mascota() { return $this->belongsTo(Mascota::class, 'mascota_id'); }
}
