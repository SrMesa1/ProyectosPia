<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoEvaluaciones extends Model
{
    protected $table = 'proyecto_evaluaciones';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_proyecto', 'id_evaluador', 'criterio', 'resultado'];
}
