<div>
    <x-modals.create-update route="user.assignPermission" :data="$user">
        <x-slot name="icon">
            <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33" />
            </svg>
        </x-slot>
        <x-slot name="title">
            Asignar Permiso - {{ $user->nombre }}
        </x-slot>
        <x-slot name="content">
            @method('PUT')
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Rol
                            </th>
                            <th scope="col" class="px-6 py-3 flex justify-center">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="px-4">
                                <span
                                    class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Revocar
                                    rol</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <input type="radio" name="idRol" value="0" wire:model="selectedRol"
                                        class="w-4 h-4 border-gray-300 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                            </td>
                        </tr>
                        @foreach ($roles as $rol)
                            <tr class="bg-white hover:bg-gray-50">
                                <td class="px-4">
                                    @if ($rol->name === 'admin')
                                        <span
                                            class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/10">Administrador</span>
                                    @elseif($rol->name === 'modify')
                                        <span
                                            class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/10">Modificar
                                            datos Postulante</span>
                                    @elseif($rol->name === 'validatePhotos')
                                        <span
                                            class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/10">Validar
                                            Postulante</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center">
                                        <input type="radio" name="idRol" value="{{ $rol->id }}"
                                            class="w-4 h-4 border-gray-300 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
        <x-slot name="buttonAceptar">
            <button type="submit"
                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                Confirmar
            </button>
        </x-slot>
        <x-slot name="buttonCancelar">
            <button type="button" wire:click="$emit('closeModal')"
                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
        </x-slot>
    </x-modals.create-update>
</div>
