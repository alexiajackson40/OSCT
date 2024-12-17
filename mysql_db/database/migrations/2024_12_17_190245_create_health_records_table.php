<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('health_records', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id');
        $table->float('glucose')->nullable();
        $table->float('cholesterol')->nullable();
        $table->float('triglycerides')->nullable();
        $table->float('hemoglobin_glucosilada')->nullable();
        $table->float('weight')->nullable();
        $table->float('height')->nullable();
        $table->float('bmi')->nullable();
        $table->float('waist')->nullable();
        $table->float('hip')->nullable();
        $table->float('waist_hip_ratio')->nullable();
        $table->timestamps();
        
        // Add foreign key relationship to the students table
        $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
