<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Pembelian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFF4E6]">

  <div class="max-w-5xl mx-auto mt-28 mb-20 p-6 bg-white rounded-xl shadow-lg border border-orange-100">
      <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-[#db5400]">📦 Status Pembelian Merchandise </h2>
          <a href="{{ route('toko') }}" class="text-sm text-orange-600 hover:underline">Belanja Lagi &rarr;</a>
      </div>
    <a href="{{ route('home') }}" class="text-[#ff8800] flex items-center gap-2">
        ← Kembali ke beranda
    </a>

      <p class="text-gray-600 mb-6">
          Hi, <strong>{{ Auth::user()->USER_NAME }}</strong>! Berikut adalah riwayat pesananmu.
      </p>

      @if($history->isEmpty())
          {{-- TAMPILAN JIKA BELUM PERNAH BELI --}}
          <div class="mt-4 p-8 bg-blue-50 border-l-4 border-blue-500 rounded-lg text-center">
              <p class="text-blue-700 font-semibold">Kamu belum memiliki riwayat pembelian.</p>
              <a href="{{ route('toko') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                  Mulai Belanja
              </a>
          </div>
      @else
          {{-- TABEL DATA --}}
          <div class="overflow-x-auto rounded-lg border border-gray-200">
              <table class="w-full text-sm text-left text-gray-500">
                  <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                      <tr>
                          <th class="px-6 py-3">Tanggal Beli</th>
                          <th class="px-6 py-3">Produk</th>
                          <th class="px-6 py-3 text-center">Qty</th>
                          <th class="px-6 py-3">Total Harga</th>
                          <th class="px-6 py-3 text-center">Status</th>
                          <th class="px-6 py-3">Terakhir Update</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($history as $item)
                      <tr class="bg-white border-b hover:bg-orange-50 transition">
                          {{-- 1. Tanggal Beli --}}
                          <td class="px-6 py-4">
                              <div class="font-bold text-gray-900">
                                  {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                              </div>
                              <div class="text-xs">
                                  {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB
                              </div>
                              <div class="text-[10px] text-gray-400 mt-1">
                                  {{ $item->trx_id }}
                              </div>
                          </td>

                          {{-- 2. Produk (Gambar + Nama) --}}
                          <td class="px-6 py-4">
                              <div class="flex items-center gap-3">
                                  {{-- Cek apakah gambar dari DB (storage) atau hardcode JS (images) --}}
                                  @if($item->ID_PRODUCT >= 101 && $item->ID_PRODUCT <= 120)
                                      {{-- Logic khusus data Hardcode JS (Opsional, sesuaikan nama file kamu) --}}
                                      <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-xs font-bold">
                                          IMG
                                      </div>
                                  @else
                                      <img src="{{ asset('storage/'.$item->FOTO_PRODUCT) }}" class="w-10 h-10 rounded-md object-cover border">
                                  @endif
                                  
                                  <span class="font-medium text-gray-900">{{ $item->NAMA_PRODUCT }}</span>
                              </div>
                          </td>

                          {{-- 3. Qty --}}
                          <td class="px-6 py-4 text-center font-bold text-gray-700">
                              x{{ $item->qty }}
                          </td>

                          {{-- 4. Total Harga --}}
                          <td class="px-6 py-4 font-bold text-orange-600">
                              Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                          </td>

                          {{-- 5. Status Badge --}}
                          <td class="px-6 py-4 text-center">
                              @if($item->status == 'MENUNGGU')
                                  <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full border border-yellow-200">
                                      ⏳ Menunggu
                                  </span>
                              @elseif($item->status == 'SIAP_KIRIM' || $item->status == 'DISETUJUI')
                                  <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                                      📦 Siap Kirim
                                  </span>
                              @elseif($item->status == 'SELESAI')
                                  <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full border border-green-200">
                                      ✅ Selesai
                                  </span>
                              @else
                                  <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full border border-red-200">
                                      {{ $item->status }}
                                  </span>
                              @endif
                          </td>

                          {{-- 6. Tanggal Update --}}
                          <td class="px-6 py-4 text-xs">
                              {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      @endif
  </div>

  @include('footer') {{-- Asumsi ada footer --}}

</body>
</html>