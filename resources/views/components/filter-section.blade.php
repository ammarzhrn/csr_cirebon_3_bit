<div class="mb-6">
    <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4 flex-wrap md:px-28 ">
        <div class="flex space-x-2 w-full sm:w-auto">
            @if(auth()->user()->level === 'admin')
            <a href="{{ route('dashboard.download.csv') }}" class="w-full sm:w-[137px] h-[44px] px-4 py-2.5 rounded-lg bg-white text-[#099250] font-inter text-sm font-semibold leading-5 flex items-center justify-center gap-2 hover:bg-green-50 transition duration-300">
                <span>Unduh .csv</span>
            </a>
            <a href="{{ route('dashboard.download.pdf') }}" class="w-full sm:w-[137px] h-[44px] px-4 py-2.5 rounded-lg bg-white text-[#98100A] font-inter text-sm font-semibold leading-5 flex items-center justify-center gap-2 hover:bg-red-50 transition duration-300">
                <span>Unduh .pdf</span>
            </a>
            @elseif(auth()->user()->level === 'mitra')
            <a href="{{ route('dashboard.mitra.download.csv') }}" class="w-full sm:w-[137px] h-[44px] px-4 py-2.5 rounded-lg bg-white text-[#099250] font-inter text-sm font-semibold leading-5 flex items-center justify-center gap-2 hover:bg-green-50 transition duration-300">
                <span>Unduh .csv</span>
            </a>
            <a href="{{ route('dashboard.mitra.download.pdf') }}" class="w-full sm:w-[137px] h-[44px] px-4 py-2.5 rounded-lg bg-white text-[#98100A] font-inter text-sm font-semibold leading-5 flex items-center justify-center gap-2 hover:bg-red-50 transition duration-300">
                <span>Unduh .pdf</span>
            </a>
            @endif
        </div>
    </div>
</div>