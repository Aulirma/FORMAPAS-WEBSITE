<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pengurus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="p-10 bg-orange-50">

    <div class="flex items-center gap-3 mb-6">
        <a href="<?php echo e(route('admin.dashboard')); ?>"
        class="text-orange-400 font-semibold hover:text-orange-700">
            ← Kembali ke Dashboard
        </a>
    </div>

    <div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-orange-600">Daftar Pengurus</h1>
            
            <a href="<?php echo e(route('admin.pengurus.create')); ?>" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">
                <i class="fa-solid fa-plus"></i> Tambah Baru
            </a>
        </div>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Foto</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Jabatan</th>
                    <th class="p-3">Dept</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pengurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        <img src="<?php echo e(asset('storage/' . $p->image)); ?>" class="w-12 h-12 rounded-full object-cover border">
                    </td>
                    <td class="p-3 font-bold"><?php echo e($p->name); ?></td>
                    <td class="p-3 text-gray-600"><?php echo e($p->position); ?></td>
                    <td class="p-3">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded uppercase"><?php echo e($p->department); ?></span>
                    </td>
                    <td class="p-3 text-center flex justify-center gap-3">
                        <a href="<?php echo e(route('admin.pengurus.edit', $p->id)); ?>" class="text-blue-500 hover:text-blue-700" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="<?php echo e(route('admin.pengurus.destroy', $p->id)); ?>" method="POST" onsubmit="return confirm('Hapus?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="p-5 text-center text-gray-400">Belum ada data.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\UAS\resources\views/admin/pengurus/index.blade.php ENDPATH**/ ?>