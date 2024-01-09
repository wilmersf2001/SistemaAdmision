@props(['file', 'image'])

@if ($file == App\Utils\Constants::CARPETA_ARCHIVOS_VALIDOS)
    @if ($image != 0)
        <img class="w-10 h-10 sm:w-20 sm:h-20 text-center rounded-full object-cover object-top" src="{{ asset($image) }}"
            alt="POSTULANTE" />
        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
            <div
                class="w-8 h-8 border-2 border-green-500 rounded-full text-green-500 sm:w-10 sm:h-10 flex items-center justify-center">
                <x-icons.check />
            </div>
        </div>
    @else
        <div class="flex justify-center text-green-500">
            <x-icons.check />
        </div>
    @endif
@else
    @if ($image != 0)
        <img class="w-10 h-10 sm:w-20 sm:h-20 text-center rounded-full object-cover object-top" src="{{ asset($image) }}"
            alt="POSTULANTE" />
        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
            <div
                class="w-8 h-8 border-2 border-red-500 rounded-full text-red-500 sm:w-10 sm:h-10 flex items-center justify-center">
                <x-icons.aspa flag="0" />
            </div>
        </div>
    @else
        <div class="flex justify-center text-green-500">
            <x-icons.check />
        </div>
    @endif
@endif
