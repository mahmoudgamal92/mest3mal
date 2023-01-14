<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('auction_number');
            $table->integer('user_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('title');
            $table->text('details')->nullable();
            $table->integer('duration');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('images')->nullable();
            $table->enum('status',['active','done','canceled'])->default('active');
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
        Schema::dropIfExists('auctions');
    }
}
