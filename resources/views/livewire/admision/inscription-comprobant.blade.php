<div class="px-4">
    <form wire:submit.prevent="searchByDni" class="bg-white sm:flex md:w-1/2 animate-fade-in">
        <div>
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                Ingresar DNI
            </span>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-icons.search />
                </div>
                <input type="text" wire:model="dniApplicant"
                    class="w-full pl-10 mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1"
                    placeholder="759841..">
            </div>
            <x-input-error for="dniApplicant" />
        </div>
        <div class="flex items-end mt-2 justify-end">
            <button type="submit"
                class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Buscar</button>
        </div>
    </form>
    <div class="my-6 animate-fade-in">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Nombres</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if ($applicantExists)
                        <div class="animate-fade-in">
                            {{ $applicantExists ? $applicant->nombres : '' }}
                        </div>
                    @endif
                </dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Apellidos</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if ($applicantExists)
                        <div class="animate-fade-in">
                            {{ $applicantExists ? $applicant->ap_paterno . ' ' . $applicant->ap_materno : '' }}
                        </div>
                    @endif
                </dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Correo</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if ($applicantExists)
                        <div class="animate-fade-in">
                            {{ $applicantExists ? $applicant->correo : '' }}
                        </div>
                    @endif
                </dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Estado</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if ($applicantExists)
                        <div class="animate-fade-in">
                            <x-badge :estado="$applicant->estado_postulante_id" />
                        </div>
                    @endif
                </dd>
            </div>
            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900"></dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                            <div class="flex w-0 flex-1 items-center">
                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                    <span class="truncate font-medium">ficha_inscripción.pdf</span>
                                </div>
                            </div>
                            @if ($applicantExists)
                                <div class="animate-fade-in">
                                    @if ($validApplicantExists)
                                        <div class="flex">
                                            <a target="_black"
                                                href={{ route('pdf.pdfData', ['dni' => $applicant->num_documento]) }}
                                                class="font-medium text-indigo-600 hover:text-indigo-500 pr-2">Visualizar</a>
                                            <span class="relative flex h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                                <span
                                                    class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                                            </span>
                                        </div>
                                    @else
                                        <button class="font-medium text-red-600 hover:text-red-500">
                                            no disponible
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </li>
                    </ul>
                </dd>
            </div>
        </dl>
    </div>
</div>
