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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('gender')->default(0)->comment('1 : Male, 0 : Female');
            $table->integer('division_id');
            $table->integer('city_id');
            $table->integer('location_id');
            $table->string('address');
            $table->string('religion');
            $table->string('profession')->nullable();
            $table->integer('blood_id');
            $table->date('last_donate')->nullable();
            $table->date('birth_date');
            $table->string('email')->unique()->nullable();
            $table->string('facebook')->nullable();
            $table->string('image')->nullable();
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('password', 60);
            $table->tinyInteger('status')->default(0)->comment('Pending : 0, Approved : 1, Banned : 2');
            $table->integer('click')->default(0);
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
        Schema::dropIfExists('donors');
    }
};
