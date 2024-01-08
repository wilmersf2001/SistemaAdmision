@extends('layouts.app')

@section('title', 'Registro Completado')

@section('content')
    <div class="py-10">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left transition-all w-full">
            <div class="bg-blue-50 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start mb-8">
                    <div
                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-semibold leading-6 text-red-600" id="modal-title">IMPORTANTE</h3>
                        <div class="my-4">
                            <p class="text-base text-gray-800">En las próximas horas se estará validando su inscripción, de
                                encontrarse conforme se remitirá a su correo
                                electrónico la <b>constancia de inscripción</b> al proceso de Admisión 2024-I (o descargarla
                                <a href="http://127.0.0.1:8000/ficha-inscripcion" target="_blank"
                                    class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">aquí</a>),
                                <b>la cual deberá imprimir y canjearla por su carné de postulante</b> en la Oficina de
                                Tecnología
                                de la Información - Campus Universitario.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-start-2 gap-x-2 grid grid-cols-4 sm:gap-x-10">
                    <div class="group relative">
                        <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ asset('images/paso1.jpeg') }}" alt="Paso 1" class="object-cover object-center">
                        </div>
                    </div>
                    <div class="group relative">
                        <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ asset('images/paso2.jpeg') }}" alt="Paso 2" class="object-cover object-center">
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="group relative text-blue-600">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-10 h-10 sm:w-32 sm:h-32">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-xs group relative sm:text-sm">
                        <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                            <img src="{{ asset('images/paso3.jpeg') }}" alt="Paso 3" class="object-cover object-center">
                        </div>
                        <a href="{{ route('ficha.startPdfQuery') }}" class="block">
                            <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="text-xs flex sm:text-sm">
                    <div class="w-1/2 flex justify-center font-bold text-red-600">
                        CULMINADOS
                    </div>
                    <div class="w-1/2 flex justify-end font-bold text-green-600">
                        SIGUENTE
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 flex sm:px-6 justify-end">
                <a href="https://admision.unprg.edu.pe/"
                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Volver
                    al Portal UNPRG</a>
            </div>
        </div>
    </div>
@endsection
