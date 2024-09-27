<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    // use HasFactory;
    protected $table='movimiento';
    public $timestamps=false;
    protected $fillable = [
        'tipo_movimiento_id',
        'equipo_id',
        'fecha_hora',
    ];
}
