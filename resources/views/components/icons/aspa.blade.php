@props(['flag', 'size'])
<svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5 transition hover:-translate-y-1 hover:scale-110 duration-300 @if ($flag == 1) text-gray-300 @endif">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
</svg>
