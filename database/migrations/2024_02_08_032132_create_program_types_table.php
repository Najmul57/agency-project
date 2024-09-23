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
        Schema::create('program_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('university_id');
            $table->string('name')->unique();
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('premium_countries')
                ->onDelete('cascade');

            $table->foreign('university_id')
                ->references('id')->on('primium_universities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_types');
    }
};
