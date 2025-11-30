<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('email');
            $table->integer('age')->nullable()->after('mobile');
            $table->string('dob')->nullable()->after('age');
            $table->string('father_name')->nullable()->after('dob');
            $table->string('mother_name')->nullable()->after('father_name');
            $table->string('permanent_address')->nullable()->after('mother_name');
            $table->string('current_address')->nullable()->after('permanent_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mobile', 'age', 'dob', 'father_name', 
                'mother_name', 'permanent_address', 'current_address'
            ]);
        });
    }
};
