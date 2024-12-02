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
            $table->string('ip');
            $table->text('action');
            $table->text('status');
            $table->string('path');
            $table->json('payload');
            $table->text('platform')->nullable();
            $table->text('method');
            $table->text('origin');
            $table->tinyInteger('attempt_count');
            $table->json('attempt_at');
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