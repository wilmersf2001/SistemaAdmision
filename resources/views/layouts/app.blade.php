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
    @livewireStyles
</head>

<body style="min-height: 100vh; position: relative;">
    @php
        $processNumber = \App\Models\Proceso::getProcessNumber();
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
                        @if ($processNumber)
                            <p class="text-white flex-col hidden lg:grid mr-4">PROCESO DE ADMISIÓN</p>
                            <h4 class="text-yellow-300 font-semibold text-2xl">
                                {{ $processNumber }}</h4>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <main class="min-h-full pt-8 mx-auto max-w-7xl px-6 lg:px-8">
            @if ($processNumber || Route::currentRouteName() === 'login')
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
            <div class="w-full h-28 md:h-20"></div>
        </main>
        <x-footer />
    </div>

    @livewireScripts
</body>

</html>
