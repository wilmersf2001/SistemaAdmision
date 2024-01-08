<div class="mx-auto max-w-5xl">
    @if ($this->academicPrograms->count() != count($programAcademicWhitVacancies))
        <form action="{{ route('vacancyDistribution.store') }}" method="POST">
            @csrf
            <div class="mx-auto grid max-w-5xl gap-x-5 gap-y-6 px-4 lg:px-6 xl:grid-cols-3">
                <div class="max-w-5xl">
                    <label class="block mb-8">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Sede
                        </span>
                        <select name="sedeId" wire:model="selectedSede"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="sedeId" />
                    </label>
                    <label class="block mb-8">
                        <span
                            class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                            Programa Academico
                        </span>
                        <select name="programaId" wire:model="programaId"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($academicPrograms as $academicProgram)
                                @if (!in_array($academicProgram->id, $programAcademicWhitVacancies))
                                    <option value={{ $academicProgram->id }}>
                                        {{ $academicProgram->nombre }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <x-input-error for="programaId" />
                    </label>
                </div>
            </div>
            <div role="list" class="grid gap-x-8 gap-y-6 sm:grid-cols-1 ms:gap-y-10">
                @if ($programaId)
                    <ddiv class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 animate-fade-in">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Modalidad
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            N° Vacantes
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modalities as $modalitie)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td scope="row"
                                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $modalitie->descripcion }}
                                        </td>
                                        <td class="px-6 py-3 text-center">
                                            <input type="number" name="modalities[{{ $modalitie->id }}]"
                                                wire:model="modalidadId.{{ $modalitie->id }}"
                                                class="bg-gray-50 border-gray-300 text-center text-gray-900 text-sm block w-16 rounded-md sm:text-sm">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <x-input-error for="modalidadId.*" />
                        </table>
            </div>
            <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-40">Asignar
                    vacantes</button>
            </div>
        @else
            <div class="p-4 my-6 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                <span class="font-medium">Seleccionar!</span> Seleccione programa académico
            </div>
    @endif
@else
    <div class="grid min-h-full place-items-center bg-white px-6 py-8 sm:py-16 lg:px-8">
        <div class="text-center">
            <h1 class="mt-4 text-lg font-bold tracking-tight text-gray-900 sm:text-2xl">
                Asignación de vacantes culminada con exito</h1>
            <p class="mt-2 text-base leading-7 text-gray-600">Se ha asignado todas las vacantes a los programas
                academicos
            </p>
            <div class="mt-8 flex items-center justify-center">
                <a href="#"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Visualizar asignación de vacantes </a>
            </div>
        </div>
    </div>
    </form>

    @endif
    @if (session('success'))
        <x-result-alert title="Asignación de vacantes exitosa" message="{{ session('success') }}" result="success" />
    @endif
    @if (session('errors'))
        <x-result-alert title="Error en la asignación de vacantes"
            message="Verifique los datos esten correctamente ingresados" result="error" />
    @endif
</div>
