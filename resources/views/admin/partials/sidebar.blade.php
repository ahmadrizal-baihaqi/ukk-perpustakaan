<div class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col h-screen sticky top-0 z-50 antialiased">
    <div class="p-8 flex flex-col h-full">

        <div class="flex items-center gap-3 px-2 mb-12">
            <img src="{{ asset('storage/logos/libera.png') }}" class="w-10 h-10 object-contain">
            <span class="text-xl font-extrabold tracking-tighter uppercase text-gray-900">
                Libera<span class="text-[#0d6efd]">.</span>
            </span>
        </div>

        <nav class="space-y-2 flex-1">
            @php
                $menus = [
                    ['route' => 'admin.dashboard', 'icon' => 'fas fa-th-large', 'label' => 'Dashboard'],
                    ['route' => 'admin.categories', 'icon' => 'fas fa-tags', 'label' => 'Kategori'],
                    ['route' => 'admin.books', 'icon' => 'fas fa-book', 'label' => 'Data Buku'],
                    ['route' => 'admin.users', 'icon' => 'fas fa-users', 'label' => 'Data Anggota'],
                    ['route' => 'admin.reports', 'icon' => 'fas fa-file-alt', 'label' => 'Laporan'],
                ];
            @endphp

            @foreach($menus as $menu)
            @php
                $isActive = request()->routeIs($menu['route']);
            @endphp
            <a href="{{ route($menu['route']) }}"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-200
               {{ $isActive ? 'bg-[#0d6efd] shadow-lg shadow-blue-200' : 'hover:bg-blue-50/50' }}">

                <div class="w-6 text-center">
                    <i class="{{ $menu['icon'] }} text-sm {{ $isActive ? 'text-white' : 'text-gray-400' }}"></i>
                </div>

                <span class="text-sm font-bold tracking-tight {{ $isActive ? 'text-white' : 'text-gray-400' }}">
                    {{ $menu['label'] }}
                </span>
            </a>
            @endforeach
        </nav>

        <div class="mt-auto pt-8 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-4 px-5 py-4 w-full rounded-2xl text-gray-400 hover:bg-red-50 hover:text-red-600 transition-all font-bold text-sm">
                    <div class="w-6 text-center">
                        <i class="fas fa-power-off text-base"></i>
                    </div>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>
