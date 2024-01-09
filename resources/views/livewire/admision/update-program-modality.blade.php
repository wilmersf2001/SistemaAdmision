<div>
    <a wire:click="$set('showModal', true)"
        class="cursor-pointer inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Modificar
        Postulante</a>

    @if ($showModal)
        <div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full justify-center p-4 text-center sm:items-center sm:p-0 items-center">
                    <form wire:submit.prevent="store"
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        @csrf
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex items-center">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900">Autorización de
                                        Documento</h3>
                                </div>
                            </div>
                            <div class="relative overflow-x-auto sm:rounded-lg pt-4 mt-2 px-6">
                                <div class="grid md:grid-cols-1 md:gap-6">
                                    <label class="block mb-6">
                                        <span class="block text-sm font-medium text-slate-700">
                                            DNI Postulante
                                        </span>
                                        <input type="text" value="{{ $applicantDni }}" disabled
                                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                                    </label>
                                </div>
                                <div class="my-2 flex items-center gap-x-4">
                                    <h4 class="flex-none text-sm font-semibold leading-6 text-indigo-600">Actualización
                                        realizada a
                                        continuación</h4>
                                    <div class="h-px flex-auto bg-gray-100"></div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6 my-4">
                                    <label class="block mb-6">
                                        <span class="block text-sm font-medium text-slate-700">
                                            Campo
                                        </span>
                                        <input type="text" value="{{ $modifiedFieldOne }}" disabled
                                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                                    </label>
                                    <label class="block mb-6">
                                        <span class="block text-sm font-medium text-slate-700">
                                            Número de documento
                                        </span>
                                        <input type="text" wire:model="documentNumberOne" required
                                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                                        <x-input-error for="documentNumberOne" />
                                    </label>
                                </div>
                                @if ($modifyTwoFields)
                                    <div class="grid md:grid-cols-2 md:gap-6 my-4">
                                        <label class="block mb-6">
                                            <span class="block text-sm font-medium text-slate-700">
                                                Campo
                                            </span>
                                            <input type="text" value="{{ $modifiedFieldTwo }}" disabled
                                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                                        </label>
                                        <label class="block mb-6">
                                            <span class="block text-sm font-medium text-slate-700">
                                                Número de documento
                                            </span>
                                            <input type="text" wire:model="documentNumberTwo" required
                                                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                                            <x-input-error for="documentNumberTwo" />
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <div class="flex justify-center">
                                <span class="sm:ml-3">
                                    <button type="submit"
                                        class="inline-flex items-center justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                                        <div wire:loading.flex wire:target="store">
                                            <x-icons.loading />
                                            Procesando ...
                                        </div>
                                        <p wire:loading.remove wire:target="store">Guardar y Actualizar</p>
                                    </button>
                                </span>
                            </div>
                            <button type="button" wire:click="$set('showModal', false)"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
    @endif
</div>
