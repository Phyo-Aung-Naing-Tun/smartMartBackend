<?php

use App\Enums\ShopStatus;
use App\Enums\ShopType;
use App\Models\User;
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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('profile')->nullable();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();
            $table->text('email');
            $table->string('phone');
            $table->string('about');
            $table->string('address')->nullable();
            $table->string('slogan')->nullable();
            $table->text('type')->default(ShopType::NORMAL->value);
            $table->text('status')->default(ShopStatus::PENDING->value);
            $table->string('schedule')->nullable();
            $table->timestamp('active_at')->nullable();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};