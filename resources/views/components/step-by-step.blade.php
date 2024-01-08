@props(['currentStep'])

@if ($currentStep == 1)
    <ol class="flex items-center w-full mb-4 sm:mb-5 justify-center">
        <li
            class="flex w-full items-center text-blue-600 after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
            <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.identification />
            </div>
        </li>
        <li
            class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
            <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.academic-cap />
            </div>
        </li>
        <li class="flex items-center">
            <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.document />
            </div>
        </li>
    </ol>
@elseif($currentStep == 2)
    <ol class="flex items-center w-full mb-4 sm:mb-5 justify-center">
        <li
            class="flex w-full items-center text-green-600  after:content-[''] after:w-full after:h-1 after:border-b after:border-green-100 after:border-4 after:inline-block">
            <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.check />
            </div>
        </li>
        <li
            class="flex w-full items-center text-blue-600 after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
            <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.academic-cap />
            </div>
        </li>
        <li class="flex items-center">
            <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.document />
            </div>
        </li>
    </ol>
@elseif($currentStep == 3)
    <ol class="flex items-center w-full mb-4 sm:mb-5 justify-center">
        <li
            class="flex w-full items-center text-green-600 after:content-[''] after:w-full after:h-1 after:border-b after:border-green-100 after:border-4 after:inline-block">
            <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.check />
            </div>
        </li>
        <li
            class="flex w-full items-center text-green-600 after:content-[''] after:w-full after:h-1 after:border-b after:border-green-100 after:border-4 after:inline-block">
            <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.check />
            </div>
        </li>
        <li class="flex items-center text-blue-600">
            <div class="flex items-center  justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                <x-icons.document />
            </div>
        </li>
    </ol>
@endif
