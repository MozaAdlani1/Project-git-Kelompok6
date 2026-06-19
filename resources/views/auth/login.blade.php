<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Klinik Kampus UIN STS Jambi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans min-h-screen flex items-center justify-center p-4">

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden max-w-4xl w-full flex flex-col md:flex-row">
        
        <div class="md:w-1/2 bg-gradient-to-br from-blue-900 to-indigo-950 p-8 text-white flex flex-col justify-between items-center text-center">
            <div class="flex flex-col items-center gap-3 my-auto">
                <!-- Bagian Logo -->
            <div class="flex items-center justify-center mb-4">
                     <img src="{{ asset('image/OIP.jpeg') }}" alt="Logo UIN" class="w-20 h-20 object-contain">
            </div>
                <h1 class="text-2xl font-bold tracking-wide uppercase">Klinik Kampus<br>UIN STS Jambi</h1>
                <p class="text-sm text-indigo-200 max-w-xs mt-2">
                    Sistem Informasi Klinik Kampus Terintegrasi Edisi 2026
                </p>
            </div>
            
           <div class="w-full h-48 overflow-hidden rounded-xl border border-white/10 mt-6 shadow-lg">
                <img src="{{ asset('images/WhatsApp-Image-2024-07-26-at-15.14.25-1.jpeg') }}" 
                    alt="Gedung UIN STS Jambi" 
                     class="w-full h-full object-cover brightness-105 contrast-110 saturate-125">
            </div>
        </div>

        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-slate-800">Selamat Datang</h2>
                <p class="text-sm text-slate-500 mt-1">Silakan masuk ke akun Anda untuk mengakses sistem.</p>
            </div>

            {{-- Pesan error login --}}
            @if ($errors->has('login'))
                <div class="mb-4 p-3.5 bg-red-50 border border-red-200 text-red-700 text-xs rounded-lg font-medium">
                    {{ $errors->first('login') }}
                </div>
            @endif

            {{-- Pesan error validasi --}}
            @if ($errors->has('username') || $errors->has('password'))
                <div class="mb-4 p-3.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs rounded-lg font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/login" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition" 
                        placeholder="Masukkan username" required>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-sm font-medium text-slate-700">Password</label>
                        <a href="#" class="text-xs text-blue-600 hover:underline">Lupa Password?</a>
                    </div>
                    <input type="password" name="password" 
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition" 
                        placeholder="Masukkan password" required>
                </div>

                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 rounded-lg transition duration-200 shadow-md shadow-blue-200 mt-2">
                    Login
                </button>
            </form>

            <div class="mt-12 text-center text-xs text-slate-400">
                &copy; 2026 Klinik Kampus UIN STS Jambi
            </div>
        </div>

    </div>

</body>
</html>