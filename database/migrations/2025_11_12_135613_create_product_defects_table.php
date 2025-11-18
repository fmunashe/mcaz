<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_defects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Client::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('product_name')->nullable();
            $table->text('description')->nullable();
            $table->text('intended_use')->nullable();
            $table->text('type_of_container')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('expiry_date')->nullable();
            $table->text('name_of_manufacturer')->nullable();
            $table->text('address_of_manufacturer')->nullable();
            $table->string('name_of_reporter')->nullable();
            $table->string('title_of_reporter')->nullable();
            $table->string('practice_location')->nullable();
            $table->string('practise_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('date_problem_observed')->nullable();
            $table->enum('product_available_for_examination', ['Yes', 'No'])->nullable()->default('Yes');
            $table->string('reporter_signature')->nullable();
            $table->string('report_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_defects');
    }
};
