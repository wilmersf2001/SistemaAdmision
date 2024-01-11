<div class="animate-fade-in">
    @if ($postulantes->total() > 0)
        <div class="flex justify-end">
            <button wire:click="openAlert"
                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mx-4">
                Actualización Total
            </button>
        </div>
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
                                Número de documento
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Tipo de documento
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
                    @foreach ($postulantes as $i => $postulante)
                        <tr class="bg-white border-b dark:bg-white-800 dark:border-white-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postulante->nombres }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postulante->ap_paterno }} {{ $postulante->ap_materno }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postulante->num_documento }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                @if ($postulante->tipo_documento == 1)
                                    DNI
                                @else
                                    CE
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <x-badge :estado="$postulante->estado_postulante_id" />
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <button wire:click="updateStatePostulante({{ $postulante }})"
                                    class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mx-4">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33" />
                                    </svg>
                                    Huella
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($postulantes->total() > 10)
                {{ $postulantes->links() }}
            @endif
        </div>
    @else
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 mt-8" role="alert">
            <span class="font-medium">No se encontraron registros de postulantes</span>
        </div>
    @endif

    @if ($showAlert)
        <x-modals.warning color="blue">
            <x-slot name="title">¿Seguro que desea actualizar el estado de todos los postulantes?</x-slot>
            <x-slot name="content"> Pasará a un estado de <strong>Huella Digital</strong>. </x-slot>
            <x-slot name="button">
                <div class="flex justify-center">
                    <span class="sm:ml-3">
                        <button type="button" wire:click="updateStateTotalPostulante"
                            class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                            Confirmar
                        </button>
                    </span>
                </div>
                <button type="button" wire:click="$set('showAlert', false)"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancelar</button>
            </x-slot>
        </x-modals.warning>
    @endif
</div>
