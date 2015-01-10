<?php

class Torrent extends Eloquent {

    public function category() {
        return $this->belongsTo('Category');
    }

    public function uploader() {
        return $this->belongsTo('User');
    }

    public function files() {
        return $this->hasMany('TorrentFile');
    }
    
}