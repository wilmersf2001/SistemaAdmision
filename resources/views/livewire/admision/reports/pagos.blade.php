<div class="animate-fade-in">
    @if ($pagos->total() > 0)
        <div class="flex justify-between">
            <div class="grid grid-cols-2 gap-6">
                <label class="block mb-6">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-900">
                        Desde
                    </span>
                    <input type="date" wire:model="fechaDesde" name="fecha_desde"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                    {{-- <x-input.error for="payDay" /> --}}
                </label>
                <label class="block mb-6">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-900">
                        Hasta
                    </span>
                    <input type="date" wire:model="fechaHasta" name="fecha_hasta"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                    {{-- <x-input.error for="payDay" /> --}}
                </label>
            </div>
            <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow">
                <ul role="list" class="space-y-2">
                    <li class="flex">
                        <svg class="flex-shrink-0 w-4 h-4 text-blue-600" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="text-base font-normal leading-tight text-gray-900 ms-3">Total inscritos colegio
                            nacional: {{ $totalInsNacional }}</span>
                    </li>
                    <li class="flex">
                        <svg class="flex-shrink-0 w-4 h-4 text-blue-600" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="text-base font-normal leading-tight text-gray-900 ms-3">Total inscritos colegio
                            particular: {{ $totalInsParticular }}</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-4 h-4 text-blue-600" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="text-base font-normal leading-tight text-gray-900 ms-3">Total de pagos realizados:
                            {{ $pagos->total() }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                N° Oficina
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Concepto
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                N° Documento
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Importe
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">
                                Fecha de pago
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">
                                N° documento de depositante
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $i => $pago)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $pago->num_oficina }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $pago->cod_concepto }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $pago->num_documento }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $pago->importe }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $pago->fecha }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                {{ $pago->num_doc_depo }} -
                                @if ($pago->tipo_doc_depo == '1')
                                    DNI
                                @else
                                    CE
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($pagos->total() > 10)
                {{ $pagos->links() }}
            @endif
        </div>
    @else
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 mt-8" role="alert">
            <span class="font-medium">No se encontraron registros de usuarios</span>
        </div>
    @endif
</div>
