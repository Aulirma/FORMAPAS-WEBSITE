<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Alur Seleksi | FORMAPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .modal { transition: opacity 0.3s ease, visibility 0.3s ease; }
        .modal-active { opacity: 1; visibility: visible; }
        .modal-inactive { opacity: 0; visibility: hidden; }
    </style>
</head>
<body class="bg-[#FFF4E6] text-gray-800">
    
    @include('header') {{-- Pastikan header kamu mendukung halaman ini --}}

    <section class="max-w-4xl mx-auto px-6 py-16 pt-24">
        <div class="text-center mb-16">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Seleksi</h1>
            <p class="text-gray-500">Halo, <strong>{{ $user->USER_NAME }}</strong>! Pantau progres seleksimu di sini.</p>
        </div>

        <div class="relative">
            <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gray-200 hidden md:block z-0"></div>

            @php
                // Logika Tampilan: Hijau jika lolos/menunggu, Oranye jika belum
                $s1_done = ($seleksi->status_tahap_1 == 'lolos' || $seleksi->status_tahap_1 == 'menunggu');
                $s1_color = $s1_done ? 'green' : 'orange';
                $s1_icon  = $s1_done ? '<i class="fa-solid fa-check text-green-600 text-xl"></i>' : '<span class="text-white font-bold text-xl">1</span>';
                $s1_bg    = $s1_done ? 'bg-green-100 border-green-200' : 'bg-white border-orange-600';
            @endphp

            <div id="step-1" class="relative flex flex-col md:flex-row gap-8 mb-12">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div class="flex items-center justify-center w-16 h-16 rounded-full {{ $s1_done ? 'bg-green-100' : 'bg-orange-600' }} border-4 border-white shadow-lg transition-all">
                        {!! $s1_icon !!}
                    </div>
                </div>
                <div class="flex-grow {{ $s1_done ? 'bg-white border-green-200' : 'bg-white border-orange-600' }} p-6 rounded-2xl shadow-lg border-l-4 transition-all">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold {{ $s1_done ? 'text-green-700' : 'text-orange-600' }}">Administrasi Berkas</h3>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $s1_done ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                            {{ ucfirst($seleksi->status_tahap_1 ?? 'Belum Mengisi') }}
                        </span>
                    </div>
                    
                    @if($seleksi->status_tahap_1 == 'menunggu')
                        <p class="text-gray-600 text-sm">Data terkirim. Menunggu verifikasi Admin via WhatsApp.</p>
                    @elseif($seleksi->status_tahap_1 == 'lolos')
                        <p class="text-green-600 text-sm">Selamat! Berkas Anda telah diverifikasi.</p>
                    @else
                        <p class="text-gray-600 mb-6 text-sm">Lengkapi data diri dan kirim konfirmasi ke WhatsApp Admin.</p>
                        <button onclick="openModal('modal-administrasi')" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all">
                            Lengkapi Berkas <i class="fa-solid fa-upload ml-2"></i>
                        </button>
                    @endif
                </div>
            </div>

            @php
                // Terbuka HANYA JIKA Tahap 1 'lolos'
                $s2_open = ($seleksi->status_tahap_1 == 'lolos');
                $s2_done = ($seleksi->status_tahap_2 == 'lolos' || $seleksi->status_tahap_2 == 'menunggu');
            @endphp

            <div id="step-2" class="relative flex flex-col md:flex-row gap-8 mb-12 {{ $s2_open ? '' : 'opacity-50 grayscale' }}">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div class="flex items-center justify-center w-16 h-16 rounded-full {{ $s2_done ? 'bg-green-100' : ($s2_open ? 'bg-orange-600' : 'bg-gray-200') }} border-4 border-white shadow-md transition-all">
                        @if($s2_done) <i class="fa-solid fa-check text-green-600 text-xl"></i>
                        @elseif($s2_open) <span class="text-white font-bold text-xl">2</span>
                        @else <i class="fa-solid fa-lock text-gray-500 text-xl"></i> @endif
                    </div>
                </div>
                <div class="flex-grow bg-white p-6 rounded-2xl border-l-4 {{ $s2_done ? 'border-green-200' : ($s2_open ? 'border-orange-600 shadow-lg' : 'border-gray-200 border-dashed') }} transition-all">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold {{ $s2_done ? 'text-green-700' : ($s2_open ? 'text-orange-600' : 'text-gray-600') }}">Penulisan Essay</h3>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-500">
                            {{ ucfirst($seleksi->status_tahap_2) }}
                        </span>
                    </div>
                    
                    @if(!$s2_open)
                        <p class="text-gray-500 text-sm">Selesaikan Tahap 1 untuk membuka tahap ini.</p>
                        <button disabled class="bg-gray-300 text-gray-500 font-semibold py-2 px-6 rounded-lg cursor-not-allowed">Terkunci</button>
                    @elseif($seleksi->status_tahap_2 == 'menunggu')
                        <p class="text-gray-600 text-sm">Essay terkirim. Menunggu penilaian Admin.</p>
                    @elseif($seleksi->status_tahap_2 == 'lolos')
                        <p class="text-green-600 text-sm">Essay Anda Diterima!</p>
                    @else
                        <p class="text-gray-600 mb-6 text-sm">Kirim Judul Essay dan File PDF ke WhatsApp Admin.</p>
                        <button onclick="openModal('modal-essay')" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md">
                            Upload Essay <i class="fa-solid fa-file-pdf ml-2"></i>
                        </button>
                    @endif
                </div>
            </div>

            @php
                // Terbuka HANYA JIKA Tahap 2 'lolos'
                $s3_open = ($seleksi->status_tahap_2 == 'lolos');
                $s3_done = $seleksi->sudah_wawancara;
            @endphp
            <div id="step-3" class="relative flex flex-col md:flex-row gap-8 mb-12 {{ $s3_open ? '' : 'opacity-50 grayscale' }}">
                 <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div class="flex items-center justify-center w-16 h-16 rounded-full {{ $s3_done ? 'bg-green-100' : ($s3_open ? 'bg-orange-600' : 'bg-gray-200') }} border-4 border-white shadow-md transition-all">
                        @if($s3_done) <i class="fa-solid fa-check text-green-600 text-xl"></i>
                        @elseif($s3_open) <i class="fa-solid fa-video text-white text-xl"></i>
                        @else <i class="fa-solid fa-lock text-gray-500 text-xl"></i> @endif
                    </div>
                </div>
                <div class="flex-grow bg-white p-6 rounded-2xl border-l-4 {{ $s3_done ? 'border-green-200' : ($s3_open ? 'border-orange-600 shadow-lg' : 'border-gray-200 border-dashed') }}">
                    <h3 class="text-xl font-bold mb-2 {{ $s3_open ? 'text-gray-800' : 'text-gray-500' }}">Wawancara</h3>
                    
                    @if(!$s3_open)
                        <p class="text-gray-500 text-sm">Selesaikan Tahap Essay dulu.</p>
                    @elseif($s3_done)
                        <p class="text-green-600 text-sm font-bold">Terima kasih sudah wawancara!</p>
                    @else
                         <p class="text-gray-500 mb-6 text-sm">Lihat jadwal dan konfirmasi kehadiran.</p>
                         <button onclick="openModal('modal-wawancara')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md">
                            Lihat Jadwal
                        </button>
                    @endif
                </div>
            </div>

            @php
                $s4_open = $seleksi->sudah_wawancara;
                $is_lulus = ($seleksi->status_final == 'lulus');
            @endphp
            <div id="step-4" class="relative flex flex-col md:flex-row gap-8 mb-12 {{ $s4_open ? '' : 'opacity-50 grayscale' }}">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div class="flex items-center justify-center w-16 h-16 rounded-full {{ $is_lulus ? 'bg-green-600' : 'bg-orange-600' }} border-4 border-white shadow-lg">
                        <i class="fa-solid fa-envelope text-white text-xl"></i>
                    </div>
                </div>
                <div class="flex-grow bg-white p-6 rounded-2xl border-l-4 border-orange-600 shadow-lg">
                    <h3 class="text-xl font-bold text-orange-600 mb-2">Pengumuman Final</h3>
                    
                    @if($seleksi->status_final == 'menunggu')
                        @if($s4_open)
                            <p class="text-gray-600 text-sm">Hasil seleksi sedang diproses. Cek berkala ya!</p>
                            <button disabled class="mt-4 bg-gray-300 text-gray-500 font-semibold py-2 px-6 rounded-lg cursor-not-allowed">Belum Diumumkan</button>
                        @else
                            <p class="text-gray-500 text-sm">Terkunci.</p>
                        @endif
                    @else
                        <div class="mt-4 text-center">
                            <p class="text-gray-600 mb-4">Hasil telah keluar!</p>
                            <div onclick="openAnnouncement()" class="cursor-pointer bg-orange-100 p-4 rounded-lg border-2 border-orange-300 hover:bg-orange-200">
                                <span class="font-bold text-orange-800">BUKA AMPLOP</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($is_lulus)
            <div id="step-5" class="relative flex flex-col md:flex-row gap-8 mb-12">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div class="flex items-center justify-center w-16 h-16 rounded-full bg-orange-600 border-4 border-white shadow-lg">
                        <i class="fa-solid fa-champagne-glasses text-white text-xl"></i>
                    </div>
                </div>
                <div class="flex-grow bg-white p-6 rounded-2xl border-l-4 border-orange-600 shadow-lg">
                    <h3 class="text-xl font-bold text-orange-600">Welcome Party</h3>
                    <p class="text-gray-600 mb-4">Undangan khusus untuk kamu!</p>
                    <button onclick="openModal('modal-party')" class="bg-orange-600 text-white py-2 px-6 rounded-lg">Lihat Detail Acara</button>
                </div>
            </div>
            @endif

        </div>
    </section>

    <div id="modal-administrasi" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 relative">
            <button onclick="closeModal('modal-administrasi')" class="absolute top-4 right-4 text-gray-400"><i class="fa-solid fa-xmark"></i></button>
            <h2 class="text-2xl font-bold mb-4">Lengkapi Berkas</h2>
            
            <form action="{{ route('seleksi.tahap1') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="text-sm text-gray-500 bg-orange-50 p-3 rounded">
                        <i class="fa-brands fa-whatsapp text-green-600"></i> 
                        Setelah klik kirim, Anda akan diarahkan ke WhatsApp Admin untuk mengirim file CV, KTM, & Transkrip.
                    </div>
                </div>
                <button type="submit" class="mt-6 w-full bg-orange-600 text-white font-bold py-3 rounded-xl">Kirim & Chat WA</button>
            </form>
        </div>
    </div>

    <div id="modal-essay" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 relative">
            <button onclick="closeModal('modal-essay')" class="absolute top-4 right-4 text-gray-400"><i class="fa-solid fa-xmark"></i></button>
            <h2 class="text-2xl font-bold mb-4">Kirim Essay</h2>
            
            <form action="{{ route('seleksi.tahap2') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Judul Essay</label>
                        <input type="text" name="judul_essay" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="text-sm text-gray-500 bg-orange-50 p-3 rounded">
                        <i class="fa-brands fa-whatsapp text-green-600"></i> 
                        File PDF Essay dikirim manual lewat WhatsApp setelah klik tombol ini.
                    </div>
                </div>
                <button type="submit" class="mt-6 w-full bg-orange-600 text-white font-bold py-3 rounded-xl">Kirim Judul & Chat WA</button>
            </form>
        </div>
    </div>

    <div id="modal-wawancara" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 relative text-center">
            <button onclick="closeModal('modal-wawancara')" class="absolute top-4 right-4 text-gray-400"><i class="fa-solid fa-xmark"></i></button>
            <h2 class="text-2xl font-bold mb-4">Konfirmasi Wawancara</h2>
            
            <div class="space-y-3 mb-6">
                <a href="#" class="block bg-green-50 p-3 rounded text-green-700 font-bold border border-green-200">Buka Spreadsheet Jadwal</a>
                <a href="#" class="block bg-blue-50 p-3 rounded text-blue-700 font-bold border border-blue-200">Link Google Meet</a>
            </div>

            <form action="{{ route('seleksi.tahap3') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg">
                    Saya Sudah Wawancara <i class="fa-solid fa-check-double ml-2"></i>
                </button>
            </form>
        </div>
    </div>

    <div id="modal-pengumuman" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-70 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative text-center transform scale-90 transition-transform duration-300" id="announcement-card">
            
            <button onclick="closeModal('modal-pengumuman')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <div id="result-content">
                @if($seleksi->status_final == 'lulus')
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                        <i class="fa-solid fa-trophy text-green-600 text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-green-600 mb-2">SELAMAT!</h2>
                    <p class="text-xl font-semibold text-gray-700 mb-4">Anda Diterima sebagai Pengurus</p>
                    
                    <button onclick="unlockWelcomeParty()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg transition-transform hover:-translate-y-1">
                        Lanjut ke Welcome Party <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>

                @elseif($seleksi->status_final == 'tidak_lulus')
                    <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-heart-crack text-red-600 text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-red-600 mb-2">MOHON MAAF</h2>
                    <p class="text-gray-600 mb-4">Jangan patah semangat. Anda belum lolos seleksi kali ini.</p>
                    <button onclick="closeModal('modal-pengumuman')" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl">
                        Tutup
                    </button>

                @else
                    <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-hourglass-half text-orange-600 text-4xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-orange-600 mb-2">BELUM ADA HASIL</h2>
                    <p class="text-gray-600 mb-4">Mohon bersabar ya, hasil belum dirilis.</p>
                @endif
            </div>
        </div>
    </div>

    <div id="modal-party" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-80 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-0 relative overflow-hidden transform scale-100 transition-transform duration-300">
            
            <div class="bg-orange-600 h-32 flex items-center justify-center relative">
                <button onclick="closeModal('modal-party')" class="absolute top-4 right-4 text-white hover:text-orange-200 bg-black bg-opacity-20 rounded-full w-8 h-8 flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <i class="fa-solid fa-champagne-glasses text-white text-6xl opacity-50"></i>
                <div class="absolute -bottom-6 w-full flex justify-center">
                    <div class="bg-white p-2 rounded-full shadow-lg">
                        <div class="bg-orange-100 w-20 h-20 rounded-full flex items-center justify-center border-4 border-white">
                            <i class="fa-solid fa-gift text-orange-600 text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-16 pb-8 px-8 text-center">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-2">YOU'RE INVITED!</h2>
                <p class="text-orange-600 font-semibold text-lg mb-6">Welcome Party Pengurus Baru 2025</p>

                <div class="space-y-4 text-left bg-gray-50 p-6 rounded-xl border border-gray-100 mb-6">
                    <div class="flex items-start gap-3">
                        <i class="fa-regular fa-calendar text-orange-500 mt-1"></i>
                        <div>
                            <p class="font-bold text-gray-800">Sabtu, 20 Januari 2025</p>
                            <p class="text-xs text-gray-500">Mulai pukul 19.00 WIB - Selesai</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot text-orange-500 mt-1"></i>
                        <div>
                            <p class="font-bold text-gray-800">Aula Utama Kampus</p>
                            <p class="text-xs text-gray-500">Jl. Pendidikan No. 123 (Gedung B Lt. 3)</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-shirt text-orange-500 mt-1"></i>
                        <div>
                            <p class="font-bold text-gray-800">Dresscode: Casual Chic</p>
                            <p class="text-xs text-gray-500">Warna dominan: Putih / Oranye</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="https://chat.whatsapp.com/KS7RURd691C4Y04rrdksgs" target="_blank" class="block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl shadow-md transition-all">
                        <i class="fa-brands fa-whatsapp mr-2"></i> Gabung Grup WhatsApp
                    </a>
                    <button onclick="closeModal('modal-party')" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition-all">
                        Siap Hadir!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Fungsi Buka/Tutup Modal
        function openModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('modal-inactive');
                modal.classList.add('modal-active');
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('modal-active');
                modal.classList.add('modal-inactive');
            }
        }

        // 2. Fungsi Buka Amplop Pengumuman
        function openAnnouncement() {
            openModal('modal-pengumuman');
            
            // Cek status kelulusan dari PHP blade
            @if($seleksi->status_final == 'lulus')
                // Beri sedikit jeda agar modal muncul dulu, baru meledak
                setTimeout(triggerConfetti, 300);
            @endif
        }

        // 3. Fungsi Confetti (PERBAIKAN Z-INDEX DI SINI)
        function triggerConfetti() {
            var duration = 3 * 1000;
            var animationEnd = Date.now() + duration;
            
            // KITA SET Z-INDEX TINGGI AGAR MUNCUL DI DEPAN MODAL
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 9999 };

            function randomInRange(min, max) {
              return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function() {
              var timeLeft = animationEnd - Date.now();

              if (timeLeft <= 0) {
                return clearInterval(interval);
              }

              var particleCount = 50 * (timeLeft / duration);
              
              // Ledakan Kiri & Kanan
              confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
              confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);
        }

        // 4. Fungsi Buka Welcome Party (Scroll ke Bawah)
        function unlockWelcomeParty() {
            // Tutup modal dulu
            closeModal('modal-pengumuman');
            
            // Cari elemen step-5 (Welcome Party)
            const step5 = document.getElementById('step-5');
            
            if(step5) {
                // Scroll perlahan ke elemen tersebut
                setTimeout(() => {
                    step5.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Tambahkan efek highlight (kedip) sebentar biar user ngeh
                    step5.classList.add('ring-4', 'ring-orange-300', 'transition-all', 'duration-500');
                    setTimeout(() => {
                        step5.classList.remove('ring-4', 'ring-orange-300');
                    }, 2000);
                }, 300); // Tunggu modal nutup dulu 0.3 detik
            } else {
                console.error("Elemen Welcome Party (step-5) tidak ditemukan. Pastikan user sudah berstatus 'Lulus'.");
            }
        }
    </script>

</body>
</html>