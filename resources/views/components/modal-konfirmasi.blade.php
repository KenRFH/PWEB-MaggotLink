<div x-data="{ open: false, id: null }" x-on:open-konfirmasi.window="open = true; id = $event.detail.id" x-cloak>
    <template x-teleport="body">
        <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
            <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md" @click.away="open = false">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Penjadwalan</h2>
                <p class="mb-6 text-gray-600">Yakin ingin mengonfirmasi penjadwalan ini?</p>
                <form :action="`/bagisampah/update-status/${id}`" method="POST">
                    @csrf
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white">
                            Ya, Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
