<?php

use App\Models\Language;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('username');
            $table->string('pin');
            $table->foreignIdFor(Language::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('otp');
            $table->boolean('accepted_terms')->default(false);
            $table->enum('notify_via', ['sms', 'email'])->default('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
