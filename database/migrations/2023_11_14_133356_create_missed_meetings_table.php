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
        Schema::create('missed_meetings', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('charge_paid_for');
            $table->string('charge_amount');
            $table->string('month_paid_for');
            $table->dateTime('date_of_payment')->nullable();
            $table->longText('comment')->nullable();
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
        Schema::dropIfExists('missed_meetings');
    }
};
