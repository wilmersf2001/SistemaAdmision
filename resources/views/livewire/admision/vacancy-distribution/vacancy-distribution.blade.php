<div>
    <div class="mx-auto grid max-w-7xl gap-x-10 gap-y-6 px-4 lg:px-6">
        <div class="flex">
            <button id="dropdown-button" data-dropdown-toggle="dropdown"
                class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200"
                type="button">Modalidades<svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg></button>
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <div class="py-2 text-xs text-gray-700" aria-labelledby="dropdown-button">
                    @foreach ($modalities as $modalitie)
                        <a wire:click.prevent="getProgramByModality({{ $modalitie->id }})"
                            class="block w-full px-4 py-2 border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700">
                            {{ $modalitie->descripcion }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="relative w-full">
                <input type="search" id="search-dropdown" wire:model.debounce.500ms="searchProgramAcademic"
                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Buscar programa académico" required>
            </div>
        </div>

        <div role="list" class="grid gap-x-8 sm:grid-cols-1 ms:gap-y-10">
            @if ($academicProgramId)
                @if ($academicProgramsByModality->count() > 0)
                    <div class="mb-4">
                        <span
                            class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">MODALIDAD:
                            {{ $academicProgramsByModality->first()->modalidad->descripcion }}</span>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 animate-fade-in">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Programa Académico
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        N° Vacantes
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($academicProgramsByModality as $academicProgramByModality)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td scope="row"
                                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $academicProgramByModality->programaAcademico->nombre }}
                                        </td>
                                        <td class="px-6 py-3 flex justify-center">
                                            @if ($academicProgramModificationId === $academicProgramByModality->id)
                                                <input type="number"
                                                    wire:model="vacantQuantity.{{ $academicProgramByModality->id }}"
                                                    min="0" maxlength="3" max="999"
                                                    class="border shadow-sm border-slate-300 rounded-md text-xs appearance-none text-center @error('vacantQuantity.*') bg-red-200 sm:border-red-700 @enderror">
                                            @else
                                                {{ $academicProgramByModality->vacantes }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-3 text-center">
                                            @if ($academicProgramModificationId === $academicProgramByModality->id)
                                                <button wire:click="updateVacancy({{ $academicProgramByModality->id }})"
                                                    class="font-medium text-green-600 hover:underline">Guardar</button>
                                            @else
                                                <button class="text-green-600"
                                                    wire:click="modifyVacancy({{ $academicProgramByModality->id }})">
                                                    <x-icons.pencil flag="0" />
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($academicProgramsByModality->total() > 10)
                        {{ $academicProgramsByModality->links() }}
                    @endif
                @else
                    <div class="p-4 my-6 text-sm text-blue-800 rounded-lg bg-blue-50 animate-fade-in" role="alert">
                        <span class="font-medium">No se encontraron resultado en la busqueda</span>
                    </div>
                @endif
            @else
                <div class="p-4 my-6 text-sm text-blue-800 rounded-lg bg-blue-50 animate-fade-in" role="alert">
                    <span class="font-medium">Inicie la búsqueda!</span> Seleccione una modalidad
                </div>
            @endif
        </div>
    </div>
</div>
