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
       Schema::create('product_elements', function (Blueprint $table) {
            $table->id();
            $table->string('element_name')->nullable();
            $table->string('element_type')->nullable();
            $table->text('options')->nullable(); // JSON ya comma-separated string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_elements');
    }
};
