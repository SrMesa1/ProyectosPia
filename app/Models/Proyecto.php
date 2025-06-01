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
        'id_tipo_proyecto',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'id_estudiante',
        'id_asignatura',
        'grupo'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date'
    ];

    const ESTADOS = [
        'pendiente' => 'Pendiente',
        'en_curso' => 'En Curso',
        'completado' => 'Completado',
        'cancelado' => 'Cancelado'
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

    public function tipoProyecto()
    {
        return $this->belongsTo(TipoProyecto::class, 'id_tipo_proyecto');
    }

    public function getEstadoNombreAttribute()
    {
        return self::ESTADOS[$this->estado] ?? $this->estado;
    }
}
