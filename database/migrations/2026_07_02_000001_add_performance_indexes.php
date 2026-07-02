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
        Schema::table('bookings', function (Blueprint $table): void {
            $table->index('status');
            $table->index('created_at');
            $table->index('user_id');
        });

        Schema::table('motors', function (Blueprint $table): void {
            $table->index('status');
            $table->index('is_popular');
            $table->index('price_per_day');
        });

        Schema::table('payments', function (Blueprint $table): void {
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table): void {
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('motors', function (Blueprint $table): void {
            $table->dropIndex(['status']);
            $table->dropIndex(['is_popular']);
            $table->dropIndex(['price_per_day']);
        });

        Schema::table('payments', function (Blueprint $table): void {
            $table->dropIndex(['status']);
        });
    }
};
