<?php

use Illuminate\Database\Migrations\Migration;

class CreateTorrents extends Migration {

    public function up() {
        Schema::create('torrents', function($table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->binary('file');
            $table->bigInteger('size')->unsigned();
            $table->integer('downloads')->unsigned();
            $table->integer('seeders')->unsigned();
            $table->integer('leechers')->unsigned();
            $table->integer('uploader_id')->unsigned();
            $table->foreign('uploader_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::drop('torrents');
    }

}
