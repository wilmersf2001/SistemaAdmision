<div class="animate-fade-in">
    <form action="{{ route('pdf.reporteInscritos') }}" method="POST" class="flex justify-between lg:flex-row flex-col"
        target="_blank">
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
        <div class="flex w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow items-center">
            <ul role="list" class="space-y-2">
                <li class="flex">
                    <svg class="flex-shrink-0 w-4 h-4 text-blue-600" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="text-base font-normal leading-tight text-gray-900 ms-3">Total Inscritos:
                        {{ $postulantesInscritos->count() > 0 ? $postulantesInscritos->sum('conteo') : '-' }}
                    </span>
                </li>
            </ul>
            <div class="flex flex-1 justify-end">
                <div class="p-2">
                    @if ($errors->any() || $postulantesInscritos->count() == 0)
                        <button type="button" class="bg-gray-300 p-2 rounded-full text-gray-500" disabled>
                            <x-icons.doc />
                        </button>
                    @else
                        <button type="submit" class="bg-blue-600 p-2 rounded-full text-white cursor-pointer">
                            <x-icons.doc />
                        </button>
                    @endif
                </div>
            </div>
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
</div>
