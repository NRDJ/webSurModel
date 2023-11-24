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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('rut')->unique();
            $table->string('business_name'); //razon social
            $table->string('main_line', 100)->nullable(); //giro principal
            $table->string('commercial_address', 100)->nullable(); //direccion comercial
            $table->string('logo')->nullable(); //logotipo
            $table->string('contact_name', 30); //nombre de contacto
            $table->string('contact_phone', 12); //telefono de contacto
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
};
