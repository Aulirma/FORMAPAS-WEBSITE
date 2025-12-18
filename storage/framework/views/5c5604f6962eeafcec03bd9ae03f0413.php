<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengurus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10 bg-orange-50">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-orange-600 mb-6">Edit Data Pengurus</h2>

        <form action="<?php echo e(route('admin.pengurus.update', $pengurus->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> <div class="mb-4">
                <label class="block font-bold mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="<?php echo e($pengurus->name); ?>" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">Jabatan</label>
                <input type="text" name="position" value="<?php echo e($pengurus->position); ?>" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">Departemen</label>
                <select name="department" class="w-full border p-2 rounded">
                    <option value="bph" <?php echo e($pengurus->department == 'bph' ? 'selected' : ''); ?>>BPH</option>
                    <option value="sosling" <?php echo e($pengurus->department == 'sosling' ? 'selected' : ''); ?>>SOSLING</option>
                    <option value="huminfo" <?php echo e($pengurus->department == 'huminfo' ? 'selected' : ''); ?>>HUMINFO</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">Foto (Biarkan kosong jika tidak ingin mengganti)</label>
                <div class="mb-2">
                    <img src="<?php echo e(asset('storage/' . $pengurus->image)); ?>" class="w-20 h-20 object-cover rounded shadow">
                </div>
                <input type="file" name="image" class="w-full border p-2 rounded">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block font-bold mb-1 text-sm text-green-600"><i class="fa-brands fa-whatsapp"></i> WhatsApp</label>
                    <input type="text" name="whatsapp" value="<?php echo e($pengurus->whatsapp); ?>" class="w-full border p-2 rounded text-sm">
                </div>
                <div>
                    <label class="block font-bold mb-1 text-sm text-pink-600"><i class="fa-brands fa-instagram"></i> Instagram</label>
                    <input type="text" name="instagram" value="<?php echo e($pengurus->instagram); ?>" class="w-full border p-2 rounded text-sm">
                </div>
                <div>
                    <label class="block font-bold mb-1 text-sm text-blue-600"><i class="fa-solid fa-envelope"></i> Email</label>
                    <input type="email" name="email" value="<?php echo e($pengurus->email); ?>" class="w-full border p-2 rounded text-sm">
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Data</button>
                <a href="<?php echo e(route('admin.pengurus.index')); ?>" class="bg-gray-300 px-6 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\UAS\resources\views/admin/pengurus/edit.blade.php ENDPATH**/ ?>