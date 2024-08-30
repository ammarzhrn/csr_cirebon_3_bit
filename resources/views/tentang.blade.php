<x-app-layout>

    @auth

    <script>
        window.location.href = "{{ url('/dashboard') }}";
        alert("Admin & Mitra tidak dapat mengakses halaman umum, logout untuk mengakses halaman umum");
    </script>

    @endauth

    <div id="tentang-sections" style="display: block">
        @include('components.tentang-heading')

        @include('components.tentang-detail')

        @include('components.tujuan-tentang')

        @include('components.manfaat-tentang')

        @include('components.laporan-terbaru')

        @include('components.panduan-csr')

        @include('components.contact')

        @include('components.footer')
    </div>

    <div id="pengajuan-form-section" style="display: none">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <a href="{{ url('/tentang') }}" class=" px-4 py-1 bg-red-800 text-white rounded-md hover:bg-red-700 transition duration-150 ease-in-out" id="show-profile-layout">
                            Kembali
                        </a>
                        <h3 class="text-lg font-semibold mt-4 mb-4">{{ __('Pengajuan Surat Rekomendasi CSR') }}</h3>
                        <p class="mb-4">Silakan Mengisi form Ajukan CSR.</p>
                        @include('pengajuan.pengajuan-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPengajuanForm() {
            // Hide all components in tentang.blade.php
            document.getElementById('tentang-sections').style.display = 'none';
    
            // Show the pengajuan form section
            document.getElementById('pengajuan-form-section').style.display = 'block';
        }
    </script>
    
</x-app-layout>
