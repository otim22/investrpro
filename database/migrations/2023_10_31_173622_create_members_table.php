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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('surname');
            $table->string('given_name');
            $table->string('other_name')->nullable();
            $table->date('date_of_birth');
            $table->string('telephone_number');
            $table->string('email')->unique();
            $table->text('address');
            $table->string('occupation');
            $table->string('nin')->nullable();
            $table->string('passport_number')->nullable();
            $table->foreignId('company_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
