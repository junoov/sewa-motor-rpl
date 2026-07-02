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
        Schema::table('motors', function (Blueprint $table): void {
            $table->index('brand_id');
            $table->index('motor_type_id');
            $table->index('location_id');
        });

        Schema::table('bookings', function (Blueprint $table): void {
            $table->index('motor_id');
            $table->index('pickup_location_id');
        });

        Schema::table('payments', function (Blueprint $table): void {
            $table->index('booking_id');
        });

        Schema::table('wishlists', function (Blueprint $table): void {
            $table->index('user_id');
            $table->index('motor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motors', function (Blueprint $table): void {
            $table->dropIndex(['brand_id']);
            $table->dropIndex(['motor_type_id']);
            $table->dropIndex(['location_id']);
        });

        Schema::table('bookings', function (Blueprint $table): void {
            $table->dropIndex(['motor_id']);
            $table->dropIndex(['pickup_location_id']);
        });

        Schema::table('payments', function (Blueprint $table): void {
            $table->dropIndex(['booking_id']);
        });

        Schema::table('wishlists', function (Blueprint $table): void {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['motor_id']);
        });
    }
};
