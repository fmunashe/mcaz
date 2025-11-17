<?php

use App\Models\ProductDefect;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_defects_followup_information', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(ProductDefect::class)->nullable()->constrained()->cascadeOnDelete();
            $table->longText('followup_information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_defects_followup_information');
    }
};
