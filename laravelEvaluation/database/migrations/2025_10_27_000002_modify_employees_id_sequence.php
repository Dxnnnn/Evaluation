<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyEmployeesIdSequence extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Truncate the table to reset all data
        DB::table('employees')->truncate();
        
        // For MySQL: Alter the auto_increment to start from 0
        DB::statement('ALTER TABLE employees AUTO_INCREMENT = 0');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset auto_increment to 1 (default)
        DB::statement('ALTER TABLE employees AUTO_INCREMENT = 1');
    }
}