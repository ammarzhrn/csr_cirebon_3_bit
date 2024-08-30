@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-admin')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengajuan') }}
        </h2>
    </x-slot>

    <div class="py-12 mb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <div class="flex items-center space-x-2 overflow-x-auto whitespace-nowrap">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.66667 14.1663H13.3333M9.18141 2.30297L3.52949 6.6989C3.15168 6.99276 2.96278 7.13968 2.82669 7.32368C2.70614 7.48667 2.61633 7.67029 2.56169 7.86551C2.5 8.0859 2.5 8.32521 2.5 8.80384V14.833C2.5 15.7664 2.5 16.2331 2.68166 16.5896C2.84144 16.9032 3.09641 17.1582 3.41002 17.318C3.76654 17.4996 4.23325 17.4996 5.16667 17.4996H14.8333C15.7668 17.4996 16.2335 17.4996 16.59 17.318C16.9036 17.1582 17.1586 16.9032 17.3183 16.5896C17.5 16.2331 17.5 15.7664 17.5 14.833V8.80384C17.5 8.32521 17.5 8.0859 17.4383 7.86551C17.3837 7.67029 17.2939 7.48667 17.1733 7.32368C17.0372 7.13968 16.8483 6.99276 16.4705 6.69891L10.8186 2.30297C10.5258 2.07526 10.3794 1.9614 10.2178 1.91763C10.0752 1.87902 9.92484 1.87902 9.78221 1.91763C9.62057 1.9614 9.47418 2.07526 9.18141 2.30297Z" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-semibold text-sm text-red-600">
                        {{ __('Pengajuan') }}
                    </span>
                </div>
            </div>

            <!-- UI untuk judul dan tombol -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 space-y-4 sm:space-y-0">
                <h2 class="text-2xl sm:text-[28px] font-semibold leading-tight sm:leading-[44px] tracking-[-0.02em] text-left">
                    Pengajuan
                </h2>
            </div>

            <!-- Search input -->
            <div class="mb-4 flex flex-wrap items-center justify-between">
                <form action="{{ route('dashboard.pengajuan.index') }}" method="GET" id="searchForm" class="w-full sm:w-[calc(35%-8px)] mb-2 sm:mb-0">
                    <input type="text" name="search" id="searchInput" placeholder="Cari pengajuan..." class="w-full px-4 py-2.5 h-[44px] rounded-lg border border-gray-300" value="{{ request('search') }}">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                    <button type="submit" class="hidden">Cari</button>
                </form>
            </div>

            <!-- Table -->
            <div class="w-full max-w-[1240px] mx-auto">
                <div class="bg-white shadow-md rounded-t-xl border border-gray-200 overflow-hidden">
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Nama
                                            <svg class="ml-1 w-3 h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.99967 1.33334V10.6667M5.99967 10.6667L10.6663 6.00001M5.99967 10.6667L1.33301 6.00001" stroke="#101828" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Nama Instansi
                                            <svg class="ml-1 w-3 h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.99967 1.33334V10.6667M5.99967 10.6667L10.6663 6.00001M5.99967 10.6667L1.33301 6.00001" stroke="#101828" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Mitra CSR
                                            <svg class="ml-1 w-3 h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.99967 1.33334V10.6667M5.99967 10.6667L10.6663 6.00001M5.99967 10.6667L1.33301 6.00001" stroke="#101828" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Nama Program
                                            <svg class="ml-1 w-3 h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.99967 1.33334V10.6667M5.99967 10.6667L10.6663 6.00001M5.99967 10.6667L1.33301 6.00001" stroke="#101828" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($pengajuan as $index => $item)
                                <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-base font-normal leading-5 text-gray-900">{{ $item->nama }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-base font-normal leading-5 text-gray-900">{{ $item->nama_instansi }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-base font-normal leading-5 text-gray-900">{{ $item->mitra_csr }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-base font-normal leading-5 text-gray-900">{{ $item->nama_program }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base font-normal leading-5 text-gray-900">
                                        <a href="{{ route('dashboard.pengajuan.show', $item->id) }}">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden">
                        @foreach($pengajuan as $index => $item)
                            <div class="p-4 border-b {{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <p class="text-sm mb-2"><span class="font-medium">Nama:</span> {{ $item->nama}}</p>
                                <p class="text-sm mb-2"><span class="font-medium">Nama Instansi:</span> {{$item->nama_instansi}}</p>
                                <p class="text-sm mb-2"><span class="font-medium">Mitra CSR:</span> {{$item->mitra_csr}}</p>
                                <p class="text-sm mb-2"><span class="font-medium">Nama Program:</span> {{$item->nama_program}}</p>
                                <div class="flex space-x-2 mt-2">
                                    <a href="{{ route('dashboard.pengajuan.show', $item->id) }}" 
                                       class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 px-3 py-1 rounded-md transition duration-300">Detail</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white border-t border-gray-200 px-4 py-3 sm:px-6 rounded-b-xl mt-2">
                    {{ $pengajuan->appends(request()->except('page'))->links('vendor.pagination.custom-pengajuan') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('perPageSelect');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('per_page', this.value);
            currentUrl.searchParams.delete('page'); // Reset halaman ke 1 saat mengubah jumlah per halaman
            window.location.href = currentUrl.toString();
        });
    }
});
</script>