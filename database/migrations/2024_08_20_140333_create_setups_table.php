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
        Schema::create('setups', function (Blueprint $table) {
            $table->id();
            $table->string('display_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('text_logo')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->decimal('nhil', 5, 2)->nullable();
            $table->decimal('gehl', 5, 2)->nullable();
            $table->decimal('covid19', 5, 2)->nullable();
            $table->decimal('vat', 5, 2)->nullable();
            $table->integer('division');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('setups')->insert([
            'display_name' => 'Sammav Point of Sale System',
            'address' => 'Sammav',
            'phone1' => '0000000000',
            'phone2' => '0000000000',
            'text_logo' => 'Sam IT Consult',
            'email' => 'sammav2018@gmail.com',
            'facebook' => 'sammav2018@gmail.com',
            'nhil' => '2.5',
            'gehl' => '2.5',
            'covid19' => '1',
            'vat' => '15',
            'division' => '14',
            'created_at' =>  now(),
            'updated_at' =>  now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setups');
    }
};
