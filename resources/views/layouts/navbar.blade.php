<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href={{ asset('\imgs\favicon.ico') }}>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>@yield('title')</title>

    @livewireStyles

</head>

<body>
    @php
        $processNumber = \App\Models\Proceso::getProcessNumber();
    @endphp
    <div>{{-- max-w-7xl --}}
        <nav class="fixed top-0 z-50 w-full bg-gray-800 border-b border-gray-200">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-700 focus:outline-none focus:ring-gray-200">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>

                        </button>
                        <div class="flex items-center md:me-24">
                            <div class="flex-shrink-0 me-3">
                                <img src="{{ asset('images/logo_unprg.png') }}" alt="UNPRG" width="30"
                                    height="30" />
                            </div>
                            <div class="flex-col ml-2 lg:grid">
                                <p class="text-xs font-semibold text-white">UNIVERSIDAD NACIONAL</p>
                                <p class="text-ms text-white">PEDRO RUIZ GALLO</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center ms-3">
                        <div>
                            <div class="lg:flex lg:flex-1 lg:justify-end">
                                <form action="{{ route('auth.logout') }}" method="POST">
                                    @csrf
                                    <button
                                        class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                        type="submit">
                                        <div class="flex items-center">
                                            <x-icons.out />
                                            <p class="ml-1">Salir</p>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
                <ul class="space-y-2 font-medium">
                    {{-- @can('validar-fotos') --}}
                    <li>
                        <a href={{ route('home') }}
                            class="flex font-medium items-center px-3 py-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <x-icons.home />
                            <span class="flex-1 ms-3 whitespace-nowrap font-normal">Home</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('validar-fotos') --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full px-3 py-2 text-base text-gray-900 transition rounded-lg group hover:bg-gray-100"
                            aria-controls="dropdown-email" data-collapse-toggle="dropdown-email">
                            <x-icons.mail />
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Enviar
                                correos</span>
                            <x-icons.chevron-down />
                        </button>
                        <ul id="dropdown-email" class="hidden py-2 space-y-2 font-normal">
                            <li>
                                <a href={{ route('applicant-photo.validPhotos') }}
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Archivos
                                    validos</a>
                            </li>
                            <li>
                                <a href={{ route('applicant-photo.validRectifiedPhotos') }}
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Archivos
                                    rectificados</a>
                            </li>
                            <li>
                                <a href={{ route('applicant-photo.observedPhotos') }}
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Archivos
                                    observados</a>
                            </li>
                            <li>
                                <a href={{ route('applicant-photo.rectifyphotos') }}
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Reiterar
                                    observación</a>
                            </li>
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('modificar-postulante') --}}
                    <li>
                        <a href={{ route('home.modifyApplicant') }}
                            class="flex font-medium items-center px-3 py-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <x-icons.pencil flag='0' size='5' />
                            <span class="flex-1 ms-3 whitespace-nowrap font-normal">Modificar</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('visualizar-constancias') --}}
                    <li>
                        <a {{-- href={{ route('home.inscriptionComprobant') }} --}}
                            class="flex font-medium items-center px-3 py-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <x-icons.doc />
                            <span class="flex-1 ms-3 whitespace-nowrap font-normal">Ver ficha</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('usuarios') --}}
                    <li>
                        <a href={{ route('home.user') }}
                            class="flex font-medium items-center px-3 py-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <x-icons.users />
                            <span class="flex-1 ms-3 whitespace-nowrap font-normal">Usuarios</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                </ul>
                {{-- <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200">
                    @can('usuarios')
                        <li>
                            <a href={{ route('home.processOpening') }}
                                class="flex font-medium items-center px-3 py-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <x-icons.open-process />
                                <span class="flex-1 ms-3 whitespace-nowrap font-normal">Procesos de admisión</span>
                            </a>
                        </li>
                    @endcan
                    @can('usuarios')
                        <li>
                            <button type="button"
                                class="flex items-center w-full px-3 py-2 text-base text-gray-900 transition rounded-lg group hover:bg-gray-100"
                                aria-controls="dropdown-txt" data-collapse-toggle="dropdown-txt">
                                <x-icons.dollar />
                                <span
                                    class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal truncate">Pagos
                                    Banco
                                </span>
                                <x-icons.chevron-down />
                            </button>
                            <ul id="dropdown-txt" class="hidden py-2 space-y-2 font-normal">
                                <li>
                                    <a href={{ route('home.uploadTxtFile') }}
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Subir
                                        txt</a>
                                </li>
                                <li>
                                    <a href={{ route('home.uploadedFiles') }}
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Archivos
                                        subidos</a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('usuarios')
                        <li>
                            <button type="button"
                                class="flex items-center w-full px-3 py-2 text-base text-gray-900 transition rounded-lg group hover:bg-gray-100"
                                aria-controls="dropdown-vacantes" data-collapse-toggle="dropdown-vacantes">
                                <x-icons.users />
                                <span
                                    class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Vacantes</span>
                                <x-icons.chevron-down />
                            </button>
                            <ul id="dropdown-vacantes" class="hidden py-2 space-y-2 font-normal">
                                <li>
                                    <a href={{ route('home.assignVacancies') }}
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Asignar</a>
                                </li>
                                <li>
                                    <a href={{ route('home.vacancyDistribution') }}
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Visualizar</a>
                                </li>

                            </ul>
                        </li>
                    @endcan
                </ul> --}}
            </div>
        </aside>

        <div class="sm:ml-64">
            <header class="bg-white shadow mt-14">
                <div class="mx-auto px-4 py-10 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">@yield('subtitle') @yield('user')
                    </h1>
                </div>
                <div class="inline-block px-4 lg:px-8">
                    <h2
                        class="font-medium text-xs tracking-tight text-white bg-gray-800 px-4 py-2 rounded-tl-lg rounded-tr-lg">
                        @if ($processNumber)
                            ADMISIÓN {{ $processNumber }}
                        @else
                            <span
                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">No
                                hay proceso en curso.</span>
                        @endif
                    </h2>
                </div>
            </header>

            <div class="rounded-lg">
                <div class="px-6 py-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    {{-- <footer class="bg-white shadow w-full z-50" style="position: absolute; bottom:0">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                    href="http://www.unprg.edu.pe/univ/portal/index.php" class="hover:underline">UNPRG</a>. Todos los
                derechos
                reservados - Oficina de Tecnología de la Información.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="http://www.unprg.edu.pe/univ/portal/index.php" target="_blank"
                        class="mr-4 hover:underline md:mr-6 ">Universidad
                        Nacional Pedro Ruiz Gallo</a>
                </li>
            </ul>
        </div>
    </footer> --}}
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
</body>

</html>
