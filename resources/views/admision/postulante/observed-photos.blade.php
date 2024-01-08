@extends('layouts.navbar')

@section('title', 'Lista Observados')
@section('subtitle', 'ARCHIVOS OBSERVADOS')

@section('content')
    @livewire('admision.applicant-photos', ['file' => $file, 'fileStatus' => $fileStatus])
@endsection
