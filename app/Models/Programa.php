<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programa';
    protected $primaryKey = 'id_programa';
    public $timestamps = false;

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'id_programa');
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_programa');
    }
}
