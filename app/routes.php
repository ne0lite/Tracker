<?php

Route::get('/', 'TorrentController@getTorrents');

Route::get('/login', 'AuthController@getLogin');
Route::post('/login', 'AuthController@postLogin');
Route::get('/logout', 'AuthController@getLogout');
Route::get('/register', 'AuthController@getRegister');
Route::post('/register', 'AuthController@postRegister');

Route::get('/torrents', 'TorrentController@getTorrents');
Route::get('/torrents/rss', 'TorrentController@getTorrentsRSS');
Route::get('/torrents/search/{category}', 'TorrentController@getTorrents');
Route::get('/torrents/{id}', 'TorrentController@getDetails');
Route::get('/torrents/{id}/delete', 'TorrentController@deleteTorrent');
Route::get('/torrents/{id}/download', 'TorrentController@getDownload');
Route::get('/upload', 'TorrentController@getUpload');
Route::post('/upload', 'TorrentController@postUpload');

Route::get('/user/{id}', 'UserController@user');
