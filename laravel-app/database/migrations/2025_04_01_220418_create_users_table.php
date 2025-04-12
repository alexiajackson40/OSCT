<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role'); // New column to distinguish user roles
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('school_name')->nullable(); // For patients only
            $table->date('dob')->nullable(); // For patients only
            $table->string('gender')->nullable(); // For patients only
            $table->string('guardian')->nullable(); // For patients only
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};