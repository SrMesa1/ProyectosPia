<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoAsignatura extends Model
{
    protected $table = 'proyecto_asignaturas';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_proyecto', 'id_asignatura', 'grupo', 'id_docente'];
}
