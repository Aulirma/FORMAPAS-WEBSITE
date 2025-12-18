

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk & Daftar | FORMAPAS</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap');

        :root {
            --oren-utama: #db5400;
            --oren-sub: #ff9336;
            --oren-bg: #f8e1ca;
            --teks-gelap: #333333;
            --teks-abu: #666666;
            --teks-putih: #ffffff;
        }

        body {
            background-color: var(--oren-bg);
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background-image: linear-gradient(to right, var(--oren-sub), var(--oren-utama));
            color: var(--teks-putih);
            box-shadow: 0 4px 15px rgba(219, 84, 0, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(219, 84, 0, 0.4);
        }
        .btn-primary:active { transform: scale(0.95); }
        .btn-primary:disabled { background: #ccc; cursor: not-allowed; }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--teks-putih);
            color: var(--teks-putih);
        }
        .btn-outline:hover {
            background-color: var(--teks-putih);
            color: var(--oren-utama);
        }

        .container-auth {
            position: relative;
            overflow: hidden;
            width: 850px;
            max-width: 100%;
            min-height: 550px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container { left: 0; width: 50%; z-index: 2; }
        .sign-up-container { left: 0; width: 50%; opacity: 0; z-index: 1; }

        .container-auth.right-panel-active .sign-in-container { transform: translateX(100%); }
        .container-auth.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% { opacity: 0; z-index: 1; }
            50%, 100% { opacity: 1; z-index: 5; }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container-auth.right-panel-active .overlay-container { transform: translateX(-100%); }

        .overlay {
            background: linear-gradient(135deg, var(--oren-sub), var(--oren-utama));
            color: var(--teks-putih);
            position: relative;
            left: -100%;
            width: 200%;
            height: 100%;
            transition: transform 0.6s ease-in-out;
        }

        .container-auth.right-panel-active .overlay { transform: translateX(50%); }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 50%;
            height: 100%;
            text-align: center;
            padding: 0 40px;
        }

        .overlay-left { transform: translateX(-20%); }
        .container-auth.right-panel-active .overlay-left { transform: translateX(0); }

        .overlay-right { right: 0; }
        .container-auth.right-panel-active .overlay-right { transform: translateX(20%); }

        .input-custom {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 8px;
        }

        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--oren-utama);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-4">
    <a href="{{ route('home') }}" class="fixed top-6 left-6 text-[#ff8800] flex items-center gap-2">
        <i class="fa-solid fa-x"></i> Kembali ke Home
    </a>

    <div class="container-auth bg-white rounded-[20px] shadow-2xl relative" id="container">

        <!-- SIGN UP -->
        <div class="form-container sign-up-container">
            <form action="{{ route('register') }}" method="POST" class="bg-white flex flex-col items-center justify-center h-full px-10 text-center">
                @csrf
                <h1 class="text-3xl font-bold mb-4 text-[var(--oren-utama)]">Buat Akun</h1>
                <input type="text" name="USER_NAME" placeholder="Username" class="input-custom" required />
                <input type="text" name="NIK" placeholder="350606xxxxxxxxx" class="input-custom" required />
                <input type="email" name="USER_EMAIL" placeholder="Email" class="input-custom" required />
                <input type="password" name="USER_PASSWORD" placeholder="Password" class="input-custom" required />
                <input type="hidden" name="ADMIN_ID" value="1" />
                <button type="submit" class="btn-primary rounded-full px-12 py-3 mt-4 font-bold text-xs uppercase">Daftar</button>
            </form>
        </div>


        <!-- SIGN IN -->
        <div class="form-container sign-in-container">
            <form action="{{ route('login') }}" method="POST" id="signInForm" class="bg-white flex flex-col items-center justify-center h-full px-10 text-center">
                @csrf    
                <h1 class="text-3xl font-bold mb-4 text-[var(--oren-utama)]">Masuk</h1>

                <div class="flex mb-4">
                    <button type="button" class="border border-gray-300 rounded-full w-10 h-10 flex items-center justify-center mx-1 hover:bg-gray-100"><i class="fab fa-facebook-f text-gray-600"></i></button>
                    <button type="button" class="border border-gray-300 rounded-full w-10 h-10 flex items-center justify-center mx-1 hover:bg-gray-100"><i class="fab fa-google text-gray-600"></i></button>
                    <button type="button" class="border border-gray-300 rounded-full w-10 h-10 flex items-center justify-center mx-1 hover:bg-gray-100"><i class="fab fa-linkedin-in text-gray-600"></i></button>
                </div>

                <input type="email" name="USER_EMAIL" id="loginEmail" placeholder="Email" class="input-custom" required />
                <input type="password" name="USER_PASSWORD" id="loginPassword" placeholder="Password" class="input-custom" required />

                <!-- Forgot Password Added -->
                <a id="forgotPassBtn" class="text-xs text-gray-500 my-4 hover:text-[var(--oren-utama)] hover:underline cursor-pointer">
                    Lupa password?
                </a>

                <button type="submit" class="btn-primary rounded-full px-12 py-3 font-bold text-xs uppercase">
                    <span id="btnTextSignIn">Masuk</span>
                </button>
                <p id="signInError" class="text-red-500 text-xs mt-2 hidden"></p>
            </form>
        </div>

        <!-- OVERLAY -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="text-3xl font-bold mb-4">Selamat Datang!</h1>
                    <p class="text-sm mb-8">Join menjadi keluarga formapals dengan mengisi data diri ini. <br> Atau sudah punya akun?</p>
                    <button class="btn-outline rounded-full px-12 py-3 font-bold text-xs uppercase" id="signIn">Masuk</button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1 class="text-3xl font-bold mb-4">Welcome Back Formapals!</h1>
                    <p class="text-sm mb-8">Silahkan isi akun yang sudah kamu daftarkan sebelumnya. Atau buat lagi akun baru?</p>
                    <button class="btn-outline rounded-full px-12 py-3 font-bold text-xs uppercase" id="signUp">Daftar</button>
                    <a href="{{ route('admin.login') }}" 
                    id="AdminBtn" 
                    class="text-xs text-white my-4 hover:text-[var(--oren-sub)] hover:underline cursor-pointer">
                        Login Sebagai Admin
                    </a>
                </div>

            </div>
        </div>
    </div>

<script>
    const container = document.getElementById('container');
    document.getElementById('signUp').onclick = () => container.classList.add('right-panel-active');
    document.getElementById('signIn').onclick = () => container.classList.remove('right-panel-active');

    document.getElementById('forgotPassBtn').onclick = () => {
        const email = document.getElementById('loginEmail').value;
        if (!email) {
            alert('Masukkan email terlebih dahulu.');
            return;
        }
        alert('Reset password telah dikirim (simulasi).');
    };
</script>

</body>
</html>
