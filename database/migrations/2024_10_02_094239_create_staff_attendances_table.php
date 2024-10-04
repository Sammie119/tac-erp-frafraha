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
        Schema::create('staff_attendances', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->string('month', 20);
            $table->tinyInteger('year');
            $table->foreignId('division')->constrained('system_l_o_v_s');
            $table->foreignId('created_by_id')->constrained('users');
            $table->foreignId('updated_by_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('staff_attendances_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attendance_id')->nullable();
            $table->string('staff_number', 10);
            $table->string('month', 20)->nullable();
            $table->tinyInteger('year')->nullable();
            $table->date('attendance_date');
            $table->timestamp('checkin_time');
            $table->timestamp('departure_time');
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
        Schema::dropIfExists('staff_attendances');

        Schema::dropIfExists('staff_attendances_details');
    }
};
