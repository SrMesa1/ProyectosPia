<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre_usuario',
        'email',
        'password',
        'id_estudiante',
        'id_docente',
        'id_evaluador',
        'id_tipo_usuario',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relaciones
    public function estudiante() { 
        return $this->belongsTo(Estudiante::class, 'id_estudiante'); 
    }
    
    public function docente() { 
        return $this->belongsTo(Docente::class, 'id_docente'); 
    }
    
    public function evaluador() { 
        return $this->belongsTo(Evaluador::class, 'id_evaluador'); 
    }
    
    public function tipoUsuario() { 
        return $this->belongsTo(TipoUsuario::class, 'id_tipo_usuario', 'id_tipo_usuario'); 
    }
    
    public function roles() { 
        return $this->belongsToMany(Rol::class, 'usuario_rol', 'id_usuario', 'id_rol'); 
    }
}

