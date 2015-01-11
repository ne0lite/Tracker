@extends('main')
@section('content')

<h2>Hello, {{{ Auth::user()->name }}}!</h2>

<br>
@if (count($torrents) == 0)
<div class="alert alert-info" role="alert">
No torrents uploaded yet.
</div>

@else
<h4>Uploaded torrents:</h4>
<br>
<table class="table table-bordered table-striped" id="torrents-table">
    <tr>
        <th>Torrent name</th>
        <th>Size</th>
        <th>Downloaded</th>
        <th>Seeders</th>
        <th>Leechers</th>
        <th>Category</th>
    </tr>
    @foreach ($torrents as $torrent)
         <tr>
            <td>
                <a href="{{{ url('torrents', $torrent->id) }}}">{{{ $torrent->name }}}</a>
                @if (!Auth::guest())
                <div class="pull-right">
                    <a class="download btn btn-default btn-xs" href="{{{ action('TorrentController@getDownload', array('id' => $torrent->id)) }}}" role="button">Download</a>
                    @if (Auth::user()->admin)
                    <a class="btn btn-danger btn-xs" href="{{{ action('TorrentController@deleteTorrent', array('id' => $torrent->id)) }}}" role="button">Delete</a>
                    @endif
                </div>
                @endif
            </td>
            <td>
                {{{ round($torrent->size/1024/1024, 2) }}} MB
            </td>
            <td class="downloads">
                {{{ $torrent->downloads }}}
            </td>
            <td>
                {{{ $torrent->seeders }}}
            </td>
            <td>
                 {{{ $torrent->leechers }}}
             </td>
            <td>
                <a href="{{{ url('torrents/search', strtolower($torrent->category->name)) }}}">
                {{{ $torrent->category->name }}}
                </a>
            </td>
        </tr>
    @endforeach
</table>
@endif

@stop