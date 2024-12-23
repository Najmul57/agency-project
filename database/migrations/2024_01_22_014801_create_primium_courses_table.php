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
        Schema::create('primium_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_type_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('university_id');
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->string('breadcrumb');
            $table->string('status')->default(0);
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('premium_countries')
                ->onDelete('cascade');

            $table->foreign('university_id')
                ->references('id')->on('primium_universities')
                ->onDelete('cascade');

            $table->foreign('program_type_id')
                ->references('id')->on('program_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primium_courses');
    }
};
