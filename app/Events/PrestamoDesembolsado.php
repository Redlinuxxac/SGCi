<?php

namespace App\Events;

use App\Models\Prestamo;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrestamoDesembolsado
{
    use Dispatchable, SerializesModels;

    /**
     * The prestamo instance.
     *
     * @var \App\Models\Prestamo
     */
    public $prestamo;

    /**
     * Create a new event instance.
     */
    public function __construct(Prestamo $prestamo)
    {
        $this->prestamo = $prestamo;
    }
}
