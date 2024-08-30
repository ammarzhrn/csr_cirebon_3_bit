<x-app-layout>

    @auth

    <script>
        window.location.href = "{{ url('/dashboard') }}";
        alert("Admin & Mitra tidak dapat mengakses halaman umum, logout untuk mengakses halaman umum");
    </script>

    @endauth 

    @include('components.mitra-list-heading')
    
    @include('components.mitra-list-card')

    @include('components.contact')

    @include('components.footer')

</x-app-layout>
