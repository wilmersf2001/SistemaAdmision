@props(['formattedToday', 'numberProcess'])

<div class="mx-auto mt-10 max-w-2xl rounded-3xl ring-1 ring-gray-200 sm:mt-20 lg:mx-0 lg:flex lg:max-w-none">
    <div class="p-8 sm:p-10 lg:flex-auto">
        <h3 class="text-2xl font-bold tracking-tight text-gray-900">DECLARACIÓN JURADA</h3>
        <time datetime="2020-03-16" class="text-gray-500">{{ $formattedToday }}</time>
        <div class="relative flex mt-6">
            <div class="flex h-6 items-center">
                <input id="accordance" name="accordance" type="checkbox" wire:model="accordance"
                    class="h-4 w-4 rounded text-indigo-600 focus:ring-indigo-600 cursor-pointer">
            </div>
            <div class="text-sm">
                <label for="accordance" class="font-medium text-gray-900 pl-2">Declaro bajo juramento
                    que:</label>
            </div>
        </div>
        <div class="mt-4">
            <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                <li class="text-gray-400"><span class="text-gray-600">Conozco, acepto y me someto a las
                        bases,
                        condiciones y procedimientos establecidos en eI
                        Reglamento del Concurso de Admisión {{ $numberProcess }} de la Universidad Nacional
                        Pedro Ruiz Gallo.</span></li>
                <li class="text-gray-400"><span class="text-gray-600">La información y fotografia
                        registrada es
                        AUTÉNTICA y que las imágenes de mi DNI enviados para
                        mi inscripción como postulante al presente Concurso de Admisión,
                        son copia fiel al original, en caso de faltar a la verdad me someto a las sanciones
                        correspondientes (Art. 38 del Reglamento del presente Concurso de Admisión).</span>
                </li>
                <li class="text-gray-400"><span class="text-gray-600">No tengo impedimento para participar
                        en eI
                        Concurso de Admisión {{ $numberProcess }}.</span></li>
                <li class="text-gray-400"><span class="text-gray-600">De alcanzar una vacante, me
                        comprometo a
                        regularizar mi expediente en la fecha establecida en el
                        cronograma del presente Concurso de Admisión; en caso contrario
                        me someto a las sanciones correspondientes (Art.87 del Reglamento del presente
                        Concurso de
                        Admisión).</span></li>
            </ul>
        </div>
    </div>
</div>
