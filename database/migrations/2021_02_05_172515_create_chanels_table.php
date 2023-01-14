<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chanels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('social_id');
            $table->integer('followers')->nullable();
            $table->integer('Daily_Video_Views')->nullable();
            $table->integer('avg_video_view')->nullable();
            $table->integer('Avg_Daily_comments')->nullable();
            $table->integer('Avg_Weekly_comments')->nullable();
            $table->integer('Avg_daily_likes')->nullable();
            $table->integer('Avg_monthly_likes')->nullable();
            $table->integer('Avg_daily_posters')->nullable();
            $table->integer('Subscription')->nullable();
            $table->integer('Avg_Daily_publishing')->nullable();
            $table->integer('Avg_Video_sharing')->nullable();
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
        Schema::dropIfExists('chanels');
    }
}
