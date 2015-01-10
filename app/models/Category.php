<?php

class Category extends Eloquent {

    public $timestamps = false;

    public function torrents() {
        return $this->hasMany('Torrent');
    }

}