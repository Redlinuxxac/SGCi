<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaContable extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'padre_id',
        'permite_transacciones',
    ];

    /**
     * Get the parent account of this account.
     */
    public function padre()
    {
        return $this->belongsTo(CuentaContable::class, 'padre_id');
    }

    /**
     * Get the child accounts of this account.
     */
    public function hijos()
    {
        return $this->hasMany(CuentaContable::class, 'padre_id');
    }
}
