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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id('price_id');
            $table->bigInteger('product_id')->nullable();
            $table->decimal('old_cost', 10,2)->default(0)->comment('cost price');
            $table->decimal('old_price', 10,2)->default(0)->comment('selling price');
            $table->decimal('new_cost', 10,2)->default(0)->comment('cost price');
            $table->decimal('new_price', 10,2)->default(0)->comment('selling price');
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
        Schema::dropIfExists('product_prices');
    }
};
