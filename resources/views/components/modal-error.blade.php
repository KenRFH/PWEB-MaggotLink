@props(['message', 'type' => 'success'])

@php
    $colors = [
        'success' => 'green',
        'error' => 'red',
        'info' => 'blue',
        'warning' => 'yellow',
    ];

    $icons = [
        'success' => asset('assets/success.svg'),
        'error' => asset('assets/error.svg'),
        // 'info' => asset('assets/info.svg'),
        // 'warning' => asset('assets/warning.svg'),
    ];

    $color = $colors[$type] ?? 'green';
    $icon = $icons[$type] ?? asset('assets/icons/success.svg');
@endphp

<div class="fixed inset-0 flex items-center justify-center z-50">
    <!-- Overlay -->
    <div class="bg-black bg-opacity-50 absolute inset-0"></div>

    <!-- Modal Box -->
    <div class="bg-white p-8 rounded-2xl shadow-lg z-10 w-[90%] max-w-md text-center">
        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <img src="{{ $icon }}" alt="{{ $type }} icon" class="w-30 h-30" />
        </div>

        <!-- Message -->
        <p class="text-lg font-semibold text-{{ $color }}-800 mb-4">{{ $message }}</p>

        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="text-sm text-{{ $color }}-600 hover:underline">Kembali</a>
    </div>
</div>
