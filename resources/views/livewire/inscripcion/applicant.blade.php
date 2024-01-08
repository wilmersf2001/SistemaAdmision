<div class="p-4 xl:p-6 relative">
    <div wire:offline>
        You are now offline.
    </div>

    <x-step-by-step :currentStep="$currentStep" />

    <form action="{{ route('applicant.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="banco_id" value="{{ $bank->id }}">
        <input type="hidden" name="num_documento" value="{{ $bank->num_doc_depo }}">
        <input type="hidden" name="tipo_documento" value="{{ $bank->tipo_doc_depo }}">
        <input type="hidden" name="num_voucher" value="{{ $bank->num_documento }}">
        <input type="hidden" name="modalidad_id" value="{{ $applicant->modalidad_id }}">
        <div class="{{ $currentStep == 1 ? 'animate-slide-in-left' : 'hidden' }}">
            <x-bank-information :bank="$bank" />
            <div class="mt-4 mb-7 flex items-center gap-x-4 bg-sky-200 px-4 py-2 rounded-full">
                <div class="flex items-center text-sky-900">
                    <x-icons.identification />
                    <h4 class="flex-none text-base font-medium leading-none text-sky-900 ml-2">Datos Personales
                        Postulante
                    </h4>
                </div>
            </div>
            <div class="px-4">
                <div class="grid md:grid-cols-3 md:gap-6">
                    <x-input.form span="Nombres Completos" name="nombres" model="applicant.nombres"
                        disable="{{ $disableInputApplicant }}" />
                    <x-input.form span="Apellido Paterno" name="ap_paterno" model="applicant.ap_paterno"
                        disable="{{ $disableInputApplicant }}" />
                    <x-input.form span="Apellido Materno" name="ap_materno" model="applicant.ap_materno"
                        disable="{{ $disableInputApplicant }}" />
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <label class="block mb-8">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Seleccione Sexo
                        </span>
                        <select name="sexo_id" wire:model="applicant.sexo_id"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($generos as $genero)
                                <option value={{ $genero->id }}>
                                    {{ ucfirst(strtolower($genero->descripcion)) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.error for="applicant.sexo_id" />
                    </label>
                    <label class="block mb-8">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Fecha de Nacimiento
                        </span>
                        <input type="date" name="fecha_nacimiento" wire:model.lazy="applicant.fecha_nacimiento"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        <x-input.error for="applicant.fecha_nacimiento" />
                    </label>
                </div>
            </div>

            @if ($isAgeMinor)
                <div class="rounded-3xl ring-1 ring-gray-200 mb-10 animate-fade-in">
                    <div class="-mt-2 p-2 lg:mt-0 lg:w-full">
                        <div class="rounded-2xl bg-gray-50 py-6 lg:py-8 px-8">
                            <x-form-apoderado />
                            <div class="flex justify-center mt-6">
                                <div wire:loading wire:target="getApoderadoDataByDni">
                                    <x-icons.loading />
                                </div>
                                <div class="w-full grid md:grid-cols-3 md:gap-6 animate-fade-in" wire:loading.remove
                                    wire:target="getApoderadoDataByDni">
                                    <x-input.form span="Nombres" name="nombres_apoderado"
                                        model="applicant.nombres_apoderado" disable="{{ $disableInputApoderado }}"
                                        margin="mb-4" />
                                    <x-input.form span="Apellido Paterno" name="ap_paterno_apoderado"
                                        model="applicant.ap_paterno_apoderado" disable="{{ $disableInputApoderado }}"
                                        margin="mb-4" />
                                    <x-input.form span="Apellido Materno" name="ap_materno_apoderado"
                                        model="applicant.ap_materno_apoderado" disable="{{ $disableInputApoderado }}"
                                        margin="mb-4" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-4 mb-7 flex items-center gap-x-4 bg-sky-200 px-4 py-2 rounded-full">
                <div class="flex items-center text-sky-900">
                    <x-icons.map-pin />
                    <h4 class="flex-none text-base font-medium leading-none text-sky-900 ml-2">Lugar de Nacimiento
                    </h4>
                </div>
            </div>

            <div class="px-4">
                @if ($bank->tipo_doc_depo == 1)
                    <div class="grid md:grid-cols-3 md:gap-6">
                        <label class="block mb-10">
                            <span class="block mb-2 text-sm font-medium text-gray-900">
                                Departamento
                            </span>
                            <select wire:change="changePlaceBirth('DEPARTMENT',$event.target.value)"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                <option class="hidden">Seleccionar</option>
                                @foreach ($departaments as $departament)
                                    <option value={{ $departament->id }}>
                                        {{ $departament->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block mb-10">
                            <span class="block mb-2 text-sm font-medium text-gray-900">
                                Provincia
                            </span>
                            <select wire:change="changePlaceBirth('PROVINCE',$event.target.value)"
                                wire:model="selectedProvinceBirthId"
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
                            <span class="block mb-2 text-sm font-medium text-gray-900">
                                Distrito
                            </span>
                            <select name="distrito_nac" wire:model="applicant.distrito_nac_id"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                <option class="hidden">Seleccionar</option>
                                @foreach ($districtsBirth as $districtBirth)
                                    <option value={{ $districtBirth->id }}>
                                        {{ $districtBirth->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input.error for="applicant.distrito_nac_id" />
                        </label>
                    </div>
                @else
                    @php
                        $applicant->distrito_nac_id = 1868;
                    @endphp
                    <input type="hidden" name="distrito_nac" wire:model="applicant.distrito_nac_id">
                    <div class="grid md:grid-cols-3 md:gap-6">
                        <label class="block mb-10">
                            <span class="block mb-2 text-sm font-medium text-gray-900">
                                País de Procedencia
                            </span>
                            <select name="pais_id" wire:model="applicant.pais_id"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                <option class="hidden">Seleccionar</option>
                                @foreach ($countries as $country)
                                    <option value={{ $country->id }}>
                                        {{ $country->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input.error for="applicant.pais_id" />
                        </label>
                    </div>
                @endif
            </div>

            <div class="mt-4 mb-7 flex items-center gap-x-4 bg-sky-200 px-4 py-2 rounded-full">
                <div class="flex items-center text-sky-900">
                    <x-icons.map-pin />
                    <h4 class="flex-none text-base font-medium leading-none text-sky-900 ml-2">Lugar de Residencia
                    </h4>
                </div>
            </div>

            <div class="px-4">
                <div class="grid md:grid-cols-3 md:gap-6">
                    <label class="block mb-10">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Departamento
                        </span>
                        <select wire:change="changePlaceReside('DEPARTMENT',$event.target.value)"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($departaments as $departament)
                                <option value={{ $departament->id }}>
                                    {{ $departament->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block mb-10">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Provincia
                        </span>
                        <select wire:change="changePlaceReside('PROVINCE',$event.target.value)"
                            wire:model="selectedProvinceResideId"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($provincesReside as $provinceReside)
                                <option value={{ $provinceReside->id }}>
                                    {{ $provinceReside->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block mb-10">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Distrito
                        </span>
                        <select name="distrito_res" wire:model="applicant.distrito_res_id"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($districtsReside as $districtReside)
                                <option value={{ $districtReside->id }}>
                                    {{ $districtReside->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.error for="applicant.distrito_res_id" />
                    </label>
                </div>

                <div class="grid md:grid-cols-3 md:gap-6">
                    <label class="block mb-10">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Tipo de Dirección
                        </span>
                        <select name="tipo_direccion" wire:model="applicant.tipo_direccion_id"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($adressType as $adress)
                                <option value={{ $adress->id }}>
                                    {{ $adress->descripcion }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.error for="applicant.tipo_direccion_id" />
                    </label>
                    <x-input.form span="Dirección" name="direccion" model="applicant.direccion"
                        placeholder="Ejem: Calle Ficticia 123" />
                </div>
            </div>

            <div class="mt-4 mb-7 flex items-center gap-x-4 bg-sky-200 px-4 py-2 rounded-full">
                <div class="flex items-center text-sky-900">
                    <x-icons.phone />
                    <h4 class="flex-none text-base font-medium leading-none text-sky-900 ml-2">Datos de Contacto
                    </h4>
                </div>
            </div>
            <div class="px-4">
                <div class="grid md:grid-cols-3 md:gap-6">
                    <x-input.form span="Teléfono del Postulante" name="telefono" model="applicant.telefono"
                        placeholder="Ejem: 955123456" maxlength='9' />

                    <x-input.form span="Teléfono del Apoderado" name="telefono_ap" model="applicant.telefono_ap"
                        placeholder="Ejem: 955123456" maxlength='9' />

                    <x-input.form span="Correo Electrónico" name="correo" model="applicant.correo" type="email"
                        placeholder="Ejem: postulante@gmail.com" />
                </div>
            </div>

            <div class="flex w-full justify-end">
                <a href="{{ route('start') }}"
                    class="cursor-pointer mt-4 mr-4 text-gray-900 bg-white hover:bg-gray-100 shadow-md focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Cancelar
                </a>
                <button type="button" wire:click="nextStep"
                    class="cursor-pointer mt-4 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Siguiente
                </button>
            </div>

        </div>

        <div class="{{ $currentStep == 2 ? 'animate-slide-in-right relative' : 'hidden' }}">
            <x-bank-information :bank="$bank" />
            <div class="mt-4 mb-7 flex items-center gap-x-4 bg-sky-200 px-4 py-2 rounded-full">
                <div class="flex items-center text-sky-900">
                    <x-icons.academic-cap />
                    <h4 class="flex-none text-base font-medium leading-none text-sky-900 ml-2">Información Académica
                    </h4>
                </div>
            </div>

            <div class="px-4">
                <div class="grid md:grid-cols-3 md:gap-6">
                    <label class="block mb-8">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Departamento de Procedencia Colegio
                        </span>
                        <select wire:change="changePlaceOriginSchool('DEPARTMENT',$event.target.value)"
                            wire:model="selectedDepartamentOriginSchoolId"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($departaments as $departament)
                                <option value={{ $departament->id }}>
                                    {{ $departament->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block mb-8">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Provincia de Procedencia Colegio
                        </span>
                        <select wire:change="changePlaceOriginSchool('PROVINCE',$event.target.value)"
                            wire:model="selectedProvinceOriginSchoolId"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($provincesOriginSchool as $provinceOriginSchool)
                                <option value={{ $provinceOriginSchool->id }}>
                                    {{ $provinceOriginSchool->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.error for="selectedProvinceOriginSchoolId" />
                    </label>

                    <label class="block mb-8">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Distrito de Procedencia Colegio
                        </span>
                        <select wire:model="selectedDistrictOriginSchoolId"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($districtsOriginSchool as $districtOriginSchool)
                                <option value={{ $districtOriginSchool->id }}>
                                    {{ $districtOriginSchool->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.error for="selectedDistrictOriginSchoolId" />
                    </label>
                </div>

                <div class="grid md:grid-cols-3 md:gap-6">
                    <label class="block mb-8 relative">
                        <input type="hidden" name="colegio_id" wire:model="applicant.colegio_id">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Nombre del Colegio
                        </span>
                        <input type="text" wire:model.debounce.500ms="searchSchoolName"
                            wire:input="$set('showSchools', true)"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                            placeholder="Ejem: San Martín de los Andes" />

                        @if ((!$selectedDistrictOriginSchoolId || !$typeSchool) && $searchSchoolName != null && !$errors->any())
                            <p class="absolute peer-invalid:visible text-red-600 text-xs animate-slide-in-left">
                                seleccione el distrito de procedencia y tipo colegio</p>
                        @endif

                        @if (session()->has('null'))
                            <p class="absolute peer-invalid:visible text-red-600 text-xs animate-slide-in-left">
                                {{ session('null') }}</p>
                        @else
                            @if ($showSchools && $selectedDistrictOriginSchoolId && $typeSchool)
                                <ul
                                    class="w-full absolute shadow bg-white max-w-md max-h-48 p-2 overflow-y-auto text-sm text-gray-700">
                                    @foreach ($schools as $school)
                                        <li wire:click="updateSchool({{ $school->id }})">
                                            <div
                                                class="flex items-center pl-2 rounded hover:bg-gray-100 cursor-pointer">
                                                <p
                                                    class="w-full py-2 text-xs font-medium text-gray-900 rounded dark:text-gray-900">
                                                    {{ $school->nombre }}
                                                </p>
                                                <span
                                                    class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $school->distrito }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                        <x-input.error for="applicant.colegio_id" />
                    </label>

                    <label class="block mb-8">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Año de Egreso del Colegio
                        </span>
                        @if ($applicant->modalidad_id)
                            <select name="anno_egreso" wire:model="applicant.anno_egreso"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                <option class="hidden">Seleccionar</option>
                                @php
                                    $maxYear = $applicant->modalidad_id != \App\Utils\Constants::MODALIDAD_QUINTO_SECUNDARIA ? date('Y') - 1 : date('Y');
                                @endphp
                                @for ($i = $minimumYear; $i <= $maxYear; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        @else
                            <input type="text" disabled placeholder="Seleccione el modalidad"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" />
                        @endif
                        <x-input.error for="applicant.anno_egreso" />
                    </label>
                </div>
            </div>

            <div class="mt-4 mb-7 flex items-center gap-x-4 bg-sky-200 px-4 py-2 rounded-full">
                <div class="flex items-center text-sky-900">
                    <x-icons.information />
                    <h4 class="flex-none text-base font-medium leading-none text-sky-900 ml-2">Información de
                        Postulación
                    </h4>
                </div>
            </div>

            <div class="px-4">
                <div class="grid md:grid-cols-3 md:gap-6">
                    <label class="block mb-8">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Sede de Postulación
                        </span>
                        <select name="sede_id" wire:model="applicant.sede_id"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option class="hidden">Seleccionar</option>
                            @foreach ($sedes as $sede)
                                <option value={{ $sede->id }}>
                                    {{ $sede->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <x-input.error for="applicant.sede_id" />
                    </label>

                    <label class="block mb-8">
                        <span class="block mb-2 text-sm font-medium text-gray-900">
                            Programa Académico al que Postula
                        </span>
                        @if ($applicant->modalidad_id)
                            <select name="programa_academico_id" wire:model="applicant.programa_academico_id"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                <option class="hidden">Seleccionar</option>
                                @foreach ($academicPrograms as $academicProgram)
                                    <option value={{ $academicProgram->programa_academico_id }}>
                                        {{ $academicProgram->programaAcademico->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" disabled placeholder="Seleccione la modalidad"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" />
                        @endif
                        <x-input.error for="applicant.programa_academico_id" />
                    </label>

                    <x-input.form span="Número de veces que postula a la UNPRG" name="num_veces_unprg"
                        model="applicant.num_veces_unprg" type="number" />
                </div>

                <div class="grid md:grid-cols-3 md:gap-6">
                    <x-input.form span="Número de veces que postula a otras universidades" name="num_veces_otro"
                        model="applicant.num_veces_otros" type="number" />

                    @if ($universities)
                        <label class="block mb-8">
                            <span class="block mb-2 text-sm font-medium text-gray-900">
                                Universidad de Procedencia
                            </span>
                            <select wire:model="applicant.universidad_id"
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                                <option class="hidden">Seleccionar</option>
                                @foreach ($universities as $university)
                                    <option value={{ $university->id }}>
                                        {{ $university->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input.error for="applicant.universidad_id" />
                        </label>
                    @endif
                </div>
            </div>

            <div class="flex w-full justify-end">
                <button type="button" wire:click="previousStep"
                    class="cursor-pointer mt-4 mr-4 text-gray-900 bg-white hover:bg-gray-100 shadow-md focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Atrás
                </button>
                <button type="button" wire:click="nextStep"
                    class="cursor-pointer mt-4 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Siguiente
                </button>
            </div>
        </div>

        <div class="{{ $currentStep == 3 ? 'animate-slide-in-right' : 'hidden' }}">

            <div class="mt-4 mb-7 flex items-center gap-x-4 bg-sky-200 px-4 py-2 rounded-full">
                <div class="flex items-center text-sky-900">
                    <x-icons.folder />
                    <h4 class="flex-none text-base font-medium leading-none text-sky-900 ml-2">Archivos Requeridos
                    </h4>
                </div>
            </div>

            <div class="mx-auto grid max-w-7xl gap-x-8 gap-y-20 xl:grid-cols-3">
                <div class="max-w-2xl">
                    <div class="flex items-center gap-x-4">
                        <h4 class="flex-none text-sm font-semibold leading-6 text-indigo-600">CONSIDERACIONES PARA
                            FOTOGRAFÍA</h4>
                        <div class="h-px flex-auto bg-gray-100"></div>
                    </div>
                    <ul role="list" class="mt-4 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600">
                        <li class="flex gap-x-3">
                            <x-icons.check />
                            Iluminación uniforme y suave, evitando sombras fuertes en el rostro.
                        </li>
                        <li class="flex gap-x-3">
                            <x-icons.check />
                            Enfoca correctamente tu rostro (no utilizar lentes ni cualquier otro tipo de accesorios) y
                            utiliza fondo blanco.
                        </li>
                        <li class="flex gap-x-3">
                            <x-icons.check />
                            Ropa apropiada, evita estampados llamativos y bividis.
                        </li>
                        <li class="flex gap-x-3">
                            <x-icons.check />
                            Expresión facial tranquila y neutral, sin sonreír ni fruncir el ceño.
                        </li>
                    </ul>
                    <div class="mt-6 flex items-center gap-x-4">
                        <h4 class="flex-none text-sm font-semibold leading-6 text-indigo-600">CONSIDERACIONES PARA DNI
                        </h4>
                        <div class="h-px flex-auto bg-gray-100"></div>
                    </div>
                    <ul role="list" class="mt-4 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600">
                        <li class="flex gap-x-3">
                            <x-icons.check />
                            Asegúrate que la imagen esté completamente legible y sin reflejos para evitar
                            problemas al verificar la información.
                        </li>
                    </ul>
                </div>
                <div class="grid gap-x-8 gap-y-12 sm:grid-cols-1 sm:gap-y-16 xl:col-span-2">
                    <div>
                        <div class="grid md:grid-cols-1 md:gap-6">
                            <x-input.file span="Foto Carnet Postulante" model="profilePhoto"
                                imageId="preview-profilePhoto" alt="FOTO CARNET" src="images/foto-carnet.jpg"
                                click="$set('profilePhoto', null)" inputId="fileInput-profilePhoto" />
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6 mb-10">
                            <x-input.file span="DNI Parte Anverso" model="frontDniPhoto"
                                imageId="preview-frontDniPhoto" alt="DNI ANVERSO" src="images/dni-anverso.png"
                                click="$set('frontDniPhoto', null)" inputId="fileInput-frontDniPhoto" w="w-56"
                                h="h-40" />
                            <x-input.file span="DNI Parte Reverso" model="reverseDniPhoto"
                                imageId="preview-reverseDniPhoto" alt="DNI REVERSO" src="images/dni-reverso.png"
                                click="$set('reverseDniPhoto', null)" inputId="fileInput-reverseDniPhoto" w="w-56"
                                h="h-40" />
                        </div>
                        <div class="flex w-full justify-end">
                            <button type="button" wire:click="previousStep"
                                class="cursor-pointer mt-4 mr-4 text-gray-900 bg-white hover:bg-gray-100 shadow-md focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Atrás
                            </button>
                            <button type="button" wire:click="nextStep"
                                class="cursor-pointer mt-4 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($currentStep > 3)
            @livewire('inscripcion.summary-template', ['applicant' => $applicant, 'tipo_documento' => $bank->tipo_doc_depo])

            <x-declaration-jurada :formattedToday="$formattedToday" :numberProcess="$numberProcess" />

            <div class="flex w-full justify-end">
                <button type="button" wire:click="previousStep"
                    class="cursor-pointer mt-4 mr-4 text-gray-900 bg-white hover:bg-gray-100 shadow-md focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Atrás
                </button>
                @if ($accordance)
                    <button type="submit"
                        class="cursor-pointer mt-4 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center animate-slide-in-down">
                        Finalizar y Enviar
                    </button>
                @endif
            </div>
        @endif
    </form>
    <script>
        function handleImagePreview(inputId, previewId) {
            const fileInput = document.querySelector(`#${inputId}`);
            const preview = document.querySelector(`#${previewId}`);

            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                const fileReader = new FileReader();

                fileReader.readAsDataURL(file);
                fileReader.addEventListener('load', (e) => {
                    preview.setAttribute('src', e.target.result);
                });
            });
        }

        handleImagePreview('fileInput-profilePhoto', 'preview-profilePhoto');
        handleImagePreview('fileInput-frontDniPhoto', 'preview-frontDniPhoto');
        handleImagePreview('fileInput-reverseDniPhoto', 'preview-reverseDniPhoto');
    </script>
</div>
