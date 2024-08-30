{{-- Sektor --}}
<div class="w-screen h-auto py-24 px-60 flex flex-col justify-center items-center max-md:px-5 ">
    <div class="w-36 h-2 bg-orange-500"></div>
    <h1 class="font-black text-4xl mt-2">Sektor CSR</h1>
    <h1 class="text-gray-500 text-xl mt-2">Bidang program CSR Kabupaten Cirebon yang tersedia</h1>
    <div class="w-full h-full grid grid-cols-4 max-md:grid-cols-2 grid-rows-1 justify-center items-center gap-5 mt-10">
        {{-- Card Sektor --}}
        @foreach ($sektor as $item)
        <div class="w-full h-96 border-2 rounded-md flex justify-start items-center flex-col">
            <img class="w-full h-1/2 rounded-t-md object-cover" src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->nama_sektor }}">
            <div class="w-full h1/2 flex justify-start items-start flex-col p-5 space-y-5">
                <h1 class="font-bold text-2xl">{{ $item->nama_sektor }}</h1>
                <h1 class="w-full font-normal text-base px-3 py-1 bg-slate-200 rounded-md">Tersedia : {{ $item->programs->count() }}</h1>
                <a href="{{ route('sektor.show', $item->id) }}" class="w-full text-base px-3 py-2 bg-red-800 text-white rounded-md text-center">Lihat Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>