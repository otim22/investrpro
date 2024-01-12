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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->integer('amount_taken');
            $table->integer('amount_paid')->nullable();
            $table->dateTime('date_paid')->nullable();
            $table->longText('comment')->nullable();
            $table->boolean('is_active')->nullable()->default(0);
            $table->foreignId('member_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('loan_application_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
