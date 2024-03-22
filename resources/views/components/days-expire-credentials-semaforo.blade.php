@props(['dias'])

@if ($dias >= 9)
    <div
        class="w-12 h-12 flex justify-center items-center rounded-full bg-green-100 p-3 text-xs font-medium text-green-800 ring-1 ring-inset ring-green-600/20">
        {{ $dias }}
    </div>
@elseif($dias >= 6)
    <span
        class="w-12 h-12 flex justify-center items-center rounded-full bg-yellow-100 p-3 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
        {{ $dias }}
    </span>
@elseif($dias >= 0)
    <span
        class="w-12 h-12 flex justify-center items-center rounded-full bg-red-100 p-3 text-xs font-medium text-red-800 ring-1 ring-inset ring-red-600/20">
        {{ $dias }}
    </span>
@else
    <span
        class="w-12 h-12 flex justify-center items-center rounded-full bg-gray-100 p-3 text-xs font-medium text-gray-800 ring-1 ring-inset ring-gray-600/20">
        caduco
    </span>
@endif
