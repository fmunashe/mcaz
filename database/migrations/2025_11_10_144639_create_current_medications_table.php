<?php

use App\Models\ADR;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('current_medications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(ADR::class)->constrained()->cascadeOnDelete();
            $table->string('brand_name')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('dose')->nullable();
            $table->string('frequency')->nullable();
            $table->string('date_started')->nullable();
            $table->string('date_stopped')->nullable();
            $table->enum('suspected_medicine', ['Yes', 'No'])->default('No')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_medications');
    }
};
