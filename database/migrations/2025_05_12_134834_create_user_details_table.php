<?php

use App\Enums\ApprovingEnum;
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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('full_name')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean("is_banned")->default(false);
            $table->foreignId('approved_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->enum('approve', array_map(fn($language) => $language->value, ApprovingEnum::cases()))->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
