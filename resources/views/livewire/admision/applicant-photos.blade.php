<div class="animate-fade-in">
    @if ($isProcessOpen)
        <div class="flex justify-between mb-8 mx-4 items-center">
            <div class="hidden sm:col-span-3 sm:block">
                <p class="max-w-2xl text-sm leading-6 text-gray-500">Fecha de último lote de imágenes subidas</p>
                <span
                    class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded border border-blue-400">
                    <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                    </svg>
                    @if ($latestDate == 0)
                        Carpeta vacía
                    @else
                        {{ date('Y/m/d', $latestDate) }}
                    @endif
                </span>
            </div>
            @if ($applicantPagination->total() > 0)
                <form action={{ route('mail.sendMail') }} method="POST">
                    @csrf
                    <input type="hidden" name="applicantIdList" value="{{ json_encode($applicantIdList) }}">
                    <input type="hidden" name="state" value={{ $fileStatus }}>
                    <input type="hidden" name="file" value={{ $file }}>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 inline-flex items-center">
                        Enviar correo
                        <span
                            class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                            {{ count($totalApplicants) }}
                        </span>
                    </button>
                </form>
            @endif
        </div>
        @if ($applicantPagination->total() > 0)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-start">
                                    Nombres - correo
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-start">
                                    Apellidos
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-center">
                                    Código
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-center">
                                    DNI
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-center">
                                    Estado
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-center">
                                    DNI Anverso
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-center">
                                    Foto Reverso
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-center">
                                    Foto
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applicantPagination as $i => $applicant)
                            <tr class="bg-white border-b">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $applicant->nombres }}
                                    <p class="mt-1 truncate text-sm leading-5 text-gray-500">{{ $applicant->correo }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $applicant->ap_paterno }} {{ $applicant->ap_materno }}
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                    {{ $applicant->codigo }}
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                    {{ $applicant->num_documento }}
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                    <x-badge :estado="$applicant->estado_postulante_id" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center bg-gray-50 relative">
                                        <x-show-file-with-status :file="$file" :image="$listUrlPhotoAndDni[$applicant->num_documento][0]" />
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center bg-gray-50 relative">
                                        <x-show-file-with-status :file="$file" :image="$listUrlPhotoAndDni[$applicant->num_documento][1]" />
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center bg-gray-50 relative">
                                        <x-show-file-with-status :file="$file" :image="$listUrlPhotoAndDni[$applicant->num_documento][2]" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($applicantPagination->total() > 10)
                    {{ $applicantPagination->links() }}
                @endif
            </div>
        @else
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 mt-8" role="alert">
                <span class="font-medium">No se encontraron registros!</span> Correos correctamente enviados o datos no
                cargados.
            </div>
        @endif
    @else
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Importante!</span> Habilite un proceso para poder ejecutar esta acción.
        </div>
    @endif
</div>
