@extends('layouts.app')

@section('title', 'Consulta postulante')

@section('content')
    <div class="flex justify-center">
        <div class="mx-auto max-w-lg rounded-3xl ring-1 ring-gray-200 lg:flex lg:max-w-4xl">
            <div class="p-8 sm:p-10 lg:flex-auto">
                <div class="mt-4 flex items-center gap-x-4">
                    <h4 class="flex-none text-lg font-semibold leading-6 text-indigo-600">CONSULTAR INSCRIPCIÓN
                    </h4>
                    <div class="h-px flex-auto bg-gray-100"></div>
                </div>
                <ul role="list" class="mt-8 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600 sm:gap-6 list-disc">
                    <li class="flex gap-x-3">
                        <h5 class="text-sm font-bold text-gray-600">Recuerda que:</h5>
                    </li>
                    <li class="text-gray-400"><span class="text-gray-600">El horario de recojo del carné de postulante
                            es de lunes a viernes, de 08:00 a.m. a 1:30 p.m. y de 03:30 p.m. a 06:00 p.m., en la Oficina
                            de Tecnologías de la Información.</span></li>
                    <li class="text-gray-400"><span class="text-gray-600">Debe esperar a que sus fotos sean aprobadas
                            para poder generar su ficha de inscripción.</span></li>
                    <li class="text-gray-400"><span class="text-gray-600">La aprobación de las fotos o las observaciones
                            sobre las mismas se comunicarán a través de su correo electrónico o consultando aqui.</span>
                    </li>
                </ul>
            </div>
            <div class="lg:w-full lg:max-w-md lg:flex-shrink-0">
                <div class="flex min-h-full flex-col justify-center lg:px-8">
                    <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm p-4">
                        @livewire('inscripcion.ficha-inscripcion')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
