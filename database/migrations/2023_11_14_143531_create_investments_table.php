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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('investment_type');
            $table->dateTime('date_of_investment');
            $table->string('duration');
            $table->string('interest_rate');
            $table->string('amount_invested');
            $table->dateTime('date_of_maturity');
            $table->string('expected_return_before_tax');
            $table->string('expected_return_after_tax')->nullable();
            $table->string('interest_recieved_and_reinvested')->nullable();
            $table->foreignId('company_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
