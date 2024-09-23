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
        Schema::create('primium_university_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('universitycourse_id');
            $table->unsignedBigInteger('program_type_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('university_id');
            $table->unsignedBigInteger('country_id');

            $table->longText('description')->nullable();
            $table->longText('overview')->nullable();
            $table->longText('criteria')->nullable();
            $table->longText('scholarship')->nullable();
            $table->longText('career')->nullable();
            $table->longText('fee')->nullable();
            $table->longText('assistance')->nullable();
            $table->longText('faq')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();

            $table->foreign('universitycourse_id')
                ->references('id')->on('primium_university_courses')
                ->onDelete('cascade');

            $table->foreign('country_id')
                ->references('id')->on('premium_countries')
                ->onDelete('cascade');

            $table->foreign('university_id')
                ->references('id')->on('primium_universities')
                ->onDelete('cascade');

            $table->foreign('program_type_id')
                ->references('id')->on('program_types')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')->on('premium_courses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primium_university_contents');
    }
};
