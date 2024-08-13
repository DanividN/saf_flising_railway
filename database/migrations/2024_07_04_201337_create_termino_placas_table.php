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
        Schema::create('termino_placas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('color');
            $table->string('primer_semestre');
            $table->string('segundo_semestre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termino_placas');
    }
};
