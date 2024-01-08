<div class="px-4">
    <form wire:submit.prevent="refreshData" class="bg-white sm:flex md:w-1/2 animate-fade-in">
        <div>
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                Ingresar DNI
            </span>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-icons.search />
                </div>
                <input type="text" wire:model="searchByApplicantDni"
                    class="w-full pl-10 mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1"
                    placeholder="759841..">
            </div>
            <x-input-error for="searchByApplicantDni" />
        </div>
        <div class="flex items-end mt-2 justify-end">
            <button type="submit"
                class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Buscar</button>
        </div>
    </form>
    <div class="w-full mb-8">
        <div class="flex justify-center">
            <div wire:loading wire:target="refreshData" class="animate-fade-in mt-24">
                <x-icons.loading />
            </div>
        </div>
        <div wire:loading.remove wire:target="refreshData">
            @if ($applicant)
                <div
                    class="mx-auto max-w-2xl rounded-3xl ring-1 ring-inset ring-green-600/20 ring-gray-200 lg:mx-0 lg:flex lg:max-w-none bg-green-50 my-8">
                    <div class="px-4 py-3 lg:flex-auto">
                        <ul role="list"
                            class="grid grid-cols-1 gap-4 text-xs leading-3 text-gray-600 sm:grid-cols-3 sm:gap-6">
                            <li class="flex gap-x-3">
                                <p class="font-medium text-green-800">Número de Voucher :</p>
                                {{ $applicant->num_voucher }}
                            </li>
                            <li class="flex gap-x-3">
                                <p class="font-medium text-green-800">Importe :</p> S/. {{ $importe }}
                            </li>
                            <li class="flex gap-x-3">
                                <p class="font-medium text-green-800">Estado :</p>
                                {{ $applicant->estadopostulante->descripcion }}
                            </li>
                        </ul>
                    </div>
                </div>

                <form action={{ route('applicant.update', $applicant) }} method="POST" class="animate-slide-in-down">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-3 md:gap-6">
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Nombres
                            </span>
                            <input type="text" wire:model="applicant.nombres" name="nombres" required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.nombres" />
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Apellido Paterno
                            </span>
                            <input type="text" wire:model="applicant.ap_paterno" name="apPaterno" required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.ap_paterno" />
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Apellido Materno
                            </span>
                            <input type="text" wire:model="applicant.ap_materno" name="apMaterno" required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.ap_materno" />
                        </label>
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-6">
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                DNI
                            </span>
                            <input type="text" wire:model="applicant.num_documento" readonly
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 block w-full rounded-md sm:text-sm read-only:bg-slate-50 read-only:text-slate-500 read-only:border-slate-200 read-only:shadow-none" />
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Programa Académico
                            </span>
                            @if (auth()->user()->can('usuarios'))
                                <select wire:model="applicant.programa_academico_id"
                                    wire:change="changesModalityOrProgram('PROGRAM',$event.target.value)"
                                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                    @foreach ($academicPrograms as $academicProgram)
                                        <option value={{ $academicProgram->id }}>
                                            {{ $academicProgram->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($programChange)
                                    <p class="absolute mt-1 text-xs text-green-600">Campo alterado</p>
                                @else
                                    <p class="absolute mt-1 text-xs text-blue-600">Modificación con
                                        autorización</p>
                                @endif
                            @else
                                <input type="text" value="{{ $applicant->programaAcademico->nombre }}" disabled
                                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" />
                            @endif
                            <x-input-error for="applicant.programa_academico_id" />
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Modalidad
                            </span>
                            @if (auth()->user()->can('usuarios'))
                                <select wire:model="applicant.modalidad_id"
                                    wire:change="changesModalityOrProgram('MODALITY',$event.target.value)"
                                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                    @foreach ($modalities as $modalitie)
                                        <option value={{ $modalitie->id }}>
                                            {{ $modalitie->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($modalityChange)
                                    <p class="absolute mt-1 text-xs text-green-600">Campo alterado</p>
                                @else
                                    <p class="absolute mt-1 text-xs text-blue-600">Modificación con
                                        autorización</p>
                                @endif
                            @else
                                <input type="text" value="{{ $applicant->modalidad->descripcion }}" disabled
                                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" />
                            @endif
                            <x-input-error for="applicant.modalidad_id" />
                        </label>
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-6">
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Departamento Nacimiento
                            </span>
                            <select wire:model="selectedDepartmentBirth"
                                wire:change="changePlaceBirth('DEPARTMENT',$event.target.value)"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                @foreach ($departments as $department)
                                    <option value={{ $department->id }}>
                                        {{ $department->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Provincia Nacimiento
                            </span>
                            <select wire:model="selectedProvinceBirth"
                                wire:change="changePlaceBirth('PROVINCE',$event.target.value)"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                <option class="hidden">Seleccionar</option>
                                @foreach ($provincesBirth as $provinceBirth)
                                    <option value={{ $provinceBirth->id }}>
                                        {{ $provinceBirth->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Distrito Nacimiento
                            </span>
                            @if ($selectedProvinceBirth)
                                <select name="distrito_n" wire:model="applicant.distrito_nac_id"
                                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                    <option class="hidden">Seleccionar</option>
                                    @foreach ($districtsBirth as $districtBirth)
                                        <option value={{ $districtBirth->id }}>
                                            {{ $districtBirth->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <label class="block">
                                    <input type="text" value="Seleccione provincia" disabled
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                " />
                                </label>
                            @endif
                            <x-input-error for="applicant.distrito_nac_id" />
                        </label>
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-6">
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Departamento Residencia
                            </span>
                            <select wire:model="selectedDepartmentReside"
                                wire:change="changePlaceReside('DEPARTMENT',$event.target.value)"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                @foreach ($departments as $departamento)
                                    <option value={{ $departamento->id }}>
                                        {{ $departamento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Provincia Residencia
                            </span>
                            <select wire:model="selectedProvinceReside"
                                wire:change="changePlaceReside('PROVINCE',$event.target.value)"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                <option class="hidden">Seleccionar</option>
                                @foreach ($provincesReside as $provincia)
                                    <option value={{ $provincia->id }}>
                                        {{ $provincia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Distrito Residencia
                            </span>
                            @if ($selectedProvinceReside)
                                <select name="distrito_r" wire:model="applicant.distrito_res_id"
                                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                    <option class="hidden">Seleccionar</option>
                                    @foreach ($districtsReside as $distrito)
                                        <option value={{ $distrito->id }}>
                                            {{ $distrito->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <label class="block">
                                    <input type="text" value="Seleccione provincia" disabled
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                " />
                                </label>
                            @endif
                            <x-input-error for="applicant.distrito_res_id" />
                        </label>
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-6">
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Correo
                            </span>
                            <input type="email" name="correo" wire:model="applicant.correo" required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.correo" />
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Fecha de Nacimiento
                            </span>
                            <input type="date" name="fecha_nacimiento" wire:model="applicant.fecha_nacimiento"
                                required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.fecha_nacimiento" />
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Teléfono
                            </span>
                            <input type="tel" name="telefono" wire:model="applicant.telefono" maxlength="9"
                                required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            @if (session()->has('telefono'))
                                <p class="text-xs text-red-600">Solo acepta caracteres numéricos</p>
                            @endif
                            <x-input-error for="applicant.telefono" />
                        </label>
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-6">
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Dirección
                            </span>
                            <input type="text" name="direccion" wire:model="applicant.direccion" required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.direccion" />
                        </label>
                        <label class="block mb-10 relative">
                            <input type="hidden" name="colegioId" wire:model="applicant.colegio_id">
                            <span class="block text-sm font-medium text-slate-700">
                                Colegio
                                {{ $applicant->colegio->tipo == 1 ? 'Nacional' : ($applicant->colegio->tipo == 2 ? 'Privado' : '') }}
                            </span>
                            <input type="text" wire:model.debounce.500ms="searchSchoolName"
                                wire:input="$set('showSchools', true)"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            @if ($showSchools)
                                <ul class="absolute w-full shadow bg-white max-w-sm max-h-48 p-2 overflow-y-auto text-sm text-gray-700"
                                    aria-labelledby="dropdownSearchButton">
                                    @foreach ($schools as $school)
                                        <li wire:click="updateSchool({{ $school->id }})">
                                            <div
                                                class="flex items-center justify-between px-2 py-1 rounded hover:bg-gray-100 cursor-pointer">
                                                <p class="text-xs font-medium text-gray-900 rounded">
                                                    {{ $school->nombre }}
                                                </p>
                                                <span
                                                    class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $school->distrito }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                @if (session()->has('null'))
                                    <p class="absolute mt-2 text-xs text-red-600">
                                        {{ session('null') }}</p>
                                @else
                                    <div class="flex justify-end">
                                        <span
                                            class="absolute inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">
                                            {{ $schoolLocation }}
                                        </span>
                                    </div>
                                @endif
                            @endif
                        </label>

                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Teléfono Apoderado
                            </span>
                            <input type="tel" name="telefono_ap" wire:model="applicant.telefono_ap"
                                maxlength="9" required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            @if (session()->has('telefonoAp'))
                                <p class="text-xs text-red-600">Solo acepta caracteres numéricos</p>
                            @endif
                            <x-input-error for="applicant.telefono_ap" />
                        </label>
                    </div>
                    @if (
                        $universities &&
                            auth()->user()->can('usuarios'))
                        <div class="grid md:grid-cols-3 md:gap-6">
                            <label class="block">
                                <span class="block text-sm font-medium text-slate-700">
                                    Universidades
                                </span>
                                <select name="idUniversity" wire:model="applicant.universidad_id"
                                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                    @foreach ($universities as $university)
                                        <option value={{ $university->id }}>
                                            {{ $university->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="applicant.universidad_id" />
                            </label>
                        </div>
                    @endif
                    <div class="flex w-full justify-end">
                        @if ($errors->any())
                            <button type="button" disabled
                                class="inline-flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm sm:ml-3 sm:w-auto">Modificar
                                Postulante</button>
                        @else
                            @if ($programChange || $modalityChange)
                                @if ($modalityChange && $programChange)
                                    @livewire('update-program-modality', ['applicantDni' => $applicant->num_documento, 'modalityId' => $applicant->modalidad_id, 'programId' => $applicant->programa_academico_id, 'modifyTwoFields' => true])
                                @else
                                    @livewire('update-program-modality', ['applicantDni' => $applicant->num_documento, 'modalityId' => $applicant->modalidad_id, 'programId' => $applicant->programa_academico_id, 'modifyTwoFields' => false])
                                @endif
                            @else
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                                    Modificar Postulante
                                </button>
                            @endif
                        @endif
                    </div>
                </form>
            @else
                <div class="p-4 my-6 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                    <span class="font-medium">Inicie la búsqueda!</span> para modificar datos de postulante digite
                    el
                    DNI en el buscador.
                </div>
            @endif
        </div>
    </div>

    @if (session('success'))
        <x-result-alert title="Modificación exitosa" message="{{ session('success') }}" result="success" />
    @endif

    @if (session()->has('warning'))
        <x-modals.warning color="blue">
            <x-slot name="title">Advertencia</x-slot>
            <x-slot name="content">
                El importe del postulante debe ser mayor o igual al monto de la nueva modalidad.
                <div class="group relative flex gap-x-2 rounded-lg items-center">
                    <p class="text-xs font-semibold leading-6 text-gray-900"> Importe de la modalidad:</p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500"> S/. {{ $montoModalidad }}
                    </p>
                </div>
                <div class="group relative flex gap-x-2 rounded-lg items-center mt-2">
                    <p class="text-xs font-semibold leading-6 text-gray-900"> Importe de postulante:</p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500"> S/. {{ $importe }}</p>
                </div>
            </x-slot>
            <x-slot name="button">
                <button type="button" wire:click="$set('showAlert', false)"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Aceptar</button>
            </x-slot>
        </x-modals.warning>
    @endif
</div>
