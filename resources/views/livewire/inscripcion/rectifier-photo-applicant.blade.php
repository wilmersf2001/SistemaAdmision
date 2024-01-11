<div class="animate-fade-in">
    <form action="{{ route('ficha.storeRectifiedPhotos') }}" method="POST" class="flex flex-col bg-white px-2 sm:px-20"
        enctype="multipart/form-data">
        @csrf
        <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
            <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
            <div class="flex items-center sm:px-16 bg-red-50 py-4 rounded-2xl">

                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Inscripción
                            Observada
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Por favor se le comunica subir <b
                                    class="text-red-500">OTRO</b>
                                archivo en formato JPG |
                                <b class="text-red-500">NO SUBIR EL MISMO ARCHIVO OBSERVADO</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center gap-x-4">
                <h4 class="flex-none text-sm font-semibold leading-6 text-indigo-600">CONSIDERACIONES PARA FOTOGRAFÍA
                </h4>
                <div class="h-px flex-auto bg-gray-100"></div>
            </div>
            <ul role="list"
                class="mt-6 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600 sm:grid-cols-2 sm:gap-6">
                <li class="flex gap-x-3">
                    <x-icons.check />
                    Iluminación uniforme y suave, evitando sombras fuertes en el rostro.
                </li>
                <li class="flex gap-x-3">
                    <x-icons.check />
                    Enfoca correctamente tu rostro (no utilizar lentes ni cualquier otro tipo de accesorios) y utiliza
                    fondo blanco.
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
                <h4 class="flex-none text-sm font-semibold leading-6 text-indigo-600">CONSIDERACIONES PARA DNI</h4>
                <div class="h-px flex-auto bg-gray-100"></div>
            </div>
            <ul role="list" class="mt-6 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600">
                <li class="flex gap-x-3">
                    <x-icons.check />
                    Asegúrate que la imagen esté completamente legible y sin reflejos para evitar
                    problemas al verificar la información.
                </li>
            </ul>

            <div class="rounded-3xl ring-1 ring-gray-200 mb-10 animate-fade-in mt-6">
                <div class="-mt-2 p-2 lg:mt-0 lg:w-full">
                    <div class="rounded-2xl bg-gray-50 py-4">
                        <div class="flow-root">
                            <div
                                class="mt-6 grid gap-x-6 gap-y-10 grid-cols-1 {{ $numberPhotos == 3 ? 'lg:grid-cols-3' : ($numberPhotos == 2 ? 'sm:grid-cols-2' : '') }} xl:gap-x-8 justify-items-center">
                                @foreach ($observedPhotos as $photo)
                                    <div class="group relative flex flex-col items-center justify-center">
                                        <div class="flex items-end">
                                            <div
                                                class="relative w-32 overflow-hidden rounded-md bg-gray-200 aspect-none lg:h-48 mr-2">
                                                <div class="h-full w-full flex items-center">
                                                    @if ($photo['indicator'] == 0)
                                                        <img src="{{ asset($photo['url']) }}" alt=""
                                                            class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                                    @else
                                                        <img src="{{ asset($photo['url']) }}" alt=""
                                                            class="object-cover object-center">
                                                    @endif
                                                </div>
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <div class="text-red-500 text-7xl">X</div>
                                                </div>
                                            </div>
                                            <div class="col-span-full">
                                                <label class="block text-xs font-medium leading-6 text-gray-900">Vista
                                                    previa {{ $photo['indicator'] == 0 ? 'foto' : 'DNI' }}
                                                    {{ $photo['name'] }}</label>
                                                <div
                                                    class="w-32 h-48 bg-gray-200 rounded-lg border border-dashed border-gray-900/25 overflow-hidden flex items-center">
                                                    @if ($photo['indicator'] == 0)
                                                        <img src="{{ asset('images/vista_previa.png') }}"
                                                            alt="{{ $photo['name'] }}" id="preview-{{ $photo['name'] }}"
                                                            class="h-full w-full object-cover object-center lg:h-full lg:w-full"
                                                            wire:ignore>
                                                    @else
                                                        <img src="{{ asset('images/vista_previa.png') }}"
                                                            alt="{{ $photo['name'] }}"
                                                            id="preview-{{ $photo['name'] }}"
                                                            class="object-cover object-center" wire:ignore>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <label class="block mt-4">
                                            <span
                                                class="after:content-['*'] after:ml-0.5 after:text-red-500 block mb-2 text-sm font-medium text-gray-900">
                                                Foto {{ $photo['indicator'] == 0 ? '' : 'DNI' }}
                                                {{ $photo['name'] }}
                                            </span>
                                            <input type="file" wire:model="photo.{{ $photo['name'] }}"
                                                name="photo.{{ $photo['name'] }}"
                                                wire:click="$set('photo.{{ $photo['name'] }}', '')"
                                                id="fileInput-{{ $photo['name'] }}"
                                                class="block w-full text-sm text-slate-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-xs file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100
                                        " />
                                            @if ($disabled)
                                                <x-input.error for="photo.{{ $photo['name'] }}" />
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="number_photos" value="{{ $numberPhotos }}">
            </div>

            <div class="flex justify-end p-4">
                @if (!$errors->isEmpty())
                    <button type="button" wire:click="store"
                        class="rounded-md border border-transparent px-6 py-3 text-base font-medium bg-indigo-500 text-gray-200 border-slate-200 shadow-none">Rectificar
                        Fotos</button>
                @else
                    <button type="submit"
                        class="rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Rectificar
                        Fotos</button>
                @endif
            </div>
        </div>
    </form>

    <script>
        function handleImagePreview(inputId, previewId) {
            const fileInput = document.querySelector(`#${inputId}`);
            const preview = document.querySelector(`#${previewId}`);

            if (fileInput && preview) {
                fileInput.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    const fileReader = new FileReader();

                    fileReader.readAsDataURL(file);
                    fileReader.addEventListener('load', (e) => {
                        preview.setAttribute('src', e.target.result);
                    });
                });
            }
        }

        handleImagePreview('fileInput-perfil', 'preview-perfil');
        handleImagePreview('fileInput-anverso', 'preview-anverso');
        handleImagePreview('fileInput-reverso', 'preview-reverso');
    </script>
</div>
