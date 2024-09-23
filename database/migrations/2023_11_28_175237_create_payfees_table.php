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
        Schema::create('payfees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('status')->default('0');
            $table->string('registation_id');
            $table->string('university_name');
            $table->string('email');
            $table->string('number');
            $table->string('country');
            $table->string('address');
            $table->string('city');
            $table->string('district');
            $table->string('display_amount')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('display_type');
            $table->string('payment_method_item');
            $table->string('txt_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_txt_upload')->nullable();
            $table->string('signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payfees');
    }
};
