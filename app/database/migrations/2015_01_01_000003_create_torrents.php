<?php

use Illuminate\Database\Migrations\Migration;

class CreateTorrents extends Migration {

    public function up() {
        Schema::create('torrents', function($table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->bigInteger('size')->unsigned();
            $table->integer('downloads')->unsigned();
            $table->integer('uploader_id')->unsigned();
            $table->foreign('uploader_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        // http://stackoverflow.com/questions/20089652/laravel-mediumblob-for-database
        DB::statement("ALTER TABLE torrents ADD file LONGBLOB");
    }

    public function down() {
        Schema::drop('torrents');
    }

}
