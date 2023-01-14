<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExperincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__experinces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('exper_start_year')->nullable();
            $table->string('exper_end_year')->nullable();
            $table->string('exper_end_month')->nullable();
            $table->string('exper_start_month')->nullable();
            $table->string('company')->nullable();
            $table->text('summary')->nullable();
            $table->enum('current',['yes','no'])->nullable();
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
        Schema::dropIfExists('user__experinces');
    }
}
