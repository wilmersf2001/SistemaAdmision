<div class="px-4">
    <form wire:submit.prevent="refreshData" class="bg-white sm:flex md:w-1/2 animate-fade-in">
        <div>
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                Ingresar DNI Postulante
            </span>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-icons.search />
                </div>
                <input type="text" wire:model="searchByApplicantDni" oninput="validarNumeroTelefono(this)"
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

                <form action={{ route('applicant.updateApoderado', $applicant) }} method="POST"
                    class="animate-slide-in-down">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Número de documento de Apoderado
                            </span>
                            <input type="text" wire:model="applicant.num_documento_apoderado" minlength="8"
                                maxlength="9" name="num_documento_apoderado" oninput="validarNumeroTelefono(this)"
                                required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.num_documento_apoderado" />
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Nombres de Apoderado
                            </span>
                            <input type="text" wire:model="applicant.nombres_apoderado" name="nombres_apoderado"
                                required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.nombres_apoderado" />
                        </label>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Apellido Paterno Apoderado
                            </span>
                            <input type="text" wire:model="applicant.ap_paterno_apoderado"
                                name="ap_paterno_apoderado" required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.ap_paterno_apoderado" />
                        </label>
                        <label class="block mb-10">
                            <span class="block text-sm font-medium text-slate-700">
                                Apellido Materno Apoderado
                            </span>
                            <input type="text" wire:model="applicant.ap_materno_apoderado"
                                name="ap_materno_apoderado" required
                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            <x-input-error for="applicant.ap_materno_apoderado" />
                        </label>
                    </div>

                    <div class="flex w-full justify-end">
                        @if ($errors->any())
                            <button type="button" disabled
                                class="inline-flex w-full justify-center rounded-md bg-indigo-400 px-3 py-2 text-sm font-semibold text-white shadow-sm sm:ml-3 sm:w-auto">Modificar
                                Apoderado</button>
                        @else
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Modificar
                                Apoderado</button>
                        @endif
                    </div>
                </form>
            @else
                <div class="p-4 my-6 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                    <span class="font-medium">Inicie la búsqueda!</span> para modificar datos de Apoderado digite
                    el
                    DNI del postulante en el buscador.
                </div>
            @endif
        </div>
    </div>

    @if (session('success'))
        <x-result-alert title="Modificación de Apoderado exitosa" message="{{ session('success') }}" result="success" />
    @endif
</div>
