<x-app-layout>

    @auth

    <script>
        window.location.href = "{{ url('/dashboard') }}";
        alert("Admin & Mitra tidak dapat mengakses halaman umum, logout untuk mengakses halaman umum");
    </script>

    @endauth

    @include('components.detail-proyek-heading')

    @include('components.detail-proyek-desc')

    @include('components.detail-gallery')

    @include('components.detail-table')

    @include('components.contact')

    @include('components.footer')

    @if($proyek->thumbnail)
        <div class="w-full max-w-md aspect-[300/183.29] rounded-lg overflow-hidden relative">
            <img src="{{ asset('storage/' . $proyek->thumbnail) }}" alt="Thumbnail proyek"
                 class="w-full h-full object-cover">
        </div>
    @else
        <p class="text-gray-500">Tidak ada thumbnail untuk proyek ini.</p>
    @endif

</x-app-layout>
