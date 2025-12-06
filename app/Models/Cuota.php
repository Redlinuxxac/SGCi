<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'prestamo_id',
        'numero_cuota',
        'monto',
        'fecha_vencimiento',
        'estado',
    ];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }
}
