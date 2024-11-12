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
        Schema::create('financial_periods', function (Blueprint $table) {
            $table->id('period_id');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 - Inactive, 1 - Active');
            $table->string('description')->nullable();
            $table->decimal('total_investment', 13, 2)->default(0.00);
            $table->decimal('total_sales', 13, 2)->default(0.00);
            $table->decimal('total_profit', 13, 2)->default(0.00);
            $table->decimal('total_expenses', 13, 2)->default(0.00);
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
        Schema::dropIfExists('financial_periods');
    }
};
