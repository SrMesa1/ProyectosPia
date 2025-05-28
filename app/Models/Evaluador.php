<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluador extends Model
{
     use HasFactory;

    protected $table = 'evaluador';
    protected $primaryKey = 'id_evaluador';
    public $timestamps = false;

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'id_evaluador');
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_evaluaciones', 'id_evaluador', 'id_proyecto')
            ->withPivot('criterio', 'resultado');
    }
}
