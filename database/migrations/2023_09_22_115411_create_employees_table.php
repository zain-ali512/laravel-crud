<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('emp_id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('designation');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};