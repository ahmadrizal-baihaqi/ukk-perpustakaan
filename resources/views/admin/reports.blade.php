<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman | Libera</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('storage/images/favicon-96x96.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        *:not(i) {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        body {
            background-color: #fcfdfe;
            color: #1a202c;
        }
    </style>
</head>
<body class="antialiased">

    <div class="flex h-screen">
        @include('admin.partials.sidebar')

        <div class="flex-1 p-10 overflow-y-auto">

            <header class="mb-10">
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter uppercase">Laporan Peminjaman</h2>
                <p class="text-gray-400 text-sm font-medium mt-1">Histori transaksi dan audit sirkulasi buku perpustakaan.</p>
            </header>

            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50 border-b border-gray-50">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Peminjam</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Info Buku</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Tgl Pinjam</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Batas</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Kembali</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-[13px]">
                        @forelse($loans as $loan)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <p class="font-bold text-gray-900 uppercase tracking-tighter">{{ $loan->user->name }}</p>
                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">ID: #{{ $loan->user->id }}</p>
                            </td>

                            <td class="px-8 py-6">
                                <p class="font-bold text-gray-900 uppercase tracking-tighter line-clamp-1 max-w-[200px]">{{ $loan->book->judul }}</p>
                                <p class="text-[9px] text-[#0d6efd] font-bold uppercase tracking-widest mt-1">{{ $loan->book->category->nama_kategori ?? 'Umum' }}</p>
                            </td>

                            <td class="px-8 py-6 font-bold text-gray-500 uppercase">
                                {{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d/m/Y') }}
                            </td>

                            <td class="px-8 py-6 font-bold text-red-500 uppercase">
                                {{ \Carbon\Carbon::parse($loan->batas_kembali)->format('d/m/Y') }}
                            </td>

                            <td class="px-8 py-6 font-bold uppercase">
                                @if($loan->status == 'dikembalikan')
                                    <span class="text-green-500">
                                        {{ \Carbon\Carbon::parse($loan->tanggal_kembali ?? $loan->updated_at)->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="text-gray-200">---</span>
                                @endif
                            </td>

                            <td class="px-8 py-6 text-center">
                                <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest {{ $loan->status == 'dipinjam' ? 'bg-amber-100 text-amber-600' : 'bg-green-100 text-green-600' }}">
                                    {{ $loan->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center text-gray-300 font-black uppercase tracking-[0.2em] text-[10px]">
                                Belum ada data transaksi peminjaman
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
