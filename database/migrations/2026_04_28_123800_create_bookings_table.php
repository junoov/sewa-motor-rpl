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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('motor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pickup_location_id')->constrained('locations')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('duration_days');
            $table->unsignedInteger('subtotal');
            $table->unsignedInteger('deposit_amount')->default(0);
            $table->unsignedInteger('total_price');
            $table->string('status', 40)->default('menunggu pembayaran');
            $table->text('notes')->nullable();
            $table->timestamp('terms_accepted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
