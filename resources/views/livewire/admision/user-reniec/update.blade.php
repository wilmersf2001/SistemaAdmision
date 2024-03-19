<x-modals.create-update route="userReniec.update" :data="$user">
    <x-slot name="icon">
        <x-icons.user />
    </x-slot>
    <x-slot name="title">
        Actualizar credenciales de {{ $user->nombresApellidos }}
    </x-slot>
    <x-slot name="content">
        @method('PUT')
        <div class="grid md:grid-cols-1 md:gap-6">
            <label class="block mb-10">
                <span class="block text-sm font-medium text-slate-700">
                    Credencial Anterior
                </span>
                <input type="text" wire:model="oldPassword" name="oldPassword"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                <x-input-error for="oldPassword" />
            </label>
        </div>
        <div class="grid md:grid-cols-1 md:gap-6">
            <label class="block mb-10">
                <span class="block text-sm font-medium text-slate-700">
                    Nueva Credencial
                </span>
                <input type="text" wire:model="newPassword" name="newPassword"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                <x-input-error for="newPassword" />
            </label>
        </div>
    </x-slot>
    <x-slot name="buttonAceptar">
        <button type="submit" {{ $errors->any() ? 'disabled' : '' }}
            class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
            Actualizar
        </button>
    </x-slot>
    <x-slot name="buttonCancelar">
        <button type="button" wire:click="$emit('closeModal')"
            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
    </x-slot>
</x-modals.create-update>
</div>
