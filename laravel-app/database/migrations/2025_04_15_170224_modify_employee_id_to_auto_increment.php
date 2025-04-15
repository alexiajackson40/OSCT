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
        Schema::table('personnel', function (Blueprint $table) {
            // Drop the existing primary key if needed
            $table->dropPrimary(); 
    
            // Change employee_id to auto-incrementing integer
            $table->integer('employee_id')->autoIncrement()->change();
    
            // Set it as the primary key again
            $table->primary('employee_id');
        });
    }
    
    public function down()
    {
        Schema::table('personnel', function (Blueprint $table) {
            // Revert back to non-incrementing string if needed
            $table->dropPrimary();
            $table->string('employee_id')->change();
        });
    }
    
};
