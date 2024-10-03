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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('invoice_no', 20)->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->date('transaction_date')->nullable();
            $table->decimal('without_tax_amount', 10,2)->nullable();
            $table->tinyInteger('taxable')->default(0);
            $table->decimal('nhil', 10, 2)->default(0.00);
            $table->decimal('gehl', 10, 2)->default(0.00);
            $table->decimal('covid19', 10, 2)->default(0.00);
            $table->decimal('vat', 10, 2)->default(0.00);
            $table->decimal('transaction_amount', 10, 2)->default(0.00);
            $table->string('status', 50)->default('Not Started');
            $table->integer('division');
            $table->integer('created_by_id');
            $table->integer('updated_by_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->string('invoice_no', 20)->nullable();
            $table->integer('receipt_no');
            $table->date('payment_date')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->decimal('amount_paid', 10, 2)->default(0.00);
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->string('payment_method', 20)->default('cash')->comment('cash, cheque');
            $table->integer('division');
            $table->integer('created_by_id');
            $table->integer('updated_by_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->integer('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('unit_price')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
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
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transaction_payments');
        Schema::dropIfExists('transaction_details');
    }
};
