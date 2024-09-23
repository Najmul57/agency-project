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
        Schema::create('primium_universities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->string('slug');
            $table->string('email');
            $table->string('university_id')->nullable();
            $table->string('thumbnail');
            $table->string('logo');
            $table->string('breadcrumb');
            $table->string('address')->nullable();
            $table->longText('about')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('premium_countries')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primium_universities');
    }
};
