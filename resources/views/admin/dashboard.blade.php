<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | FORMAPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="p-6 bg-[#FFF4E6]">

    <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl shadow-sm">
        <div>
            <h1 class="text-3xl font-extrabold text-[#db5400]">DASHBOARD ADMIN</h1>
            <p class="text-gray-500">
                Selamat datang, {{ $admin->ADMIN_NAME }}!
            </p>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('admin.pengurus.index') }}" 
               class="bg-[#db5400] text-white px-4 py-2 rounded-lg font-bold hover:bg-[#b04300] transition shadow-md flex items-center gap-2">
                <i class="fa-solid fa-users-gear"></i> Kelola Pengurus
            </a>
            <div class="h-8 w-[1px] bg-gray-300 mx-2"></div>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-600 font-semibold hover:text-red-800 transition flex items-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    @endif
    

    <div class="mb-10 bg-white p-6 rounded-2xl shadow-sm border-l-4 border-[#db5400]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-[#db5400]">
                <i class="fa-solid fa-cart-shopping mr-2"></i> PESANAN MASUK
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-orange-100">
                    <tr>
                        <th class="px-4 py-3">ID Transaksi</th>
                        <th class="px-4 py-3">Pemesan</th>
                        <th class="px-4 py-3">Total Bayar</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-bold text-gray-900">{{ $order->trx_id }}</td>
                        <td class="px-4 py-3">
                            <div class="font-semibold">{{ $order->nama_penerima }}</div>
                            <div class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-4 py-3 text-orange-600 font-bold">
                            Rp {{ number_format($order->total_bayar, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-center flex justify-center gap-2">
                            <form action="{{ route('admin.orders.approve', $order->trx_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded hover:bg-green-600 transition flex items-center gap-1">
                                    <i class="fa-solid fa-check"></i> Kirim
                                </button>
                            </form>

                            <button onclick="tolakPesanan('{{ $order->trx_id }}')" 
                                    class="bg-red-500 text-white px-3 py-1.5 rounded hover:bg-red-600 transition flex items-center gap-1">
                                <i class="fa-solid fa-xmark"></i> Tolak
                            </button>

                            <form id="form-tolak-{{ $order->trx_id }}" 
                                  action="{{ route('admin.orders.reject', $order->trx_id) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="alasan" id="alasan-{{ $order->trx_id }}">
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400 italic">
                            Tidak ada pesanan baru yang menunggu konfirmasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div class="mb-10 bg-white p-6 rounded-2xl shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-[#db5400]">
                Pendaftar KKN Terbaru
            </h2>
            <form method="GET">
                <select name="status" onchange="this.form.submit()" class="border rounded px-3 py-1 text-sm bg-gray-50 cursor-pointer">
                    <option value="menunggu" {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diterima" {{ $status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </form>
        </div>

        <div class="max-h-[400px] overflow-y-auto border rounded-lg">
            <table class="w-full text-sm">
                <thead class="sticky top-0 bg-orange-100 z-10">
                    <tr>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Universitas</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftar as $p)
                        <tr class="border-b hover:bg-orange-50 transition">
                            <td class="p-3">{{ $p->nama_lengkap }}</td>
                            <td class="p-3">{{ $p->universitas }}</td>
                            <td class="p-3 text-center font-bold">
                                @if($p->status === 'menunggu')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">MENUNGGU</span>
                                @elseif($p->status === 'diterima')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">DITERIMA</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">DITOLAK</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if($p->status === 'menunggu')
                                    <div class="flex justify-center gap-1">
                                        <form method="POST" action="{{ route('admin.kkn.approve', $p->id) }}">
                                            @csrf
                                            <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">Setuju</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.kkn.reject', $p->id) }}">
                                            @csrf
                                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Tolak</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-8 text-gray-400">Belum ada pendaftar KKN untuk status ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> 

    <div class="mt-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Verifikasi Seleksi Pengurus</h2>
                <p class="text-sm text-gray-500">Daftar pendaftar yang menunggu persetujuan</p>
            </div>
            <div class="relative">
                <select class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md bg-gray-50 text-gray-700">
                    <option>Semua Tahapan</option>
                    <option>Tahap 1 (Berkas)</option>
                    <option>Tahap 2 (Essay)</option>
                    <option>Final</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 text-sm border-b border-gray-100">
                        <th class="py-3 font-semibold">Nama Pendaftar</th>
                        <th class="py-3 font-semibold">Status Saat Ini</th>
                        <th class="py-3 font-semibold">Data Masuk</th>
                        <th class="py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse($seleksi_pending as $s)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4">
                            <div class="font-bold text-gray-800">{{ $s->nama_lengkap ?? $s->user->USER_NAME }}</div>
                            <div class="text-xs text-gray-500">NIK: {{ $s->nik }}</div>
                        </td>
                        <td class="py-4">
                            @if($s->status_tahap_1 == 'menunggu')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700">
                                    Menunggu Tahap 1
                                </span>
                            @elseif($s->status_tahap_2 == 'menunggu')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                    Menunggu Tahap 2
                                </span>
                            @elseif($s->sudah_wawancara && $s->status_final == 'menunggu')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">
                                    Menunggu Final
                                </span>
                            @endif
                        </td>
                        <td class="py-4">
                            @if($s->status_tahap_1 == 'menunggu')
                                <span class="text-gray-600">Berkas Administrasi</span>
                            @elseif($s->status_tahap_2 == 'menunggu')
                                <div class="text-gray-600 truncate max-w-xs" title="{{ $s->judul_essay }}">
                                    Essay: "{{ $s->judul_essay }}"
                                </div>
                            @else
                                <span class="text-gray-600">Sudah Wawancara</span>
                            @endif
                        </td>
                        <td class="py-4 flex justify-center gap-2">
                            <form action="{{ route('admin.seleksi.update', $s->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="keputusan" value="lolos">
                                <button type="submit" class="w-8 h-8 rounded-full bg-green-100 text-green-600 hover:bg-green-600 hover:text-white flex items-center justify-center transition" title="Loloskan">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.seleksi.update', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak peserta ini?');">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="keputusan" value="gagal">
                                <button type="submit" class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-600 hover:text-white flex items-center justify-center transition" title="Tolak / Gagal">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-400">
                            <i class="fa-solid fa-clipboard-check text-4xl mb-3"></i><br>
                            Tidak ada pendaftar yang perlu diverifikasi saat ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-10"></div>

    <!-- NEWS, FORMAPALS, MERCH -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col border-t-4 border-blue-500">
            <div class="p-6 flex justify-between items-center bg-blue-50">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fa-solid fa-newspaper mr-2"></i> NEWS
                </h2>
                <a href="{{ route('news.index') }}"
                class="bg-blue-600 text-white px-4 py-1 rounded text-sm font-bold hover:bg-blue-700 shadow-md">
                    Kelola News →
                </a>
            </div>
            <div class="p-4 flex-1">
                <ul class="space-y-3">
                    @forelse($latestNews as $n)
                        <li class="border-b pb-2 text-sm text-gray-700 truncate">
                            <span class="text-blue-500 font-bold mr-2">•</span>
                            {{ $n->JUDUL_NEWS }}
                            <div class="text-xs text-gray-400 ml-4">{{ $n->created_at }}</div>
                        </li>
                    @empty
                        <li class="text-gray-400 text-sm">Tidak ada data.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col border-t-4 border-[#db5400]">
            <div class="p-6 flex justify-between items-center bg-orange-50">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fa-solid fa-users mr-2"></i> FORMAPALS
                </h2>
                <a href="{{ route('formapals') }}" class="bg-[#db5400] text-white px-4 py-1 rounded text-sm font-bold hover:bg-[#b04300] shadow-md">
                    Cek User →
                </a>
            </div>
            <div class="p-4 flex-1">
                <ul class="space-y-3">
                    @forelse($latestUsers as $u)
                        <li class="border-b pb-2 text-sm text-gray-700">
                            <span class="text-orange-500 font-bold mr-2">•</span> {{ $u->USER_NAME }}
                            <div class="text-xs text-gray-400 ml-4">{{ $u->USER_EMAIL }}</div>
                        </li>
                    @empty
                        <li class="text-gray-400 text-sm">Tidak ada data.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col border-t-4 border-green-500">
            <div class="p-6 flex justify-between items-center bg-green-50">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fa-solid fa-shirt mr-2"></i> MERCH
                </h2>
                <a href="{{ route('admin.merch') }}" class="bg-green-600 text-white px-4 py-1 rounded text-sm font-bold hover:bg-green-700 shadow-md">
                    Edit Merch →
                </a>
            </div>
            <div class="p-4 flex-1">
                <ul class="space-y-3">
                    @forelse($latestMerch as $m)
                        <li class="border-b pb-2 text-sm text-gray-700 flex justify-between">
                            <div class="truncate w-2/3">
                                <span class="text-green-500 font-bold mr-2">•</span> {{ $m->NAMA_PRODUCT }}
                            </div>
                            <span class="text-xs font-bold text-green-700">Rp {{ number_format($m->HARGA_PRODUCT,0,',','.') }}</span>
                        </li>
                    @empty
                        <li class="text-gray-400 text-sm">Tidak ada data.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

    <script>
        function tolakPesanan(trxId) {
            // 1. Munculkan Prompt (Kotak isian)
            let alasan = prompt("Mengapa pesanan ini ditolak? (Wajib diisi)");

            // 2. Cek apakah admin mengisi atau membatalkan
            if (alasan != null && alasan.trim() !== "") {
                // 3. Masukkan alasan ke form tersembunyi
                document.getElementById('alasan-' + trxId).value = alasan;
                
                // 4. Submit formnya
                document.getElementById('form-tolak-' + trxId).submit();
            } else if (alasan === "") {
                alert("Alasan penolakan tidak boleh kosong!");
            }
        }
    </script>

</body>
</html>
