@extends('main')
@section('content')

<h2>Login</h2>

{{ Form::open(array('url' => 'login', 'class' => 'form-horizontal')) }}

@foreach($errors->all() as $message)
<p class="error_msg">{{ $message }}</p>
@endforeach

<div class="form-group">
        {{ Form::label('email', 'Email address', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::email('email', null, array('class' => 'form-control', 'placeholder'=> 'Enter email' )) }}
    </div>
</div>
<div class="form-group">
        {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::password('password', array('class' => 'form-control', 'placeholder'=> 'Password' )) }}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          {{ Form::checkbox('remember_me') }} Remember me
        </label>
      </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ Form::submit('Login', array('class' => 'btn btn-default')) }}
    </div>
</div>

    {{--<tr>--}}
        {{--<td>--}}
            {{--{{ Form::label('email', 'Email address') }}--}}
        {{--</td>--}}
        {{--<td>--}}
            {{--{{ Form::email('email') }}--}}
        {{--</td>--}}
    {{--</tr>--}}

    {{--<tr>--}}
        {{--<td>--}}
            {{--{{ Form::label('password', 'Password') }}--}}
        {{--</td>--}}
        {{--<td>--}}
            {{--{{ Form::password('password') }}--}}
        {{--</td>--}}
    {{--</tr>--}}

    {{--<tr>--}}
        {{--<td>--}}
            {{--{{ Form::label('remember_me', 'Remember me') }}--}}
        {{--</td>--}}
        {{--<td>--}}
            {{--{{ Form::checkbox('remember_me') }}--}}
        {{--</td>--}}
    {{--</tr>--}}

    {{--<tr>--}}
        {{--<td colspan="2">--}}
            {{--{{ Form::submit('Login') }}--}}
        {{--</td>--}}
    {{--</tr>--}}

{{ Form::close() }}

@stop