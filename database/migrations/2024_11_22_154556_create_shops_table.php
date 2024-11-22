<?php

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
            $table->text('type')->default('normal');
            $table->string('schedule')->nullable();
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