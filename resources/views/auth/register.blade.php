<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Libera</title>
    <link rel="icon" href="{{ asset('storage/images/favicon-96x96.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif !important; }
    </style>
</head>
<body class="bg-[#f3f4f6] antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center py-10 px-6">

        <div class="w-full sm:max-w-md bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-[2.5rem] border border-gray-100 p-8 md:p-10">

            <div class="flex justify-center mb-8">
                <a href="/">
                    <img src="{{ asset('storage/logos/libera.png') }}" class="w-20 h-20 object-contain">
                </a>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block font-bold text-[10px] text-gray-400 uppercase tracking-[0.2em] mb-1.5 ml-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full border-gray-100 bg-gray-50 rounded-xl py-3 px-4 font-bold text-sm outline-none focus:border-[#0d6efd] border transition-all">
                        @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-[10px] text-gray-400 uppercase tracking-[0.2em] mb-1.5 ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border-gray-100 bg-gray-50 rounded-xl py-3 px-4 font-bold text-sm outline-none focus:border-[#0d6efd] border transition-all">
                        @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block font-bold text-[10px] text-gray-400 uppercase tracking-[0.2em] mb-1.5 ml-1">Password</label>
                            <input type="password" name="password" required
                                class="w-full border-gray-100 bg-gray-50 rounded-xl py-3 px-4 font-bold text-sm outline-none focus:border-[#0d6efd] border transition-all">
                        </div>
                        <div>
                            <label class="block font-bold text-[10px] text-gray-400 uppercase tracking-[0.2em] mb-1.5 ml-1">Confirm</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full border-gray-100 bg-gray-50 rounded-xl py-3 px-4 font-bold text-sm outline-none focus:border-[#0d6efd] border transition-all">
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-[#0d6efd] hover:bg-blue-700 text-white font-black uppercase tracking-[0.2em] text-[11px] py-4 rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-95">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-50 text-center">
                <a class="text-[10px] font-black text-gray-400 hover:text-[#0d6efd] transition-colors uppercase tracking-widest" href="{{ route('login') }}">
                    Sudah punya akun? Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
