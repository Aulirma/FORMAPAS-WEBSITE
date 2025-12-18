<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>FORMAPAS Merchandise</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#FFF4E6]">
  @include('header')
  <main class="pt-10 pb-16 mx-auto px-6 max-w-7xl">
    <section class="pt-15 pb-10 mt-20 text-center">
      <h1 class="text-4xl md:text-5xl font-extrabold text-orange-600">
        FORMAPAS Merchandise
      </h1>
      <p class="text-gray-600 mt-2">
        Dukung organisasi kami dengan membeli merchandise resmi
      </p>
    </section>

    <div class="flex flex-col md:flex-row justify-center gap-4 mt-6 mb-12">
      <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl w-full md:w-72 shadow-sm border">
        <i class="fa-light fa-magnifying-glass"></i>
        <input id="searchInput" type="text" placeholder="Search merchandise..." class="w-full outline-none">
      </div>

      <select id="categoryFilter" class="px-4 py-2 rounded-xl border border-gray-300 bg-white">
        <option value="All">All Categories</option>
        <option value="Clothing">Clothing</option>
        <option value="Accessories">Accessories</option>
        <option value="Stationery">Stationery</option>
      </select>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start relative">

      <div class="lg:col-span-2 w-full">
        
        <section class="bg-white/80 rounded-xl p-6 md:p-10 mb-12 border shadow-sm">
          <h2 class="text-2xl font-bold text-center mb-8">🔥 PAKET HEMAT</h2>
          <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-2xl p-4 shadow-md border hover:shadow-lg transition">
              <img src="images/1.png" class="w-full h-40 object-cover rounded-xl bg-gray-100">
              <h3 class="mt-4 text-center font-semibold">Bundle 1</h3>
              <p class="text-center text-orange-600 font-bold">Rp 75.000</p>
              <button onclick="addItem(111, 'Bundle 1', 75000)"" class="mt-4 w-full bg-orange-600 text-white py-2 rounded-xl hover:bg-orange-700 transition">
                Add to Cart
              </button>
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-md border hover:shadow-lg transition">
              <img src="images/2.png" class="w-full h-40 object-cover rounded-xl bg-gray-100">
              <h3 class="mt-4 text-center font-semibold">Bundle 2</h3>
              <p class="text-center text-orange-600 font-bold">Rp 150.000</p>
              <button onclick="addItem(112, 'Bundle 2',150000)" class="mt-4 w-full bg-orange-600 text-white py-2 rounded-xl hover:bg-orange-700 transition">
                Add to Cart
              </button>
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-md border hover:shadow-lg transition">
              <img src="images/3.png" class="w-full h-40 object-cover rounded-xl bg-gray-100">
              <h3 class="mt-4 text-center font-semibold">Bundle 3</h3>
              <p class="text-center text-orange-600 font-bold">Rp 50.000</p>
              <button onclick="addItem(113, 'Bundle 3',50000)" class="mt-4 w-full bg-orange-600 text-white py-2 rounded-xl hover:bg-orange-700 transition">
                Add to Cart
              </button>
            </div>

          </div>
        </section>

        <h2 class="mb-6 text-2xl font-bold text-gray-800">ORIGINAL PRODUCT</h2>
        <section id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        </section>
      </div>
      <div class="lg:col-span-1 sticky top-24 space-y-6">
        
        <section class="bg-white p-6 rounded-xl shadow border border-orange-100">
          <h2 class="text-xl font-bold mb-4 flex items-center gap-2">🛒 Keranjang Belanja</h2>
          <div id="cartItems" class="space-y-3 max-h-[60vh] overflow-y-auto custom-scrollbar">
            <p class="text-gray-400 text-sm text-center py-4 italic empty-msg">Belum ada item</p>
          </div>
          <hr class="my-4">

          <div class="flex justify-between items-center font-bold text-lg">
            <span>Total</span>
            <span id="cartTotal" class="text-orange-600">Rp 0</span>
          </div>

          <button onclick="openCheckout()" class="mt-6 bg-orange-600 hover:bg-orange-700 transition text-white px-4 py-3 rounded-xl w-full font-bold shadow-lg shadow-orange-200">
            Checkout Sekarang
          </button>
        </section>

      <section id="checkout" class="hidden bg-white p-6 rounded-xl shadow border border-orange-100 animate-fade-in">
        <h2 class="text-xl font-bold mb-4">📦 Data Pengiriman</h2>

        <div class="mb-3">
          <label class="text-xs text-gray-500 font-bold ml-1">Nama Lengkap</label>
          <input id="checkoutNama" type="text" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 {{ Auth::check() ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}" 
            placeholder="Nama Lengkap" value="{{ Auth::check() ? Auth::user()->USER_NAME : '' }}" {{ Auth::check() ? 'readonly' : '' }}
          >
        </div>

        <div class="mb-3">
          <label class="text-xs text-gray-500 font-bold ml-1">Alamat Pengiriman</label>
          <textarea id="checkoutAlamat" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-orange-500" rows="2" 
            placeholder="Alamat Lengkap (Jalan, RT/RW, Kecamatan)" 
          ></textarea>
        </div>

        <div class="mb-4">
          <label class="text-xs text-gray-500 font-bold ml-1">Nomor WhatsApp</label>
          <input id="checkoutHp" type="text" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-orange-500" 
            placeholder="Contoh: 08123456789" value="{{ Auth::check() ? Auth::user()->NO_HP : '' }}"
          >
        </div>
        
        <button onclick="validateAndPay()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-xl w-full font-bold transition shadow-lg shadow-green-200">
          Bayar via QRIS
        </button>
        
        <button onclick="document.getElementById('checkout').classList.add('hidden')" class="mt-2 text-gray-400 text-sm w-full hover:text-gray-600">
          Batal
        </button>
      </section>

      <section id="qrisBox" class="hidden bg-white p-6 rounded-xl shadow border text-center animate-fade-in">
        <h2 class="text-xl font-bold mb-2">Scan QRIS</h2>
        <div class="bg-white p-2 border inline-block rounded-lg">
            <img src="images/qris.png" class="mx-auto w-48">
        </div>
        <p class="mt-4 text-sm font-semibold animate-pulse text-red-500">
          Selesaikan dalam <span id="timer">10</span> detik
        </p>
      </section>

        <section id="statusBox" class="hidden bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-xl text-center font-bold text-sm">
          ⏳ MENUNGGU KONFIRMASI ADMIN
        </section>

        <section id="invoice" class="hidden bg-white p-4 rounded-xl shadow-lg border border-dashed border-gray-300 text-xs font-mono">
            <div class="text-center font-bold text-sm mb-1">FORMAPAS MART</div>
            <div class="text-center text-[10px] text-gray-500">Jl. Organisasi No.1</div>
            <hr class="my-3 border-dashed">
            <div class="mb-2">
               <div>No: <span id="trxId" class="font-bold"></span></div>
               <div id="trxDate"></div>
            </div>
            <div id="invoiceItems" class="space-y-1 mb-2"></div>
            <hr class="my-2 border-dashed">
            <div class="flex justify-between font-bold text-sm">
              <span>TOTAL</span>
              <span id="invoiceTotal"></span>
            </div>
            <div class="text-center mt-4 text-gray-400">Terima kasih 🙏</div>
        </section>

      </div>
    </div>
  </main>  @include('footer')

  <script>
/* --- KODE BARU (SOLUSI) --- */
const dbProducts = <?php echo json_encode($products
    // 1. FILTER: Jangan ambil produk ID 101 s/d 120 dari database untuk ditampilkan
    // (Karena ini sudah ada di kodingan JS kamu, biar tidak dobel)
    ->filter(function($p) {
        return $p->ID_PRODUCT < 101 || $p->ID_PRODUCT > 120; 
    })
    ->values() // Reset index array
    ->map(function($p){
        return [
            'id'    => $p->ID_PRODUCT,
            'title' => $p->NAMA_PRODUCT,
            'cat'   => $p->JENIS_PRODUCT, 
            'price' => (int)$p->HARGA_PRODUCT,
            // Gambar dari database admin tetap ambil dari storage
            'image' => asset('storage/'.$p->FOTO_PRODUCT),
        ];
})); ?>;

    const ASSET_URL = "{{ asset('images') }}";
    const products = [
      { id: 101, title: "FORMAPAS T-Shirt", cat: "Clothing", price: 75000, image: "{{ asset('images/kaosputih.png') }}" },
      { id: 102, title: "Sunset Hoodie", cat: "Clothing", price: 150000, image: "{{ asset('images/hodie.png') }}" },
      { id: 103, title: "Canvas Tote Bag", cat: "Accessories", price: 50000, image: "{{ asset('images/tas.png') }}" },
      { id: 104, title: "Sticker Pack", cat: "Stationery", price: 15000, image: "{{ asset('images/sticker.png') }}" },
      { id: 105, title: "Baseball Cap", cat: "Accessories", price: 60000, image: "{{ asset('images/topi.png') }}" },
      { id: 106, title: "Water Bottle", cat: "Accessories", price: 40000, image: "{{ asset('images/botol.png') }}" },
      { id: 107, title: "FORMAPAS Jacket", cat: "Clothing", price: 180000, image: "{{ asset('images/bajuoren.png') }}" },
      { id: 108, title: "Notebook FORMAS", cat: "Stationery", price: 25000, image: "{{ asset('images/notebook.png') }}" }    ];
  let cart=[];

  const allProducts = [...products, ...dbProducts];
/* ================= RENDER PRODUK ================= */
function renderProducts(){
  const keyword = searchInput.value.toLowerCase();
  const category = categoryFilter.value;

  productGrid.innerHTML = "";

  const filtered = allProducts.filter(p => {
    const byCat = category === "All" || p.cat === category;
    const bySearch = p.title.toLowerCase().includes(keyword);
    return byCat && bySearch;
  });

  if(filtered.length === 0){
    productGrid.innerHTML = `
      <p class="col-span-full text-center text-gray-500">
        Produk tidak ditemukan
      </p>`;
    return;
  }

  filtered.forEach(p => {
    productGrid.innerHTML += `
      <div class="bg-white p-6 rounded-xl shadow">
        <img src="${p.image}" class="h-40 mx-auto object-contain mb-3">
        <div class="font-bold">${p.title}</div>
        <div class="text-orange-600 font-bold">
          Rp ${p.price.toLocaleString("id-ID")}
        </div>
        <button onclick="addItem(${p.id},'${p.title}',${p.price})"
          class="mt-4 bg-orange-600 text-white py-2 rounded w-full">
          Add to Cart
        </button>
      </div>`;
  });
}
searchInput.addEventListener("input", renderProducts);
categoryFilter.addEventListener("change", renderProducts);

renderProducts();


/* ================= KERANJANG ================= */
function addItem(id, title,price){
  const f=cart.find(x=>x.title===title);
  f ? f.qty++ : cart.push({id, title,price,qty:1});
  renderCart();
}

function renderCart(){
  let total=0;
  cartItems.innerHTML="";

  cart.forEach((c,i)=>{
    const sub=c.price*c.qty;
    total+=sub;

    cartItems.innerHTML+=`
    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
      <div>
        <div class="font-medium">${c.title}</div>
        <div class="text-sm text-gray-500">
          Rp ${c.price.toLocaleString("id-ID")}
        </div>
      </div>
      <div class="flex items-center gap-3">
        <button onclick="decreaseQty(${i})"
          class="px-2 bg-gray-200 rounded font-bold">−</button>
        <span class="font-semibold">${c.qty}</span>
        <button onclick="increaseQty(${i})"
          class="px-2 bg-gray-200 rounded font-bold">+</button>
        <button onclick="removeItem(${i})"
          class="text-red-500 font-bold text-lg">🗑</button>
      </div>
    </div>`;
  });

  cartTotal.innerText="Rp "+total.toLocaleString("id-ID");
}

function increaseQty(i){ cart[i].qty++; renderCart(); }
function decreaseQty(i){ cart[i].qty--; if(cart[i].qty<=0) cart.splice(i,1); renderCart(); }
function removeItem(i){ cart.splice(i,1); renderCart(); }

  /* ================= CHECKOUT ================= */
  function validateAndPay() {
    // 1. Ambil value dari input berdasarkan ID yang baru kita buat
    const nama = document.getElementById('checkoutNama').value.trim();
    const alamat = document.getElementById('checkoutAlamat').value.trim();
    const hp = document.getElementById('checkoutHp').value.trim();

    // 2. Cek apakah ada yang kosong
    if (!nama || !alamat || !hp) {
        alert("Mohon lengkapi Nama, Alamat, dan No HP sebelum membayar!");
        return; // Stop, jangan lanjut ke QRIS
    }

    // 3. Jika aman, lanjut ke fungsi showQRIS
    showQRIS();
  }

  function openCheckout(){
  if(cart.length===0) return alert("Keranjang kosong");
  checkout.classList.remove("hidden");
  }

  function showQRIS(){
    checkout.classList.add("hidden");
    qrisBox.classList.remove("hidden");

    let t = 10; // Detik timer
    const iv = setInterval(() => {
        timer.innerText = --t;
        
        if(t <= 0){
            clearInterval(iv);
            
            // --- PERBAIKAN DI SINI ---
            // Jangan panggil showInvoice() langsung.
            // Panggil fungsi kirim ke database dulu!
            submitOrderToDatabase(); 
            
            // showInvoice nanti akan dipanggil otomatis 
            // di dalam submitOrderToDatabase() kalau sukses.
        }
    }, 1000);
  }

  function showInvoice(){
  let total=0, html="";
  const trx="TRX-"+Date.now();
  const now=new Date();

  trxId.innerText=trx;
  trxDate.innerText=now.toLocaleDateString("id-ID")+" "+now.toLocaleTimeString("id-ID");

  cart.forEach(c=>{
  const sub=c.price*c.qty;
  total+=sub;
  html+=`
  <div class="flex justify-between">
  <span>${c.title} x${c.qty}</span>
  <span>${sub.toLocaleString("id-ID")}</span>
  </div>`;
  });

  invoiceItems.innerHTML=html;
  invoiceTotal.innerText="Rp "+total.toLocaleString("id-ID");

  invoice.classList.remove("hidden");
  statusBox.classList.remove("hidden");

  cart=[];
  renderCart();
  }

  /* ================= KIRIM KE DATABASE (AJAX) ================= */
  function submitOrderToDatabase() {
    // 1. Siapkan Data sesuai permintaan Controller
    const payload = {
        nama: document.getElementById('checkoutNama').value,
        alamat: document.getElementById('checkoutAlamat').value,
        no_hp: document.getElementById('checkoutHp').value,
        cart: cart // Mengirim array keranjang
    };

    // 2. Ambil CSRF Token (Wajib untuk Laravel)
    const token = document.querySelector('meta[name="csrf-token"]').content;

    // 3. Kirim ke Route '/checkout'
    fetch("{{ route('checkout.store') }}", { 
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify(payload)
    })
    .then(response => {
        // Cek jika sesi habis (Error 401 dari controller)
        if (response.status === 401) {
            alert("Sesi Anda habis. Silakan login ulang.");
            window.location.href = "/login"; // Arahkan ke login
            return;
        }
        return response.json();
    })
    .then(data => {
        // 4. Cek respon dari Controller
        if(data.success) {
            // BERHASIL!
            document.getElementById('qrisBox').classList.add("hidden");
            
            // Tampilkan Invoice dengan TRX ID dari Controller
            showInvoice(data.trx_id); 
        } else {
            // GAGAL
            alert("Gagal: " + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Terjadi kesalahan koneksi.");
        document.getElementById('qrisBox').classList.add("hidden");
        document.getElementById('checkout').classList.remove("hidden");
    });
  }
  </script>

</body>
</html>