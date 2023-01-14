<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form__details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_type')->nullable();
            $table->string('service_type')->nullable();
            $table->string('deliver_time')->nullable();
            $table->string('content')->nullable();
            $table->string('uplode_file')->nullable();
            $table->string('order_text')->nullable();
            $table->string('order_details')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('form__details');
    }
}
