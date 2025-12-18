<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengurus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10 bg-orange-50">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-orange-600 mb-6">Tambah Pengurus Baru</h2>

        <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block font-bold mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">Jabatan</label>
                <input type="text" name="position" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">Departemen</label>
                <select name="department" class="w-full border p-2 rounded">
                    <option value="bph">BPH</option>
                    <option value="sosling">SOSLING</option>
                    <option value="huminfo">HUMINFO</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">Foto</label>
                <input type="file" name="image" class="w-full border p-2 rounded" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block font-bold mb-1 text-sm text-green-600"><i class="fa-brands fa-whatsapp"></i> WhatsApp (Link)</label>
                    <input type="text" name="whatsapp" placeholder="https://wa.me/628..." class="w-full border p-2 rounded text-sm">
                </div>
                <div>
                    <label class="block font-bold mb-1 text-sm text-pink-600"><i class="fa-brands fa-instagram"></i> Instagram (Link)</label>
                    <input type="text" name="instagram" placeholder="https://instagram.com/..." class="w-full border p-2 rounded text-sm">
                </div>
                <div>
                    <label class="block font-bold mb-1 text-sm text-blue-600"><i class="fa-solid fa-envelope"></i> Email (Alamat)</label>
                    <input type="email" name="email" placeholder="nama@email.com" class="w-full border p-2 rounded text-sm">
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700">Simpan</button>
                <a href="{{ route('admin.pengurus.index') }}" class="bg-gray-300 px-6 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>