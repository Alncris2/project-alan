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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->decimal("anchoring_price", 10, 2)->nullable();
            $table->decimal('price_annual', 10, 2);
            $table->decimal("anchoring_price_annual", 10, 2)->nullable();
            $table->integer('trial_days')->default(0);
            $table->enum('after_trial', ['charge', 'free'])->default('charge');
            $table->enum('after_trial_period', ['monthly', 'annual'])->default('monthly');
            $table->integer('sort_order')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('popular')->default(false);
            $table->boolean('recommended')->default(false);
            $table->boolean('highlighted')->default(false);
            $table->boolean('hidden')->default(false);   
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
