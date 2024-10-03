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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('task_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->date('due_date')->nullable();
            $table->foreignId('division')->constrained('system_l_o_v_s');
            $table->foreignId('project_id')->constrained('projects', 'project_id');
            $table->foreignId('assigned_staff_id')->constrained('staff', 'staff_id');
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
        Schema::dropIfExists('tasks');
    }
};
