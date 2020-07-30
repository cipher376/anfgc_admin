<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SermonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('sermons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic');
            $table->string('author');
            $table->longText('sermon');
            $table->string('filename');
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

        Schema::dropIfExists('sermons');
    }
}
