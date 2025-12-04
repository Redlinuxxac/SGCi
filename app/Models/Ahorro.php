<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ahorro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'socio_id',
        'tipo_cuenta',
        'saldo',
        'tasa_interes',
        'fecha_apertura',
        'estado',
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }
}
