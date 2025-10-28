<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ussd_sessions', function (Blueprint $table) {
            $table->id();
            $table->text('session_id')->comment('Provided by telco gateway');
            $table->text('msisdn')->comment('MSISDN of user');
            $table->bigInteger('current_menu_id')->comment('Current active menu');
            $table->json('input_data')->comment('Stores entered values (PINs, names, etc.)');
            $table->enum('status', ['active', 'completed', 'failed'])->default('active')->comment('Session state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ussd_session');
    }
};
