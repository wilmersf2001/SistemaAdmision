<div>
    <form class="space-y-6" action="{{ route('ficha.validatePdf') }}" method="POST">
        @csrf
        <div>
            <label for="num_documento"
                class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">Número
                de Documento</label>
            <div class="mt-2">
                <input id="num_documento" name="num_documento" type="text" wire:model="num_documento" minlength="8"
                    maxlength="9"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
            </div>
            <x-input.error for="num_documento" />
        </div>

        <div>
            <label for="num_voucher"
                class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">Número
                de
                Voucher</label>

            <div class="mt-2">
                <input id="num_voucher" name="num_voucher" type="text" wire:model="num_voucher" minlength="7"
                    maxlength="7"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
            </div>
            <x-input.error for="num_voucher" />
        </div>

        <div>
            <button type="submit"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Consultar</button>
        </div>
    </form>
    @if (session('error'))
        <x-alerts.error message="{{ session('error') }}" />
    @endif
    @if (session('success'))
        <x-alerts.success title="Rectificación Existosa" message="{{ session('success') }}" />
    @endif
</div>
