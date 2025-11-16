<?php

use App\Models\ADRSeriousReason;
use App\Models\AEFI;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('a_e_f_i_severities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(AEFI::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ADRSeriousReason::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_e_f_i_severities');
    }
};
