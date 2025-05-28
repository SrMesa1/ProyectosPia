<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true; // o false si no usas created_at/updated_at

    protected $fillable = [
        'nombre_usuario',
        'contraseña',
        'id_estudiante',
        'id_docente',
        'id_evaluador',
        'id_tipo_usuario',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->contraseña; // importante si el campo no se llama 'password'
    }

    // Relaciones
    public function estudiante() { return $this->belongsTo(Estudiante::class, 'id_estudiante'); }
    public function docente() { return $this->belongsTo(Docente::class, 'id_docente'); }
    public function evaluador() { return $this->belongsTo(Evaluador::class, 'id_evaluador'); }
    public function tipoUsuario() { return $this->belongsTo(TipoUsuario::class, 'id_tipo_usuario'); }
    public function roles() { return $this->belongsToMany(Rol::class, 'usuario_rol', 'id_usuario', 'id_rol'); }
}

