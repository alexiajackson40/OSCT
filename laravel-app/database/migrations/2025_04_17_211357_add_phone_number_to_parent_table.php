<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('parent', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('email'); // or wherever you'd like it
        });
    }

    public function down(): void
    {
        Schema::table('parent', function (Blueprint $table) {
            $table->dropColumn('phone_number');
        });
    }
};

