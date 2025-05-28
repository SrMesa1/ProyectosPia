<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
     use HasFactory;

    protected $table = 'docente';
    protected $primaryKey = 'id_docente';
    public $timestamps = false;

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_asignaturas', 'id_docente', 'id_proyecto')
            ->withPivot('id_asignatura', 'grupo');
    }
}
