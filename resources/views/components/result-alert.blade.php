@props(['title', 'message', 'result'])

@php
    $color_icon = $result == 'success' ? 'green' : ($result == 'error' ? 'red' : 'yellow');
    $color_button = $result == 'success' ? 'indigo' : ($result == 'error' ? 'red' : 'yellow');
@endphp

<div id="alertModal" class="relative z-50 animate-fade-in" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-400 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div
                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-{{ $color_icon }}-100 mb-6 text-{{ $color_icon }}-600">
                        @if ($result == 'success')
                            <x-icons.check />
                        @elseif($result == 'error')
                            <x-icons.aspa flag="0" size="6" />
                        @else
                            <x-icons.exclamation />
                        @endif
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">{{ $title }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">{{ $message }}</p>
                        </div>
                    </div>

                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button id="close" type="button"
                        class="inline-flex w-full justify-center rounded-md bg-{{ $color_button }}-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-{{ $color_button }}-500 sm:ml-3">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('close').addEventListener('click', function() {
        var modal = document.getElementById('alertModal');
        modal.style.display = 'none';
    });
</script>
