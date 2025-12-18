<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun | FORMAPAS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f8e1ca] min-h-screen px-4 py-10 sm:py-16">
    <div class="max-w-3xl mx-auto">
    <!-- CARD -->
        <div class="bg-white rounded-2xl shadow-2xl px-5 sm:px-8 py-6 sm:py-8 transition-all duration-300">
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <h2 class="text-2xl font-bold text-[#db5400]">
                Pengaturan Akun
            </h2>
            <a href="{{ route('home') }}" class="text-[#ff8800] flex items-center gap-2">
                <i class="fa-solid fa-x"></i> Kembali
            </a>
        </div>
        <hr class="border-t-4 border-[#FF7A00] w-50 mx-auto mb-2">
        <div class="w-50 h-1 bg-[#FF7A00]/50 mx-auto mb-6"></div>
            <!-- INFO USER -->
        <div class="p-6 rounded-xl text-[#FF7A00] bg-[#f8e1ca] border border-orange-200">
            <h3 class="text-2xl font-extrabold mb-6">Detail Pengguna</h3>

            <div class="grid grid-cols-2 gap-x-6 gap-y-3">            
                <div class="col-span-1">
                    <p class="text-sm text-black">Nama</p>
                    <p class="font-bold text-lg break-words leading-tight">
                        {{ Auth::user()->USER_NAME }}
                    </p>
                    @if(Auth::user()->MBTI_RESULT)
                        <span class="w-fit px-3 py-0.5 mt-1 rounded-full text-xs font-semibold 
                                    bg-orange-100 text-[#db5400] inline-block shadow-sm">
                            {{ Auth::user()->MBTI_RESULT }}
                        </span>
                    @endif
                </div>
                <div class="col-span-1">
                    <p class="text-sm text-black">NIK</p>
                    <p class="font-semibold break-words">
                        {{ Auth::user()->NIK }}
                    </p>
                </div>
                <div class="col-span-1 mt-4"> </div>
                <div class="col-span-1">
                    <p class="text-sm text-black">Email</p>
                    <p class="font-semibold break-words">
                        {{ Auth::user()->USER_EMAIL }}
                    </p>
                </div>
            </div>
        </div>
        <div class="mb-5"></div>
        <!-- UBAH PASSWORD -->
        <button onclick="toggleSection('passwordForm')"
            class="text-[#db5400] font-semibold hover:underline mb-3">
            Ubah Password
        </button>

        <form id="passwordForm"
            method="POST"
            action="{{ route('user.update.pw') }}"
            class="hidden space-y-4 mb-8">
            @csrf
            @method('PUT')

            <input type="password" name="old_password"
                placeholder="Password Lama"
                class="w-full bg-gray-100 rounded-xl px-4 py-3
                focus:outline-none focus:ring-2 focus:ring-[#db5400]/50">

            <input type="password" name="new_password"
                placeholder="Password Baru"
                class="w-full bg-gray-100 rounded-xl px-4 py-3
                focus:outline-none focus:ring-2 focus:ring-[#db5400]/50">

            <input type="password" name="new_password_confirmation"
                placeholder="Ulangi Password Baru"
                class="w-full bg-gray-100 rounded-xl px-4 py-3
                focus:outline-none focus:ring-2 focus:ring-[#db5400]/50">

            <button type="submit"
                class="w-full py-3 rounded-full font-semibold text-white
                bg-gradient-to-r from-[#ff9336] to-[#db5400]
                shadow-lg hover:scale-[1.02] transition">
                Simpan Password
            </button>
        </form>

        <!-- UBAH EMAIL -->
            <br>
        <button onclick="toggleSection('emailForm')"
            class="text-[#db5400] font-semibold hover:underline mb-3">
            Ubah Email
        </button>

        <form id="emailForm"
            action="{{ route('user.update.email') }}"
            method="POST"
            class="hidden space-y-4 mb-8">
            @csrf

            <input type="email" name="USER_EMAIL"
                placeholder="Email Baru"
                class="w-full bg-gray-100 rounded-xl px-4 py-3
                focus:outline-none focus:ring-2 focus:ring-[#db5400]/50">

            <button
                class="w-full py-3 rounded-full font-semibold text-white
                bg-gradient-to-r from-[#ff9336] to-[#db5400]
                shadow-lg hover:scale-[1.02] transition">
                Simpan Email
            </button>
        </form>

        <!-- CUSTOMER SERVICE -->
        <a href="https://wa.me/628XXXXXXXXX?text=Halo%20Admin,%20saya%20{{ Auth::user()->USER_NAME }}%20ingin%20bertanya."
            target="_blank"
            class="block text-center text-green-600 font-semibold hover:underline mb-6">
            Hubungi Customer Service
        </a>

        <!-- HAPUS AKUN -->
        <form action="{{ route('user.delete') }}" method="POST"
            onsubmit="return confirm('Yakin ingin menghapus akun? Data tidak bisa dikembalikan.')">
            @csrf
            @method('DELETE')

            <button
                class="w-full py-3 rounded-full border border-red-500 text-red-600
                font-semibold hover:bg-red-50 transition">
                Hapus Akun Permanen
            </button>
        </form>
        </div>
    </div>

<script>
    function toggleSection(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>

</body>
</html>
