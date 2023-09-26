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
        Schema::create('message_analytics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('message_id')->nullable();
            $table->uuid('recipient_id')->nullable();
            $table->enum('delivery_status', ['delivered', 'failed', 'pending'])->nullable();
            $table->timestamp('delivery_timestamp')->nullable();
            $table->timestamps();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_analytics');
    }
};
