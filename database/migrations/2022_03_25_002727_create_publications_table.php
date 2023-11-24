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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->integer('remuneration');
            $table->integer('amount'); //cantidad
            $table->enum('collation', ['Si', 'No'])->default('No'); //colacion
            $table->string('state');
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('time_end')->nullable();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('profile_id');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
};
