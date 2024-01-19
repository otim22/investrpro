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
            $table->string('ref_code');
            $table->string('credit_type');
            $table->string('credit_purpose');
            $table->integer('amount_requested');
            $table->string('repayment_plan');
            $table->string('signature');
            $table->string('financial_year');
            $table->boolean('is_approved')->nullable()->default(0);
            $table->boolean('is_rejected')->nullable()->default(0);
            $table->longText('comment')->nullable();
            $table->string('approved_by_one')->nullable();
            $table->dateTime('date_one_signed')->nullable();
            $table->string('approved_by_two')->nullable();
            $table->dateTime('date_two_signed')->nullable();
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
