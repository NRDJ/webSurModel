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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('eyes_color', 10)->nullable(); //color de ojos
            $table->string('hair_color', 10)->nullable(); //color de pelo
            $table->string('height', 100)->nullable(); //estatura
            $table->string('weight', 100)->nullable(); //peso
            $table->string('shirt_size')->nullable(); //talla polera
            $table->string('pants_size', 10)->nullable(); //talla pantalon
            $table->string('profession')->nullable();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
};
