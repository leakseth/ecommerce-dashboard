<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('image')->nullable();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('stock')->default(0);
            $table->enum('status', ['in_stock', 'out_of_stock', 'low_stock'])->default('in_stock');
            $table->text('description')->nullable();
            $table->timestamps();

            // Add foreign key safely
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
