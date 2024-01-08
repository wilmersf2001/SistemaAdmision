<div>
    @if ($processExists)
        <x-modals.warning color="blue">
            <x-slot name="title">Advertencia</x-slot>
            <x-slot name="content">
                Existe un proceso pendiente de curso, debe ejecutar el inicio del proceso para poder aperturar un nuevo
                proceso.
            </x-slot>
            <x-slot name="button">
                <button type="button" wire:click="$emit('closeModal')"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Aceptar</button>
            </x-slot>
        </x-modals.warning>
    @else
        <x-modals.create-update route="process.store" :data="null">
            <x-slot name="icon">
                <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </x-slot>
            <x-slot name="title">
                Aperturar Nuevo Proceso
            </x-slot>
            <x-slot name="content">
                @if (!empty($lastProcess))
                    <div class="mb-4">
                        <p class="text-xs text-blue-600 mb-1">Fecha de último proceso aperturado</p>
                        <span
                            class="mb-2 bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded border border-blue-400">
                            <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                            </svg>
                            {{ $lastProcessDateformatted }}
                        </span>
                    </div>
                @endif
                <div class="grid md:grid-cols-1 md:gap-6">
                    <label class="block mb-6">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Número
                        </span>
                        <input type="text" name="numeroProceso" wire:model="numero_proceso" required
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                            placeholder="" />
                        <x-input-error for="numero_proceso" />
                    </label>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <label class="block mb-6">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Fecha inicio
                        </span>
                        <input type="date" name="fechaInicio" wire:model="fecha_inicio" required
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                    </label>
                    <label class="block mb-6">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Fecha fin
                        </span>
                        <input type="date" name="fechaFin" wire:model="fecha_fin" required
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                    </label>
                </div>
                <x-input-error for="fecha_inicio" />
                <x-input-error for="fecha_fin" />
                <div class="grid md:grid-cols-1 md:gap-6">
                    <label class="block">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Descripción
                        </span>
                        <textarea id="descripcion" name="descripcion" rows="3" required
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></textarea>
                    </label>
                </div>
            </x-slot>
            <x-slot name="buttonAceptar">
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                    Aperturar
                </button>
            </x-slot>
            <x-slot name="buttonCancelar">
                <button type="button" wire:click="$emit('closeModal')"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
            </x-slot>
        </x-modals.create-update>
    @endif
</div>
