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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('credit_type');
            $table->string('credit_purpose');
            $table->string('amount_requested');
            $table->string('repayment_plan');
            $table->string('signature');
            $table->string('financial_year');
            $table->string('approved_by_chairperson')->nullable();
            $table->dateTime('date_chairperson_signed')->nullable();
            $table->string('approved_by_treasurer')->nullable();
            $table->dateTime('date_treasurer_signed')->nullable();
            $table->foreignId('member_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
