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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id('purchase_id');
            $table->text('invoice_number', 20);
            $table->foreignId('supplier_id')->constrained('suppliers', 'supplier_id');
            $table->date('order_date');
            $table->date('received_date')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=complete');
            $table->foreignId('division')->constrained('system_l_o_v_s');
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
        Schema::dropIfExists('purchase_orders');
    }
};
