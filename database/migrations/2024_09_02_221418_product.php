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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('brands')->nullable();
            $table->string('category')->nullable();
            $table->string('size')->nullable();
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('price')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('area')->nullable();
            $table->string('large_desc')->nullable();
            $table->string('pincode')->nullable();
            $table->text('model_name')->nullable();
            $table->text('color')->nullable();
            $table->text('other_color')->nullable();
            $table->text('rent')->nullable();
            $table->text('frame_size')->nullable();
            $table->text('frame_no')->nullable();
            $table->text('frame_material')->nullable();
            $table->text('speed')->nullable();
            $table->text('fork')->nullable();
            $table->text('shifters')->nullable();
            $table->text('front_gear')->nullable();
            $table->text('rear_gear')->nullable();
            $table->text('front_derailleur')->nullable();
            $table->text('rear_derailleur')->nullable();
            $table->text('brake')->nullable();
            $table->text('image1')->nullable();
            $table->text('image2')->nullable();
            $table->text('image3')->nullable();
            $table->text('image4')->nullable();
            $table->text('image5')->nullable();
            $table->text('image6')->nullable();
            $table->text('image7')->nullable();
            $table->text('image8')->nullable();
            $table->text('user_id')->nullable();
            $table->enum('is_verify', ['N','Y']);
            $table->enum('verify_status', ['panding','reject','verified']);
            $table->enum('status', ['Y','N']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
