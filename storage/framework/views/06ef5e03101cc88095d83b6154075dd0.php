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
          <a href="<?php echo e(route('toko')); ?>" class="text-sm text-orange-600 hover:underline">Belanja Lagi &rarr;</a>
      </div>
    <a href="<?php echo e(route('home')); ?>" class="text-[#ff8800] flex items-center gap-2">
        ← Kembali ke beranda
    </a>

      <p class="text-gray-600 mb-6">
          Hi, <strong><?php echo e(Auth::user()->USER_NAME); ?></strong>! Berikut adalah riwayat pesananmu.
      </p>

      <?php if($history->isEmpty()): ?>
          
          <div class="mt-4 p-8 bg-blue-50 border-l-4 border-blue-500 rounded-lg text-center">
              <p class="text-blue-700 font-semibold">Kamu belum memiliki riwayat pembelian.</p>
              <a href="<?php echo e(route('toko')); ?>" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                  Mulai Belanja
              </a>
          </div>
      <?php else: ?>
          
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
                      <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr class="bg-white border-b hover:bg-orange-50 transition">
                          
                          <td class="px-6 py-4">
                              <div class="font-bold text-gray-900">
                                  <?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d M Y')); ?>

                              </div>
                              <div class="text-xs">
                                  <?php echo e(\Carbon\Carbon::parse($item->created_at)->format('H:i')); ?> WIB
                              </div>
                              <div class="text-[10px] text-gray-400 mt-1">
                                  <?php echo e($item->trx_id); ?>

                              </div>
                          </td>

                          
                          <td class="px-6 py-4">
                              <div class="flex items-center gap-3">
                                  
                                  <?php if($item->ID_PRODUCT >= 101 && $item->ID_PRODUCT <= 120): ?>
                                      
                                      <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-xs font-bold">
                                          IMG
                                      </div>
                                  <?php else: ?>
                                      <img src="<?php echo e(asset('storage/'.$item->FOTO_PRODUCT)); ?>" class="w-10 h-10 rounded-md object-cover border">
                                  <?php endif; ?>
                                  
                                  <span class="font-medium text-gray-900"><?php echo e($item->NAMA_PRODUCT); ?></span>
                              </div>
                          </td>

                          
                          <td class="px-6 py-4 text-center font-bold text-gray-700">
                              x<?php echo e($item->qty); ?>

                          </td>

                          
                          <td class="px-6 py-4 font-bold text-orange-600">
                              Rp <?php echo e(number_format($item->total_harga, 0, ',', '.')); ?>

                          </td>

                          
                          <td class="px-6 py-4 text-center">
                              <?php if($item->status == 'MENUNGGU'): ?>
                                  <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full border border-yellow-200">
                                      ⏳ Menunggu
                                  </span>
                              <?php elseif($item->status == 'SIAP_KIRIM' || $item->status == 'DISETUJUI'): ?>
                                  <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                                      📦 Siap Kirim
                                  </span>
                              <?php elseif($item->status == 'SELESAI'): ?>
                                  <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full border border-green-200">
                                      ✅ Selesai
                                  </span>
                              <?php else: ?>
                                  <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full border border-red-200">
                                      <?php echo e($item->status); ?>

                                  </span>
                              <?php endif; ?>
                          </td>

                          
                          <td class="px-6 py-4 text-xs">
                              <?php echo e(\Carbon\Carbon::parse($item->updated_at)->diffForHumans()); ?>

                          </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
              </table>
          </div>
      <?php endif; ?>
  </div>

  <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

</body>
</html><?php /**PATH C:\laragon\www\UAS\resources\views/user/merch.blade.php ENDPATH**/ ?>