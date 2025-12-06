<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestamo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'socio_id',
        'monto',
        'tasa_interes',
        'plazo_meses',
        'fecha_desembolso',
        'estado',
        'observaciones',
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function cuotas()
    {
        return $this->hasMany(Cuota::class);
    }
}
