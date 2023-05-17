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
            $table->string('name')->nullable();
            $table->string('images')->nullable();
            $table->longText('body')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->string('slug')->unique();
            $table->integer('sold')->nullable();
            $table->string('is_featured')->default(false);
            $table->string('badge')->default(false);
            $table->string('status')->default(false);
            $table->string('cover_image')->nullable();
            $table->string('SKU')->nullable();
            $table->longText('keyfeature')->nullable();
            $table->longText('specification')->nullable();
            $table->foreignId('subcategory_id')->constrained('sub_categories')->onDelete('CASCADE')->onUpdate('CASCADE');
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
