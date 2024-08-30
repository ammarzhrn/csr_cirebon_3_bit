<!-- Container for login information -->
<div class="md:w-[35%] flex flex-col items-center justify-center ml-5 md:items-start md:ml-5 p-8">
    <div class="w-full">
        <!-- Back to home page link -->
        <a href="/" class="text-[#98100A] hover:text-red-700 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke halaman utama
        </a>
        <!-- Welcome message and instructions -->
        <div class="mt-5 text-center md:text-left">
            <h2 class="text-4xl font-bold mb-4">Selamat Datang</h2>
            <p class="text-gray-600 mb-8 w-full md:w-[400px] text-base">
                Silakan masukan email dan kata sandi untuk masuk ke halaman dashboard Anda
            </p>
        </div>

        <!-- Registration link for new users -->
        <div class="inline-block border border-gray-300 p-3 rounded-lg w-full">
            <p class="text-gray-900 text-center font-bold">
                Belum punya akun mitra?
                <a href="{{ route('register') }}" class="text-[#98100A] hover:underline font-bold">
                    Registrasi di sini
                </a>
            </p>
        </div>
    </div>
</div>
