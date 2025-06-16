@props(['message', 'type' => 'success'])

@php
    $colors = [
        'success' => 'green',
        'error' => 'red',
        'info' => 'blue',
        'warning' => 'yellow',
    ];
    $color = $colors[$type] ?? 'green';
@endphp

<div class="fixed inset-0 flex items-center justify-center z-50">
    <!-- Overlay -->
    <div class="bg-black bg-opacity-50 absolute inset-0"></div>

    <!-- Modal Box -->
    <div class="bg-white p-8 rounded-2xl shadow-lg z-10 w-[90%] max-w-md text-center">
        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <div class="bg-{{ $color }}-400 rounded-full p-4">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="3"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="{{ $type === 'success' ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}" />
                </svg>
            </div>
        </div>

        <!-- Message -->
        <p class="text-lg font-semibold text-{{ $color }}-800">{{ $message }}</p>

        <!-- Back Button -->
       <a href="{{ url()->previous() }}" class="text-sm text-{{ $color }}-600 hover:underline">Kembali</a>

    </div>
</div>
