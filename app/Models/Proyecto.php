<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
     use HasFactory;

    protected $table = 'proyecto';
    protected $primaryKey = 'id_proyecto';
    public $timestamps = false;

    public function tipoProyecto()
    {
        return $this->belongsTo(TipoProyecto::class, 'id_tipo_proyecto');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'proyecto_estudiantes', 'id_proyecto', 'id_estudiante');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'proyecto_asignaturas', 'id_proyecto', 'id_asignatura')
            ->withPivot('grupo', 'id_docente');
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'id_proyecto');
    }

    public function evaluadores()
    {
        return $this->belongsToMany(Evaluador::class, 'proyecto_evaluaciones', 'id_proyecto', 'id_evaluador')
            ->withPivot('criterio', 'resultado');
    }
}
