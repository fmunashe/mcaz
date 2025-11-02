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
            $table->bigInteger('current_menu_id')->comment('Current active menu')->nullable();
            $table->text("app_id")->comment("Application ID");
            $table->text("application_unique_id")->comment("Application Unique ID");
            $table->integer("stage")->comment("Stage")->nullable();
            $table->text("payload_text")->comment("Payload Text")->nullable();
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
