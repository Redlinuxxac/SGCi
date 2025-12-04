<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ahorros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_id')->constrained()->onDelete('cascade');
            $table->enum('tipo_cuenta', ['vista', 'plazo_fijo', 'especial'])->default('vista');
            $table->decimal('saldo', 15, 2)->default(0.00);
            $table->decimal('tasa_interes', 5, 2)->default(0.00);
            $table->date('fecha_apertura');
            $table->enum('estado', ['activa', 'inactiva', 'cerrada'])->default('activa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ahorros');
    }
};
