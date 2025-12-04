<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'asiento_contable_id',
        'cuenta_contable_id',
        'debe',
        'haber',
        'descripcion',
    ];

    /**
     * Get the journal entry that the line item belongs to.
     */
    public function asientoContable()
    {
        return $this->belongsTo(AsientoContable::class);
    }

    /**
     * Get the account for the line item.
     */
    public function cuentaContable()
    {
        return $this->belongsTo(CuentaContable::class);
    }
}
