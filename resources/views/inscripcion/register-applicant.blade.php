@extends('layouts.app')

@section('title', 'Registro de postulante')

@section('content')
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        @livewire('inscripcion.applicant', ['responseApiReniec' => $applicant, 'bank' => $bank, 'typeSchool' => $typeSchool])
    </div>
@endsection
