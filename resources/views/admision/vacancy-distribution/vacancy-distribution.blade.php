@extends('layouts.navbar')

@section('title', 'Tabla de distribucion de vacantes')
@section('subtitle', 'TABLA DE VACANTES')

@section('content')
    @livewire('admision.vacancy-distribution.vacancy-distribution')
@endsection
