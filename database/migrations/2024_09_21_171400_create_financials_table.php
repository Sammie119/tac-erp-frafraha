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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id('financial_id');
            $table->string('transaction_id', 15);
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('type')->constrained('system_l_o_v_s');
            $table->foreignId('source')->constrained('system_l_o_v_s');
            $table->foreignId('mode')->constrained('system_l_o_v_s');
            $table->decimal('amount',10,2)->default(0);
            $table->foreignId('division')->constrained('system_l_o_v_s');
            $table->date('transaction_date');
            $table->string('amount_paid_by')->nullable();
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
        Schema::dropIfExists('financial_transactions');
    }
};
