<x-app-layout>

    @auth

    <script>
        window.location.href = "{{ url('/dashboard') }}";
        alert("Admin & Mitra tidak dapat mengakses halaman umum, logout untuk mengakses halaman umum");
    </script>

    @endauth

    @include('components.laporan-heading')
    
    @include('components.laporan-card', ['laporans' => $laporans, 'sort' => $sort, 'search' => $search])

    @include('components.contact')

    @include('components.footer')

    @foreach($laporans as $laporan)
        <!-- Kode untuk menampilkan setiap laporan -->
        @if($laporan->status === 'terbit')
        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
            Diterbitkan
        </span>
        @elseif($laporan->status === 'tolak')
        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
            Ditolak
        </span>
        @endif
    @endforeach

</x-app-layout>
