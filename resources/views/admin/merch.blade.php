<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.dashboard') }}"
       class="text-orange-400 font-semibold hover:text-orange-700">
        ← Kembali ke Dashboard
    </a>
    <h1 class="text-3xl font-bold text-[#FF7A00]">Manajemen Merchandise</h1>
</div>

<!-- BUTTON TAMBAH -->
<button onclick="openCreateModal()"
        class="px-4 py-2 bg-blue-600 text-white rounded">
    + Tambah Product
</button>

<!-- TABLE -->
<div class="mt-6 bg-white shadow rounded p-4">
<table class="w-full">
<thead>
<tr class="border-b">
    <th class="p-2 text-left">Nama</th>
    <th class="p-2 text-left">Kategori</th>
    <th class="p-2 text-left">Harga</th>
    <th class="p-2 text-left">Foto</th>
    <th class="p-2 text-left">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($products as $p)
<tr class="border-b">
    <td class="p-2">{{ $p->NAMA_PRODUCT }}</td>
    <td class="p-2">{{ $p->JENIS_PRODUCT }}</td>
    <td class="p-2">Rp {{ number_format($p->HARGA_PRODUCT,0,',','.') }}</td>
    <td class="p-2">
        <img src="{{ asset('storage/'.$p->FOTO_PRODUCT) }}"
             class="h-12 rounded">
    </td>
    <td class="p-2 flex gap-2">

        <!-- DELETE -->
        <form action="{{ route('admin.merch.delete',$p->ID_PRODUCT) }}"
              method="POST">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1 bg-red-600 text-white rounded">
                Hapus
            </button>
        </form>

    </td>
</tr>
@endforeach
</tbody>
</table>
</div>

<!-- ================= CREATE MODAL ================= -->
<div id="createModal" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center">
<div class="bg-white p-6 rounded w-96">

<h2 class="text-xl font-bold mb-4">Tambah Product</h2>

<form action="{{ route('admin.merch.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label class="block mb-2">Nama Product</label>
<input name="NAMA_PRODUCT" class="w-full border p-2 rounded mb-3">

<label class="block mb-2">Kategori</label>
<select name="JENIS_PRODUCT" class="w-full border p-2 rounded mb-3">
    <option value="Clothing">Clothing</option>
    <option value="Accessories">Accessories</option>
    <option value="Stationery">Stationery</option>
    <option value="Bundling">Bundling</option>
</select>

<label class="block mb-2">Harga</label>
<input type="number" name="HARGA_PRODUCT"
       class="w-full border p-2 rounded mb-3">

<label class="block mb-2">Foto Product</label>
<input type="file" name="FOTO_PRODUCT"
       class="w-full border p-2 rounded mb-4">

<div class="flex justify-end gap-2">
    <button type="button" onclick="closeCreateModal()"
        class="px-3 py-1 bg-gray-500 text-white rounded">Batal</button>
    <button class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
</div>

</form>
</div>
</div>

<script>
function openCreateModal(){ createModal.classList.remove('hidden'); }
function closeCreateModal(){ createModal.classList.add('hidden'); }

function openEditModal(id,nama,jenis,harga){
    editModal.classList.remove('hidden');
    editNama.value = nama;
    editJenis.value = jenis;
    editHarga.value = harga;
    editForm.action = "/admin/merch/" + id;
}
function closeEditModal(){ editModal.classList.add('hidden'); }
</script>

</body>
</html>
