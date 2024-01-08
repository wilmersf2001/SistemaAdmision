<div>
    @if ($process->estado == 1)
        <x-modals.warning color="blue">
            <x-slot name="title">¿Seguro que desea terminar el proceso {{ $processNumber }} ?</x-slot>
            <x-slot name="content"> Confirmado el termino del proceso no podrá revertir la operación. </x-slot>
            <x-slot name="button">
                <div class="flex justify-center">
                    <span class="sm:ml-3">
                        <button type="button" wire:click="modifyProcessStatus"
                            class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                            Terminar
                        </button>
                    </span>
                </div>
                <button type="button" wire:click="$emit('closeModal')"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancelar</button>
            </x-slot>
        </x-modals.warning>
    @else
        <x-modals.warning color="blue">
            <x-slot name="title">Advertencia</x-slot>
            <x-slot name="content"> No puede finalizar un proceso en estado pendiente, ya que no se ha iniciado.
            </x-slot>
            <x-slot name="button">
                <button type="button" wire:click="$emit('closeModal')"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                    Aceptar
                </button>
            </x-slot>
        </x-modals.warning>
    @endif
</div>
