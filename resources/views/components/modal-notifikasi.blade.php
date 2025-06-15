@props(['message', 'type' => 'error'])

<div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-black bg-opacity-50 absolute inset-0"></div>
    <div class="bg-white p-6 rounded-lg shadow-lg z-10 w-96">
        <h2 class="text-lg font-semibold text-{{ $type === 'error' ? 'red' : 'blue' }}-600 mb-2">
            {{ $type === 'error' ? 'Terjadi Kesalahan' : 'Informasi' }}
        </h2>
        <p class="text-gray-700 text-sm">{{ $message }}</p>
        <div class="mt-4 text-right">
            <a href="#" onclick="history.back()" class="text-sm text-gray-500 hover:underline">Kembali</a>
        </div>
    </div>
</div>
