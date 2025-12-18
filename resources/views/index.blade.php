<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMAPAS | Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.12.4/build/spline-viewer.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#FFF4E6] text-gray-800">

    @include('header')

    <div class="grid grid-cols-1 sm:grid-cols-2 items-center gap-6 px-6 mt-20 pt-24 pb-16">
        <div class="flex justify-center">
            <spline-viewer
                url="https://prod.spline.design/GfhIy6-rZoRJ878u/scene.splinecode"> 
            </spline-viewer>
        </div>
        <div class="flex flex-col justify-center px-4 sm:px-0">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                <span class="text-[#db5400]">Hai, We Are</span><br>
                <span class="text-[#ff9336]">FORMAPAS</span>
            </h1>
            <p class="text-lg md:text-xl opacity-80 mb-6 max-w-md">
                Kami merupakan Organisasi Mahasiswa Daerah yang berasal dari Pasuruan. Daerah bisa ditempuh cukup 1 jam dari Surabaya.
            </p>
            <a href="{{ route('kkn') }}" class="bg-[#db5400] text-white px-5 py-3 rounded-lg shadow-md hover:shadow-lg hover:bg-[#e87c09cc] transition w-max">
                Learn Our Speciality Program
            </a>
            <p class="mt-4 text-sm italic text-gray-600">
                // Interact with the 3D model by drag, pinch or click ( saki's, cabin, bridge)
            </p>
        </div>
        <div class="h-20"></div>
    </div>

    <section
    id="aboutSection"
    class="relative min-h-[600px] overflow-hidden flex items-center"
    >
        <!-- BACKGROUND SLIDER -->
        <div id="bgSlider" class="absolute inset-0 flex transition-transform duration-1000 ease-in-out"></div>

        <!-- OVERLAY -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- RIGHT CONTENT WRAPPER -->
        <div class="relative z-10 w-full max-w-6xl mx-auto px-6">
            <div class="flex justify-end">
                
                <!-- ABOUT US PANEL -->
                <div class="w-full md:w-[55%] lg:w-[45%] text-white">

                    <!-- TITLE -->
                    <h2 class="text-4xl font-bold mb-2 text-right">
                        About Us
                    </h2>

                    <div class="flex justify-end mb-6">
                        <div class="w-16 h-1 bg-white"></div>
                    </div>

                    <!-- GLASS CARD -->
                    <div class="backdrop-blur-xl bg-white/20 rounded-2xl p-6 shadow-xl border border-white/30">

                        <!-- TAB BUTTON -->
                        <div class="flex flex-wrap gap-3 mb-6 justify-end">
                            <button onclick="changeTab('visimisi', event)"
                                class="tabBtn bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold shadow-lg scale-105 transition">
                                Visi & Misi
                            </button>
                            <button onclick="changeTab('gathering', event)"
                                class="tabBtn bg-white/30 text-white px-4 py-2 rounded-lg font-semibold transition">
                                Gathering
                            </button>
                            <button onclick="changeTab('study', event)"
                                class="tabBtn bg-white/30 text-white px-4 py-2 rounded-lg font-semibold transition">
                                Study Together
                            </button>
                        </div>

                        <!-- CONTENT -->
                        <div class="bg-black/20 rounded-xl p-5 min-h-[180px] border border-white/30">

                            <div id="visimisi" class="tabContent block">
                                <h3 class="text-2xl font-bold mb-3 flex items-center gap-2">
                                    ✨ Visi & Misi
                                </h3>
                                <p class="leading-relaxed">
                                    Sebagai wadah pemuda dan mahasiswa, kami hadir menjadi katalisator perubahan.
                                </p>
                            </div>

                            <div id="gathering" class="tabContent hidden">
                                <h3 class="text-2xl font-bold mb-3">🤝 Gathering</h3>
                                <p>Kegiatan rutin untuk mempererat hubungan dan solidaritas.</p>
                            </div>

                            <div id="study" class="tabContent hidden">
                                <h3 class="text-2xl font-bold mb-3">🧠 Study Together</h3>
                                <p>Belajar bareng dan saling bantu memahami materi.</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="py-16 px-6 bg-white">
        <h2 class="text-4xl font-bold text-center mb-2">Latest News</h2>
        <hr class="border-t-4 border-[#FF7A00] w-20 mx-auto mb-2">
        <div class="w-20 h-1 bg-[#FF7A00] mx-auto mb-6"></div>

        <div id="news" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($news as $item)
                <div class="news-card bg-[#FFF4E6] rounded-2xl shadow-md hover:shadow-lg hover:shadow-[#FF7A00]/50 transition overflow-hidden">
                    <img src="{{ asset('storage/'.$item->FOTO_NEWS) }}"
                        class="w-full h-48 object-cover">

                    <div class="p-5 text-left">
                        <h3 class="text-xl font-bold mb-2 text-[#db5400]">
                            {{ $item->JUDUL_NEWS }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-3">
                            {{ $item->LOKASI_NEWS }}
                        </p>

                        <p class="text-gray-700 text-sm line-clamp-3">
                            {{ $item->ISI_NEWS }}
                        </p>

                        <button
                            class="mt-3 px-4 py-2 bg-[#ffa552] text-white rounded-lg shadow hover:bg-[#ff7a00] transition readMoreBtn"
                            data-title="{{ $item->JUDUL_NEWS }}"
                            data-img="{{ asset('storage/'.$item->FOTO_NEWS) }}"
                            data-date="{{ $item->LOKASI_NEWS }}"
                            data-content="{{ $item->ISI_NEWS }}"
                        >
                            Read More
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div class="h-20"></div>

  @include('footer')
    <div id="newsModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center px-4">
    <div class="bg-white max-w-2xl w-full rounded-2xl p-6 shadow-xl relative">
        <button id="closeModal" class="absolute top-3 right-3 text-xl">✖</button>

        <img id="modalImg" class="w-full h-64 object-cover rounded-xl mb-4">
        <h3 id="modalTitle" class="text-2xl font-bold mb-2"></h3>
        <p id="modalDate" class="text-sm text-gray-500 mb-4"></p>
        <p id="modalContent" class="text-gray-700"></p>
    </div>
    </div>

<script>
    const backgrounds = [
        "/images/bg.JPG",
        "/images/bg2.JPG",
        "/images/bg3.JPG",
        "/images/bg4.JPG"
    ];

    const section = document.getElementById("aboutSection");
    const slider = document.createElement("div");       // container slider
    slider.className =
        "absolute inset-0 flex transition-transform duration-1000 ease-in-out";
    section.prepend(slider);

    backgrounds.forEach(img => {
        const slide = document.createElement("div");
        slide.className = "min-w-full bg-cover bg-center";
        slide.style.backgroundImage = `url('${img}')`;
        slider.appendChild(slide);
    });

    let index = 0;

    setInterval(() => {
        index = (index + 1) % backgrounds.length;
        slider.style.transform = `translateX(-${index * 100}%)`;
    }, 5000);

    function changeTab(id, e) {

        document.querySelectorAll('.tabContent')
            .forEach(c => c.classList.add('hidden'));

        document.getElementById(id).classList.remove('hidden');

        document.querySelectorAll('.tabBtn').forEach(btn => {
            btn.classList.remove(
                'bg-[#FF7A00]', 'text-white',
                'shadow-[0_0_10px_rgba(255,122,0,0.6)]', 'scale-105'
            );
            btn.classList.add(
                'bg-[#FF7A00]/40', 'text-black'
            );
        });

        e.target.classList.remove('bg-[#FF7A00]/40', 'text-black');
        e.target.classList.add(
            'bg-[#FF7A00]', 'text-white',
            'shadow-[0_0_10px_rgba(255,122,0,0.6)]', 'scale-105'
        );
    }

    // =============== Modal ===============
    function initModal() {
        const modal = document.getElementById("newsModal");
        const closeModal = document.getElementById("closeModal");

        document.querySelectorAll(".readMoreBtn").forEach(btn => {
            btn.addEventListener("click", () => {
                document.getElementById("modalTitle").innerText = btn.dataset.title;
                document.getElementById("modalContent").innerText = btn.dataset.content;
                document.getElementById("modalImg").src = btn.dataset.img;
                document.getElementById("modalDate").innerText = btn.dataset.date;

                modal.classList.remove("hidden");
                modal.classList.add("flex");
            });
        });

        closeModal.onclick = () => modal.classList.add("hidden");
    }

    </script>

</body>
</html>
