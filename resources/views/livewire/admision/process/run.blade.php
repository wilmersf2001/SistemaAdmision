<div>
    @if ($ongoingProcess)
        <x-modals.warning color="blue">
            <x-slot name="title">Advertencia</x-slot>
            <x-slot name="content">
                Ya existe un proceso en ejecución {{ $processNumber }} , debe cerrar el proceso actual para poder
                ejecutar otro.
            </x-slot>
            <x-slot name="button">
                <button type="button" wire:click="$emit('closeModal')"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Aceptar</button>
            </x-slot>
        </x-modals.warning>
    @else
        <x-modals.warning color="blue">
            <x-slot name="title">Advertencia</x-slot>
            <x-slot name="content">
                ¿Está seguro que desea ejecutar el proceso
                {{ date('Y', strtotime($process->fecha_inicio)) . ' - ' . $process->numero }}?
            </x-slot>
            <x-slot name="button">
                <button type="button" wire:click="runProcess" wire:loading.remove wire:target="runProcess"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Aceptar</button>
                <span wire:loading.flex wire:target="runProcess"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                    <x-icons.loading />
                    Procesando ...
                </span>
                <button type="button" wire:click="$emit('closeModal')"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">cancelar</button>

            </x-slot>
        </x-modals.warning>
    @endif
</div>
