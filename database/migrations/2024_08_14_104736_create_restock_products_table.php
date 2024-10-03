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
        Schema::create('restock_products', function (Blueprint $table) {
            $table->id('restock_id');
            $table->bigInteger('product_id')->nullable();
            $table->integer('old_quantity')->default(0);
            $table->integer('old_stock')->default(0);
            $table->integer('old_sold')->default(0);
            $table->integer('new_quantity')->default(0);
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
        Schema::dropIfExists('restock_products');
    }
};
