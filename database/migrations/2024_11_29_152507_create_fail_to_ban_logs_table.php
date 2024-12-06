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
        Schema::create('fail_to_ban_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->unsignedBigInteger('fail_to_ban_id');
            $table->text('action')->nullable();
            $table->text('status')->nullable();
            $table->string('path')->nullable();
            $table->json('payload')->nullable();
            $table->text('platform')->nullable();
            $table->text('method')->nullable();
            $table->text('origin')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('attempt_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fail_to_ban_logs');
    }
};