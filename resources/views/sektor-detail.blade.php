<x-app-layout>


    @auth

    <script>
        window.location.href = "{{ url('/dashboard') }}";
        alert("Admin & Mitra tidak dapat mengakses halaman umum, logout untuk mengakses halaman umum");
    </script>

    @endauth

    @include('components.sektor-detail-heading')

    @include('components.sektor-detail-main')

    @include('components.sektor-detail-proyek')

    @include('components.detail-gallery')

    @include('components.contact')

    @include('components.footer')

</x-app-layout>
