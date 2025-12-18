<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Formapals</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFF4E6] min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">
            <a 
                href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-2 text-orange-500 hover:text-orange-700 font-semibold transition">
                <span class="text-xl">←</span>
                <span>Kembali ke Dashboard</span>
            </a>

            <h1 class="text-2xl font-bold text-gray-800">
                Daftar Formapals
            </h1>
        </div>

        <!-- ALERT SUCCESS -->
        @if(session('success'))
            <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow-sm overflow-hidden">
                <thead class="bg-orange-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">NIK</th>
                        <th class="py-3 px-4 text-left">Nama</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">MBTI Result</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($users as $u)
                        <tr class="hover:bg-orange-50 transition">
                            <td class="py-3 px-4">{{ $u->NIK }}</td>
                            <td class="py-3 px-4 font-medium">{{ $u->USER_NAME }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $u->USER_EMAIL }}</td>
                            <td class="py-3 px-4">
                                {{ $u->MBTI_RESULT ?? '-' }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <form 
                                    action="{{ route('formapals.delete', $u->NIK) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit"
                                        class="rounded-lg bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-500">
                                Tidak ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
