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
            $table->string('user_type'); // 'admin', 'personnel', 'patient'
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('school_name')->nullable(); // patients only
            $table->date('dob')->nullable(); // patients only
            $table->string('gender')->nullable(); // patients only
            $table->string('guardian')->nullable(); // patients only
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
