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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->string('pincode')->nullable();
            $table->text('image')->nullable();
            $table->text('card_details')->nullable();
            $table->text('gst_number')->nullable();
            $table->text('owner_first_name')->nullable();
            $table->text('owner_last_name')->nullable();
            $table->text('business_location_image')->nullable();
            $table->text('owner_image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('is_block', ['N','Y']);
            $table->enum('email_verify', ['N','Y']);
            $table->enum('details_verify', ['N','Y']);
            $table->enum('is_active', ['Y','N']);
            $table->enum('role', ['user','provider','vendor','admin','auditor']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
