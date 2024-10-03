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
        Schema::create('requisition_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('req_id')->constrained('requisitions', 'req_id');
            $table->integer('product_id');
            $table->integer('req_quantity');
            $table->integer('issued_quantity')->default(0);
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
        Schema::dropIfExists('requisition_details');
    }
};
