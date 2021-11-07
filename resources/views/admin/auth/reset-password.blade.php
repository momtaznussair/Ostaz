@extends('layouts.master2')

@section('title')
   {{__('Reset Password')}}
@endsection

@section('content')
    @livewire('admin.auth.password-reset')
@endsection