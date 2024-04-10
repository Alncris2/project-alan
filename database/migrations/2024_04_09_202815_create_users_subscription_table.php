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
        Schema::create('users_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('restrict');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamp('renewal_at')->nullable();
            $table->timestamp('unpaused_at')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('paid_price', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->string('discount_name')->nullable();
            $table->enum('discount_type', ['recurrent', 'once', 'temporary'])->default('recurrent');
            $table->timestamp('discount_starts_at')->nullable();
            $table->timestamp('discount_ends_at')->nullable();
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('payment_receipt')->nullable();
            $table->string('payment_error')->nullable();
            $table->json('payment_error_details')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('paused_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_subscriptions');
    }
};
