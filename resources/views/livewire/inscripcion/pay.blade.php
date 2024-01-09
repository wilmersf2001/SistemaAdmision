<div>
    <form action={{ route('pay.validatePayment') }} method="POST"
        class="mx-auto max-w-2xl rounded-3xl ring-1 ring-gray-200 lg:mx-0 lg:flex lg:max-w-none">
        @csrf
        <div class="px-8 py-6 lg:flex-auto">
            <h3 class="text-2xl font-bold tracking-tight text-gray-900">BIENVENIDO POSTULANTE</h3>
            <p class="mt-4 text-base leading-7 text-gray-600 text-justify">Para avanzar en tu proceso de admisión,
                asegúrate de haber completado el pago en el Banco de la Nación y luego ingresa los datos del voucher
                para verificar el pago.</p>

            <div class="mt-8 flex items-center gap-x-4 mb-5">
                <h4 class="flex-none text-base font-semibold leading-6 text-indigo-600">Información
                    de Postulación
                </h4>
                <div class="h-px flex-auto bg-gray-100"></div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <label class="block mb-6">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-gray-900 mr-2">
                        Modalidad
                    </span>
                    <select name="modalityId" wire:model="modalityId"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                        <option class="hidden">Seleccionar</option>
                        @foreach ($modalities as $modalitie)
                            <option value={{ $modalitie->id }}>
                                {{ $modalitie->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    <x-input.error for="modalityId" />
                </label>
                <label class="block mb-6">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-gray-900 mr-2">
                        Tipo de colegio de procedencia
                    </span>
                    <select name="typeSchoolId" wire:model="typeSchoolId"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                        <option class="hidden">Seleccionar</option>
                        <option value="1">Nacional</option>
                        <option value="2">Particular</option>
                    </select>
                    <x-input.error for="typeSchoolId" />
                </label>
            </div>

            <div class="mt-2 flex items-center gap-x-4 mb-5">
                <h4 class="flex-none text-base font-semibold leading-6 text-indigo-600">Información
                    de Pago
                </h4>
                <div class="h-px flex-auto bg-gray-100"></div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <label class="block mb-6">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-900">
                        Número de documento
                    </span>
                    <input type="text" name="numDocument" wire:model="numDocument" minlength="8" maxlength="9"
                        oninput="validarNumeroTelefono(this)"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                        placeholder="Ejem: 75635..." />
                    <x-input.error for="numDocument" />
                </label>
                <label class="block mb-6">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-gray-900 mr-2">
                        Número de voucher
                    </span>
                    <input type="text" name="voucherNumber" wire:model="voucherNumber" minlength="7" maxlength="7"
                        oninput="validarNumeroTelefono(this)"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                        placeholder="Ejem: 1742..." />
                    <x-input.error for="voucherNumber" />
                </label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <label class="block mb-6">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-900">
                        Número de agencia
                    </span>
                    <input type="text" name="agencyNumber" wire:model="agencyNumber" minlength="4" maxlength="4"
                        oninput="validarNumeroTelefono(this)"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                        placeholder="Ejem: 0230" />
                    <x-input.error for="agencyNumber" />
                </label>
                <label class="block mb-6">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-900">
                        Fecha del pago
                    </span>
                    <input type="date" name="payDay" wire:model="payDay"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                    <x-input.error for="payDay" />
                </label>
            </div>
        </div>
        <div class="-mt-2 p-2 lg:mt-0 lg:w-full lg:max-w-md lg:flex-shrink-0">
            <div
                class="h-full rounded-2xl bg-gray-50 py-8 text-center ring-1 ring-inset ring-gray-900/5 lg:flex lg:flex-col lg:justify-center">
                <div class="mx-auto max-w-xs px-8">
                    <div class="flex justify-center items-center">
                        <img src="{{ asset('images/logo_bn.png') }}" alt="Banco de la nacion" width="45"
                            height="45" />
                        <p class="ml-4 text-2xl tracking-tight text-gray-600">Banco de la Nación</p>
                    </div>
                    <p class="text-base font-semibold text-gray-600 mb-6">Datos del voucher</p>

                    <div class="overflow-hidden bg-white shadow-lg ring-1 ring-gray-900/5 py-2 px-2">
                        <div class="zoom-container w-60 h-60">
                            <div class="image-zoom w-full h-full cursor-zoom-in transition-transform duration-300 ease-out bg-cover"
                                style="background-image: url('{{ asset('images/voucher_ejemplo.png') }}')"></div>
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-8 block w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">INGRESAR</button>

                    <p class="mt-6 text-center text-xs text-gray-500">
                        ¿Necesitas consultar tasas de pago por derecho de inscripción y prospecto?
                        <a href="https://admision.unprg.edu.pe/costos" target="_blank"
                            class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">clic
                            aquí</a>
                    </p>

                    <div class="mt-2 flex items-center">
                        <p class="text-center text-xs text-gray-500 mr-2">
                            ¿Es usted administrador?
                        </p>
                        <a href="{{ route('login') }}" class="flex items-center justify-center">
                            <div
                                class="flex items-center justify-center w-6 h-6 bg-yellow-100 rounded-full lg:h-6 lg:w-6 shrink-0">
                                <div class="rounded-full bg-yellow-100 text-yellow-600">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if (session('alert'))
        <x-alerts.error message="{{ session('alert') }}" />
    @endif
</div>
