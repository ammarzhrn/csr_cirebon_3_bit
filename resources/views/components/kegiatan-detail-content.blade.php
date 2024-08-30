<div class="w-screen h-auto py-24 px-60 flex flex-col justify-start items-start max-md:px-5 max-md:py-10 space-y-5 bg-white">
    <div class='w-16 h-1 bg-orange-500'></div>
    @if($kegiatan->foto_url)
        <img class="w-full h-96 object-cover" src="{{ $kegiatan->foto_url }}" alt="{{ $kegiatan->judul_kegiatan }}">
    @endif
    <div class="w-full pb-10 flex justify-center items-start flex-col">
        <h1 class="text-xl font-thin">{!! $kegiatan->deskripsi !!}</h1>
    </div>
</div>