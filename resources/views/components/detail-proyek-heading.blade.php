<div class="w-screen h-[500px] max-md:h-[300px] flex max-md:flex-col justify-center items-center pt-20 bg-cover bg-center bg-responsive">
    <div class="w-full h-full flex flex-col justify-center items-start space-y-4 px-60 max-md:px-5">
        <a href="/sektor" class=' font-light text-2xl text-white mt-3'>Back</a>
        <h1 class=' font-black text-8xl text-white max-md:text-5xl'>{{ $proyek->nama_proyek }}</h1>
        <h1 class=' font-light text-2xl text-white mt-3'>Mulai: {{$proyek->tgl_awal}} - Akhir: {{$proyek->tgl_akhir}}</h1>
        <h1 class=' font-light text-2xl max-md:text-lg text-white mt-3'>{{$proyek->lokasi}}</h1>
    </div>
</div>

<style>
 .bg-responsive {
        background-image: url('{{ asset('images/bg.png') }}');
        background-size: cover;
        background-repeat: no-repeat;
    }

    @media (max-width: 768px) {
        .bg-responsive {
            background-image: url('{{ asset('images/bg-phone.png') }}');
        }
    }
</style>