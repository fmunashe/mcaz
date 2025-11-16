<?php

use App\Models\ADROutcome;
use App\Models\AgeGroup;
use App\Models\Gender;
use App\Models\RelevantMedicalHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('a_e_f_i_s', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('patient_name')->nullable();
            $table->string('patient_full_address')->nullable();
            $table->string('telephone')->nullable();
            $table->foreignIdFor(Gender::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('pregnancy_status', ['pregnant', 'lactating', 'not_pregnant'])->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('reported_by')->nullable();
            $table->text('designation')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('institution')->nullable();
            $table->string('date_of_event_notification')->nullable();
            $table->text('health_facility_name')->nullable();
            $table->string('date_aefi_started')->nullable();
            $table->enum('serious', ['Yes', 'No'])->default('Yes');
            $table->foreignIdFor(ADROutcome::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(AgeGroup::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('date_of_death')->nullable();
            $table->enum('autopsy_done', ['Yes', 'No', 'Unknown'])->default('Unknown')->nullable();
            $table->enum('investigation_needed', ['Yes', 'No'])->nullable()->default('No');
            $table->string('date_investigation_planned')->nullable();
            $table->string('date_report_received_at_national_level')->nullable();
            $table->string('aefi_worldwide_unique_id')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_e_f_i_s');
    }
};
