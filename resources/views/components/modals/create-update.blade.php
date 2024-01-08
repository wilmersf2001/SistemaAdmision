@props(['route', 'data'])

<div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex z-10 min-h-full justify-center p-4 text-center sm:items-center sm:p-0 items-center">
            <form action={{ $data ? route($route, $data) : route($route) }} method="POST"
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                @csrf
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex items-center">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            {{ $icon }}
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $title }} </h3>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto sm:rounded-lg pt-4 mt-2 px-6">
                        {{ $content }}
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <div class="flex justify-center">
                        <span class="sm:ml-3">
                            {{ $buttonAceptar }}
                        </span>
                    </div>
                    {{ $buttonCancelar }}
                </div>
            </form>
        </div>
    </div>
</div>
