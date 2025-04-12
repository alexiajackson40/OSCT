<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdatedPatientsTable extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('No_SOL'); // No. SOL. (auto-incrementing visit count)
            $table->timestamp('FECHA')->nullable(); // FECHA (entry date)
            $table->char('CURP', 8)->unique(); // CURP (primary linking ID for parents)
            $table->string('PACIENTE'); // Full name
            $table->string('SEXO', 10)->nullable(); // Gender
            $table->integer('EDAD')->nullable(); // Age
            $table->string('ESCUELA')->nullable(); // School name
            $table->enum('DERECHOHABIENCIA', ['IMSS', 'ISSSTE', 'IMSS-BIENESTAR', 'SEMAR', 'SEDENA', 'OTROS'])->nullable();
            $table->enum('AYUNO', ['SÍ', 'NO'])->nullable(); // Fasting status
            $table->decimal('GLUCOSA', 8, 2)->nullable();
            $table->decimal('TRIGLICÉRIDOS', 8, 2)->nullable();
            $table->decimal('COLESTEROL TOTAL', 8, 2)->nullable();
            $table->decimal('HBA1C', 8, 2)->nullable();
            $table->decimal('PESO', 8, 2)->nullable();
            $table->decimal('TALLA', 8, 2)->nullable();
            $table->decimal('IMC', 8, 2)->nullable();
            $table->decimal('ICC', 8, 2)->nullable();
            $table->decimal('CINTURA', 8, 2)->nullable();
            $table->decimal('CADERA', 8, 2)->nullable();
            $table->text('COMENTARIO')->nullable(); // Comments

            $table->timestamps(); // Laravel default: created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
}
