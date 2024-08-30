{{-- Proyek Tersedia --}}
<div class="w-screen h-auto py-24 px-60 flex flex-col justify-center items-center max-md:px-5 bg-white">
    {{-- Input Filter & Search --}}
    <div class='w-full flex justify-between items-center mt-10 space-x-4'>
        <form action="{{ route('mitra-list.index') }}" method="GET" class="w-full flex space-x-4">
            <!-- Select Filter -->
            <div class="w-1/4 h-14 flex items-center border rounded-lg p-2 bg-white">
                <select name="filter" class="border-none bg-transparent w-full" onchange="this.form.submit()">
                    <option value="">Pilih Filter</option>
                    <option value="terbanyak" {{ request('filter') == 'terbanyak' ? 'selected' : '' }}>Laporan Terbanyak</option>
                    <option value="tersedikit" {{ request('filter') == 'tersedikit' ? 'selected' : '' }}>Laporan Tersedikit</option>
                </select>
            </div>

            <!-- Search Input -->
            <div class="w-3/4 h-14 flex items-center border rounded-lg bg-white">
                <button type="submit" class="pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                    </svg>                  
                </button>
                <input name="search" class="w-full h-full border-none stroke-none rounded-lg focus:outline-none" placeholder="Cari Kegiatan.." type="text" value="{{ request('search') }}">
            </div>
        </form>
    </div>
    <div class="w-full h-full grid grid-cols-4 max-md:grid-cols-2 grid-rows-1 justify-center items-center gap-5 mt-10">
        {{-- Card Proyek --}}
        @foreach ($mitra as $item)
            <a href="{{ route('mitra-list.show', $item->id) }}" class="w-full h-[350px] border-2 rounded-md flex justify-start items-center flex-col hover:bg-slate-100 transition">
            <img class="w-full h-1/2 rounded-t-md object-cover" src="{{ asset('storage/images/profile/' . $item->foto_pp) }}" alt="">
            <div class="w-full flex justify-start items-start flex-col p-5 space-y-3">
                <h1 class="text-xl font-bold text-ellipsis">{{$item->nama_mitra}}</h1>
                <p>Jumlah Laporan: {{ $item->laporan_count ?? 0 }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>