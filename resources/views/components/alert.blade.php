<div 
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    x-transition:enter="transform ease-out duration-500 transition"
    x-transition:enter-start="translate-y-4 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transform ease-in duration-500 transition"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-4 opacity-0"
    style="
        background-color: {{ $type === 'error' ? '#dc2626' : '#16a34a' }};
        border-color: {{ $type === 'error' ? '#b91c1c' : '#15803d' }};
    "
    class="flex items-center justify-center gap-2 p-2 rounded"
>
    @if ($type === 'error')
        <i class="fa-solid fa-circle-xmark text-white text-2xl"></i>
    @else
        <i class="fa-solid fa-circle-check text-white text-2xl"></i>
    @endif
    <span class="font-semibold text-lg text-white break-words text-center">{{ $message }}</span>
</div>
