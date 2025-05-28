<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
     use HasFactory;

    protected $table = 'departamento';
    protected $primaryKey = 'id_departamento';
    public $timestamps = false;

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'id_facultad');
    }

    public function programas()
    {
        return $this->hasMany(Programa::class, 'id_departamento');
    }

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'id_departamento');
    }
}
