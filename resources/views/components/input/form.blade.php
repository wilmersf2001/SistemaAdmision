@props([
    'span',
    'name',
    'model',
    'type' => 'text',
    'placeholder' => '',
    'maxlength' => 255,
    'disable' => 0,
    'margin' => 'mb-8',
])

<label class="block {{ $margin }}">
    <span class="block mb-2 text-sm font-medium text-gray-900">
        {{ $span }}
    </span>
    @if ($disable == 0)
        <input type="{{ $type }}" name="{{ $name }}" wire:model="{{ $model }}"
            placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}"
            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
    @else
        <input type="{{ $type }}" name="{{ $name }}" wire:model="{{ $model }}"
            maxlength="{{ $maxlength }}" readonly
            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 block w-full rounded-md sm:text-sm read-only:bg-slate-50 read-only:text-slate-500 read-only:border-slate-200 read-only:shadow-none focus:outline-none" />
    @endif

    <x-input.error for="{{ $model }}" />
</label>
