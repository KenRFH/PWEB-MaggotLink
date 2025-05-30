<div class="fixed top-0 left-0 h-full w-48 bg-[#90B3A0] flex flex-col items-center py-6 space-y-4 shadow-md z-50">
    <a href="{{ route('profile') }}" class="text-xl font-bold italic text-white mb-6">MaggotLink</a>

    <a href="{{ route('dashboard') }}" class="w-40 py-2 text-center rounded-md {{ request()->routeIs('dashboard') ? 'bg-[#6D8F7A] font-bold' : 'bg-[#B6C9C1] font-semibold' }}">
        Dashboard
    </a>

    <a href="{{ route('admin.kerjasama.index') }}" class="w-40 py-2 text-center rounded-md {{ request()->routeIs('admin.kerjasama.index') ? 'bg-[#6D8F7A] font-bold' : 'bg-[#B6C9C1] font-semibold' }}">
        Kerja Sama
    </a>

    <a href="#" class="w-40 py-2 text-center rounded-md bg-[#B6C9C1] font-semibold">Bagi Sampah</a>

    <a href="{{ route('profile') }}" class="w-40 py-2 text-center rounded-md {{ request()->routeIs('profile') ? 'bg-[#6D8F7A] font-bold' : 'bg-[#B6C9C1] font-semibold' }}">
        Profile
    </a>
</div>
