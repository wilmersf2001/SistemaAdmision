<div>
    <form action={{ route('credentials.updateCredentials') }} method="POST">
        @csrf
        <div class="grid md:grid-cols-3 md:gap-6">
            <label class="block mb-10">
                <span class="block text-sm font-medium text-slate-700">
                    Número de Usuario
                </span>
                <input type="text" wire:model="nuDni" name="nuDni"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                <x-input-error for="nuDni" />
            </label>
            <label class="block mb-10">
                <span class="block text-sm font-medium text-slate-700">
                    Credencial Anterior
                </span>
                <input type="text" wire:model="credencialAnterior" name="credencialAnterior"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                <x-input-error for="credencialAnterior" />
            </label>
            <label class="block mb-10">
                <span class="block text-sm font-medium text-slate-700">
                    Nueva Credencial
                </span>
                <input type="text" wire:model="credencialNueva" name="credencialNueva"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                <x-input-error for="credencialNueva" />
            </label>
        </div>
        <div class="flex w-full justify-end">
            @if ($errors->any())
                <button type="button" disabled
                    class="inline-flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm sm:ml-3 sm:w-auto">Actualizar
                    Credenciales</button>
            @else
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                    Actualizar Credenciales
                </button>
            @endif
        </div>
        <div>
        </div>
    </form>

    @if (session('message'))
        <x-notification isSuccess="true">
            <x-slot name="message">{{ session('message') }}</x-slot>
        </x-notification>
    @endif
</div>
