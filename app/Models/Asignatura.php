<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table = 'asignatura';
    protected $primaryKey = 'id_asignatura';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion'
    ];

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'docente_asignatura', 'id_asignatura', 'id_docente')
            ->withPivot('grupo')
            ->withTimestamps();
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_asignatura');
    }
}
