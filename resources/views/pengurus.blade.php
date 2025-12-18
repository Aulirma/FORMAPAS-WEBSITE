<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORMAPAS | Pengurus</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
        /* Pop Up */
        .modal { transition: opacity 0.3s ease, visibility 0.3s ease; }
        .modal-active { opacity: 1; visibility: visible; }
        .modal-inactive { opacity: 0; visibility: hidden; }
    </style>
</head>
<body class="bg-[#FFF4E6] text-gray-800">
  @include('header')
  <section class="pt-24 pb-16">
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-center capitalize text-4xl md:text-5xl font-extrabold leading-tight mb-4 text-[#db5400]">Our Team</h1>
        <p class="max-w-2xl mx-auto my-6 text-center text-gray-500 ">
            Staff Pengurus FORMAPAS 2025-2026
        </p>
        <div class="flex items-center justify-center">
            <div class="flex items-center p-1 border border-orange-600 dark:border-orange-400 rounded-xl">
                <button onclick="switchTab('bph')" id="tab-bph" class="px-4 py-2 text-sm font-medium text-white capitalize bg-orange-600 md:py-3 rounded-xl md:px-12">BPH</button>
                <button onclick="switchTab('sosling')" id="tab-sosling" class="px-4 py-2 mx-4 text-sm font-medium text-orange-600 capitalize transition-colors duration-300 md:py-3 dark:text-orange-400 dark:hover:text-white focus:outline-none hover:bg-orange-600 hover:text-white rounded-xl md:mx-8 md:px-12">SOSLING</button>
                <button onclick="switchTab('huminfo')" id="tab-huminfo" class="px-4 py-2 text-sm font-medium text-orange-600 capitalize transition-colors duration-300 md:py-3 dark:text-orange-400 dark:hover:text-white focus:outline-none hover:bg-orange-600 hover:text-white rounded-xl md:px-12">HUMINFO</button>
            </div>
        </div>
        <div id="content-bph" class="grid grid-cols-1 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-3 team-content">
            @foreach($bph as $p)
            <div class="flex flex-col items-center">
                <img class="object-cover w-full rounded-xl aspect-square shadow-md" 
                    src="{{ asset('storage/' . $p->image) }}" 
                    alt="{{ $p->name }}">
                
                <h1 class="mt-4 text-2xl font-semibold text-gray-700 capitalize">{{ $p->name }}</h1>
                <p class="mt-2 text-gray-500 capitalize">{{ $p->position }}</p>
                <div class="flex items-center justify-center gap-4 mt-4">
                    {{-- 1. Ikon WhatsApp --}}
                    @if($p->whatsapp)
                        <a href="{{ $p->whatsapp }}" target="_blank" class="text-gray-400 hover:text-green-500 transition-colors duration-300 text-xl">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    @endif
                    {{-- 2. Ikon Instagram --}}
                    @if($p->instagram)
                        <a href="{{ $p->instagram }}" target="_blank" class="text-gray-400 hover:text-pink-500 transition-colors duration-300 text-xl">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                    {{-- 3. Ikon Email --}}
                    @if($p->email)
                        <button onclick="copyEmail('{{ $p->email }}')" 
                            class="text-gray-400 hover:text-blue-500 transition-colors duration-300 text-xl cursor-pointer"
                            title="Klik untuk menyalin email">
                            <i class="fa-solid fa-envelope"></i>
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div id="content-sosling" class="hidden grid grid-cols-1 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-3 team-content">
            @foreach($sosling as $p)
            <div class="flex flex-col items-center">
                <img class="object-cover w-full rounded-xl aspect-square shadow-md" 
                    src="{{ asset('storage/' . $p->image) }}" 
                    alt="{{ $p->name }}">
                    
                <h1 class="mt-4 text-2xl font-semibold text-gray-700 capitalize">{{ $p->name }}</h1>
                <p class="mt-2 text-gray-500 capitalize">{{ $p->position }}</p>
                <div class="flex items-center justify-center gap-4 mt-4">
                    {{-- 1. Ikon WhatsApp --}}
                    @if($p->whatsapp)
                        <a href="{{ $p->whatsapp }}" target="_blank" class="text-gray-400 hover:text-green-500 transition-colors duration-300 text-xl">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    @endif
                    {{-- 2. Ikon Instagram --}}
                    @if($p->instagram)
                        <a href="{{ $p->instagram }}" target="_blank" class="text-gray-400 hover:text-pink-500 transition-colors duration-300 text-xl">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                    {{-- 3. Ikon Email --}}
                    @if($p->email)
                        <button onclick="copyEmail('{{ $p->email }}')" 
                            class="text-gray-400 hover:text-blue-500 transition-colors duration-300 text-xl cursor-pointer"
                            title="Klik untuk menyalin email">
                            <i class="fa-solid fa-envelope"></i>
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div id="content-huminfo" class="hidden grid grid-cols-1 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-3 team-content">
            @foreach($huminfo as $p)
            <div class="flex flex-col items-center">
                <img class="object-cover w-full rounded-xl aspect-square shadow-md" 
                    src="{{ asset('storage/' . $p->image) }}" 
                    alt="{{ $p->name }}">
                    
                <h1 class="mt-4 text-2xl font-semibold text-gray-700 capitalize">{{ $p->name }}</h1>
                <p class="mt-2 text-gray-500 capitalize">{{ $p->position }}</p>
                <div class="flex items-center justify-center gap-4 mt-4">
                    {{-- 1. Ikon WhatsApp --}}
                    @if($p->whatsapp)
                        <a href="{{ $p->whatsapp }}" target="_blank" class="text-gray-400 hover:text-green-500 transition-colors duration-300 text-xl">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    @endif
                    {{-- 2. Ikon Instagram --}}
                    @if($p->instagram)
                        <a href="{{ $p->instagram }}" target="_blank" class="text-gray-400 hover:text-pink-500 transition-colors duration-300 text-xl">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                    {{-- 3. Ikon Email --}}
                    @if($p->email)
                        <button onclick="copyEmail('{{ $p->email }}')" 
                            class="text-gray-400 hover:text-blue-500 transition-colors duration-300 text-xl cursor-pointer"
                            title="Klik untuk menyalin email">
                            <i class="fa-solid fa-envelope"></i>
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
  </section>

  <section class="max-w-4xl mx-auto px-6 py-16">
        <div class="text-center mb-16">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Alur Seleksi Pengurus</h1>
            <p class="text-gray-500">Selesaikan setiap tahap untuk membuka tahap berikutnya.</p>
        </div>

        <div class="relative">
            <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gray-200 hidden md:block z-0"></div>

            <div id="step-1" class="relative flex flex-col md:flex-row gap-8 mb-12">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div id="icon-1" class="flex items-center justify-center w-16 h-16 rounded-full bg-orange-600 border-4 border-white shadow-lg transition-all duration-500">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                </div>
                <div id="card-1" class="flex-grow bg-white p-6 rounded-2xl shadow-lg border-l-4 border-orange-600 transition-all duration-500">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-orange-600">Administrasi Berkas</h3>
                        <span id="badge-1" class="px-3 py-1 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full animate-pulse">Sedang Berlangsung</span>
                    </div>
                    <p class="text-gray-600 mb-6 text-sm">Lengkapi data diri, upload CV, KTM, dan Transkrip Nilai.</p>
                    
                    <button onclick="openModal('modal-administrasi')" id="btn-1" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all">
                        Lengkapi Berkas <i class="fa-solid fa-upload ml-2"></i>
                    </button>
                </div>
            </div>

            <div id="step-2" class="relative flex flex-col md:flex-row gap-8 mb-12 opacity-50 grayscale transition-all duration-500">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div id="icon-2" class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-200 border-4 border-white shadow-md transition-all duration-500">
                        <i class="fa-solid fa-lock text-gray-500 text-xl"></i>
                    </div>
                </div>
                <div id="card-2" class="flex-grow bg-gray-50 p-6 rounded-2xl border border-gray-200 border-dashed transition-all duration-500">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-600 transition-colors duration-300" id="title-2">Penulisan Essay</h3>
                        <span id="badge-2" class="px-3 py-1 text-xs font-semibold text-gray-500 bg-gray-200 rounded-full">Terkunci</span>
                    </div>
                    <p class="text-gray-500 mb-6 text-sm">Buat essay sesuai ketentuan dan upload judul serta file PDF.</p>
                    
                    <button onclick="openModal('modal-essay')" id="btn-2" disabled class="bg-gray-300 text-gray-500 font-semibold py-2 px-6 rounded-lg cursor-not-allowed transition-all">
                        Terkunci
                    </button>
                </div>
            </div>

            <div id="step-3" class="relative flex flex-col md:flex-row gap-8 mb-12 opacity-50 grayscale transition-all duration-500">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div id="icon-3" class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-200 border-4 border-white shadow-md transition-all duration-500">
                        <i class="fa-solid fa-lock text-gray-500 text-xl"></i>
                    </div>
                </div>
                <div id="card-3" class="flex-grow bg-gray-50 p-6 rounded-2xl border border-gray-200 border-dashed transition-all duration-500">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-600 transition-colors duration-300" id="title-3">Wawancara</h3>
                        <span id="badge-3" class="px-3 py-1 text-xs font-semibold text-gray-500 bg-gray-200 rounded-full">Terkunci</span>
                    </div>
                    <p class="text-gray-500 mb-6 text-sm">Cek jadwal wawancara dan link Google Meet di sini.</p>
                    
                    <button onclick="openModal('modal-wawancara')" id="btn-3" disabled class="bg-gray-300 text-gray-500 font-semibold py-2 px-6 rounded-lg cursor-not-allowed transition-all">
                        Terkunci
                    </button>
                </div>
            </div>

            <div id="step-4" class="relative flex flex-col md:flex-row gap-8 mb-12 opacity-50 grayscale transition-all duration-500">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div id="icon-4" class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-200 border-4 border-white shadow-md transition-all">
                        <i class="fa-solid fa-flag-checkered text-gray-500 text-xl"></i>
                    </div>
                </div>
                <div id="card-4" class="flex-grow bg-gray-50 p-6 rounded-2xl border border-gray-200 border-dashed transition-all">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-600 transition-colors" id="title-4">Pengumuman Final</h3>
                        <span id="badge-4" class="px-3 py-1 text-xs font-semibold text-gray-500 bg-gray-200 rounded-full">Belum Diumumkan</span>
                    </div>
                    <div id="envelope-area" class="hidden mt-6 text-center">
                        <p class="text-gray-600 mb-4 text-sm">Hasil seleksi telah keluar. Silakan buka amplop di bawah ini.</p>
                        <div onclick="openAnnouncement()" class="group cursor-pointer relative w-64 h-40 bg-orange-100 mx-auto rounded-lg shadow-lg border-2 border-orange-200 hover:shadow-xl hover:-translate-y-1 transition-all overflow-hidden">
                            <div class="absolute top-0 left-0 w-0 h-0 border-l-[128px] border-l-transparent border-r-[128px] border-r-transparent border-t-[90px] border-t-orange-300 drop-shadow-md origin-top group-hover:scale-y-75 transition-transform duration-500 z-20"></div>
                            <div class="absolute top-10 left-1/2 transform -translate-x-1/2 z-10 opacity-80">
                                <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center text-white font-bold border-2 border-white shadow-sm">
                                    F
                                </div>
                            </div>
                            <div class="absolute bottom-4 w-full text-center text-orange-800 font-bold text-sm tracking-widest uppercase opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-0">
                                Buka Sekarang
                            </div>
                        </div>
                    </div>
                    <button id="btn-4" disabled class="mt-4 bg-gray-300 text-gray-500 font-semibold py-2 px-6 rounded-lg cursor-not-allowed transition-all">
                        Belum Diumumkan
                    </button>
                </div>
            </div>

            <div id="step-5" class="relative flex flex-col md:flex-row gap-8 mb-12 opacity-50 grayscale transition-all duration-500">
                <div class="flex-shrink-0 relative z-10 md:mx-0 mx-auto">
                    <div class="absolute left-8 top-8 w-0.5 h-full bg-white z-[-1] hidden md:block"></div>
                    
                    <div id="icon-5" class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-200 border-4 border-white shadow-md transition-all">
                        <i class="fa-solid fa-calendar-day text-gray-500 text-xl"></i>
                    </div>
                </div>
                <div id="card-5" class="flex-grow bg-gray-50 p-6 rounded-2xl border border-gray-200 border-dashed transition-all">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-600 transition-colors" id="title-5">Welcome Party</h3>
                        <span id="badge-5" class="px-3 py-1 text-xs font-semibold text-gray-500 bg-gray-200 rounded-full">Menunggu Hasil</span>
                    </div>
                    <p class="text-gray-500 mb-6 text-sm">Info detail lokasi dan waktu kumpul pengurus baru.</p>
                    
                    <button onclick="openModal('modal-party')" id="btn-5" disabled class="bg-gray-300 text-gray-500 font-semibold py-2 px-6 rounded-lg cursor-not-allowed transition-all">
                        Terkunci
                    </button>
                </div>
            </div>

        </div>
    </section>

    <div id="modal-administrasi" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 relative transform transition-all scale-100">
            <button onclick="closeModal('modal-administrasi')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Lengkapi Berkas</h2>
            <form onsubmit="finishStep1(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" required class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-orange-500 focus:outline-none" placeholder="Masukkan nama">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload CV (PDF)</label>
                        <input type="file" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload KTM (JPG/PNG)</label>
                        <input type="file" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload Transkrip Nilai</label>
                        <input type="file" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>
                </div>
                <button type="submit" class="mt-6 w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">Kirim Berkas</button>
            </form>
        </div>
    </div>

    <div id="modal-essay" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 relative">
            <button onclick="closeModal('modal-essay')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Upload Essay</h2>
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4 text-sm text-blue-700">
                <strong>Ketentuan:</strong><br>
                1. Tema: "Peran Mahasiswa Pasuruan untuk Daerah"<br>
                2. Minimal 500 kata, Font Times New Roman 12.<br>
                3. Format PDF.
            </div>
            <form onsubmit="finishStep2(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Essay</label>
                        <input type="text" required class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-orange-500 focus:outline-none" placeholder="Judul essay kamu">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Essay (PDF)</label>
                        <input type="file" accept=".pdf" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>
                </div>
                <button type="submit" class="mt-6 w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">Kirim Essay</button>
            </form>
        </div>
    </div>

    <div id="modal-wawancara" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 relative text-center">
            <button onclick="closeModal('modal-wawancara')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-video text-blue-600 text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Info Wawancara</h2>
            <p class="text-gray-500 mb-6">Silakan cek jadwal Anda dan simpan link Google Meet berikut.</p>

            <div class="space-y-4 mb-6">
                <a href="#" target="_blank" class="flex items-center p-4 border border-green-200 bg-green-50 rounded-xl hover:bg-green-100 transition">
                    <i class="fa-solid fa-table text-green-600 text-2xl mr-4"></i>
                    <div class="text-left">
                        <h4 class="font-bold text-green-800">Spreadsheet Jadwal</h4>
                        <p class="text-xs text-green-600">Klik untuk melihat jam wawancara</p>
                    </div>
                    <i class="fa-solid fa-external-link-alt ml-auto text-green-600"></i>
                </a>

                <a href="#" target="_blank" class="flex items-center p-4 border border-blue-200 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                    <i class="fa-brands fa-google text-blue-600 text-2xl mr-4"></i>
                    <div class="text-left">
                        <h4 class="font-bold text-blue-800">Room Google Meet</h4>
                        <p class="text-xs text-blue-600">Link untuk sesi wawancara</p>
                    </div>
                    <i class="fa-solid fa-video ml-auto text-blue-600"></i>
                </a>
            </div>

            <button onclick="finishStep3()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg mb-2 transition-all">
                Saya Sudah Wawancara <i class="fa-solid fa-check-double ml-2"></i>
            </button>
            
            <button onclick="closeModal('modal-wawancara')" class="text-gray-400 hover:text-gray-600 text-sm">Tutup / Belum Wawancara</button>
        </div>
    </div>

    <div id="modal-pengumuman" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-70 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative text-center transform scale-90 transition-transform duration-300" id="announcement-card">
            <button onclick="closeModal('modal-pengumuman')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            
            <div id="result-content">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                    <i class="fa-solid fa-trophy text-green-600 text-4xl"></i>
                </div>
                
                <h2 class="text-3xl font-bold text-green-600 mb-2">SELAMAT!</h2>
                <p class="text-xl font-semibold text-gray-700 mb-4">Anda Diterima</p>
                
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                    <p class="text-gray-600 text-sm">
                        Selamat bergabung menjadi pengurus <strong>FORMAPAS 2025/2026</strong>.<br>
                        Kami tunggu kehadiranmu di Welcome Party!
                    </p>
                </div>

                <button onclick="closeModal('modal-pengumuman'); unlockWelcomeParty()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all">
                    Lanjut ke Welcome Party <i class="fa-solid fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="modal-party" class="modal modal-inactive fixed inset-0 z-[2000] w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-60 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg relative overflow-hidden">
            <button onclick="closeModal('modal-party')" class="absolute top-4 right-4 z-10 bg-white/50 hover:bg-white rounded-full p-2 text-gray-800 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
            
            <div class="h-48 w-full bg-gray-200 relative">
                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80" alt="Party" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                    <h2 class="text-2xl font-bold text-white">Welcome Party 2025 🎉</h2>
                </div>
            </div>

            <div class="p-6">
                <p class="text-gray-600 text-sm mb-6">
                    Selamat datang Pengurus Baru! Mari berkumpul, berkenalan, dan merayakan awal perjalanan kita di FORMAPAS.
                </p>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-orange-50 p-3 rounded-xl border border-orange-100">
                        <div class="text-xs text-orange-600 font-bold uppercase mb-1">Tanggal</div>
                        <div class="text-gray-800 font-semibold"><i class="fa-regular fa-calendar mr-2"></i>25 Feb 2025</div>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-xl border border-orange-100">
                        <div class="text-xs text-orange-600 font-bold uppercase mb-1">Waktu</div>
                        <div class="text-gray-800 font-semibold"><i class="fa-regular fa-clock mr-2"></i>18:30 WIB</div>
                    </div>
                    <div class="col-span-2 bg-orange-50 p-3 rounded-xl border border-orange-100">
                        <div class="text-xs text-orange-600 font-bold uppercase mb-1">Lokasi</div>
                        <div class="text-gray-800 font-semibold"><i class="fa-solid fa-location-dot mr-2"></i>Cafe Puncak Pasuruan, Lt. 2</div>
                    </div>
                </div>

                <div class="flex items-center gap-3 mb-6 bg-gray-50 p-3 rounded-lg">
                    <i class="fa-solid fa-shirt text-gray-500"></i>
                    <span class="text-sm text-gray-600"><strong>Dresscode:</strong> Casual Putih / Cream</span>
                </div>

                <button onclick="finishStep5()" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
                    Siap Hadir! <i class="fa-solid fa-thumbs-up ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="copy-toast" class="fixed bottom-10 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-full shadow-2xl flex items-center gap-3 transition-all duration-300 opacity-0 invisible z-[9999]">
        <i class="fa-solid fa-circle-check text-green-400"></i>
        <span class="text-sm font-semibold">Email berhasil disalin!</span>
    </div>

  <!-- <div class="h-20"></div> -->

  @include('footer')
  <script>
      function switchTab(tabName) {
          const allContents = document.querySelectorAll('.team-content');
          allContents.forEach(content => {
              content.classList.add('hidden');
          });

          const selectedContent = document.getElementById('content-' + tabName);
          if(selectedContent) {
              selectedContent.classList.remove('hidden');
          }

          const allTabs = document.querySelectorAll('button[id^="tab-"]');
          allTabs.forEach(tab => {
              tab.className = "px-4 py-2 mx-4 text-sm font-medium text-orange-600 capitalize md:py-3 dark:text-orange-400 hover:bg-orange-600 hover:text-white rounded-xl md:mx-8 md:px-12 transition-all duration-300";
          });

          const activeTab = document.getElementById('tab-' + tabName);
          if(activeTab) {
              activeTab.className = "px-4 py-2 text-sm font-medium text-white capitalize bg-orange-600 md:py-3 rounded-xl md:px-12 transition-all duration-300 shadow-lg";
          }
      }

      // Fungsi Buka/Tutup Modal
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('modal-inactive');
            modal.classList.add('modal-active');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('modal-active');
            modal.classList.add('modal-inactive');
        }
        
        // 1. Tahap 1 (Berkas) Selesai
        function finishStep1(e) {
            e.preventDefault();
            closeModal('modal-administrasi');

            // Ubah Tampilan Tahap 1 jadi SELESAI (Hijau)
            document.getElementById('icon-1').className = "flex items-center justify-center w-16 h-16 rounded-full bg-green-100 border-4 border-white shadow-md transition-all";
            document.getElementById('icon-1').innerHTML = '<i class="fa-solid fa-check text-green-600 text-xl"></i>';
            document.getElementById('card-1').className = "flex-grow bg-white p-6 rounded-2xl shadow-sm border border-green-200";
            document.getElementById('badge-1').className = "px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full";
            document.getElementById('badge-1').innerText = "Selesai";
            document.getElementById('btn-1').className = "hidden"; // Sembunyikan tombol kirim

            // BUKA Tahap 2 (Essay)
            unlockStep('step-2', 'icon-2', 'card-2', 'title-2', 'badge-2', 'btn-2', 'Upload Essay', 'modal-essay', '2');
            alert('Berkas berhasil dikirim! Tahap Essay kini terbuka.');
        }

        // 2. Tahap 2 (Essay) Selesai
        function finishStep2(e) {
            e.preventDefault();
            closeModal('modal-essay');

            // Ubah Tampilan Tahap 2 jadi SELESAI (Hijau)
            document.getElementById('icon-2').className = "flex items-center justify-center w-16 h-16 rounded-full bg-green-100 border-4 border-white shadow-md transition-all";
            document.getElementById('icon-2').innerHTML = '<i class="fa-solid fa-check text-green-600 text-xl"></i>';
            document.getElementById('card-2').className = "flex-grow bg-white p-6 rounded-2xl shadow-sm border border-green-200";
            document.getElementById('badge-2').className = "px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full";
            document.getElementById('badge-2').innerText = "Selesai";
            document.getElementById('btn-2').className = "hidden";

            // BUKA Tahap 3 (Wawancara)
            unlockStep('step-3', 'icon-3', 'card-3', 'title-3', 'badge-3', 'btn-3', 'Lihat Jadwal', 'modal-wawancara', '<i class="fa-solid fa-video"></i>');
            alert('Essay berhasil dikirim! Jadwal wawancara kini tersedia.');
        }

        // Fungsi Helper untuk Membuka Kunci Tahapan
        function unlockStep(stepId, iconId, cardId, titleId, badgeId, btnId, btnText, modalTarget, iconContent) {
            document.getElementById(stepId).classList.remove('opacity-50', 'grayscale');

            // Ubah Ikon jadi Oranye (Aktif)
            const iconBox = document.getElementById(iconId);
            iconBox.className = "flex items-center justify-center w-16 h-16 rounded-full bg-orange-600 border-4 border-white shadow-lg transition-all";
            if(iconContent === '2') {
                iconBox.innerHTML = '<span class="text-white font-bold text-xl">2</span>';
            } else {
                iconBox.innerHTML = '<i class="fa-solid fa-video text-white text-xl"></i>';
            }
            
            // Ubah Kartu jadi Oranye
            document.getElementById(cardId).className = "flex-grow bg-white p-6 rounded-2xl shadow-lg border-l-4 border-orange-600 transition-all";
            document.getElementById(titleId).className = "text-xl font-bold text-orange-600";
            
            // Ubah Badge jadi "Sedang Berlangsung"
            const badge = document.getElementById(badgeId);
            badge.className = "px-3 py-1 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full animate-pulse";
            badge.innerText = "Sedang Berlangsung";

            // Aktifkan Tombol
            const btn = document.getElementById(btnId);
            btn.disabled = false;
            btn.className = "bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all";
            btn.innerText = btnText;
            btn.setAttribute('onclick', openModal('${modalTarget}'));
        }

        // 3. Tahap 3 (Wawancara) Selesai
        function finishStep3() {
            closeModal('modal-wawancara');

            // Ubah Tampilan Tahap 3 jadi SELESAI (Hijau)
            document.getElementById('icon-3').className = "flex items-center justify-center w-16 h-16 rounded-full bg-green-100 border-4 border-white shadow-md transition-all";
            document.getElementById('icon-3').innerHTML = '<i class="fa-solid fa-check text-green-600 text-xl"></i>';
            document.getElementById('card-3').className = "flex-grow bg-white p-6 rounded-2xl shadow-sm border border-green-200";
            document.getElementById('badge-3').className = "px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full";
            document.getElementById('badge-3').innerText = "Selesai";
            document.getElementById('btn-3').className = "hidden";

            // BUKA Tahap 4 (Pengumuman Final / Amplop)
            unlockStep4(); 
            
            alert('Status Wawancara terkonfirmasi! Silakan cek amplop pengumuman.');
        }

        // Fungsi Khusus Membuka Tahap 4 (Amplop)
        function unlockStep4() {
            // Hilangkan efek terkunci
            document.getElementById('step-4').classList.remove('opacity-50', 'grayscale');

            // Ubah Ikon jadi Oranye
            const iconBox = document.getElementById('icon-4');
            iconBox.className = "flex items-center justify-center w-16 h-16 rounded-full bg-orange-600 border-4 border-white shadow-lg transition-all";
            iconBox.innerHTML = '<i class="fa-solid fa-envelope text-white text-xl"></i>';
            
            // Ubah Kartu jadi Oranye
            document.getElementById('card-4').className = "flex-grow bg-white p-6 rounded-2xl shadow-lg border-l-4 border-orange-600 transition-all";
            document.getElementById('title-4').className = "text-xl font-bold text-orange-600";
            
            // Sembunyikan tombol biasa, TAMPILKAN AMPLOP
            document.getElementById('btn-4').className = "hidden";
            document.getElementById('envelope-area').classList.remove('hidden');

            // Ubah Badge jadi Merah (Penting)
            const badge = document.getElementById('badge-4');
            badge.className = "px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded-full animate-pulse";
            badge.innerText = "Hasil Keluar";
        }

        // --- LOGIKA SIMULASI UNTUK MEMBUKA TAHAP 4 ---
        function unlockStep4() {
            unlockStep('step-4', 'icon-4', 'card-4', 'title-4', 'badge-4', 'btn-4', '', '', '<i class="fa-solid fa-envelope"></i>');
            
            // Khusus Tahap 4: Sembunyikan tombol biasa, tampilkan amplop
            document.getElementById('btn-4').className = "hidden";
            document.getElementById('envelope-area').classList.remove('hidden');
            
            // Ubah status badge
            const badge = document.getElementById('badge-4');
            badge.innerText = "Hasil Keluar";
            badge.className = "px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded-full animate-pulse";
        }

        // Fungsi Saat Amplop Diklik
        function openAnnouncement() {
            // 1. Buka Modal
            openModal('modal-pengumuman');
            
            // 2. Efek Zoom In sedikit pada modal agar dramatis
            setTimeout(() => {
                document.getElementById('announcement-card').classList.remove('scale-90');
                document.getElementById('announcement-card').classList.add('scale-100');
            }, 100);

            // 3. JALANKAN KONFETI (Hujan Kertas)
            // Ini pakai library canvas-confetti
            var duration = 3 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 3000 };

            function randomInRange(min, max) {
            return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function() {
            var timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) {
                return clearInterval(interval);
            }

            var particleCount = 50 * (timeLeft / duration);
            // Konfeti dari kiri dan kanan
            confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
            confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);
        }

        // Dummy Function untuk Welcome Party (Tahap 5)
        function unlockWelcomeParty() {
            alert("Tahap 5: Welcome Party Terbuka!");
        }

        // FUNGSI MEMBUKA TAHAP 5 (Dipanggil dari tombol di Modal Pengumuman)
        function unlockWelcomeParty() {
            // Tutup modal pengumuman dulu
            closeModal('modal-pengumuman');

            // BUKA TAHAP 5
            document.getElementById('step-5').classList.remove('opacity-50', 'grayscale');

            // Ubah Ikon jadi Oranye
            const iconBox = document.getElementById('icon-5');
            iconBox.className = "flex items-center justify-center w-16 h-16 rounded-full bg-orange-600 border-4 border-white shadow-lg transition-all";
            iconBox.innerHTML = '<i class="fa-solid fa-champagne-glasses text-white text-xl"></i>';
            
            // Ubah Kartu jadi Oranye
            document.getElementById('card-5').className = "flex-grow bg-white p-6 rounded-2xl shadow-lg border-l-4 border-orange-600 transition-all";
            document.getElementById('title-5').className = "text-xl font-bold text-orange-600";
            
            // Ubah Badge
            const badge = document.getElementById('badge-5');
            badge.className = "px-3 py-1 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full animate-pulse";
            badge.innerText = "Undangan Masuk";

            // Aktifkan Tombol
            const btn = document.getElementById('btn-5');
            btn.disabled = false;
            btn.className = "bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all";
            btn.innerText = "Lihat Detail Acara";
            
            // Scroll otomatis ke bawah agar user sadar ada tahap baru
            document.getElementById('step-5').scrollIntoView({ behavior: 'smooth' });
        }

        // FUNGSI SELESAI TAHAP 5 (Akhir dari segalanya)
        function finishStep5() {
            closeModal('modal-party');

            // Ubah jadi Hijau (Selesai Total)
            document.getElementById('icon-5').className = "flex items-center justify-center w-16 h-16 rounded-full bg-green-100 border-4 border-white shadow-md transition-all";
            document.getElementById('icon-5').innerHTML = '<i class="fa-solid fa-check text-green-600 text-xl"></i>';
            document.getElementById('card-5').className = "flex-grow bg-white p-6 rounded-2xl shadow-sm border border-green-200";
            
            document.getElementById('badge-5').className = "px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full";
            document.getElementById('badge-5').innerText = "Akan Hadir";
            
            document.getElementById('btn-5').className = "hidden"; // Hilangkan tombol atau ganti jadi teks
            
            alert("Terima kasih! Sampai jumpa di Welcome Party! 🎉");
        }

        function copyEmail(email) {
            const textArea = document.createElement("textarea");
            textArea.value = email;
            textArea.style.position = "fixed";
            textArea.style.left = "-9999px";
            document.body.appendChild(textArea);
            // Salin isinya
            textArea.select();
            textArea.setSelectionRange(0, 99999); // Untuk HP
            try {
                document.execCommand("copy");
                showToast(); // Panggil notifikasi
            } catch (err) {
                console.error("Gagal menyalin email", err);
                alert("Gagal menyalin: " + email); // Fallback kasar jika error parah
            }
            document.body.removeChild(textArea);
        }

        function showToast() {
            const toast = document.getElementById('copy-toast');
            // Pastikan elemen ada
            if (toast) {
                toast.classList.remove('opacity-0', 'invisible');
                toast.classList.add('opacity-100', 'visible', '-translate-y-2');
                // Hilangkan setelah 2 detik
                setTimeout(() => {
                    toast.classList.remove('opacity-100', 'visible', '-translate-y-2');
                    toast.classList.add('opacity-0', 'invisible');
                }, 2000);
            } else {
                console.error("Elemen Toast tidak ditemukan! Cek ID 'copy-toast'");
            }
        }
  </script>
</body>
</html>