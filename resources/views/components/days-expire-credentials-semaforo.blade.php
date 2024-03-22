@props(['dias'])

@if ($dias < 5)
    <div
        class="w-12 h-12 flex justify-center items-center rounded-full bg-green-100 p-3 text-xs font-medium text-green-800 ring-1 ring-inset ring-green-600/20">
        {{ $dias }}
    </div>
@elseif($dias < 9)
    <span
        class="w-12 h-12 flex justify-center items-center rounded-full bg-yellow-100 p-3 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
        {{ $dias }}
    </span>
@elseif($dias >= 9)
    <span
        class="w-12 h-12 flex justify-center items-center rounded-full bg-red-100 p-3 text-xs font-medium text-red-800 ring-1 ring-inset ring-red-600/20">
        {{ $dias }}
    </span>
@endif
