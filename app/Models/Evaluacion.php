<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluacion';
    protected $primaryKey = 'id_evaluacion';

    protected $fillable = [
        'id_proyecto',
        'id_evaluador',
        'calificacion',
        'comentarios',
        'fecha_evaluacion'
    ];

    protected $casts = [
        'fecha_evaluacion' => 'datetime',
        'calificacion' => 'float'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }

    public function evaluador()
    {
        return $this->belongsTo(Evaluador::class, 'id_evaluador');
    }
}
