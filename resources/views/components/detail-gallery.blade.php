@if(isset($proyek) && $proyek)
    <div class="w-full h-auto py-10 px-60 flex flex-col justify-start items-start max-md:px-5 max-md:py-10 space-y-4">
        <div class="w-20 h-1 bg-orange-500 my-3"></div>
        <h1 class="font-extrabold text-5xl max-md:mb-5 max-md:text-4xl">Gallery</h1>
    </div>
    <div class="grid grid-cols-4 gap-4 px-60 pb-20 max-md:grid-cols-1 max-md:px-5">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/' . $proyek->thumbnail) }}" alt="{{ $proyek->nama_proyek }} thumbnail">
        </div>
    </div>
@else
  
@endif
