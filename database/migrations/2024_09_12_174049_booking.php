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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->text('order_id')->nullable();
            $table->text('product_id')->nullable();
            $table->text('seller_id')->nullable();
            $table->string('user_id')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->text('check_in_image')->nullable();
            $table->text('checkout_image')->nullable();
            $table->text('phone')->nullable();
            $table->text('name')->nullable();
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->text('pincode')->nullable();
            $table->enum('verify', ['N', 'Y']);
            $table->enum('payment_verify', ['N', 'Y']);
            $table->enum('owner_status', ['panding', 'reject','accept']);
            $table->enum('booking_status_user', ['running', 'cancelled']);
            $table->enum('booking_status', ['panding','running','complete','decline_ride']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};