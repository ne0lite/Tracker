<?php

use Illuminate\Database\Migrations\Migration;

class CreateTorrentUsers extends Migration {

    public function up() {
        Schema::create('torrent_users', function($table) {
            $table->increments('id');
            $table->timestamps();
            $table->binary('peer_id');
            $table->string('ip')->default('');
            $table->integer('port')->default(0);
            $table->boolean('seeding')->default(false);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('torrent_id')->unsigned();
            $table->foreign('torrent_id')->references('id')->on('torrents');
        });
    }

    public function down() {
        Schema::drop('torrent_users');
    }

}
