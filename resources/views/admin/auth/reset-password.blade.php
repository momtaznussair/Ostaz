@extends('layouts.master2')

@section('title')
   {{__('Reset Password')}}
@endsection

@section('content')
    @livewire('admin.auth.reset-password', ['email' => Request::route('email'), 'token' => Request::route('token')])
@endsection