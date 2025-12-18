<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORMAPAS | Program KKN</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .testi-card { perspective: 1200px;}
    .card-inner {
      width: 100%;
      height: 100%;
      position: relative;
      transform-style: preserve-3d;
      transition: transform 0.7s ease;
    }
    .testi-card.flipped .card-inner { transform: rotateY(180deg);}

    .front,
    .back {
      position: absolute;
      inset: 0;
      backface-visibility: hidden;
    }

    .back { transform: rotateY(180deg);}

    /* reveal */
    .testi-card.show {
      opacity: 1 !important;
      transform: translateY(0) !important;
    }

    @keyframes pop {
    0% { transform: scale(0.5); opacity: 0; }
    60% { transform: scale(1.1); }
    100% { transform: scale(1); opacity: 1; }
    }

    .animate-pop {
      animation: pop 0.6s ease-out forwards;
    }
  </style>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#FFF4E6] text-gray-800">

  <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="pt-20 pb-10 mt-20 px-6 text-center">
    <h1 class="text-5xl md:text-6xl font-extrabold text-[#db5400] mb-4">Program KKN FORMAPAS</h1>
    <p class="text-lg md:text-xl text-gray-700 max-w-2xl mx-auto mb-12">
      Kuliah Kerja Nyata untuk Pengabdian Masyarakat yang Berkelanjutan
    </p>
  </div>

  <section>
    <div class="max-w-[1200px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
      <div>
        <h2 class="text-3xl font-bold text-[#db5400] mb-4">Tentang KKN</h2>
        <p class="text-gray-700 text-lg leading-relaxed mb-4">
          Program KKN (Kuliah Kerja Nyata) FORMAPAS adalah inisiatif pengabdian masyarakat yang dirancang untuk memberdayakan komunitas lokal di Pasuruan dan sekitarnya.
        </p>
        <p class="text-gray-700 text-lg pb-3 leading-relaxed">
          Kami percaya bahwa mahasiswa memiliki tanggung jawab sosial untuk berkontribusi positif bagi masyarakat dan lingkungan sekitar.
        </p>
        <button id="btnDaftarKKN" class="bg-white text-[#ff7a00] px-8 py-4 rounded-full font-semibold shadow-md transition hover:-translate-y-1">
          Daftar KKN Sekarang
        </button>
        <!-- ALERT LOGIN -->
        <div id="alertLogin" class="fixed inset-0 bg-black bg-opacity-40 hidden flex items-center justify-center">
          <div class="bg-white p-6 rounded-xl shadow-lg w-80 text-center">
              <p class="text-gray-800 mb-4">Kamu harus login dulu untuk mendaftar KKN.</p>
              <div class="flex justify-center gap-3">
                  <a href="<?php echo e(route('auth')); ?>" class="bg-[#ff7a00] text-white px-4 py-2 rounded-md">Login</a>
                  <button id="alertCancel" class="bg-gray-300 px-4 py-2 rounded-md">Batal</button>
              </div>
          </div>
        </div>

      </div>
      <div class="bg-white rounded-2xl shadow-md p-8">
        <h3 class="text-2xl font-bold text-[#db5400] mb-6">Syarat Daftar</h3>
        <ul class="space-y-4">
          <li class="flex items-start gap-3">
            <i class="fa-solid fa-check text-[#FF7A00] text-xl mt-1"></i>
            <span class="text-gray-700">Mahasiswa yang lahir di Pasuruan</span>
          </li>
          <li class="flex items-start gap-3">
            <i class="fa-solid fa-check text-[#FF7A00] text-xl mt-1"></i>
            <span class="text-gray-700">Akan menjalani KKN (sebelum sesmester 5)</span>
          </li>
          <li class="flex items-start gap-3">
            <i class="fa-solid fa-check text-[#FF7A00] text-xl mt-1"></i>
            <span class="text-gray-700">Memiliki KTP</span>
          </li>
          <li class="flex items-start gap-3">
            <i class="fa-solid fa-check text-[#FF7A00] text-xl mt-1"></i>
            <span class="text-gray-700">Sehat jasmani dan rohani</span>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <main class="w-full px-6 md:px-12 mt-24">

    <section class="text-center py-8 relative overflow-visible">
      <h1 class="text-4xl font-bold text-[#db5400]">Pengalaman KKN</h1>
      <p class="mt-2 text-[#a97f64] inline-block">
        Stories from the field and discover your community service personality
      </p>
    </section>

    <section class="mt-10">
      <h2 class="text-2xl font-bold text-[#3b2b25] mb-6 flex items-center gap-2">
        <span class="text-3xl">📸</span> Galeri Kegiatan KKN
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        <!-- ITEM 1 -->
        <div class="group rounded-xl shadow-card border overflow-hidden bg-[#ffddcf] hover:-translate-y-2 transition cursor-pointer gallery-item">
            <div class="h-52 flex items-center justify-center">
            <img src="<?php echo e(asset('images/kegiatan 1.jpg')); ?>" class="w-full h-full object-cover">
          </div>
          <div class="bg-white p-4">
            <div class="font-semibold">Menanam padi</div>
            <div class="text-sm text-[#6f4f45]">Pasuruan, 2024</div>
          </div>
        </div>

        <!-- item 2 -->
        <div class="group rounded-xl shadow-card border overflow-hidden bg-[#ffddcf] hover:-translate-y-2 hover:shadow-xl transition cursor-pointer gallery-item">
            <div class="h-52 flex items-center justify-center">
            <img src="<?php echo e(asset('images/kegiatan 2.jpg')); ?>" class="w-full h-full object-cover">
          </div>
          <div class="bg-white p-4">
            <div class="font-semibold">Arung jeram</div>
            <div class="text-sm text-[#6f4f45]">Pasuruan, 2024</div>
          </div>
        </div>

        <!-- item 3 -->
        <div class="group rounded-xl shadow-card border overflow-hidden bg-[#ffddcf] hover:-translate-y-2 hover:shadow-xl transition cursor-pointer cursor-pointer gallery-item">
            <div class="h-52 flex items-center justify-center">
            <img src="<?php echo e(asset('images/kegiatan 3.jpg')); ?>" class="w-full h-full object-cover">
          </div>
          <div class="bg-white p-4">
            <div class="font-semibold">Memasak</div>
            <div class="text-sm text-[#6f4f45]">Pasuruan, 2024</div>
          </div>
        </div>

        <!-- item 4 -->
        <div class="group rounded-xl shadow-card border overflow-hidden bg-[#ffddcf] hover:-translate-y-2 hover:shadow-xl transition cursor-pointer cursor-pointer gallery-item">
            <div class="h-52 flex items-center justify-center">
            <img src="<?php echo e(asset('images/kegiatan 4.jpg')); ?>" class="w-full h-full object-cover">
          </div>
          <div class="bg-white p-4">
            <div class="font-semibold">Mengeksplor pelabuhan pasuruan</div>
            <div class="text-sm text-[#6f4f45]">Pasuruan, 2024</div>
          </div>
        </div>

        <!-- item 5 -->
        <div class="group rounded-xl shadow-card border overflow-hidden bg-[#ffddcf] hover:-translate-y-2 hover:shadow-xl transition cursor-pointer cursor-pointer gallery-item">
            <div class="h-52 flex items-center justify-center">
            <img src="<?php echo e(asset('images/kegiatan 5.jpg')); ?>" class="w-full h-full object-cover">
          </div>
          <div class="bg-white p-4">
            <div class="font-semibold">Meditasi bersama pengurus lainnya</div>
            <div class="text-sm text-[#6f4f45]">Pasuruan, 2024</div>
          </div>
        </div>

        <!-- item 6 -->
        <div class="group rounded-xl shadow-card border overflow-hidden bg-[#ffddcf] hover:-translate-y-2 hover:shadow-xl transition cursor-pointer cursor-pointer gallery-item">
            <div class="h-52 flex items-center justify-center">
            <img src="<?php echo e(asset('images/kegiatan 6.jpg')); ?>" class="w-full h-full object-cover">
          </div>
          <div class="bg-white p-4">
            <div class="font-semibold">Bermain basket</div>
            <div class="text-sm text-[#6f4f45]">Pasuruan, 2024</div>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONI -->
    <h2 class="text-2xl font-bold text-[#3b2b25] mt-12 flex items-center gap-2">
      <span class="text-3xl">💬</span> Testimoni Peserta
    </h2>

  <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

  <div class="testi-card bg-white rounded-xl border shadow text-center cursor-pointer relative h-[260px] ">
    <div class="front absolute inset-0 flex flex-col items-center justify-center backface-hidden p-6">
      <div class="card-inner w-full h-full relative">
        <div class="front absolute inset-0 flex flex-col items-center justify-center backface-hidden">
          <img src="<?php echo e(asset('images/Joshua 1.jpg')); ?>" class="w-20 h-20 mx-auto rounded-full object-cover border-4 border-[#ffb38a]">
          <div class="mt-3 font-bold text-lg">Joshua</div>
          <div class="text-sm text-[#a67f6b]">KKN Batch 2022</div>
          <p class="italic mt-3 text-[#6f4f45] px-4">
           "Pengalaman KKN di Pasuruan benar-benar mengubah pandangan saya."
          </p>
        </div>

        <div class="back absolute inset-0 flex items-center justify-center text-center bg-[#fff4eb] rounded-xl p-6 backface-hidden">
          <p class="text-[#6f4f45] leading-relaxed text-sm">
           Joshua aktif membantu dokumentasi dan ikut di program edukasi desa.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- ------------------- -->
  <div class="testi-card bg-white rounded-xl border shadow text-center cursor-pointer relative h-[260px] ">
    <div class="front absolute inset-0 flex flex-col items-center justify-center backface-hidden p-6">
      <div class="card-inner w-full h-full relative">
        <div class="front absolute inset-0 flex flex-col items-center justify-center backface-hidden">
          <img src="<?php echo e(asset('images/Joshua 2.jpg')); ?>" class="w-20 h-20 mx-auto rounded-full object-cover border-4 border-[#ffb38a]">
          <div class="mt-3 font-bold text-lg">Arif Hidayat</div>
          <div class="text-sm text-[#a67f6b]">KKN Batch 2022</div>
          <p class="italic mt-3 text-[#6f4f45] px-4">
            "Saya belajar banyak tentang kehidupan pedesaan."
          </p>
        </div>

        <div class="back absolute inset-0 flex items-center justify-center text-center bg-[#fff4eb] rounded-xl p-6 backface-hidden">
          <p class="text-[#6f4f45] leading-relaxed text-sm">
            Arif banyak terlibat dalam proyek lingkungan dan taman herbal.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- ------------------- -->
  <div class="testi-card bg-white rounded-xl border shadow text-center cursor-pointer relative h-[260px] ">
    <div class="front absolute inset-0 flex flex-col items-center justify-center backface-hidden p-6">
      <div class="card-inner w-full h-full relative">
        <div class="front absolute inset-0 flex flex-col items-center justify-center backface-hidden">
          <img src="<?php echo e(asset('images/Mingyu 1.jpg')); ?>" class="w-20 h-20 mx-auto rounded-full object-cover border-4 border-[#ffb38a]">
          <div class="mt-3 font-bold text-lg">Mingyu</div>
          <div class="text-sm text-[#a67f6b]">KKN Batch 2022</div>
          <p class="italic mt-3 text-[#6f4f45] px-4">
            "FORMAPAS membuat proses KKN terorganisir dan menyenangkan."
          </p>
        </div>

        <div class="back absolute inset-0 flex items-center justify-center text-center bg-[#fff4eb] rounded-xl p-6 backface-hidden">
          <p class="text-[#6f4f45] leading-relaxed text-sm">
            Mingyu adalah koordinator dokumentasi di KKN tahun 2022.
          </p>
        </div>
      </div>
    </div>
  </div>

  </section>

    <!-- GAME -->
    <section id="gameSection"
      class="relative z-[50] mt-16 bg-white border shadow-sm p-6 rounded-xl w-full">

      <div id="introBox" class="text-center">
        <h3 class="text-xl font-bold text-[#ff8a4b]">Cari Tahu Kepribadianmu</h3>
        <p class="text-[#6f4f45] mt-1"><b>KKN Di Langit</b>.</p>
        <button id="startBtn"
          class="mt-3 bg-[#ff8a4b] text-white px-5 py-2 rounded-xl font-bold">Mulai Permainan</button>
      </div>

      <div id="quizBox" class="hidden"></div>

      <!-- Container for question rendering -->
      <div id="questionArea" class="mt-6"></div>

      <!-- Progress bar -->
      <div class="mt-4">
        <div class="flex justify-between text-sm mb-1">
          <span id="qIndex" class="font-semibold">Question 1</span>
          <span id="progressPercent">0%</span>
        </div>

        <div class="w-full bg-gray-200/60 rounded-full h-2 mb-4">
          <div id="progressFill" class="bg-[#ff8a4b] h-2 rounded-full w-0"></div>
        </div>
      </div>
    </section>
  </main>
  <div class="mb-10"></div>

  <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

  <script>
    const isLoggedIn = <?php echo e(auth()->check() ? 'true' : 'false'); ?>;
    document.getElementById("btnDaftarKKN").onclick = () => {
      if (!isLoggedIn) {
          document.getElementById("alertLogin").classList.remove("hidden");
      } else {
          window.location.href = "<?php echo e(route('user.daftar')); ?>"; 
      }
    };

    document.getElementById("alertCancel").onclick = () => {
        document.getElementById("alertLogin").classList.add("hidden");
    };

    /* script.js — versi integrasi cerita Twine
      - 4 kasus (SN, EI, TF, JP)
      - auto-next setelah klik
      - tampilkan Epilog (narasi lengkap) dulu
      - tombol "Lihat Hasil MBTI" untuk menampilkan hasil
      - satu kotak/card (menggunakan questionArea)
    */

    /* ============== DATA CERITA (dari Twine yang kamu kirim) ============== */
    const passages = [
      // Kasus 1: Mobil menghilang -> S / N
      {
        id: 1,
        title: "Chapter 1: Mobil menghilang",
        img: "<?php echo e(asset('images/ilustrasi 1.jpg')); ?>",
        text: `Aku dan 3 orang temanku berangkat bersama menuju desa pelosok. Di semester 5 ini kami bersama ormada membantu masyarakat yang membutuhkan bantuan di daerah pelosok. Kami berempat langsung berangkat menggunakan mobil. Setelah 5 jam perjalanan, kami melihat desa tujuan tepat diatas kabut. Malangnya, mobil kami mogok. Terpaksa kami berhenti ditepi jalan. Aku pun ikut turun dari mobil. Saat aku berbalik, mobil itu hilang. Lenyap bersama teman-temanku. Hanya ada jalan setapak lurus di depan, menuju desa yang terselip di balik kabut putih tebal.

    ''Bagaimana aku harus bereaksi terhadap situasi tersebut?''`,
        choices: [
          { label: `“…Tenang. HP ku tadi ada di jaket. Barang-barangku juga harusnya masih lengkap. Aku cek dulu apa yang tersisa sebelum jalan.”`, set: { MBTI_SN: "S" } },
          { label: `“Kok bisa secepet itu hilangnya? Mobil segede itu nggak mungkin lenyap. Pasti ada yang aneh… atau temen-temanku nggak jauh dari sini.”`, set: { MBTI_SN: "N" } }
        ]
      },

      // Kasus 2: Warga Lokal -> I / E
      {
        id: 2,
        title: "Chapter 2: Warga Lokal",
        img: "<?php echo e(asset('images/ilustrasi 2.jpg')); ?>",
        text: `“Pak! Bu! Permisi! Pak, boleh minta tolong…?” 
        Seruku sambil mempercepat langkah, berharap siapa pun itu bisa membantuku. Orang itu berhenti. Ia menatapku lama—terlalu lama—tanpa satu kata pun. Kemudian perlahan, ia mengangkat tangan dan menunjuk ke arah desa di depan, gerakannya kaku seperti tidak wajar.
        “Terima kasih—eh, pak?”
        Aku menoleh lagi… tapi beliau sudah hilang. Tanpa jejak. Seolah tadi hanya bayangan lewat. Tubuhku bergerak lebih cepat dari pikiranku. Aku setengah berlari menuju desa, berusaha mengusir perasaan tidak enak yang menempel sejak kabut tadi. Sesampainya di pintu masuk desa, terlihat sebuah pos kecil. Seorang satpam duduk di dalamnya.

    ''Bagaimana pendapatmu dari sikap warga lokal tersebut?''`,
        choices: [
          { label: `"Kayaknya emang nggak mau diajak ngomong… ya sudah. Petunjuknya jelas kok, tinggal jalan aja."`, set: { MBTI_EI: "I" } },
          { label: `"Nggak enak kalau cuma diam. Setidaknya aku coba nanya sekali lagi… siapa tahu dia mau jawab."`, set: { MBTI_EI: "E" } }
        ]
      },

      // Kasus 3: Satpam Desa -> T / F
      {
        id: 3,
        title: "Chapter 3: Satpam desa",
        text: `“Permisi, Pak… apa benar ini desa xxxx?” tanyaku pelan.
        Orang itu—entah siapa—hanya diam menatapku. Sama seperti sebelumnya: tidak ada ekspresi, tidak ada jawaban. Sejenak aku menunggu, berharap ia sekadar terlambat merespons. Tidak. Sama sekali tidak bergerak. Perasaan aneh dari awal perjalanan kembali muncul.
        Aku mencoba terdengar sopan, “Saya dari Forum Mahasiswa Pasuruan.... ada keperluan di desa ini.”
        Tetap tidak ada reaksi apapun. Akhirnya aku memutuskan untuk memasuki desa, melewati jalan setapak yang naik-turun mengikuti lekuk pegunungan. Lima menit kemudian, suasananya berubah drastis. Rumah-rumah kecil tampak hidup; orang-orang menjemur pakaian, mengangkat hasil panen, atau mengobrol di teras. Berbeda sekali dengan sikap penjaga tadi yang terlalu diam. Aku berhenti di bawah pohon besar untuk mengusap leher dan menarik napas. Tapi bayangan wajah penjaga tadi tetap mengganggu pikiran.

    ''Apa orang - orang disini seperti itu?''`,
        choices: [
          { label: `“Nggak usah dibesar-besarin deh… lanjut aja.”`, set: { MBTI_TF: "T" } },
          { label: `“Ada yang nggak beres… kok rasanya nggak enak ninggalin gitu aja?”`, set: { MBTI_TF: "F" } }
        ]
      },

      // Kasus 4: Anak kecil -> J / P
      {
        id: 4,
        title: "Chapter 4: Anak kecil",
        img: "<?php echo e(asset('images/ilustrasi 3.jpg')); ?>",
        text: `Saat aku masih duduk di bawah pohon, seorang anak kecil tiba-tiba muncul dari arah samping. Entah sejak kapan ia di sana—aku bahkan tidak mendengar langkahnya. 
        “Kakak capek, ya…?” tanyanya pelan, suaranya terdengar sangat polos.
        Aku hanya mengangguk kecil. Kehadirannya terasa mengejutkan, apalagi setelah suasana aneh sejak pintu masuk desa tadi. Tapi anak ini berbeda—terlihat benar-benar hangat dan apa adanya. Beberapa menit berlalu begitu saja. Tanpa sadar aku mengobrol dengannya, atau lebih tepatnya: ia bercerita panjang lebar, dan aku mendengarkan. Tentang bunga, tentang rumahnya, tentang sungai kecil di belakang desa. Tiba-tiba ia mengulurkan sesuatu.
        “Ini buat kakak.”
        Aku menatap tangannya—bunga krisan kecil, kelopak putihnya lembut dan segar.
        “Oh… cantik sekali,” gumamku. “Terima kasih ya.”
        Anak itu tersenyum lebar, seolah bangga bisa membuatku senang. Sebagai balasan spontan, aku mengeluarkan sebuah buku diary kecil dari tas.
        “Kalau gitu… kakak punya ini. Anggap aja buku cerita, ya.” Matanya langsung berbinar. 

    ''Selanjutnya aku harus apa?''`,
        choices: [
          { label: `Aku menyerahkan diary itu dengan senyum kecil, lalu perlahan menjaga jarak. Meski anak itu tampak ingin terus bercerita, aku tahu aku harus kembali melanjutkan perjalanan.`, set: { MBTI_JP: "J" } },
          { label: `Aku memberikan diary itu sambil ikut duduk lebih nyaman, membiarkan diriku tinggal sedikit lebih lama untuk mendengarkan ceritanya`, set: { MBTI_JP: "P" } }
        ]
      }
    ];

    /* ============== STATE ============== */
    let currentIndex = 0; // 0..3
    const MBTI = { MBTI_SN: "", MBTI_EI: "", MBTI_TF: "", MBTI_JP: "" };
    let answers = []; // store letters per case if needed

    /* ============== DOM refs ============== */
    const startBtn = document.getElementById("startBtn");
    const introBox = document.getElementById("introBox");
    const quizBox = document.getElementById("quizBox");
    const questionArea = document.getElementById("questionArea");
    const qIndexTxt = document.getElementById("qIndex");
    const progressPercent = document.getElementById("progressPercent");
    const progressFill = document.getElementById("progressFill");

    /* ============== START ============== */
    startBtn.addEventListener("click", () => {
      introBox.classList.add("hidden");
      quizBox.classList.remove("hidden");
      currentIndex = 0;
      answers = [];
      MBTI.MBTI_SN = MBTI.MBTI_EI = MBTI.MBTI_TF = MBTI.MBTI_JP = "";
      renderPassage(currentIndex);
      updateProgress();
      // scroll into view
      document.getElementById("gameSection").scrollIntoView({ behavior: "smooth", block: "start" });
    });

    /* ============== RENDERING ============== */
    function renderPassage(idx) {
      const p = passages[idx];
      qIndexTxt.textContent = `Case ${idx + 1}`;
      // progress percent will be updated by updateProgress()

      // Render narrative + choices as buttons
      // Keep styling similar to your existing option card
      questionArea.innerHTML = `
        <div class="bg-white rounded-2xl p-6 border border-[#f2e3d8] shadow-card">

          <!-- ILUSTRASI CHAPTER -->
          <h3 class="text-lg font-semibold mb-4 text-center">${p.title}</h3>
          <img src="${p.img}" 
              class="w-full max-w-[360px] mx-auto mb-6 rounded-xl shadow-md object-cover">

          <div class="prose text-[#5a3f36] whitespace-pre-line mb-6">
            ${escapeHtml(p.text)}
          </div>

          <div class="flex flex-col gap-4">
            <button data-choice="A"
              class="choice-btn option w-full text-left px-5 py-4 rounded-xl bg-[#e8c2a0] text-[#3b2b25] hover:bg-[#d9b08c] transition font-medium">
              ${escapeHtml(p.choices[0].label)}
            </button>

            <button data-choice="B"
              class="choice-btn option w-full text-left px-5 py-4 rounded-xl bg-[#e8c2a0] text-[#3b2b25] hover:bg-[#d9b08c] transition font-medium">
              ${escapeHtml(p.choices[1].label)}
            </button>
          </div>

        </div>
  `;

      // attach listeners
      Array.from(questionArea.querySelectorAll(".choice-btn")).forEach((btn, i) => {
        btn.addEventListener("click", () => {
          // visual feedback
          Array.from(questionArea.querySelectorAll(".choice-btn")).forEach(b => {
            b.classList.remove("ring-2", "ring-[#ff8a4b]", "bg-[#ffd4b8]");
            b.classList.add("bg-[#e8c2a0]");
          });
          btn.classList.add("ring-2", "ring-[#ff8a4b]", "bg-[#ffd4b8]");

          // set MBTI letter for this passage
          const chosen = p.choices[i].set;
          // each set object has one property like { MBTI_SN: "S" }
          for (const k in chosen) {
            MBTI[k] = chosen[k];
          }
          // store readable answer (optional)
          answers[currentIndex] = Object.values(chosen)[0];

          // auto-next (delay so user sees selected style)
          setTimeout(() => {
            if (currentIndex < passages.length - 1) {
              currentIndex++;
              renderPassage(currentIndex);
              updateProgress();
            } else {
              // last case answered → show epilog (inside same card)
              showEpilog();
              updateProgress(); // should show 100%
            }
          }, 300);
        });
      });
    }

    /* ============== UPDATE PROGRESS ============== */
    function updateProgress() {
      const answeredCount = answers.filter(a => a !== undefined && a !== null && a !== "").length;
      const total = passages.length;
      const percent = Math.round((answeredCount / total) * 100);
      progressPercent.textContent = percent + "%";
      progressFill.style.width = percent + "%";
      qIndexTxt.textContent = answeredCount < total ? `Question ${answeredCount + 1}` : `Selesai`;
    }

    /* ============== EPILOG ============== */
    function showEpilog() {
      const epilogText = `Beberapa menit setelah anak kecil itu kembali ke arah rumah-rumah warga, aku mendengar suara langkah orang dewasa—terburu-buru dan saling memanggil. Suasananya berbeda dari tadi, seperti ada rombongan yang baru saja sampai. Dua pria muncul dari ujung jalan: Yang satu memakai batik dengan ID card kampus tergantung di lehernya, dan yang satu lagi memakai pakaian lurik khas perangkat desa.
    Pria dari kampus itu terlihat paling panik.
    “Kami dari pihak sekolah… mohon maaf atas kelalaian kami,” katanya sambil menunduk dalam.
    Kepala desa menimpali dengan suara pelan, “Oh tidak, Pak. Saya justru ikut berduka cita atas kejadian ini…”
    Aku memandang mereka, mencoba memahami. Namun ada sesuatu yang mulai terasa ganjil—mereka berbicara seolah aku tidak ada di sana. Dari belakang kepala desa, anak kecil itu muncul sambil memeluk diary yang tadi kuberikan.
    “Ayah… siapa ini?” ia menunjuk ke arah orang yang memakai ID card.
    Kepala desa menoleh ke anaknya, tapi matanya tidak mengikuti arah jari si kecil.
    “Eh… itu orang-orang dari kampus. Mereka… mereka yang harusnya datang tadi.”
    Pria dari kampus itu menarik napas panjang, lalu berjongkok di depan si anak kecil.
    “Adek… maaf ya. Kakak-kakak mahasiswa itu… nggak jadi datang ke desa hari ini. Ada insiden di perjalanan.”
    Anak itu menggeleng cepat, kedua matanya memerah. “Bohong! Kakaknya tadi baik banget! Kakaknya gambar buat aku! Ini buktinya!” Ia mengangkat diary lusuh itu tinggi-tinggi.
    Sementara pria kampus dan kepala desa saling bertukar pandang kebingungan…
    …aku baru menyadari satu hal. Tidak satu pun dari mereka menatap ke arahku. Bukan karena tidak melihat—tapi karena tidak bisa dilihat.

    Bukan sekedar berangkat, nikmati waktumu yang ada.`;

      questionArea.innerHTML = `
        <div class="bg-white rounded-2xl p-6 border border-[#f2e3d8] shadow-card">
          <h3 class="text-xl font-bold text-center mb-4">After Story — Epilog</h3>
          <div class="prose text-[#5a3f36] whitespace-pre-line mb-6">${escapeHtml(epilogText)}</div>

          <div class="mt-4 text-center">
            <button id="viewMbtiBtn" class="px-5 py-2 bg-[#ff8a4b] text-white rounded-xl font-bold">
              Lihat Hasil MBTI
            </button>
          </div>
        </div>
      `;

      const viewBtn = document.getElementById("viewMbtiBtn");
      if (viewBtn) {
        viewBtn.addEventListener("click", () => {
          showMBTIResult();
        });
      }

      progressPercent.textContent = "100%";
      progressFill.style.width = "100%";
      qIndexTxt.textContent = "Epilog";
    }

    /* ============== Menunjukkan hasil MBTI ============== */

    function showMBTIResult() {
      const code = `${MBTI.MBTI_EI}${MBTI.MBTI_SN}${MBTI.MBTI_TF}${MBTI.MBTI_JP}`;

      const explain_SN =
        MBTI.MBTI_SN === "S"
          ? "Ia merespons berdasarkan apa yang benar-benar ia lihat dan alami, tetap bertumpu pada hal-hal konkret meski situasinya tidak wajar."
          : "Ia lebih mengikuti firasat dan gambaran yang terbentuk di benaknya, merasakan ada sesuatu yang janggal bahkan sebelum ia memahaminya.";

      const explain_EI =
        MBTI.MBTI_EI === "E"
          ? "Ia tetap mencari hubungan—bahkan ketika orang yang ditemuinya terasa misterius—karena kehangatan manusia selalu menjadi kompasnya."
          : "Ia memilih menjaga jarak, memproses semuanya dalam diam, dan mengandalkan ruang pribadi sebagai tempat berpikir.";

      const explain_TF =
        MBTI.MBTI_TF === "T"
          ? "Ia berusaha memahami situasi dengan logika, menyusun langkah-langkah rasional meski suasananya sulit dijelaskan."
          : "Ia membiarkan empati dan perasaannya menuntun interaksi, memberi ruang bagi intuisi emosionalnya untuk memilih.";

      const explain_JP =
        MBTI.MBTI_JP === "J"
          ? "Ia tetap berpegang pada tujuan dan batasan yang jelas, mencoba menjaga arah meski dunia di sekelilingnya berubah."
          : "Ia membiarkan diri mengikuti arus, menerima momen-momen tak terduga dengan hati yang terbuka.";

      questionArea.innerHTML = `
        <div class="max-w-3xl mx-auto text-center p-8 bg-white rounded-3xl shadow-card animate-pop relative">

          <h2 class="text-3xl font-bold text-[#c85a2f] mb-3">Hasil MBTI Kamu</h2>
          <p class="text-[#6f4f45] mb-6">
            Berdasarkan pilihanmu sepanjang cerita, tipe kepribadian yang muncul adalah:
          </p>

          <div class="mx-auto w-36 h-36 rounded-full bg-gradient-to-br from-[#ffb38a] to-[#ff7a3d] 
                      flex items-center justify-center text-white text-2xl font-extrabold mb-6 animate-bounce">
            ${code}
          </div>

          <h3 class="text-xl font-bold mb-4">Ringkasan</h3>
          <p class="text-[#6f4f45] mb-10">
            Gabungan karakter ini mencerminkan preferensi kepribadianmu selama KKN.
          </p>

          <!-- ANALISIS SECTION -->
          <div class="text-left max-w-2xl mx-auto text-[#5a3f36] leading-relaxed">

            <h3 class="text-xl font-bold mb-3">Analisis Kepribadian</h3>
            <p class="mb-4">
              Perjalanan singkatdi desa itu—antara keheningan, interaksi ganjil,
              dan pertemuan hangat—mencerminkan sisi terdalam dari dirinya.
            </p>

            <p class="font-semibold mt-4">Reaksi Awal terhadap Tragedi (S/N): <span class="text-[#c85a2f] font-bold">${MBTI.MBTI_SN}</span></p>
            <p class="mb-4">${explain_SN}</p>

            <p class="font-semibold mt-4">Cara Berinteraksi (E/I): <span class="text-[#c85a2f] font-bold">${MBTI.MBTI_EI}</span></p>
            <p class="mb-4">${explain_EI}</p>

            <p class="font-semibold mt-4">Mengolah Misteri (T/F): <span class="text-[#c85a2f] font-bold">${MBTI.MBTI_TF}</span></p>
            <p class="mb-4">${explain_TF}</p>

            <p class="font-semibold mt-4">Penerimaan Keadaan (J/P): <span class="text-[#c85a2f] font-bold">${MBTI.MBTI_JP}</span></p>
            <p class="mb-6">${explain_JP}</p>

            <p class="font-bold text-center mt-6">
              Berdasarkan pilihan-pilihan itu, tipe kepribadian Kamu adalah:
              <span class="text-[#c85a2f] font-extrabold">${code}</span>
            </p>
          </div>

          <div class="flex justify-center gap-4 mt-10">
            <button id="restartBtn" class="px-5 py-2 bg-[#ff8a4b] text-white rounded-xl font-bold">Coba Lagi</button>
            <?php if(auth()->guard()->check()): ?>
            <button id="saveMbtiBtn"
              class="px-5 py-2 bg-[#ff8a4b] text-white rounded-xl font-bold">
              Simpan MBTI
            </button>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('auth', ['action' => 'register'])); ?>" class="px-5 py-2 bg-[#ff8a4b] text-white rounded-xl font-bold text-white">
                    Login untuk menyimpan hasil MBTI
                </a>
            <?php endif; ?>
          </div>

        </div>
      `;

      document.getElementById("saveMbtiBtn")?.addEventListener("click", () => {
          simpanMBTI(code);
      });

      document.getElementById("restartBtn").addEventListener("click", restartQuiz);
      runConfetti();
    }

    function simpanMBTI(mbti) {
    fetch("<?php echo e(route('kkn.mbti.save')); ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ mbti })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    })
    .catch(err => console.error(err));
   }

    /* ============== Mulai Ulang ============== */
    function restartQuiz() {
      currentIndex = 0;
      answers = [];
      MBTI.MBTI_SN = MBTI.MBTI_EI = MBTI.MBTI_TF = MBTI.MBTI_JP = "";
      
      introBox.classList.remove("hidden");
      quizBox.classList.add("hidden");
      questionArea.innerHTML = "";
      progressPercent.textContent = "0%";
      progressFill.style.width = "0%";
      qIndexTxt.textContent = "Question 1";
      document.getElementById("gameSection").scrollIntoView({ behavior: "smooth", block: "start" });
    }

    function escapeHtml(str) {
      return String(str)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#39;")
        .replace(/\n/g, "<br>");
    }

    const cards = document.querySelectorAll(".testi-card");

    // flip on click
    cards.forEach(card => {
      card.addEventListener("click", () => {
        card.classList.toggle("flipped");
      });
    });

    function revealTesti() {
      cards.forEach(card => {
        const rect = card.getBoundingClientRect();
        if (rect.top < window.innerHeight - 80) {
          card.classList.add("show");
        }
      });
    }

    window.addEventListener("scroll", revealTesti);
    window.addEventListener("load", revealTesti);

  function runConfetti() {
    var duration = 3 * 1000;
    var animationEnd = Date.now() + duration;
    var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 3000 };

    function randomInRange(min, max) {
      return Math.random() * (max - min) + min;
    }

    var interval = setInterval(function () {
      var timeLeft = animationEnd - Date.now();

      if (timeLeft <= 0) {
        return clearInterval(interval);
      }

      var particleCount = 50 * (timeLeft / duration);

      confetti(Object.assign({}, defaults, {
        particleCount,
        origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
      }));

      confetti(Object.assign({}, defaults, {
        particleCount,
        origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
      }));
    }, 250);
  }
</script>

</body>
</html><?php /**PATH C:\laragon\www\UAS\resources\views/kkn.blade.php ENDPATH**/ ?>