<x-app-layout>

    @auth

    <script>
        window.location.href = "{{ url('/dashboard') }}";
        alert("Admin & Mitra tidak dapat mengakses halaman umum, logout untuk mengakses halaman umum");
    </script>

    @endauth

@include('components.main-heading')
    
@include('components.mitra-logos')
    
@include('components.stats-landing')
    
@include('components.csr-detail')  

@include('components.sektor-component')  

@include('components.sambutan')

@include('components.kegiatan-terbaru')

@include('components.laporan-terbaru')

@include('components.faq')

@include('components.contact')

@include('components.footer')

</x-app-layout>
