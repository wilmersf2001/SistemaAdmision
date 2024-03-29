@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')
    <div class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-4xl font-semibold text-indigo-600">404</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Página no encontrada</h1>
            <p class="mt-6 text-base leading-7 text-gray-600">Lo sentimos, no pudimos encontrar la página que estás buscando.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('start') }}"
                    class="cursor-pointer mt-4 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Regresar a Inicio <span>&rarr;</span></a>
            </div>
        </div>
    </div>

@endsection
