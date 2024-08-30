<x-app-layout>


    @auth

    <script>
        window.location.href = "{{ url('/dashboard') }}";
        alert("Admin & Mitra tidak dapat mengakses halaman umum, logout untuk mengakses halaman umum");
    </script>

    @endauth

    @include('components.sektor-heading')

    @include('components.sektor-card')

    @include('components.proyek-tersedia')

    @include('components.contact')

    @include('components.footer')

</x-app-layout>
