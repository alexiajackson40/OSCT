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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->float('waist')->nullable();
            $table->float('hip')->nullable();
            $table->float('waist_hip_ratio')->nullable();
            $table->float('body_mass')->nullable();
            $table->float('cholesterol')->nullable();
            $table->float('glucose_level')->nullable();
            $table->float('hemoglobin')->nullable();
            $table->float('triglycerides')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
