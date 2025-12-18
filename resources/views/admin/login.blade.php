<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | FORMAPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #f8e1ca; font-family: sans-serif; }</style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="relative bg-white p-8 rounded-2xl shadow-xl w-96">
        <a href="{{ route('auth') }}" class="absolute top-4 right-4">
            <i class="fa-solid fa-x text-2xl" style="color:#fa7000;"></i>
        </a>
        <h2 class="text-3xl font-bold text-[#db5400] text-center">Portal Admin</h2>
        <hr class="border-t-4 border-[#FF7A00] w-20 mx-auto mb-2">
        <div class="w-20 h-1 bg-[#FF7A00]/50 mx-auto mb-6"></div>

        {{-- Pesan Error --}}
        @if(session('error'))
            <p class="text-red-500 text-center mb-4 text-sm bg-red-100 p-2 rounded">
                {{ session('error') }}
            </p>
        @endif

        {{-- Pesan Success --}}
        @if(session('success'))
            <p class="text-green-600 text-center mb-4 text-sm bg-green-100 p-2 rounded">
                {{ session('success') }}
            </p>
        @endif

        <!-- =========================
                FORM LOGIN ADMIN
        ========================== -->
        <form action="{{ route('admin.login') }}" method="POST" class="mb-6">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#db5400]"
                       required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#db5400]"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-[#db5400] text-white font-bold py-2 px-4 rounded-lg hover:bg-[#b04300] transition">
                Masuk
            </button>
        </form>

        <hr class="my-6">
    </div>
</body>
</html>
