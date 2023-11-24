<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('discount', ['Si', 'No'])->default('No'); //descuento
            $table->string('honorary_ticket')->nullable(); //boleta honorario
            $table->date('pay_day')->nullable();
            $table->string('transfer_voucher')->nullable(); //vale de transferencia
            $table->unsignedBigInteger('person_request_id');
            $table->timestamps();

            $table->foreign('person_request_id')->references('id')->on('person_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
