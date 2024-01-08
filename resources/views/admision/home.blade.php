@extends('layouts.navbar')

@section('title', 'Home')
@section('subtitle', 'BIENVENIDO')
@section('user', $firstName)

@section('content')
    <div class="bg-white py-12 sm:py-6 animate-fade-in px-10">
        <ul role="list" class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2">
            {{--             @can('validar-fotos') --}}
            <li class="rounded-2xl ring-1 ring-gray-200 max-w-md">
                <div class="flex items-center gap-x-4 rounded-tl-2xl rounded-tr-2xl py-2 px-4 bg-indigo-600">
                    <svg class="mr-2.5 h-5 w-5 flex-none stroke-white" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    <h4 class="flex-none text-sm font-semibold leading-6 text-white"> Carpeta archivos validas </h4>
                </div>
                <x-options route="applicant-photo.validPhotos">
                    <x-slot name="title">Archivos de postulantes válidos
                        <span
                            class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                            1<span>&rarr;</span>3
                        </span>
                    </x-slot>
                    <x-slot name="subtitle">Listar - valido</x-slot>
                </x-options>
                <x-options route="applicant-photo.validRectifiedPhotos">
                    <x-slot name="title">Archivos de postulantes validos
                        <span
                            class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                            7<span>&rarr;</span>3
                        </span>
                    </x-slot>
                    <x-slot name="subtitle">Listar - subsanación</x-slot>
                </x-options>
            </li>

            <li class="rounded-2xl ring-1 ring-gray-200 max-w-md">
                <div class="flex items-center gap-x-4 rounded-tl-2xl rounded-tr-2xl py-2 px-4 bg-indigo-600 mb-5">
                    <svg class="mr-2.5 h-5 w-5 flex-none stroke-white" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    <h4 class="flex-none text-sm font-semibold leading-6 text-white">Carpeta archivos observadas</h4>
                </div>
                <x-options route="applicant-photo.observedPhotos">
                    <x-slot name="title">Archivos de postulantes observados
                        <span
                            class="inline-flex items-center rounded-md bg-pink-50 px-2 py-1 text-xs font-medium text-pink-700 ring-1 ring-inset ring-pink-700/10">
                            1<span>&rarr;</span>2
                        </span>
                    </x-slot>
                    <x-slot name="subtitle">Listar - observado</x-slot>
                </x-options>
                <x-options route="applicant-photo.rectifyphotos">
                    <x-slot name="title">Archivos de postulantes observados
                        <span
                            class="inline-flex items-center rounded-md bg-pink-50 px-2 py-1 text-xs font-medium text-pink-700 ring-1 ring-inset ring-pink-700/10">
                            7<span>&rarr;</span>2
                        </span>
                    </x-slot>
                    <x-slot name="subtitle">Listar - reiterar observación</x-slot>
                </x-options>
            </li>
            {{-- @endcan --}}
        </ul>

    </div>

@endsection
