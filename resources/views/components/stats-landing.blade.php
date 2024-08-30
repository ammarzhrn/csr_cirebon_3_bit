{{-- Data Statistik --}}
<div class="w-screen h-auto py-24 px-60 flex flex-col justify-center items-center space-y-9 max-md:px-5">
    <div class='w-full flex justify-center items-center flex-col space-y-4'>
        <div class='w-16 h-1 bg-orange-500'></div>
        <h1 class='font-black text-4xl'>Data Statistik</h1>
    </div>
    <div class='w-full h-auto grid grid-cols-4 max-md:grid-cols-2 max-md:gap-y-4'>
        <div class='w-full h-full border-l-2 border-orange-500 p-5 flex justify-center items-start flex-col'>
            <h1 class='font-black text-5xl max-md:text-4xl'>{{ \App\Models\Proyek::where('status', 'terbit')->count() }}</h1>
            <h1>Total Proyek CSR</h1>
        </div>
        <div class='w-full h-full border-l-2 border-orange-500 p-5 flex justify-center items-start flex-col'>
            <h1 class='font-black text-5xl max-md:text-4xl'>{{ $jumlahProyekTerealisasi }}</h1>
            <h1>Proyek Terealisasi</h1>
        </div>
        <div class='w-full h-full border-l-2 border-orange-500 p-5 flex justify-center items-start flex-col'>
            <h1 class='font-black text-5xl max-md:text-4xl'>{{ $jumlahMitra }}</h1>
            <h1>Mitra Bergabung</h1>
        </div>
        <div class='w-full h-full border-l-2 border-orange-500 p-5 flex justify-center items-start flex-col'>
            <h1 class='font-black text-4xl max-md:text-3xl'>{{ $formattedDanaRealisasi }}</h1>
            <h1>Dana Realisasi CSR</h1>
        </div>
    </div>
</div>
