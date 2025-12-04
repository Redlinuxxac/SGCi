<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nombres',
        'apellidos',
        'cedula',
        'fecha_ingreso',
        'estado',
        'direccion',
        'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
