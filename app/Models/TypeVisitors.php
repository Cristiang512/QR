<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVisitors extends Model
{
    // use HasFactory;
    protected $table='type_visitors';
    public $timestamps=false;
    protected $fillable = [
        'name',
    ];
}
