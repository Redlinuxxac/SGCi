<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsientoContable extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'descripcion',
        'referencia_type',
        'referencia_id',
        'estado',
    ];

    /**
     * Get all of the line items for the journal entry.
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    /**
     * Get the parent model that this entry refers to (e.g., Prestamo).
     */
    public function referencia()
    {
        return $this->morphTo();
    }
}
