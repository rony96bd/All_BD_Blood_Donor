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
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('donor_id');
            $table->integer('division_id');
            $table->integer('city_id');
            $table->integer('location_id');
            $table->integer('blood_id');
            $table->string('problem');
            $table->string('amount_of_blood');
            $table->date('donate_date');
            $table->time('donate_time');
            $table->string('donate_address');
            $table->string('phone');
            $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_requests');
    }
};
