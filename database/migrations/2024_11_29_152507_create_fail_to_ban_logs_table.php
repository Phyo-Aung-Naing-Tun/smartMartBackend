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
            $table->string('ip');
            $table->string('identifier');
            $table->text('action');
            $table->text('status');
            $table->string('path');
            $table->json('payload');
            $table->timestamp('attempt_at');
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