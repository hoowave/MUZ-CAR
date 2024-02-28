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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('type');
            $table->text('introduction');
            $table->string('del_yn', 1);
            $table->timestamps();
        });

        Schema::create('car_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carId');
            $table->integer('year')->nullable();
            $table->string('fuel')->nullable();
            $table->integer('seats')->nullable();
            $table->string('gear')->nullable();
            $table->timestamps();

            $table->foreign('carId')->references('id')->on('cars')->onDelete('cascade');
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carId');
            $table->dateTime('startAt');
            $table->dateTime('endAt');
            $table->integer('minutes');
            $table->integer('cost');
            $table->char('pay_yn', 1);
            $table->timestamps();
            
            $table->foreign('carId')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('car_details');
    }
};
