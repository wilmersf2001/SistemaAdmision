@props(['isSuccess'])

<style>
    .desvanecer {
        animation: desvanecer 1.5s forwards;
    }

    @keyframes desvanecer {
        from {
            transform: translateY(0);
            transform: translateX(-50%);
            opacity: 1;
        }

        to {
            transform: translateY(100px);
            transform: translateX(-10%);
            opacity: 0;
        }
    }
</style>

<div id="notification"
    class="fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-gray-200 rounded-lg shadow bottom-10 left-1/2 z-50"
    style="transform: translateX(-50%);" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg">
        @if ($isSuccess == 'true')
            <x-icons.check />
        @else
            <x-icons.aspa flag="0" size="2" />
        @endif
    </div>
    <div class="ml-3 text-sm font-normal">{{ $message }}</div>
</div>

<script>
    var divElement = document.getElementById("notification");

    setTimeout(function() {
        divElement.classList.add("desvanecer");
    }, 3000);
    setTimeout(function() {
        divElement.remove();
    }, 5000);
</script>
