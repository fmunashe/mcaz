<?php

use App\Models\UssdMenu;
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
        Schema::create('ussd_menu_options', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UssdMenu::class)->comment('Parent menu')->constrained()->cascadeOnDelete();
            $table->integer('option_number')->comment('User’s numeric selection (1, 2, 3, etc.)');
            $table->text('option_text')->comment('The label shown for this choice');
            $table->text('next_menu_id')->nullable()->comment('Next menu to go to when selected');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ussd_menu_options');
    }
};
