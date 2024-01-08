<div>
    @if ($process->estado != 1)
        <x-modals.warning color="red">
            <x-slot name="title">¿Seguro que desea eliminar el proceso?</x-slot>
            <x-slot name="content">
                Confirmada la eliminación no podrá revertir la operación.
            </x-slot>
            <x-slot name="button">
                <form class="flex justify-center" action={{ route('process.destroy', $process) }} method="POST">
                    @csrf
                    @method('DELETE')
                    <span class="sm:ml-3">
                        <button type="submit"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                            Eliminar
                        </button>
                    </span>
                </form>
                <button type="button" wire:click="$emit('closeModal')"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
            </x-slot>
        </x-modals.warning>
    @else
        <x-modals.warning color="blue">
            <x-slot name="title">Advertencia</x-slot>
            <x-slot name="content">
                No puede eliminar un proceso que ya ha sido iniciado.
            </x-slot>
            <x-slot name="button">
                <button type="button" wire:click="$emit('closeModal')"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Aceptar</button>
            </x-slot>
        </x-modals.warning>
    @endif
</div>
