@extends('layouts.navbar')

@section('title', 'Lista Rectificar')
@section('subtitle', 'ARCHIVOS POR RECTIFICAR')

@section('content')
    @livewire('admision.applicant-photos', ['file' => $file, 'fileStatus' => $fileStatus])
@endsection
