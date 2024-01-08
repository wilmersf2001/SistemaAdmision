@extends('layouts.navbar')

@section('title', 'Usuarios')
@section('subtitle', 'GESTIONAR USUARIOS')

@section('content')
    @livewire('admision.user.users')
@endsection
