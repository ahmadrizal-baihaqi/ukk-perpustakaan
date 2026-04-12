<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Libera Admin</title>
    <link rel="icon" href="{{ asset('storage/images/favicon-96x96.png') }}" type="image/png">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body, button, input, select, textarea, span, p, h1, h2, h3, h4, h5, h6, table, td, th {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .fas, .fa-solid { font-family: "Font Awesome 6 Free" !important; font-weight: 900; display: inline-block; font-style: normal; }
        body { background-color: #fcfdfe; letter-spacing: -0.01em; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #0d6efd; border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-gray-900" x-data="{ openModal: false, editModal: false, bookId: '', bookJudul: '', bookPenulis: '', bookPenerbit: '', bookTahun: '', bookStok: '', bookCategory: '' }">

    <div class="flex min-h-screen">
        @include('admin.partials.sidebar')

        <div class="flex-1">
            <header class="h-20 bg-white/80 backdrop-blur-md sticky top-0 z-30 border-b border-gray-100 px-10 flex items-center justify-between">
                <div>
                    <h2 class="text-[10px] font-black text-[#0d6efd] uppercase tracking-[0.2em] mb-0.5">Inventory Management</h2>
                    <p class="text-lg font-extrabold text-gray-800 uppercase tracking-tighter">Koleksi Buku</p>
                </div>
                <button @click="openModal = true" class="bg-[#0d6efd] text-white px-6 py-2.5 rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition flex items-center text-[10px] font-black uppercase tracking-widest">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Buku
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
                                <th class="px-8 py-5 text-[9px] font-black text-gray-400 uppercase tracking-[0.25em] text-center">Cover</th>
                                <th class="px-8 py-5 text-[9px] font-black text-gray-400 uppercase tracking-[0.25em]">Judul & Penulis</th>
                                <th class="px-8 py-5 text-[9px] font-black text-gray-400 uppercase tracking-[0.25em]">Kategori</th>
                                <th class="px-8 py-5 text-[9px] font-black text-gray-400 uppercase tracking-[0.25em] text-center">Stok</th>
                                <th class="px-8 py-5 text-[9px] font-black text-gray-400 uppercase tracking-[0.25em] text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 uppercase text-[12px]">
                            @forelse($books as $b)
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="px-8 py-6 text-center">
                                    <img src="{{ asset('storage/'.$b->cover) }}" class="w-12 h-16 object-cover rounded-xl shadow-sm mx-auto transition-transform hover:scale-110 border border-gray-100">
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-black text-gray-900 leading-tight line-clamp-1">{{ $b->judul }}</p>
                                    <p class="text-[9px] text-gray-400 mt-1 font-bold">BY: {{ $b->penulis }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="bg-blue-50 text-[#0d6efd] px-3 py-1.5 rounded-lg font-black text-[9px] tracking-widest border border-blue-100">
                                        {{ $b->category->nama_kategori }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center font-black text-gray-900">{{ $b->stok }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-center space-x-3">
                                        <button @click="editModal = true; bookId = '{{ $b->id }}'; bookJudul = '{{ $b->judul }}'; bookPenulis = '{{ $b->penulis }}'; bookPenerbit = '{{ $b->penerbit }}'; bookTahun = '{{ $b->tahun_terbit }}'; bookStok = '{{ $b->stok }}'; bookCategory = '{{ $b->category_id }}'"
                                                class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <form action="{{ route('admin.books.delete', $b->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-10 h-10 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-8 py-20 text-center text-gray-300 text-[10px] font-black uppercase tracking-widest">Belum ada koleksi buku</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4" x-cloak x-transition>
        <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-2xl overflow-hidden p-10" @click.away="openModal = false">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Tambah Koleksi Baru</h3>
            </div>

            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6 text-left">
                @csrf
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Judul Buku</label>
                    <input type="text" name="judul" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-[#0d6efd] outline-none transition font-bold" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kategori</label>
                    <select name="category_id" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Stok Buku</label>
                    <input type="number" name="stok" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Penulis</label>
                    <input type="text" name="penulis" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Penerbit</label>
                    <input type="text" name="penerbit" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Cover Buku</label>
                    <input type="file" name="cover" class="w-full text-xs font-bold text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-blue-50 file:text-[#0d6efd] hover:file:bg-blue-100" required>
                </div>
                <div class="col-span-2 grid grid-cols-2 gap-4 mt-4">
                    <button type="button" @click="openModal = false" class="px-6 py-4 text-gray-400 font-black uppercase text-[10px] tracking-widest text-center">Batal</button>
                    <button type="submit" class="bg-[#0d6efd] text-white px-6 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-xl shadow-blue-100">Simpan Koleksi</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="editModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4" x-cloak x-transition>
        <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-2xl overflow-hidden p-10" @click.away="editModal = false">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Update Data Buku</h3>
            </div>

            <form :action="'/admin/books/' + bookId" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6 text-left">
                @csrf @method('PUT')
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Judul Buku</label>
                    <input type="text" name="judul" x-model="bookJudul" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-amber-50 focus:border-amber-500 outline-none transition font-bold" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kategori</label>
                    <select name="category_id" x-model="bookCategory" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Stok Buku</label>
                    <input type="number" name="stok" x-model="bookStok" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Penulis</label>
                    <input type="text" name="penulis" x-model="bookPenulis" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Penerbit</label>
                    <input type="text" name="penerbit" x-model="bookPenerbit" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" x-model="bookTahun" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white outline-none transition font-bold" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Ganti Cover (Opsional)</label>
                    <input type="file" name="cover" class="w-full text-xs font-bold text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-amber-50 file:text-amber-600 hover:file:bg-amber-100">
                </div>
                <div class="col-span-2 grid grid-cols-2 gap-4 mt-4 text-center">
                    <button type="button" @click="editModal = false" class="px-6 py-4 text-gray-400 font-black uppercase text-[10px] tracking-widest">Batal</button>
                    <button type="submit" class="bg-amber-500 text-white px-6 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-xl shadow-amber-100">Update Data</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
