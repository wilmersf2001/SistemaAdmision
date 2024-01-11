<div class="animate-fade-in">
    <div class="flex justify-end">
        <button wire:click="openModal(1)"
            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mx-4">
            <x-icons.plus />
            Crear usuario
        </button>
    </div>
    @if ($users->total() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Nombre
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Apellidos
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Usuario
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Permisos
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">
                                Acción
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $i => $user)
                        <tr class="bg-white border-b dark:bg-white-800 dark:border-white-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                {{ $user->nombre }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                {{ $user->apellido }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                {{ $user->usuario }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                @if ($user->getRoleNames()->implode('') === 'admin')
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/10">Administrador</span>
                                @elseif($user->getRoleNames()->implode('') === 'modify')
                                    <span
                                        class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/10">Modificar
                                        datos Postulante</span>
                                @elseif($user->getRoleNames()->implode('') === 'validatePhotos')
                                    <span
                                        class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/10">Validar
                                        Postulante</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">No
                                        cuenta con permisos</span>
                                @endif
                            </td>
                            <td
                                class="flex justify-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                @if ($user->getRoleNames()->implode('') === 'admin')
                                    <div class="mr-4"><x-icons.lock /></div>
                                    <span class="sm:block mr-3">
                                        <div class="relative">
                                            <button type="button" wire:click="openModal(4,{{ $user }})"
                                                class="popover-trigger font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <x-icons.pencil flag="0" />
                                            </button>
                                            <x-tooltip name="editar" class="popover-hover" />
                                        </div>
                                    </span>
                                @else
                                    <div class="flex justify-center">
                                        <span class="sm:block mr-6">
                                            <div class="relative">
                                                <button type="button" wire:click="openModal(2,{{ $user }})"
                                                    class="popover-trigger font-medium text-yellow-600 dark:text-blue-500 hover:underline">
                                                    <x-icons.key />
                                                </button>
                                                <x-tooltip name="permisos" class="popover-hover" />
                                            </div>
                                        </span>
                                        <span class="sm:block mr-3">
                                            <div class="relative">
                                                <button type="button" wire:click="openModal(4,{{ $user }})"
                                                    class="popover-trigger font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    <x-icons.pencil flag="0" />
                                                </button>
                                                <x-tooltip name="editar" class="popover-hover" />
                                            </div>
                                        </span>
                                        <span class="sm:ml-3">
                                            <div class="relative">
                                                <button wire:click="openModal(3,{{ $user }})"
                                                    class="popover-trigger font-medium text-red-600 dark:text-red-500 hover:underline">
                                                    <x-icons.trash flag="0" />
                                                </button>
                                                <x-tooltip name="eliminar" class="popover-hover" />
                                            </div>
                                        </span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($users->total() > 10)
                {{ $users->links() }}
            @endif
        </div>
    @else
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 mt-8" role="alert">
            <span class="font-medium">No se encontraron registros de usuarios</span>
        </div>
    @endif

    @if ($showModal && $action == 1)
        @livewire('admision.user.create')
    @elseif($showModal && $action == 2)
        @livewire('admision.user.permission', ['user' => $modalSelectedUser])
    @elseif($showModal && $action == 3)
        @livewire('admision.user.delete', ['user' => $modalSelectedUser])
    @elseif($showModal && $action == 4)
        @livewire('admision.user.update', ['user' => $modalSelectedUser])
    @endif

    @if (session('success'))
        <x-notification isSuccess="true">
            <x-slot name="message">{{ session('success') }}</x-slot>
        </x-notification>
    @endif

    @if ($errors->any())
        <x-notification isSuccess="false">
            <x-slot name="message">Error al crear o modificar usuario</x-slot>
        </x-notification>
    @endif
</div>
