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
        Schema::create('stores_transfers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_transfer_id');
            $table->date('transfer_date');
            $table->bigInteger('from_store_id');
            $table->bigInteger('to_store_id');
            $table->bigInteger('product_id');
            $table->bigInteger('transfer_quantity');
            $table->bigInteger('old_stock');
            $table->bigInteger('approved_quantity')->nullable();
            $table->bigInteger('new_stock')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 - pending, 1 - approved, 2 - rejected');
            $table->string('remarks', 400)->nullable();
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
        Schema::dropIfExists('stores_transfers');
    }
};
