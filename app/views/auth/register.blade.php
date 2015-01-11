@extends('main')
@section('content')

<h2>Register</h2>


{{ Form::open(array('url' => 'register', 'class' => 'form-horizontal')) }}


<div class="form-group">
        @foreach($errors->get('name') as $message)
            <p colspan="2" class="error_msg">{{ $message }}</p>
        @endforeach
        {{ Form::label('name', 'Full name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, array('class' => 'form-control', 'placeholder'=> 'Enter email' )) }}
    </div>
</div>
<div class="form-group">
    @foreach($errors->get('email') as $message)
        <p colspan="2" class="error_msg">{{ $message }}</p>
    @endforeach
        {{ Form::label('email', 'Email address', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::email('email', null, array('class' => 'form-control', 'placeholder'=> 'Enter email' )) }}
    </div>
</div>
<div class="form-group">
    @foreach($errors->get('password') as $message)
        <p colspan="2" class="error_msg">{{ $message }}</p>
    @endforeach
        {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::password('password',  array('class' => 'form-control', 'placeholder'=> 'Password' )) }}
    </div>
</div>
<div class="form-group">
        {{ Form::label('password_confirmation', 'Password confirmation', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder'=> 'Password again' )) }}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ Form::submit('Register', array('class' => 'btn btn-default')) }}
    </div>
</div>


{{--<table>--}}

    {{--@foreach($errors->get('name') as $message)--}}
    {{--<tr><td colspan="2" class="error_msg">{{ $message }}</td></tr>--}}
    {{--@endforeach--}}

    {{--<tr>--}}
        {{--<td>--}}
            {{--{{ Form::label('name', 'Full name') }}--}}
        {{--</td>--}}
        {{--<td>--}}
            {{--{{ Form::text('name') }}--}}
        {{--</td>--}}
    {{--</tr>--}}

    {{--@foreach($errors->get('email') as $message)--}}
    {{--<tr><td colspan="2" class="error_msg">{{ $message }}</td></tr>--}}
    {{--@endforeach--}}

    {{--<tr>--}}
        {{--<td>--}}
            {{--{{ Form::label('email', 'Email address') }}--}}
        {{--</td>--}}
        {{--<td>--}}
            {{--{{ Form::email('email') }}--}}
        {{--</td>--}}
    {{--</tr>--}}

    {{--@foreach($errors->get('password') as $message)--}}
    {{--<tr><td colspan="2" class="error_msg">{{ $message }}</td></tr>--}}
    {{--@endforeach--}}

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
            {{--{{ Form::label('password_confirmation', 'Confirm password') }}--}}
        {{--</td>--}}
        {{--<td>--}}
            {{--{{ Form::password('password_confirmation') }}--}}
        {{--</td>--}}
    {{--</tr>--}}

    {{--<tr>--}}
        {{--<td colspan="2">--}}
            {{--{{ Form::submit('Register') }}--}}
        {{--</td>--}}
    {{--</tr>--}}

{{--</table>--}}

{{ Form::close() }}

@stop