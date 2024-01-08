@props(['flag', 'size' => 5])
<svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-{{ $size }} h-{{ $size }} transition hover:-translate-y-1 hover:scale-110 duration-300 @if ($flag == 1) text-gray-300 @endif">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
</svg>
