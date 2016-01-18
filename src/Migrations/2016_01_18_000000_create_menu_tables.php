<?php

use jlourenco\base\Database\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('pos')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            $table->creation();
        });

        Schema::create('Page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('url', 250);
            $table->string('target', 25);
            $table->string('icon', 250);
            $table->text('contents')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->creation();
        });

        Schema::create('Menu_Page', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu')->unsigned();
            $table->integer('page')->unsigned();
            $table->integer('father')->unsigned()->nullable();
            $table->integer('order');

            $table->foreign('menu')->references('id')->on('Menu');
            $table->foreign('page')->references('id')->on('Page');
            $table->foreign('father')->references('id')->on('Page');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('Menu_Page');
        Schema::drop('Menu');
        Schema::drop('Page');

    }

}
