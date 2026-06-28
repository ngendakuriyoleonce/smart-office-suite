<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meeting_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('meeting_rooms');
            $table->foreignId('booked_by')->constrained('users');
            $table->string('title');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->index(['room_id', 'start_time', 'end_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meeting_bookings');
    }
};
