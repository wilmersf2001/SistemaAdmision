@extends('layouts.navbar')

@section('title', 'Listar Validas')
@section('subtitle', 'ARCHIVOS VALIDOS')

@section('content')
    @livewire('admision.applicant-photos', ['file' => $file, 'fileStatus' => $fileStatus])
@endsection
