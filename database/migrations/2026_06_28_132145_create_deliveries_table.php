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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('tracking_number')->unique();

            $table->string('sender_name');
            $table->string('sender_phone');
            $table->string('sender_address');

            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('receiver_address');

            $table->string('package_type');
            $table->text('description')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->text('notes')->nullable();

            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->date('estimated_delivery')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
