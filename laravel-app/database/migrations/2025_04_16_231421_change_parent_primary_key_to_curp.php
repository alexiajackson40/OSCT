<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::table('parent', function (Blueprint $table) {
        // Drop the auto-increment ID column first
        $table->dropColumn('id');
    });

    Schema::table('parent', function (Blueprint $table) {
        // Then add CURP as the new primary key
        $table->string('CURP')->primary();
    });
}


    public function down(): void
    {
        Schema::table('parent', function (Blueprint $table) {
            $table->dropPrimary('parent_CURP_primary');
            $table->dropColumn('CURP');
            $table->bigIncrements('id');
        });
    }
};
