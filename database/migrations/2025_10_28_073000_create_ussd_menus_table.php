<?php

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
        Schema::create('ussd_menus', function (Blueprint $table) {
            $table->id();
            $table->string('code')->comment('Unique internal identifier (REGISTER_PIN, MAIN_MENU)');
            $table->text('title')->nullable()->comment('The text shown to the user');
            $table->enum('type',['menu', 'input', 'end'])->nullable()->comment('The type of screen');
            $table->text('next_menu_id')->nullable()->comment('Default next step if no options (for sequential inputs)');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ussd_menus');
    }
};
