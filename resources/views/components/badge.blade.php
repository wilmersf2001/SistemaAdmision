@props(['estado'])
@if ($estado == 1)
    <span
        class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Inscrito
        web </span>
@elseif($estado == 2 || $estado == 3)
    <span
        class="inline-flex items-center rounded-md bg-pink-50 px-2 py-1 text-xs font-medium text-pink-700 ring-1 ring-inset ring-pink-700/10">Inscripción
        observada <span>&rarr;</span>e{{ $estado }}</span>
@elseif($estado == 4)
    <span
        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Validado
        y enviado correo</span>
@elseif($estado == 5)
    <span
        class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-700/10">Carnet
        impreso</span>
@elseif($estado == 6)
    <span
        class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Huella
        digital</span>
@elseif($estado == 7)
    <span
        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Carnet
        entregado</span>
@endif
