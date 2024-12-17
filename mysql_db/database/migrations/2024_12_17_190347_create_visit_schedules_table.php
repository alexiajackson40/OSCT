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
    Schema::create('visit_schedules', function (Blueprint $table) {
        $table->id();
        $table->string('level');
        $table->string('shift');
        $table->string('school_code');
        $table->string('school_name');
        $table->string('municipality');
        $table->string('location');
        $table->string('address');
        $table->integer('total_students');
        $table->date('visit_date');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_schedules');
    }
};
