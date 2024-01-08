<div class="animate-fade-in">
    <div class="flex justify-end">
        <button wire:click="openModal(1)"
            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mx-4">
            <x-icons.plus />
            Aperturar proceso
        </button>
    </div>
    @if ($processes->total() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Número de proceso
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Descripción
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Fecha Inicio
                                <a class="cursor-pointer" wire:click="orderDate(1)"><x-icons.order /></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Fecha fin
                                <a class="cursor-pointer" wire:click="orderDate(2)"> <x-icons.order /> </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Estado
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
                    @foreach ($processes as $i => $process)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $process->numero }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $process->descripcion }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $process->fecha_inicio }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $process->fecha_fin }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                @if ($process->estado == 0)
                                    <span
                                        class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">Pendiente</span>
                                @elseif($process->estado == 1)
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">En
                                        curso</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Cerrado</span>
                                @endif
                            </td>
                            <td class="flex justify-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex justify-center">
                                    <span class="sm:block mx-4">
                                        <div class="relative">
                                            <button wire:click="openModal(4,{{ $process->id }})"
                                                @if ($process->estado == 2) disabled @endif
                                                class="popover-trigger font-medium text-green-600 dark:text-green-500 hover:underline">
                                                @if ($process->estado == 2)
                                                    <x-icons.shield flag="1" />
                                                @else
                                                    <x-icons.shield flag="0" />
                                                @endif
                                            </button>
                                            @if ($process->estado != 2)
                                                <x-tooltip name="ejecutar" class="popover-hover" />
                                            @endif
                                        </div>
                                    </span>
                                    <span class="sm:block">
                                        <div class="relative">
                                            <button wire:click="openModal(5,{{ $process->id }})"
                                                @if ($process->estado == 2) disabled @endif
                                                class="popover-trigger font-medium text-red-600 dark:text-red-500 hover:underline">
                                                @if ($process->estado == 2)
                                                    <x-icons.aspa flag="1" size="6" />
                                                @else
                                                    <x-icons.aspa flag="0" size="6" />
                                                @endif
                                            </button>
                                            @if ($process->estado != 2)
                                                <x-tooltip name="terminar" class="popover-hover" />
                                            @endif
                                        </div>
                                    </span>
                                    <span class="sm:block mx-4">
                                        <div class="relative">
                                            <button wire:click="openModal(2,{{ $process->id }})"
                                                @if ($process->estado == 2) disabled @endif
                                                class="popover-trigger font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                @if ($process->estado == 2)
                                                    <x-icons.pencil flag="1" />
                                                @else
                                                    <x-icons.pencil flag="0" />
                                                @endif
                                            </button>
                                            @if ($process->estado != 2)
                                                <x-tooltip name="editar" class="popover-hover" />
                                            @endif
                                        </div>
                                    </span>
                                    <span class="sm:block">
                                        <div class="relative">
                                            <button wire:click="openModal(3,{{ $process }})"
                                                @if ($process->estado == 2) disabled @endif
                                                class="popover-trigger font-medium text-red-600 dark:text-red-500 hover:underline">
                                                @if ($process->estado == 2)
                                                    <x-icons.trash flag="1" />
                                                @else
                                                    <x-icons.trash flag="0" />
                                                @endif
                                            </button>
                                            @if ($process->estado != 2)
                                                <x-tooltip name="eliminar" class="popover-hover" />
                                            @endif
                                        </div>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($processes->total() > 10)
                {{ $processes->links() }}
            @endif
        </div>
    @else
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 mt-8" role="alert">
            <span class="font-medium">No se encontraron registros de procesos</span>
        </div>
    @endif

    @if ($showModal && $action == 1)
        @livewire('admision.process.create')
    @elseif($showModal && $action == 2)
        @livewire('admision.process.update', ['process' => $modalSelectedProcess])
    @elseif($showModal && $action == 3)
        @livewire('admision.process.delete', ['process' => $modalSelectedProcess])
    @elseif($showModal && $action == 4)
        @livewire('admision.process.run', ['process' => $modalSelectedProcess])
    @elseif($showModal && $action == 5)
        @livewire('admision.process.close', ['process' => $modalSelectedProcess])
    @endif

    @if (session('success'))
        <x-notification isSuccess="true">
            <x-slot name="message">{{ session('success') }}</x-slot>
        </x-notification>
    @endif

    @if ($errors->any())
        <x-notification isSuccess="false">
            <x-slot name="message">Error al crear o modificar proceso</x-slot>
        </x-notification>
    @endif
</div>
