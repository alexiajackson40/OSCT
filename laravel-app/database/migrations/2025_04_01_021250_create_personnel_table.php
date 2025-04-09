<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelTable extends Migration
{
    public function up(): void
    {
        Schema::create('personnel', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('employee_id');
            $table->string('specialization')->nullable();
            $table->string('role')->default('personnel');
            $table->string('password');
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personnel');
    }
}
