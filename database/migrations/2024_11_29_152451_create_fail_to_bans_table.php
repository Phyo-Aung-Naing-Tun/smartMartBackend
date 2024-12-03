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
        Schema::create('fail_to_bans', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->text('action')->nullable();
            $table->text('status')->nullable();
            $table->string('path')->nullable();
            $table->json('payload')->nullable();
            $table->text('platform')->nullable();
            $table->text('method')->nullable();
            $table->text('origin')->nullable();
            $table->tinyInteger('attempt_count')->nullable();
            $table->json('attempt_at')->nullable();
            $table->timestamp('bann_untail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fail_to_bans');
    }
};