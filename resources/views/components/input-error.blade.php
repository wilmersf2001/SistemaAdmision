@props(['for'])
@error($for)
  <p class="absolute peer-invalid:visible text-red-600 text-xs animate-slide-in-left">{{ $message }}</p>
@enderror
