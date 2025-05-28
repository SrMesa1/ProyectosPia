<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoEstudiante extends Model
{
     protected $table = 'proyecto_estudiantes';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_proyecto', 'id_estudiante'];
}
