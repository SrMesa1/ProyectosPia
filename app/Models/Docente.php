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

    protected $fillable = [
        'nombre',
        'numero_empleado',
        'especialidad',
        'correo',
        'id_programa'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'docente_asignatura', 'id_docente', 'id_asignatura')
            ->withPivot('grupo')
            ->withTimestamps();
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_asignaturas', 'id_docente', 'id_proyecto')
            ->withPivot(['id_asignatura', 'grupo'])
            ->with(['tipoProyecto', 'asignaturas']);
    }
}
