<div class="w-screen h-96 max-md:h-auto pt-24 px-60 flex max-md:flex-col justify-center items-center max-md:px-5 max-md:py-10 space-y-2">
    <div class='w-1/2 h-full max-md:w-full flex justify-start items-start pr-24 flex-col max-md:p-0'>
        <div class="w-20 h-1 bg-orange-500 my-3"></div>
        <h1 class="font-extrabold text-5xl max-md:mb-5 max-md:text-4xl">{{$sektor->nama_sektor}}</h1>
    </div>
    <div class='w-1/2 h-full max-md:w-full flex justify-start items-start flex-col max-md:p-0'>
        <h1 class="font-normal text-1xl text-gray-600 text-justify ">{{$sektor->deskripsi}}</h1>
    </div>
</div>