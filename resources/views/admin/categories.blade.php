<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - Libera Admin</title>
    <link rel="icon" href="{{ asset('storage/images/favicon-96x96.png') }}" type="image/png">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* SINKRONISASI FONT AGAR TIDAK LONCAT */
        body, button, input, select, textarea, span, p, h1, h2, h3, h4, h5, h6, table, td, th {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .fas, .fa-solid {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900;
            display: inline-block;
            font-style: normal;
        }

        body { background-color: #fcfdfe; letter-spacing: -0.01em; }

        /* Halusin Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #0d6efd; border-radius: 10px; }

        /* Mastiin teks di tabel tegak & clean */
        .table-text { font-weight: 700 !important; text-transform: uppercase; font-size: 13px; }
    </style>
</head>
<body class="text-gray-900" x-data="{ openModal: false, editModal: false, catId: '', catNama: '' }">

    <div class="flex min-h-screen">
        @include('admin.partials.sidebar')

        <div class="flex-1">
            <header class="h-20 bg-white/80 backdrop-blur-md sticky top-0 z-30 border-b border-gray-100 px-10 flex items-center justify-between">
                <div>
                    <h2 class="text-[10px] font-black text-[#0d6efd] uppercase tracking-[0.2em] mb-0.5">Database Management</h2>
                    <p class="text-lg font-extrabold text-gray-800 uppercase tracking-tighter">Manajemen Kategori</p>
                </div>

                <button @click="openModal = true" class="bg-[#0d6efd] text-white px-6 py-2.5 rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition flex items-center text-[10px] font-black uppercase tracking-widest">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Kategori
                </button>
            </header>

            <main class="p-10">
                @if(session('success'))
                <div class="bg-blue-50 border border-blue-100 text-[#0d6efd] p-5 mb-8 rounded-2xl flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span class="text-[10px] font-black uppercase tracking-widest">{{ session('success') }}</span>
                </div>
                @endif

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-50">
                                <th class="px-8 py-5 text-[9px] font-black text-gray-400 uppercase tracking-[0.25em]">No</th>
                                <th class="px-8 py-5 text-[9px] font-black text-gray-400 uppercase tracking-[0.25em]">Nama Kategori</th>
                                <th class="px-8 py-5 text-[9px] font-black text-gray-400 uppercase tracking-[0.25em] text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($categories as $index => $cat)
                            <tr class="hover:bg-gray-50/50 transition-all group">
                                <td class="px-8 py-6 text-gray-400 font-bold text-xs">{{ $index + 1 }}</td>
                                <td class="px-8 py-6 text-gray-800 font-black uppercase tracking-tighter text-sm">{{ $cat->nama_kategori }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-center space-x-3">
                                        <button @click="editModal = true; catId = '{{ $cat->id }}'; catNama = '{{ $cat->nama_kategori }}'"
                                                class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>

                                        <form action="{{ route('admin.categories.delete', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-10 h-10 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-20 text-center text-gray-300 text-[10px] font-black uppercase tracking-widest">Belum ada data kategori</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4" x-cloak x-transition>
        <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-md overflow-hidden p-10" @click.away="openModal = false">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-[#0d6efd] mx-auto mb-4">
                    <i class="fas fa-tags text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Tambah Kategori</h3>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-8">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 text-center">Nama Kategori</label>
                    <input type="text" name="nama_kategori" placeholder="Contoh: FIKSI"
                           class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-[#0d6efd] outline-none transition text-center font-bold uppercase" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" @click="openModal = false" class="px-6 py-4 text-gray-400 font-black uppercase text-[10px] tracking-widest">Batal</button>
                    <button type="submit" class="bg-[#0d6efd] text-white px-6 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-xl shadow-blue-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="editModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4" x-cloak x-transition>
        <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-md overflow-hidden p-10" @click.away="editModal = false">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 mx-auto mb-4">
                    <i class="fas fa-edit text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Update Kategori</h3>
            </div>

            <form :action="'/admin/categories/' + catId" method="POST">
                @csrf @method('PUT')
                <div class="mb-8">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 text-center">Nama Kategori</label>
                    <input type="text" name="nama_kategori" x-model="catNama"
                           class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-amber-50 focus:border-amber-500 outline-none transition text-center font-bold uppercase" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" @click="editModal = false" class="px-6 py-4 text-gray-400 font-black uppercase text-[10px] tracking-widest">Batal</button>
                    <button type="submit" class="bg-amber-500 text-white px-6 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-xl shadow-amber-100">Update</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
