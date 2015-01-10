<?php

use Illuminate\Database\Migrations\Migration;

class CreateTorrentUsers extends Migration {

    public function up() {
        Schema::create('torrent_users', function($table) {
            $table->increments('id');
            $table->timestamps();
            //$table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('torrent_id')->references('id')->on('torrents');
        });
    }

    public function down() {
        Schema::drop('torrent_users');
    }

}
