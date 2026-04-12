<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libera | Sistem Perpustakaan Digital Modern</title>
    <link rel="icon" href="{{ asset('storage/images/favicon-96x96.png') }}" type="image/png">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        *:not(i) {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .fas, .fa-solid {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
            display: inline-block !important;
        }

        body { background-color: #fcfdfe; color: #1f2937; overflow-x: hidden; scroll-behavior: smooth; }
        .glass-nav { background: rgba(252, 253, 254, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0, 0, 0, 0.05); }
        .hero-gradient { background: radial-gradient(circle at 50% 50%, rgba(13, 110, 253, 0.08) 0%, rgba(252, 253, 254, 0) 60%); }
        .btn-primary { background-color: #0d6efd; transition: all 0.3s ease; color: white; }
        .btn-primary:hover { background-color: #0b5ed7; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2); transform: translateY(-2px); }

        .card-glass { background: #ffffff; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); transition: all 0.3s ease; }
        .card-glass:hover { border-color: #0d6efd; transform: translateY(-5px); box-shadow: 0 15px 35px rgba(13, 110, 253, 0.06); }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.9s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <nav class="glass-nav fixed w-full z-50 px-6 md:px-16 py-5 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <img src="{{ asset('storage/logos/libera.png') }}" class="w-[30px] h-[30px] object-contain transition-transform hover:rotate-12 duration-500">
            <span class="text-2xl font-black tracking-tighter uppercase text-gray-900">Libera<span class="text-[#0d6efd]">.</span></span>
        </div>

        <div class="hidden md:flex items-center gap-10 text-gray-500">
            <a href="#features" class="text-[10px] font-black uppercase tracking-[0.2em] hover:text-[#0d6efd] transition-colors">Fitur</a>
            <a href="#stats" class="text-[10px] font-black uppercase tracking-[0.2em] hover:text-[#0d6efd] transition-colors">Statistik</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/admin/dashboard') }}" class="btn-primary px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest">Buka Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] hover:text-[#0d6efd] transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-white">Daftar Akun</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="relative min-h-screen flex items-center justify-center pt-24 hero-gradient">
        <div class="container mx-auto px-6 md:px-16 text-center relative z-10">
            <div class="inline-block px-4 py-1.5 bg-blue-50 border border-blue-100 rounded-full mb-10">
                <span class="text-[#0d6efd] text-[9px] font-black uppercase tracking-[0.4em]">Perpustakaan Terintegrasi</span>
            </div>

            <h1 class="text-5xl md:text-8xl font-extrabold tracking-tighter mb-8 leading-[0.9] text-gray-900">
                Digitalisasi <br> <span class="text-[#0d6efd]">Literasi Masa Depan.</span>
            </h1>

            <p class="text-gray-500 text-base md:text-lg max-w-2xl mx-auto mb-12 font-medium leading-relaxed">
                Platform manajemen perpustakaan digital yang dirancang untuk efisiensi tinggi, pencatatan audit yang akurat, dan pengalaman pengguna yang luar biasa.
            </p>

            <div class="flex flex-col md:flex-row items-center justify-center gap-5">
                <a href="{{ route('register') }}" class="btn-primary w-full md:w-auto px-12 py-5 rounded-[2rem] font-black uppercase tracking-[0.2em] text-[11px]">
                    Mulai Eksplorasi
                </a>
                <a href="#features" class="w-full md:w-auto px-12 py-5 rounded-[2rem] border border-gray-200 text-gray-400 font-black uppercase tracking-[0.2em] text-[11px] hover:bg-gray-50 hover:text-[#0d6efd] transition-all">
                    Pelajari Fitur
                </a>
            </div>
        </div>

        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
             style="background-image: radial-gradient(#0d6efd 0.5px, transparent 0.5px); background-size: 50px 50px;">
        </div>
    </main>

    <section id="stats" class="py-20 bg-white border-y border-gray-50 reveal">
        <div class="container mx-auto px-6 md:px-16 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <h3 class="text-4xl font-black text-gray-900 mb-2 tracking-tighter">{{ $totalBuku }}</h3>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Koleksi Buku</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl font-black text-[#0d6efd] mb-2 tracking-tighter">{{ $totalAnggota }}</h3>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Siswa Terdaftar</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl font-black text-gray-900 mb-2 tracking-tighter">{{ $totalPinjaman }}</h3>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Peminjaman</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl font-black text-[#0d6efd] mb-2 tracking-tighter">99.9%</h3>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sistem Online</p>
            </div>
        </div>
    </section>

    <section id="features" class="py-32 px-6 md:px-16 bg-[#fcfdfe] relative overflow-hidden">
        <div class="container mx-auto">
            <div class="mb-20 reveal">
                <h2 class="text-3xl font-black tracking-tighter mb-4 uppercase text-gray-900">Fitur <span class="text-[#0d6efd]"> Unggulan</span></h2>
                <div class="h-1 w-20 bg-[#0d6efd] rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="card-glass p-12 rounded-[3rem] group text-gray-900 reveal">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-[#0d6efd] mb-8 group-hover:bg-[#0d6efd] group-hover:text-white transition-all duration-500 shadow-sm">
                        <i class="fa-solid fa-layer-group text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Kategorisasi Dinamis</h4>
                    <p class="text-gray-400 text-sm leading-relaxed font-medium">Pengelompokan buku berdasarkan genre, tahun, dan tipe data yang dapat diatur oleh admin secara mudah.</p>
                </div>

                <div class="card-glass p-12 rounded-[3rem] group text-gray-900 reveal">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-[#0d6efd] mb-8 group-hover:bg-[#0d6efd] group-hover:text-white transition-all duration-500 shadow-sm">
                        <i class="fa-solid fa-fingerprint text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Pelacakan Audit</h4>
                    <p class="text-gray-400 text-sm leading-relaxed font-medium">Setiap transaksi peminjaman terekam otomatis dalam log aktivitas untuk menjamin keamanan data.</p>
                </div>

                <div class="card-glass p-12 rounded-[3rem] group text-gray-900 reveal">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-[#0d6efd] mb-8 group-hover:bg-[#0d6efd] group-hover:text-white transition-all duration-500 shadow-sm">
                        <i class="fa-solid fa-microchip text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Analisis Dashboard</h4>
                    <p class="text-gray-400 text-sm leading-relaxed font-medium">Visualisasi statistik perpustakaan secara real-time untuk memudahkan pengambilan keputusan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-32 px-6 md:px-16 bg-white reveal">
        <div class="container mx-auto max-w-5xl bg-blue-50 p-12 md:p-20 rounded-[4rem] text-center border border-blue-100">
            <h2 class="text-4xl md:text-6xl font-black tracking-tighter mb-10 text-gray-900 uppercase">Siap Untuk Mentransformasi Perpustakaan?</h2>
            <p class="text-gray-500 mb-12 max-w-xl mx-auto font-medium leading-relaxed">Daftarkan instansi Anda dan mulai kelola ribuan buku dengan sistem yang lebih cerdas dan modern.</p>
            <div class="flex justify-center gap-6">
                <a href="{{ route('register') }}" class="btn-primary px-12 py-5 rounded-[2rem] text-[11px] font-black uppercase tracking-[0.2em]">Buat Akun Sekarang</a>
            </div>
        </div>
    </section>

    <footer class="py-20 px-6 md:px-16 border-t border-gray-100 text-gray-400">
        <div class="container mx-auto flex flex-col md:row justify-between items-center gap-10">
            <div class="flex items-center gap-4 text-gray-900">
                <img src="{{ asset('storage/logos/libera.png') }}" class="w-10 h-10 object-contain grayscale opacity-30">
                <span class="text-lg font-black tracking-tighter opacity-30 uppercase">Libera Digital</span>
            </div>
            <p class="text-gray-400 text-[9px] font-black uppercase tracking-[0.5em] text-center">
                &copy; 2026 Libera Library System. Dibuat untuk Pendidikan Modern.
            </p>
        </div>
    </footer>

    <script>
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);
        document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
    </script>

</body>
</html>
