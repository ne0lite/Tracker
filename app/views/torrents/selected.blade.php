@extends('main')
@section('content')

<h2>{{{ $torrent->name  }}}</h2>

@if (!Auth::guest())
<p>
<a class="btn btn-default" href="{{{ action('TorrentController@getDownload', array('id' => $torrent->id)) }}}" role="button">Download</a>
</p>
@endif

<table class="table table-bordered table-striped">
<tr>
    <th>Name</th>
    <td>{{{ $torrent->name }}}</td>
</tr>
<tr>
    <th>Size</th>
    <td>{{{ round($torrent->size/1024/1024, 2) }}} MB</td>
</tr>
<tr>
    <th>Category</th>
    <td>{{{ $torrent->category->name }}}</td>
</tr>
<tr>
    <th>Uploaded</th>
    <td>{{{ $torrent->created_at }}}</td>
    </tr>
<tr>
    <th>Uploaded by</th>
    <td>{{{ $torrent->uploader->name }}}</td>
</tr>
</table>

<table class="table table-bordered table-striped">
<tr>
   <td><strong>Torrent files</strong></td>
</tr>
@foreach ($torrent->files as $file)
<tr>
   <td>{{{$file->name}}}</td>
</tr>
@endforeach
</table>

@stop