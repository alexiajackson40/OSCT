<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Try to drop the existing primary key.
        try {
            DB::statement('ALTER TABLE personnel DROP PRIMARY KEY');
        } catch (\Exception $e) {
            // If the primary key doesn't exist, we can ignore the error.
            // Optionally log the exception if needed.
        }
        
        // Step 2: Ensure that employee_id is unique.
        Schema::table('personnel', function (Blueprint $table) {
            // Make sure employee_id is unique.
            // Note: This requires doctrine/dbal to use the change() method.
            $table->string('employee_id')->unique()->change();
        });
        
        // Step 3: Add a new primary key on employee_id.
        DB::statement('ALTER TABLE personnel ADD PRIMARY KEY (employee_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse step: Drop the primary key on employee_id.
        try {
            DB::statement('ALTER TABLE personnel DROP PRIMARY KEY');
        } catch (\Exception $e) {
            // Ignore errors if primary key does not exist.
        }
        
        // Optionally, set the primary key back to email
        DB::statement('ALTER TABLE personnel ADD PRIMARY KEY (email)');
    }
};
