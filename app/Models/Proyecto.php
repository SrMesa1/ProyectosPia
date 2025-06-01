<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyecto';
    protected $primaryKey = 'id_proyecto';

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'estado',
        'id_estudiante',
        'id_asignatura',
        'grupo'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'id_asignatura');
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'id_proyecto');
    }
}
