<?php

use App\Models\Client;
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
        Schema::create('customer_complaints', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Client::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('complaint_number')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('name_of_organisation')->nullable();
            $table->enum('complaint_channel',['Written','Email','Telephone','Verbal','Whatsapp','Facebook','Instagram','Twitter','USSD'])->nullable()->default('USSD');
            $table->longText('details_of_complaint')->nullable();
            $table->string('location')->nullable();
            $table->longText('description_of_premises')->nullable();
            $table->string('directions_to_premises')->nullable();
            $table->string('person_to_be_investigated_contact')->nullable();
            $table->string('received_by')->nullable();
            $table->string('signature')->nullable();
            $table->string('date_received')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_complaints');
    }
};
