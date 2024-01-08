<div>
    <div class="animate-fade-in">
        <div class="mt-4">
            @if ($txtfiles->total() > 0)
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nombre de archivo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Fecha de subida
                                        <a class="cursor-pointer" wire:click="orderDate"><x-icons.order /></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center justify-center">
                                        Hora de subida
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="flex items-center justify-center">Cantidad de registros</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($txtfiles as $txtfile)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <div class="flex flex-1 items-center">
                                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                <span class="truncate">{{ $txtfile->nombre }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $txtfile->created_at->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $txtfile->created_at->format('h:i A') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $txtfile->cantidad_registros }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($txtfiles->total() > 10)
                        {{ $txtfiles->links() }}
                    @endif
                </div>
            @else
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 mt-8" role="alert">
                    <span class="font-medium">No hay archivos txt cargados</span>
                </div>
            @endif
        </div>
    </div>
    @if (session('success'))
        <x-result-alert title="Registro de archivo txt exitosa" message="{{ session('success') }}" result="success" />
    @endif
    @if (session('error'))
        <x-result-alert title="Error en la carga del archivo txt" message="{{ session('error') }}" result="error" />
    @endif
</div>
