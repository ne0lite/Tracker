<?php

class TorrentFile extends Eloquent {

    public $timestamps = false;

    public function torrent() {
        return $this->belongsTo('Torrent');
    }

}