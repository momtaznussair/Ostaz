@extends('layouts.master2')

@section('title')
   {{__('Forgotten password')}}
@endsection

@section('content')
    @livewire('admin.auth.forgot-password')
@endsection