<?php

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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(AEFI::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('vaccine_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('date_of_vaccination')->nullable();
            $table->string('time_of_vaccination')->nullable();
            $table->string('dose')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('diluent_batch_number')->nullable();
            $table->string('diluent_expiry_date')->nullable();
            $table->string('diluent_time_of_reconstitution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
