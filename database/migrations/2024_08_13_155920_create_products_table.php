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
            $table->id('product_id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('type')->nullable();
            $table->integer('stock_in')->default(0);
            $table->integer('stock_out')->default(0);
            $table->decimal('cost', 10,2)->default(0)->comment('cost price');
            $table->decimal('price', 10,2)->default(0)->comment('selling price');
            $table->integer('division');
            $table->integer('created_by_id');
            $table->integer('updated_by_id');
            $table->timestamps();
            $table->softDeletes();
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
