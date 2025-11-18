<?php

use App\Models\Client;
use App\Models\Gender;
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
        Schema::create('a_d_r_s', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Client::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('mcaz_reference_number')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('hospital_number')->nullable();
            $table->string('patient_initials')->nullable();
            $table->string('vct_or_tb_number')->nullable();
            $table->string('dob')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('age')->nullable();
            $table->foreignIdFor(Gender::class)->nullable()->constrained();
            $table->string('reported_by')->nullable();
            $table->string('designation')->nullable();
            $table->string('email_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('institution_address')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_d_r_s');
    }
};
