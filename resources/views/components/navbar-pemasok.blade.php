<nav x-data="{ open: false }" class="flex flex-wrap sticky top-0 left-0 right-0 z-50 items-center justify-between px-6 py-4 bg-[#172C1F] shadow-md">
    {{-- Logo --}}
    <div class="text-xl font-bold italic text-white">
        <a href="{{ route('profile') }}">MaggotLink</a>
    </div>

    {{-- Hamburger (Mobile) --}}
    <button @click="open = !open" class="lg:hidden text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16"/>
            <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    {{-- Links --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="w-full lg:flex lg:items-center lg:w-auto lg:space-x-6 text-white font-semibold hidden mt-4 lg:mt-0">
        <a href="{{ route('halaman') }}" class="block lg:inline-block px-4 py-2">Home</a>
        <a href="{{ route('kerjasama') }}" class="block lg:inline-block px-4 py-2">Kerjasama</a>
        <a href="{{ route('bagisampah') }}" class="block lg:inline-block px-4 py-2">Bagi Sampah</a>
    </div>
</nav>
