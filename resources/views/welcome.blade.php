@extends('layouts.master2')

@section('title')
   {{__('Login')}}
@endsection

@section('content')
    <div class="container">
        {!! Form::open(['url' => 'http://www.ostaz.com/api/login']) !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            {!! Form::submit('Login', []) !!}
        {!! Form::close() !!}
    </div>
@endsection