@extends('main')
@section('content')

<h2>Latest torrents</h2>

<p>
<strong>Category:</strong>
<a href="{{{ url('torrents') }}}">All</a>
@foreach ($categories as $cat)
<a href="{{{ url('torrents/search', strtolower($cat->name)) }}}">{{{$cat->name}}}</a>
@endforeach
</p>

<form class="form-inline">
<input type="text" name="text" value="{{{$search}}}" class="form-control input-sm" style="width: 200px">
<input type="submit" value="Search" class="btn btn-default btn-sm">
</form>

<br>

@if (count($torrents) == 0)
<div class="alert alert-info" role="alert">
No torrents found.
</div>
@else
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