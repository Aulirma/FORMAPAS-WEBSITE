<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Daftar KKN | FORMAPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#FFF4E6]">
    <a href="<?php echo e(route('home')); ?>" class="fixed top-6 left-6 text-[#ff8800] flex items-center gap-2">
        <i class="fa-solid fa-x"></i> Kembali ke Home
    </a>

    <div class="max-w-3xl mx-auto mt-28 p-6 bg-white rounded-xl shadow-lg">

        <h2 class="text-2xl font-bold mb-2 text-[#db5400]">Status KKN</h2>
        <p class="mb-4">Selamat datang <b><?php echo e(Auth::user()->USER_NAME); ?></b>. <br>Cek kabar persetujuan KKN disini ya ✨</p>

        
        <?php if($pendaftaran): ?>
            <button disabled class="bg-gray-400 px-4 py-2 rounded">
                Sudah Pernah Daftar
            </button>

            <p class="mt-2 text-sm">
                Status: <?php echo e($pendaftaran->status ?? 'Menunggu verifikasi'); ?>

            </p>
        <?php else: ?>
            <div class="p-4 bg-orange-50 border-l-4 border-[#db5400] rounded-lg mb-6">
                <p>Silakan lengkapi data di bawah untuk mendaftar KKN.</p>
            </div>

            <form method="POST" action="<?php echo e(route('user.daftar.submit')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <!-- FOTO -->
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Foto 3x4</label>
                    <input type="file" name="foto" class="w-full border rounded p-2">
                </div>

                <!-- OTOMATIS -->
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" value="<?php echo e(Auth::user()->USER_NAME); ?>" readonly class="w-full bg-gray-100 p-2 rounded">
                </div>

                <div class="mb-3">
                    <label>NIK</label>
                    <input type="text" value="<?php echo e(Auth::user()->NIK); ?>" readonly class="w-full bg-gray-100 p-2 rounded">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" value="<?php echo e(Auth::user()->USER_EMAIL); ?>" readonly class="w-full bg-gray-100 p-2 rounded">
                </div>

                <!-- INPUT -->
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required class="w-full border p-2 rounded">
                </div>

                <div class="mb-3">
                    <label>Universitas</label>
                    <input type="text" name="universitas" required class="w-full border p-2 rounded">
                </div>

                <div class="mb-3">
                    <label>Tahun Masuk</label>
                    <input type="text" name="tahun_masuk" required class="w-full border p-2 rounded">
                </div>

                <div class="mb-4">
                    <label>Tempat, Tanggal Lahir</label>
                    <input type="text" name="ttl" required class="w-full border p-2 rounded">
                </div>

                <button type="submit"
                    class="bg-[#ff7a00] text-white px-6 py-2 rounded-lg font-semibold">
                    Daftar KKN
                </button>
            </form>

        <?php endif; ?>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\UAS\resources\views/user/daftarKKN.blade.php ENDPATH**/ ?>