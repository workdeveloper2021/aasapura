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
        Schema::create('site_setting', function (Blueprint $table) {
            $table->id();
            $table->longText('info_first')->nullable();
            $table->longText('info_second')->nullable();
            $table->longText('image')->nullable();
            $table->longText('image_back')->nullable();
            $table->longText('favicon')->nullable();
            $table->longText('meta_tag')->nullable();
            $table->longText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_setting');
    }
};
