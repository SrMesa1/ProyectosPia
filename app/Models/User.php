<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\Evaluador;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'tipo_usuario',
        'perfil_completado'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'perfil_completado' => 'boolean',
    ];

    /**
     * Verifica si el usuario ha completado su perfil según su tipo
     */
    public function hasCompletedProfile(): bool
    {
        return match($this->tipo_usuario) {
            'estudiante' => Estudiante::where('correo', $this->email)->exists(),
            'docente' => Docente::where('correo', $this->email)->exists(),
            'evaluador' => Evaluador::where('correo', $this->email)->exists(),
            default => true,
        };
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id_usuario');
    }

    public function docente()
    {
        return $this->hasOne(Docente::class, 'id_usuario');
    }

    public function evaluador()
    {
        return $this->hasOne(Evaluador::class, 'id_usuario');
    }
}
