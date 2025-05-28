<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiante';
    protected $primaryKey = 'id_estudiante';
    public $timestamps = false;

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_estudiantes', 'id_estudiante', 'id_proyecto');
    }
}
