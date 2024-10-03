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
        Schema::create('waybill_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waybill_id')->constrained('waybills', 'bill_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->string('remarks')->nullable();
            $table->foreignId('created_by_id')->constrained('users');
            $table->foreignId('updated_by_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waybill_details');
    }
};
