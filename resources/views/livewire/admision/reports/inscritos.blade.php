<div class="animate-fade-in">
    <form id="reportForm" action="{{ route('pdf.reporteProgramasInscritos') }}" method="POST"
        class="flex justify-between lg:flex-row flex-col" target="_blank">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <label class="block mb-6">
                <span
                    class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-900">
                    Desde
                </span>
                <input type="date" wire:model="fechaDesde" name="fecha_desde"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                <x-input.error for="fechaDesde" />
            </label>
            <label class="block mb-6">
                <span
                    class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-900">
                    Hasta
                </span>
                <input type="date" wire:model="fechaHasta" name="fecha_hasta"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                <x-input.error for="fechaHasta" />
            </label>
        </div>
        <div class="flex max-w-md items-center">
            <div class="text-sm mr-3">Descargar por:</div>
            @if ($errors->any() || $postulantesInscritos->count() == 0)
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button type="button" disabled
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-s-lg">
                        <div class="mr-2"><x-icons.doc /></div>
                        Programas académicos
                    </button>
                    <button type="button" disabled
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-e-lg">
                        <div class="mr-2"><x-icons.doc /></div>
                        Fechas
                    </button>
                </div>
            @else
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button type="button" onclick="updateAction('{{ route('pdf.reporteProgramasInscritos') }}')"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700">
                        <div class="mr-2"><x-icons.doc /></div>
                        Programas académicos
                    </button>
                    <button type="button" onclick="updateAction('{{ route('pdf.reporteFechasInscritos') }}')"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700">
                        <div class="mr-2"><x-icons.doc /></div>
                        Fechas
                    </button>
                </div>
            @endif
        </div>
    </form>
    @if ($postulantesInscritos->count() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                PROGRAMAS ACADÉMICOS
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                CANTIDAD DE INSCRITOS
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postulantesInscritos as $i => $postulante)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postulante->programa }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postulante->conteo }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 mt-8" role="alert">
            <span class="font-medium">No se encontraron registros de usuarios</span>
        </div>
    @endif
    <script>
        function updateAction(action) {
            document.getElementById('reportForm').action = action;
            document.getElementById('reportForm').submit();
        }
    </script>
</div>
