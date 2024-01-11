<x-modals.create-update route="user.update" :data="$user">
    <x-slot name="icon">
        <x-icons.user />
    </x-slot>
    <x-slot name="title">
        Editar Datos de {{ $user->nombre }}
    </x-slot>
    <x-slot name="content">
        @method('PUT')
        <div class="grid md:grid-cols-1 md:gap-6">
            <label class="block mb-6">
                <span
                    class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                    Nombres
                </span>
                <input type="text" name="nombre" wire:model="user.nombre" required
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                    placeholder="Ejem: Juan" />
                <x-input-error for="user.nombre" />
            </label>
        </div>
        <div class="grid md:grid-cols-1 md:gap-6">
            <label class="block mb-6">
                <span
                    class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                    Apellidos
                </span>
                <input type="text" name="apellido" wire:model="user.apellido" required
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                    placeholder="Ejem: Perez" />
                <x-input-error for="user.apellido" />
            </label>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
            <label class="block mb-6">
                <span
                    class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                    Usuario
                </span>
                <input type="text" name="usuario" wire:model="user.usuario" required
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                    placeholder="Ejem: jperez" />
                <x-input-error for="user.usuario" />
            </label>
            <label class="block mb-6">
                <span
                    class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                    Nueva contraseña
                </span>
                <input type="password" name="password" wire:model="newPassword"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                    placeholder="********" />
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
