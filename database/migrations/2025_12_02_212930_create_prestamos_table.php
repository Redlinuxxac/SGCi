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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_id')->constrained()->onDelete('cascade');
            $table->decimal('monto', 15, 2);
            $table->decimal('tasa_interes', 5, 2); // e.g., 12.50%
            $table->integer('plazo_meses');
            $table->date('fecha_desembolso');
            $table->enum('estado', ['pendiente', 'aprobado', 'desembolsado', 'cancelado', 'pagado'])->default('pendiente');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
