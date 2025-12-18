<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengurus | FORMAPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-[#FFF4E6]">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-[#db5400] mb-6">Tambah Pengurus Baru</h2>
        
        <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jabatan</label>
                <input type="text" name="position" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Departemen</label>
                <select name="department" class="w-full border rounded-lg px-3 py-2">
                    <option value="bph">BPH</option>
                    <option value="sosling">SOSLING</option>
                    <option value="huminfo">HUMINFO</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Foto</label>
                <input type="file" name="image" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="bg-[#db5400] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#b04300]">Simpan</button>
                <a href="{{ route('admin.pengurus.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-bold">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>