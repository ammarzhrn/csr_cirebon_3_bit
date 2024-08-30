<div class="w-screen h-auto py-24 px-60 flex flex-col justify-start items-start max-md:px-5 max-md:py-10 space-y-5 bg-white">
    <div class='w-16 h-1 bg-orange-500'></div>
    <img class="w-full h-96 object-cover" src="{{ asset('storage/images/profile/' . $mitra->foto_pp) }}" alt="">
    <div class="w-full pb-10 flex justify-center items-start flex-col">
        <h1 class="text-2xl font-bold">Rincian Laporan</h1>
        <h1 class="text-xl font-thin">{{$mitra->deskripsi}}</h1>
    </div>
</div>