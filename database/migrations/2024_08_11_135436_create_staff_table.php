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
        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id');
            $table->string('staff_number', 10);
            $table->integer('title');
            $table->integer('gender');
            $table->string('firstname');
            $table->string('othernames');
            $table->date('date_of_birth')->nullable();
            $table->integer('married')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->integer('position')->nullable();
            $table->string('banker')->nullable();
            $table->string('bank_account', 20)->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_sort_code', 10)->nullable();
            $table->string('ghana_card', 20)->nullable();
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
        Schema::dropIfExists('staff');
    }
};
