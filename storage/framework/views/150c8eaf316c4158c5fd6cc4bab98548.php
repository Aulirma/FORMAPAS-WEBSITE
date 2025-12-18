<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>News</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="flex items-left gap-2 mb-6">
        <a 
            href="<?php echo e(route('admin.dashboard')); ?>" 
            class="px-4 py-2 hover:text-orange-700 text-orange-400 font-semibold rounded-lg shadow">
            ← Kembali ke Dashboard
        </a>    
        <h1 class="text-3xl font-bold text-[#FF7A00]">Manajemen Berita</h1>
    </div>

    <!-- Button Open Modal -->
    <button onclick="openCreateModal()"
            class="px-4 py-2 bg-blue-600 text-white rounded">
        + Tambah Berita
    </button>

    <!-- Table -->
    <div class="mt-6 bg-white shadow rounded p-4">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left">Judul</th>
                    <th class="p-2 text-left">Isi</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-2"><?php echo e($n->JUDUL_NEWS); ?></td>
                    <td class="p-2"><?php echo e(Str::limit($n->ISI_NEWS, 50)); ?></td>
                    <td class="p-2 flex gap-2">

                        <!-- BUTTON EDIT -->
                        <button
                            onclick="openEditModal('<?php echo e($n->NO_NEWS); ?>', '<?php echo e($n->JUDUL_NEWS); ?>', `<?php echo e($n->ISI_NEWS); ?>`)"
                            class="px-3 py-1 bg-yellow-500 text-white rounded">
                            Edit
                        </button>

                        <!-- BUTTON DELETE -->
                        <form action="<?php echo e(route('news.destroy',$n->NO_NEWS)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="px-3 py-1 bg-red-600 text-white rounded">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>


    <!-- ===================== -->
    <!-- CREATE MODAL -->
    <!-- ===================== -->
    <div id="createModal" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center">
        <div class="bg-white p-6 rounded w-96">

            <h2 class="text-xl font-bold mb-4">Tambah Berita</h2>

            <form action="<?php echo e(route('news.create')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-1">Foto Berita</label>
                    <input type="file" name="FOTO_NEWS"
                        class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-orange-400">
                </div>
                <label class="block mb-2">Judul</label>
                <input name="JUDUL_NEWS" class="w-full border p-2 rounded mb-4">
                <label class="block mb-2">Lokasi Berita Dibuat</label>
                <input name="LOKASI_NEWS" class="w-full border p-2 rounded mb-4">

                <label class="block mb-5">Isi</label>
                <textarea name="ISI_NEWS" class="w-full border p-2 rounded mb-4"></textarea>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeCreateModal()" class="px-3 py-1 bg-gray-500 text-white rounded">Batal</button>
                    <button class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
                </div>

            </form>
        </div>
    </div>


    <!-- ===================== -->
    <!-- EDIT MODAL -->
    <!-- ===================== -->
    <div id="editModal" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center">
        <div class="bg-white p-6 rounded w-96">

            <h2 class="text-xl font-bold mb-4">Edit Berita</h2>

            <form id="editForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <label class="block mb-2">Judul</label>
                <input id="editTitle" name="JUDUL_NEWS" class="w-full border p-2 rounded mb-4">

                <label class="block mb-2">Isi</label>
                <textarea id="editContent" name="ISI_NEWS" class="w-full border p-2 rounded mb-4"></textarea>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="px-3 py-1 bg-gray-500 text-white rounded">Batal</button>
                    <button class="px-3 py-1 bg-yellow-600 text-white rounded">Update</button>
                </div>

            </form>
        </div>
    </div>

    <!-- JS -->
<script>
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }
    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    function openEditModal(id, title, content) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editTitle').value = title;
        document.getElementById('editContent').value = content;
        document.getElementById('editForm').action = "/admin/news/" + id; // sesuai route
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

</body>
</html>
<?php /**PATH C:\laragon\www\UAS\resources\views/admin/news.blade.php ENDPATH**/ ?>