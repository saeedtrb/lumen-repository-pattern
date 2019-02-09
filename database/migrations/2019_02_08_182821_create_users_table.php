<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('first_name',128);
            $table->string('last_name', 128);
            $table->char('mobile', 16);
            $table->char('email', 128)->nullable();

            $table->string('password', 64);
            $table->boolean('disabled')->default(false);
            $table->integer('created_at')->unsigned();
            $table->integer('updated_at')->unsigned()->nullable();

            $table->unique('email');
            $table->unique('mobile');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
