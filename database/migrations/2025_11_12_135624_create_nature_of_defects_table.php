<?php

use App\Models\Defect;
use App\Models\ProductDefect;
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
        Schema::create('nature_of_defects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(ProductDefect::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Defect::class)->constrained()->cascadeOnDelete();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nature_of_defects');
    }
};
