<div class="animate-fade-in">
    <div class="flex justify-end">
        <button wire:click="openModal(1)"
            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mx-4">
            <x-icons.plus />
            Crear usuario
        </button>
    </div>
    @if ($pagos->total() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                        <tr class="bg-white border-b dark:bg-white-800 dark:border-white-700">
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
