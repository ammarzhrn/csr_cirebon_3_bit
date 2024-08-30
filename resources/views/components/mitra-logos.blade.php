{{-- Mitra2 CSR --}}
<div class="w-screen h-auto py-24 px-60 flex flex-col justify-center items-center space-y-9 max-md:px-5">
    <div class='w-full flex justify-center items-start flex-col space-y-4'>
        <div class='w-16 h-1 bg-orange-500'></div>
        <h1 class='font-black text-4xl'>Mitra CSR Kabupaten Cirebon</h1>
    </div>
    <div class='w-full grid grid-cols-5 max-md:grid-cols-3 gap-10 justify-center items-center'>
        @foreach ($mitra as $item)
        <div class='flex justify-center items-center h-full w-full'>
            <img src="{{ asset('storage/images/profile/' . $item->foto_pp) }}" class='h-20' alt="" />
        </div>
        @endforeach
    </div>
</div>
