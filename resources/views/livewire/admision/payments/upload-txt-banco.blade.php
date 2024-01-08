<div class="animate-fade-in">
    <form action="{{ route('fileTxt.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center justify-center w-full relative mb-1">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-{{ $errors->has('filetxt') ? 'red' : 'gray' }}-50">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 mb-4 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clic para cargar</span>
                        o arrastre y suelte</p>
                    <p class="text-xs text-gray-500">FORMATO TXT</p>
                </div>
                <input id="dropzone-file" type="file" name="filetxt" wire:model="filetxt"
                    class="absolute w-full h-full text-sm text-slate-500 file:hidden p-4" />
            </label>
        </div>
        <x-input-error for="filetxt" />
        <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-5">
            <button type="submit"
                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-40">Subir
                archivo</button>
        </div>
    </form>
</div>
