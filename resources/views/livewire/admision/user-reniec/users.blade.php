<div class="animate-fade-in">
    <div class="flex justify-end">
        <button wire:click="openModal(1)"
            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mx-4">
            <x-icons.plus />
            Registrar usuario
        </button>
    </div>
    @if ($users->total() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                DNI del Usuario
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Nombres y Apellidos
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Cantidad de Consultas
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Creado
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Días por Vencer
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
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $user->nuDniUsuario }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $user->nombresApellidos }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $user->numeroConsultas }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('Y-m-d', strtotime($user->created_at)) }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <x-days-expire-credentials-semaforo :dias="$this->diasPorVencer($user->fechaActualizacionCredencial)" />
                            </td>
                            <td class="flex justify-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex justify-center">
                                    <span class="sm:block mr-3">
                                        <div class="relative">
                                            <button type="button" wire:click="openModal(2,{{ $user }})"
                                                class="popover-trigger font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <x-icons.pencil flag="0" />
                                            </button>
                                            <x-tooltip name="editar" class="popover-hover" />
                                        </div>
                                    </span>
                                </div>
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
        @livewire('admision.user-reniec.register')
    @elseif($showModal && $action == 2)
        @livewire('admision.user-reniec.update', ['user' => $modalSelectedUser])
    @endif

    @if (session('success'))
        <x-notification isSuccess="true">
            <x-slot name="message">{{ session('success') }}</x-slot>
        </x-notification>
    @endif

    @if (session('error'))
        <x-notification isSuccess="false">
            <x-slot name="message">{{ session('error') }}</x-slot>
        </x-notification>
    @endif

    @if ($errors->any())
        <x-notification isSuccess="false">
            <x-slot name="message">Error al crear o modificar usuario</x-slot>
        </x-notification>
    @endif
</div>
