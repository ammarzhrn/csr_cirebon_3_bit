<!-- {{-- Kegiatan Terbaru --}} -->
<div class="w-screen h-auto py-24 px-60 flex flex-col justify-center items-center max-md:px-5 ">
    <div class="w-36 h-2 bg-orange-500"></div>
    <h1 class="font-black text-4xl mt-2">Laporan Program Terbaru</h1>
    <div class="w-full grid grid-cols-4 max-md:grid-cols-2 grid-rows-1 justify-center items-center gap-5 mt-10">
        <!-- {{-- Card Kegiatan --}} -->
        @if(isset($laporanTerbaru) && $laporanTerbaru->count() > 0)
            @foreach($laporanTerbaru as $item)
                <a href="{{ route('laporan.show', $item->id) }}" class="w-full h-[350px] border-2 rounded-md flex justify-start items-center flex-col hover:bg-slate-100 transition">
                    <img class="w-full h-1/2 rounded-t-md object-cover" src="{{ $item->thumbnail_url }}" alt="{{ $item->judul_laporan }}">
                    <div class="w-full flex justify-start items-start flex-col p-5 space-y-3">
                        <h1 class="text-xl font-bold text-ellipsis">{{$item->judul_laporan}}</h1>
                        <h1 class="text-lg font-thin max-md:hidden">{{ Str::limit($item->deskripsi, 25, '...') }}</h1>
                        <h1 class="text-lg font-thin hidden max-md:block">{{ Str::limit($item->deskripsi, 15, '...') }}</h1>
                    </div>
                </a>
            @endforeach
        @else
            <p>Tidak ada laporan terbaru.</p>
        @endif
    </div>
    <a href="/laporan" class="w-72 py-3 border-2 rounded-md flex justify-center items-center mt-10 hover:bg-slate-200 transition">Lihat semua laporan</a>
</div>