<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChurchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('churches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('est_date');
            $table->string('country');
            $table->string('location');
            $table->string('pastor');
            $table->string('phone');
            $table->string('email');
            $table->longText('note');
            $table->string('user_id');
            $table->integer('status')->nullable();
            $table->rememberToken();
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
        //
        Schema::dropIfExists('churches');
    }
}
