<?php

class UserController extends BaseController {

    public function user($id)
    {
        if (Auth::check()) {
            $torrents = Torrent::where('uploader_id', '=', $id)->orderBy('created_at', 'desc');
            return View::make('user', array('torrents' => $torrents->get(),  ));

       }
        return Redirect::to('/login');
    }
}
