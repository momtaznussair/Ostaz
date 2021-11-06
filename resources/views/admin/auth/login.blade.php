@extends('layouts.master2')

@section('title')
   {{__('Login')}}
@endsection

@section('content')
    @livewire('admin.auth.login')
@endsection