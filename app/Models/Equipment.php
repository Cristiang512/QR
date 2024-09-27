<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    // use HasFactory;
    protected $table='equipo';
    public $timestamps=false;
    protected $fillable = [
        'type',
        'brand_id',
        'serial',
        'visitante_id',
    ];
}
