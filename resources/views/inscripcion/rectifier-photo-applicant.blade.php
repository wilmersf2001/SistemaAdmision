@extends('layouts.app')

@section('title', 'Registro Completado')

@section('content')
    @livewire('inscripcion.rectifier-photo-applicant', ['applicant' => $applicant, 'observedPhotos' => $observedPhotos])
@endsection
