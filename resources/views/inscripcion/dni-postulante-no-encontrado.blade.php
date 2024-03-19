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

                <div class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
                    <div class="text-center">
                        <p class="text-4xl font-semibold text-indigo-600">:(</p>
                        <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Carnet no
                            encontrado</h1>
                        <p class="mt-6 text-base leading-7 text-gray-600">Lo sentimos, aun no cuenta con carnet de
                            postulante. Se recomienda consultar cuando se hayan aceptado sus archivos como válidos.</p>
                        <p class="mt-6 text-base leading-7 text-gray-600">Vuelva a intentar mas tarde.</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <a href="{{ route('start') }}"
                                class="cursor-pointer mt-4 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Regresar
                                a Inicio <span>&rarr;</span></a>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>

</html>
