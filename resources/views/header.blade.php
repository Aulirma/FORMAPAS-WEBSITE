<header 
    id="header-utama" 
    class="fixed top-0 left-0 w-full bg-white shadow-md py-3 z-[1000] transition-all duration-300 "
>
    <div class="max-w-[1200px] mx-auto px-5 flex items-center">

        <!-- Logo -->
        <div class="flex items-center gap-3 min-w-[200px]">
            <img src="{{ asset('images/Formapas Logo.png') }}" alt="Logo" class="w-10 h-auto">
            <div class="leading-tight">
                <h1 class="text-[18px] font-bold text-[#333]">FORMAPAS</h1>
                <span class="text-[12px] text-[#666]">Forum Mahasiswa Pasuruan</span>
            </div>
        </div>

        <!-- Nav Menu -->
        <nav class="flex-1 hidden md:flex justify-center">
            <ul class="flex gap-6">
                <li>
                    <a href="{{ route('home') }}"id="home"
                       class="nav-link text-[#333] font-medium text-[15px] py-2 px-4 rounded-lg hover:text-[#ff9336] transition">
                       Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('toko') }}" id="toko"
                       class="nav-link text-[#333] font-medium text-[15px] py-2 px-4 rounded-lg hover:text-[#ff9336] transition">
                       Toko
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengurus') }}" id="pengurus"
                       class="nav-link text-[#333] font-medium text-[15px] py-2 px-4 rounded-lg hover:text-[#ff9336] transition">
                       Pengurus
                    </a>
                </li>
                <li>
                    <a href="{{ route('kkn') }}" id="kkn"
                       class="nav-link text-[#333] font-medium text-[15px] py-2 px-4 rounded-lg hover:text-[#ff9336] transition">
                       KKN
                    </a>
                </li>
            </ul>
        </nav>
        <div class="flex items-center gap-4 min-w-[200px] justify-end">
            <button class="hidden md:block text-[#333] text-[18px] p-1 hover:text-[#db5400] transition">
                <i class="fa-regular fa-moon"></i>
            </button>
            @guest
                <!-- Jika belum login -->
                <a href="{{ route('auth', ['action' => 'register']) }}" 
                class="hidden md:block bg-[#db5400] text-white font-semibold text-[15px] py-2.5 px-6 rounded-lg shadow-md transition hover:bg-[#e87c09cc] hover:-translate-y-1">
                Join Us
                </a>
            @endguest

            @auth
            <!-- Jika sudah login -->
                <div class="relative hidden md:flex items-center gap-3">
                    <button id="profileButton"
                        class="bg-[#db5400] text-white font-semibold text-[15px] py-2.5 px-6 rounded-lg shadow-md 
                        transition hover:bg-[#e87c09cc] hover:-translate-y-1">
                        Hi, {{ Auth::user()->USER_NAME ?? 'User' }}
                    </button>

                    <div id="profileMenu" class="hidden absolute top-full right-0 mt-2 w-64 bg-white shadow-xl border rounded-xl p-4 z-50 transition">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-xl">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->USER_NAME }}</p>
                                <p class="text-gray-500 text-sm">{{ Auth::user()->USER_EMAIL }}</p>
                            </div>
                        </div>

                        <hr class="my-3">

                        <a href="{{ route('user.setting') }}" class="block text-gray-700 hover:text-[#db5400] px-1 py-1">✏ Setting Akun</a>
                        <a href="{{ route('user.daftar') }}" class="block text-gray-700 hover:text-red-600 px-1 py-1">🏃‍♀️ Status KKN</a>
                        <a href="{{ route('user.merch') }}" class="block text-gray-700 hover:text-red-600 px-1 py-1">🛒 Status Merchandise</a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full text-left text-gray-700 hover:text-[#db5400] px-1 py-1 mt-2">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth            
        </div>
    </div>
</header>

<script>
    const header = document.getElementById('header-utama');
    const btn = document.getElementById('profileButton');
    const menu = document.getElementById('profileMenu');
    // OPEN ACCOUNT SETTING FLOATING WINDOW
    document.addEventListener("DOMContentLoaded", () => {
        const btn = document.getElementById("profileButton");
        const menu = document.getElementById("profileMenu");

        if (btn && menu) {
            btn.addEventListener("click", (e) => {
                e.stopPropagation();
                menu.classList.toggle("hidden");
            });

            document.addEventListener("click", (e) => {
                if (!menu.contains(e.target)) {
                    menu.classList.add("hidden");
                }
            });
        }
    });
    // ANIMASI KETIKA SCROLL
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('opacity-95', 'backdrop-blur-md');
            header.style.backgroundColor = 'rgba(255, 255, 255, 0.75)';
        } else {
            header.classList.remove('opacity-95', 'backdrop-blur-md');
            header.style.backgroundColor = 'white';
        }
    });
    // NAVBAR ACTIVE LINK
    (function () {
        const path = window.location.pathname.toLowerCase();

        const home = document.getElementById("home");
        const toko = document.getElementById("toko");
        const pengurus = document.getElementById("pengurus");
        const kkn = document.getElementById("kkn");

        const active = "text-[#333] font-medium text-[15px] py-2 px-4 rounded-lg bg-[#f8e1ca] text-[#ff6600] font-semibold transition";
        const normal = "text-[#333] font-medium text-[15px] py-2 px-4 rounded-lg hover:text-[#ff9336] transition";

        // reset kondisi
        home.className = "nav-link " + normal;
        toko.className = "nav-link " + normal;
        pengurus.className = "nav-link " + normal;
        kkn.className = "nav-link " + normal;

        // aturan aktif
        if (path === "/index" ) {
            home.className = "nav-link " + active;
        } 
        else if (path === "/toko") {
            toko.className = "nav-link " + active;
        }
        else if (path === "/pengurus") {
            pengurus.className = "nav-link " + active;
        }
        else if (path === "/kkn") {
            kkn.className = "nav-link " + active;
        }
    })();
</script>