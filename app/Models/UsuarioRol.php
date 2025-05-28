<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
    protected $table = 'usuario_rol';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_usuario', 'id_rol'];
}
