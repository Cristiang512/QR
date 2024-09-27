<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    // use HasFactory;
    protected $table='visitante';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'last_name',
        'document',
        'tipo_visitante_id'
    ];
}
