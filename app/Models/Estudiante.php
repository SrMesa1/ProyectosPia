<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiante';
    
    protected $primaryKey = 'id_estudiante';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'codigo',
        'semestre',
        'id_programa',
        'id_usuario'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id_programa');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_estudiante', 'id_estudiante');
    }
}
