<x-app-layout>

    @auth

    <script>
        window.location.href = "{{ url('/dashboard') }}";
        alert("Admin & Mitra tidak dapat mengakses halaman umum, logout untuk mengakses halaman umum");
    </script>

    @endauth

    <x-kegiatan-detail-heading :kegiatan="$kegiatan" />

    @include('components.kegiatan-detail-content')
    
    @include('components.contact')

    @include('components.footer')

</x-app-layout>
