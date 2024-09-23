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
        Schema::create('course_program_type', function (Blueprint $table) {
            $table->unsignedBigInteger('primium_course_id');
            $table->foreign('primium_course_id')->references('id')->on('primium_courses')->onDelete('cascade');

            $table->unsignedBigInteger('program_type_id');
            $table->foreign('program_type_id')->references('id')->on('program_types')->onDelete('cascade');

            // Additional columns if needed

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_program_type');
    }
};
