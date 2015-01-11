@extends('main')
@section('content')

<h2>Upload new torrent</h2>

{{ Form::open(array('url' => 'upload','files'=>true, 'class' => 'form-horizontal')) }}

<div class="form-group">
    {{ Form::label('category', 'Category', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
        @foreach($errors->get('category') as $message)
        <p class="error_msg">{{ $message }}</p>
        @endforeach
        {{ Form::select('category', $categories, null, array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('file', 'Torrent file', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
        @foreach($errors->get('file') as $message)
        <p class="error_msg">{{ $message }}</p>
        @endforeach
        {{ Form::file('file','',array('id'=>'','class'=>'')) }}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ Form::submit('Upload', array('class' => 'btn btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop