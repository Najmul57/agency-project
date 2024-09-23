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
        Schema::create('expensives', function (Blueprint $table) {
            $table->id();
            $table->string('auth_id');
            $table->string('title');
            $table->string('type')->comment('1 = deposit, 2 = expense');
            $table->string('amount');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expensives');
    }
};
