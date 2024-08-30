<!-- Container for registration information -->
<div class="md:w-2/5 p-8 border-b md:border-b-0 md:border-r border-gray-300 flex flex-col justify-center">
    <!-- Back to home page link -->
    <a href="{{ url('/') }}" class="text-[#98100A] hover:text-red-700 flex items-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Kembali ke halaman utama
    </a>
    <!-- Registration title and instructions -->
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Registrasi Mitra</h2>
    <p class="text-gray-600 mb-6">Silakan masukan email dan kata sandi untuk masuk ke halaman dashboard Anda</p>
    <!-- Login link for existing users -->
    <div class="border border-gray-300 p-4 rounded-lg text-center">
        <p class="text-gray-900 font-semibold">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-[#98100A] hover:underline">Klik di sini</a>
        </p>
    </div>
</div>
