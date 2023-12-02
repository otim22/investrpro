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
        Schema::table('missed_meetings', function (Blueprint $table) {
            $table->string('asset_type')->nullable()->default(null);
            $table->string('financial_year')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('missed_meetings', function (Blueprint $table) {
            $table->dropColumn('asset_type');
            $table->dropColumn('financial_year');
        });
    }
};
