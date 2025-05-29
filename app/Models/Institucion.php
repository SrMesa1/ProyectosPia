<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
      use HasFactory;

    protected $table = 'institucion';
    protected $primaryKey = 'id_institucion';
    public $timestamps = false;

    public function facultades()
    {
        return $this->hasMany(Facultad::class, 'id_institucion');
    }
}
