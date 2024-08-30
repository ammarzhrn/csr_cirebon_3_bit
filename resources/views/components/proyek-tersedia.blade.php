{{-- Proyek Tersedia --}}
<div class="w-screen h-auto py-24 px-60 flex flex-col justify-center items-center max-md:px-5" x-data="proyekTersedia()">
    <div class="w-36 h-2 bg-orange-500"></div>
    <h1 class="font-black text-4xl my-2">Proyek Tersedia</h1>

    {{-- Input Filter & Search --}}
    <div class='w-full flex justify-between items-center mt-10 space-x-4'>
       
    

        <div class="w-full h-14 flex items-center border rounded-lg bg-white">
            <button class="pl-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                </svg>                  
            </button>
            <input class="w-full h-full border-none stroke-none rounded-lg focus:outline-none" 
                   placeholder="Cari Proyek.." 
                   type="text" 
                   x-model="searchQuery" 
                   @input="filterProyek()">
        </div>
    </div>

    <div class="w-full h-full grid grid-cols-4 max-md:grid-cols-2 grid-rows-1 justify-center items-center gap-5 mt-10">
        {{-- Card Proyek --}}
        <template x-for="item in filteredProyek" :key="item.id">
            <div class="w-full border-2 rounded-md flex justify-start items-center flex-col">
                <img class="w-full h-[150px] object-cover rounded-t-md" :src="'/storage/' + item.thumbnail" :alt="item.nama_proyek">
                <div class="w-full h1/2 flex justify-start items-start flex-col p-5 space-y-3">
                    <h1 class="font-bold text-2xl" x-text="item.nama_proyek"></h1>
                    <h1 class="w-full font-regular text-slate-700 text-lg max-md:text-base p-2 bg-slate-300 flex rounded-md">
                        <span class="pr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>                          
                        </span>
                        <span x-text="item.lokasi"></span>
                    </h1>
                    <h1 class="w-full font-regular text-slate-700 text-lg max-md:text-base p-2 bg-slate-300 flex rounded-md" x-text="item.sektor.nama_sektor"></h1>
                    <h1 class="w-full font-regular text-slate-700 text-lg max-md:text-base p-2 bg-slate-300 flex rounded-md" x-text="item.tgl_akhir"></h1>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
function proyekTersedia() {
    return {
        proyek: @json($proyek),
        sektors: @json($sektors ?? []),
        selectedSektor: '',
        searchQuery: '',
        filteredProyek: [],

        init() {
            this.filteredProyek = this.proyek;
        },

        filterProyek() {
            this.filteredProyek = this.proyek.filter(item => {
                const sektorMatch = !this.selectedSektor || item.id_sektor == this.selectedSektor;
                const searchMatch = !this.searchQuery || item.nama_proyek.toLowerCase().includes(this.searchQuery.toLowerCase());
                return sektorMatch && searchMatch;
            });
        }
    }
}
</script>