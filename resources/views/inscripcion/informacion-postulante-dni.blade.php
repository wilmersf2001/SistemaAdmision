<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href={{ asset('\images\favicon.ico') }}>
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body style="min-height: 100vh; position: relative;">
    @php
        $processNumber = \App\Models\Proceso::getProcessNumber();
        $processOpen = \App\Models\Proceso::processOpen();
    @endphp
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/logo_unprg.png') }}" alt="UNPRG" width="40"
                                height="40" />
                        </div>
                        <div class="flex-col ml-2 hidden lg:grid">
                            <p class="text-xs font-semibold text-white">UNIVERSIDAD NACIONAL</p>
                            <p class="text-ms text-white">PEDRO RUIZ GALLO</p>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        @if ($processOpen)
                            <p class="text-white flex-col hidden lg:grid mr-4">PROCESO DE ADMISIÓN</p>
                            <h4 class="text-yellow-300 font-semibold text-2xl">
                                {{ $processNumber }}</h4>
                        @else
                            <div class="mt-2 flex items-center">
                                <a href="{{ route('login') }}" class="flex items-center justify-center">
                                    <div
                                        class="flex items-center justify-center w-6 h-6 bg-yellow-100 rounded-full lg:h-6 lg:w-6 shrink-0">
                                        <div class="rounded-full bg-yellow-100 text-yellow-600">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <main class="min-h-full pt-8 mx-auto max-w-7xl px-6 lg:px-8">
            @if ($processOpen || Route::currentRouteName() === 'login')
                @yield('content')
            @else
                <section class="bg-white rounded-3xl">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
                        <h1
                            class="mb-4 text-4xl font-semibold text-gray-900 tracking-tight leading-none md:text-5xl lg:text-6x">
                            PROCESO DE ADMISIÓN UNPRG</h1>
                        <h1
                            class="mb-4 text-4xl font-semibold tracking-tight leading-none text-red-500 md:text-5xl lg:text-6x">
                            CULMINADO</h1>
                        <div
                            class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4 mt-12">
                            <a href="https://admision.unprg.edu.pe/"
                                class="mt-4 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center animate-slide-in-down">
                                Ir al Portal UNPRG
                            </a>
                        </div>
                    </div>
                </section>
            @endif
            <div class="w-full h-28 md:h-20">
                <div>
                    <div class="px-4 sm:px-0">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">INFORMACIÓN POSTULANTE</h3>
                        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Datos personales y de postulación.</p>
                    </div>
                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">N° Doc. de Identidad</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ $postulante->num_documento }}
                                </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Nombre Completo</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ $postulante->nombres }} {{ $postulante->ap_paterno }}
                                    {{ $postulante->ap_materno }}
                                </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Programa Académico</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ $postulante->programaAcademico->nombre }}
                                </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Modalidad</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    {{ $postulante->modalidad->descripcion }}
                                </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Foto del Postulante</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <img src="{{ asset('storage/archivos_validos/foto_carnet/' . $dniDecodificado . '.jpg') }}"
                                        alt="UNPRG" width="180" height="180" />
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
