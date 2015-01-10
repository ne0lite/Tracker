<?php

use Illuminate\Database\Migrations\Migration;

class CreateTorrentFiles extends Migration {

    public function up() {
        Schema::create('torrent_files', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('size')->unsigned();
            $table->integer('torrent_id')->unsigned();
            $table->foreign('torrent_id')->references('id')->on('torrents')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::drop('torrent_files');
    }

}
