{{-- Proyek Tersedia --}}
<div class="w-screen h-auto py-24 px-60 flex flex-col justify-center items-center max-md:px-5 bg-white">
    {{-- Input Filter & Search --}}
    <div class='w-full flex justify-between items-center mt-10 space-x-4'>
         <!-- Select Terbaru -->
         <div class="w-1/4 h-14 flex items-center border rounded-lg p-2 bg-white">
            <select id="sort-select" class="border-none bg-transparent w-full" onchange="this.form.submit()">
                <option value="terbaru" {{ $sort == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="terlama" {{ $sort == 'terlama' ? 'selected' : '' }}>Terlama</option>
            </select>
        </div>

        <div class="w-3/4 h-14 flex items-center border rounded-lg bg-white">
            <button class="pl-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                </svg>                  
            </button>
            <input class="w-full h-full border-none stroke-none rounded-lg focus:outline-none" placeholder="Cari Kegiatan.." type="text">
        </div>
    </div>

    <div class="w-full h-full grid grid-cols-4 max-md:grid-cols-2 grid-rows-1 justify-center items-center gap-5 mt-10">
        {{-- Card Proyek --}}
        @foreach ($kegiatan as $item)
            <a href="{{ route('kegiatan.show', $item->id) }}" class="w-full h-[350px] border-2 rounded-md flex justify-start items-center flex-col hover:bg-slate-100 transition">
                <img class="w-full h-1/2 rounded-t-md object-cover" src="{{ $item->foto_url ?? asset('default-thumbnail.png') }}" alt="{{ $item->judul_kegiatan }}">
                <div class="w-full flex justify-start items-start flex-col p-5 space-y-3">
                    <h1 class="text-xl font-bold text-ellipsis">{{ $item->judul_kegiatan }}</h1>
                    <h1 class="text-lg font-thin max-md:hidden">
                        {{ $item->deskripsi_singkat }}
                    </h1>
                    <h1 class="text-lg font-thin hidden max-md:block">
                        {{ Str::limit($item->deskripsi_singkat, 15) }}
                    </h1>
                </div>
            </a>
        @endforeach
    </div>
</div>

<script>
    document.getElementById('sort-select').addEventListener('change', function() {
        window.location.href = '{{ route('kegiatan.index') }}?sort=' + this.value;
    });
</script>