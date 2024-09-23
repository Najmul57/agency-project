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
        Schema::create('document_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('document');
            $table->string('referance_name');
            $table->string('referance_email');
            $table->string('verification_letter');
            $table->string('paymentReceipt');
            $table->string('marksheet');
            $table->string('idProof');
            $table->string('photo');
            $table->string('signature');
            $table->string('others');
            $table->string('method');
            $table->string('amount');
            $table->string('transition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_verifications');
    }
};
