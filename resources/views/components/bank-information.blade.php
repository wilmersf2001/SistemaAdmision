@props(['bank'])

<div class="mx-auto mb-8 max-w-2xl rounded-3xl ring-1 ring-gray-200 lg:mx-0 lg:flex lg:max-w-none bg-gray-50 md:mb-10">
    <div class="p-4 lg:flex-auto">
        <ul role="list" class="grid grid-cols-1 gap-4 text-xs leading-3 text-gray-600 sm:grid-cols-4 sm:gap-6">
            <li class="flex gap-x-3">
                <p class="font-medium text-gray-800">Número de documento :</p> {{ $bank->num_doc_depo }}
            </li>
            <li class="flex gap-x-3">
                <p class="font-medium text-gray-800">Tipo de documento :</p>
                {{ $bank->tipo_doc_depo == 1 ? 'DNI' : 'Carnet de Extranjería' }}
            </li>
            <li class="flex gap-x-3">
                <p class="font-medium text-gray-800">Número de Voucher :</p> {{ $bank->num_documento }}
            </li>
            <li class="flex gap-x-3">
                <p class="font-medium text-gray-800">Importe :</p> S/.{{ $bank->importe }}
            </li>
        </ul>
    </div>
</div>
