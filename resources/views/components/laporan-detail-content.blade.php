<div class="w-screen h-auto py-24 px-60 flex flex-col justify-start items-start max-md:px-5 max-md:py-10 space-y-5 bg-white">
    <div class='w-16 h-1 bg-orange-500'></div>

    <!-- Gambar laporan -->
    @if($laporan->images)
        @php
            $images = is_string($laporan->images) ? json_decode($laporan->images) : $laporan->images;
            $firstImage = $images[0] ?? null;
        @endphp
        @if($firstImage)
            <img class="w-full h-96 object-cover" src="{{ asset('storage/images/profile/' . ($laporan->user->summary->foto_pp ?? 'profile.png')) }}" alt="Foto Profil Mitra">
        @endif
    @endif

    <div class="w-full h-auto py-10 flex flex-col justify-start items-start max-md:px-5 max-md:py-10 space-y-4">
        <div class="w-20 h-1 bg-orange-500 my-3"></div>
        <h1 class="font-extrabold text-5xl max-md:mb-5 max-md:text-4xl">Gallery</h1>
    </div>
    <div class="grid grid-cols-4 gap-4 pb-5 max-md:grid-cols-1">
        @foreach($images as $image)
            <div>
                <img class="max-w-full rounded-lg" src="{{ asset('storage/' . $image) }}" alt="Gambar Laporan">
            </div>
        @endforeach
    </div>
    <div class="w-full h-auto py-10 grid grid-cols-3 gap-3 max-md:grid-cols-1">
        <div class="w-full h-28 bg-gray-100 rounded-lg p-6">
            <h1 class="text-xl font-thin text-gray-600">Realisasi</h1>
            <h1 class="text-2xl font-bold text-gray-800">
                {{ \App\Helpers\FormatHelper::formatRupiah($laporan->realisasi) }}
            </h1>
        </div>
        <div class="w-full h-28 bg-gray-100 rounded-lg p-6">
            <h1 class="text-xl font-thin text-gray-600">Nama Proyek</h1>
            <h1 class="text-2xl font-bold text-gray-800">{{$laporan->proyek->nama_proyek}}</h1>
        </div>
        <div class="w-full h-28 bg-gray-100 rounded-lg p-6">
            <h1 class="text-xl font-thin text-gray-600">Kecamatan</h1>
            <h1 class="text-2xl font-bold text-gray-800">Kec. {{$laporan->proyek->lokasi}}</h1>
        </div>
    </div>
    <div class="w-full pb-10 flex justify-center items-start flex-col">
        <h1 class="text-2xl font-bold">Rincian Laporan</h1>
        <h1 class="text-xl font-thin">{{$laporan->deskripsi}}</h1>
    </div>
</div>