@extends('layouts.app')

@section('title', 'validar pago')

@section('processNumber', $processNumber)

@section('content')
    @livewire('inscripcion.pay')
@endsection
