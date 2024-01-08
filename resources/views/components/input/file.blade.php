@props(['span', 'src', 'alt', 'model', 'click', 'w' => 'w-36', 'h' => 'h-48', 'imageId', 'inputId'])

<div class="flex flex-col items-center mb-10">
    <div class="{{ $w }} {{ $h }} border rounded-xl border-gray-300 overflow-hidden mb-5">
        <img src="{{ asset($src) }}" alt="{{ $alt }}" class="w-full h-full object-cover" id="{{ $imageId }}"
            wire:ignore />
    </div>
    <label class="block">
        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block mb-2 text-sm font-medium text-gray-900">
            {{ $span }}
        </span>
        <input type="file" name="{{ $model }}" wire:model="{{ $model }}" wire:click="{{ $click }}"
            id="{{ $inputId }}"
            class="block w-full text-sm text-slate-500
  file:mr-4 file:py-2 file:px-4
  file:rounded-full file:border-0
  file:text-ms file:font-semibold
  file:bg-blue-50 file:text-blue-700
  hover:file:bg-blue-100
" />
        <x-input.error for="{{ $model }}" />
    </label>
</div>
