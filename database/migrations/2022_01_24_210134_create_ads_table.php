<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad_number')->unique();
            $table->integer('user_id');
            $table->string('title');
            $table->string('details')->nullable();
            $table->float('price');
            $table->integer('depart_id');
            $table->integer('cat_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('subcat_id')->nullable();
            $table->integer('model');
            $table->enum('status',['active','inactive'])->default('active');
            $table->integer('age')->nullable();
            $table->integer('surface_area')->nullable();
            $table->integer('number_halls')->nullable();
            $table->integer('number_bathrooms')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->string('car_type')->nullable();
            $table->string('car_gear')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('drive_system')->nullable();
            $table->integer('seats_number')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('zoom')->nullable();
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
        Schema::dropIfExists('ads');
    }
}
