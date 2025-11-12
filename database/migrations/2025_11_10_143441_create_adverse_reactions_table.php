<?php

use App\Models\ADR;
use App\Models\ADRSeriousReason;
use App\Models\Duration;
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
        Schema::create('adverse_reactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(ADR::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('onset_date')->nullable();
            $table->foreignIdFor(Duration::class)->nullable()->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->enum('serious',['Yes','No'])->default('No');
            $table->foreignIdFor(ADRSeriousReason::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverse_reactions');
    }
};
