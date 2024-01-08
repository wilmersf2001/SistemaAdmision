<div>
    <x-modals.create-update route="process.update" :data="$process">
        <x-slot name="icon">
            <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </x-slot>
        <x-slot name="title">
            Modificación de Proceso
        </x-slot>
        <x-slot name="content">
            @method('PUT')
            @if (!empty($penultimateProcess) && $process->estado == 0)
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
                    <input type="text" name="numeroProceso" value="{{ $process->numero }}" required
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                        placeholder="" />
                </label>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">

                @if ($process->estado == 1)
                    <label class="block mb-6">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Fecha inicio
                        </span>
                        <input type="date" value="{{ $process->fecha_inicio }}" disabled
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" />
                    </label>
                @else
                    <label class="block mb-6">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Fecha inicio
                        </span>
                        <input type="date" name="fechaInicio" wire:model="fecha_inicio" required
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                    </label>
                @endif
                @if ($process->estado == 1)
                    <label class="block mb-6">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Fecha fin
                        </span>
                        <input type="date" value="{{ $process->fecha_fin }}" disabled
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" />
                    </label>
                @else
                    <label class="block mb-6">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Fecha fin
                        </span>
                        <input type="date" name="fechaFin" wire:model="fecha_fin" required
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                    </label>
                @endif
            </div>
            @if ($process->estado == 0)
                <x-input-error for="fecha_inicio" />
                <x-input-error for="fecha_fin" />
                @if (session()->has('message'))
                    <p class="text-xs text-red-600 dark:text-red-500">{{ session('message') }}</p>
                @endif
            @endif
            <div class="grid md:grid-cols-1 md:gap-6">
                <label class="block">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                        Descripción
                    </span>
                    <textarea id="descripcion" name="descripcion" rows="3" required
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">{{ $process->descripcion }}</textarea>
                </label>
            </div>
        </x-slot>
        <x-slot name="buttonAceptar">
            <button type="submit"
                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                Modificar
            </button>
        </x-slot>
        <x-slot name="buttonCancelar">
            <button type="button" wire:click="$emit('closeModal')"
                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
        </x-slot>
    </x-modals.create-update>
</div>
