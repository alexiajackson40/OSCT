<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->char('user_id', 8); // CURP as foreign key
            $table->float('waist')->nullable();
            $table->float('hip')->nullable();
            $table->float('waist_hip_ratio')->nullable();
            $table->float('body_mass')->nullable();
            $table->float('cholesterol')->nullable();
            $table->float('glucose_level')->nullable();
            $table->float('hemoglobin')->nullable();
            $table->float('triglycerides')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('CURP')->on('patients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
