@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-admin')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
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
                        {{ __('User List') }}
                    </span>
                </div>
            </div>

            <!-- UI untuk judul dan tombol -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 space-y-4 sm:space-y-0">
                <h2 class="text-2xl sm:text-[28px] font-semibold leading-tight sm:leading-[44px] tracking-[-0.02em] text-left">
                    User List
                </h2>
                <a href="{{ route('dashboard.user.create') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 sm:px-[18px] sm:py-[10px] gap-2 rounded-[8px] border border-[#98100A] bg-[#98100A] text-white hover:bg-[#7a0d08] focus:ring-4 focus:ring-red-300 shadow-[0px_1px_2px_0px_#1018280D] text-sm sm:text-[16px] font-semibold leading-5 sm:leading-[24px] text-center sm:text-left transition-colors duration-300">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4.16667V15.8333M4.16667 10H15.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Buat User Baru
                </a>
            </div>

            <!-- Kategori filter -->
            <div class="mb-6 overflow-x-auto">
                <div class="flex space-x-2 min-w-max">
                    <button class="kategori-filter px-4 py-2 rounded-full bg-[#98100A] text-white" data-status="semua">Semua</button>
                    <button class="kategori-filter px-4 py-2 rounded-full bg-gray-200 text-gray-700" data-status="admin">Admin</button>
                    <button class="kategori-filter px-4 py-2 rounded-full bg-gray-200 text-gray-700" data-status="mitra">Mitra</button>
                    <button class="kategori-filter px-4 py-2 rounded-full bg-gray-200 text-gray-700" data-status="guest">Guest</button>
                </div>
            </div>

            <!-- Tambahan filter dan tombol unduh -->
            <form action="{{ route('dashboard.user') }}" method="GET" id="filterForm">
                <div class="mb-6">
                    <div class="flex flex-wrap items-center gap-2">
                        <select id="quarterFilter" name="quarter" class="w-full sm:w-auto h-[44px] px-4 py-2.5 rounded-lg border border-gray-300">
                            <option value="">Pilih Kuartal</option>
                            <option value="1" {{ request('quarter') == 1 ? 'selected' : '' }}>Kuartal 1 (Jan-Mar)</option>
                            <option value="2" {{ request('quarter') == 2 ? 'selected' : '' }}>Kuartal 2 (Apr-Jun)</option>
                            <option value="3" {{ request('quarter') == 3 ? 'selected' : '' }}>Kuartal 3 (Jul-Sep)</option>
                            <option value="4" {{ request('quarter') == 4 ? 'selected' : '' }}>Kuartal 4 (Okt-Des)</option>
                        </select>
                        <button type="submit" id="applyFilter" class="h-[44px] px-4 py-2.5 rounded-lg border border-red-800 bg-[#98100A] text-white font-inter text-sm font-semibold leading-5 hover:bg-red-900 transition duration-300 whitespace-nowrap">
                            Tampilkan Filter
                        </button>
                        <a href="{{ route('dashboard.user.download.csv') }}" class="h-[44px] px-4 py-2.5 rounded-lg bg-white text-[#099250] border border-[#099250] font-inter text-sm font-semibold leading-5 flex items-center justify-center gap-2 hover:bg-green-50 transition duration-300">Unduh .CSV</a>
                        <a href="{{ route('dashboard.user.download.pdf') }}" class="h-[44px] px-4 py-2.5 rounded-lg bg-white text-[#98100A] border border-[#98100A] font-inter text-sm font-semibold leading-5 flex items-center justify-center gap-2 hover:bg-red-50 transition duration-300">Unduh .PDF</a>
                    </div>
                </div>
            </form>

            <!-- Search input -->
            <div class="mb-4">
                <form action="{{ route('dashboard.user') }}" method="GET" id="searchForm" class="flex">
                    <input type="text" name="search" id="searchInput" placeholder="Cari user..." class="w-full px-4 py-2 border rounded-l-lg" value="{{ request('search') }}">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 5) }}">
                    <button type="submit" class="px-4 py-2 bg-[#98100A] text-white rounded-r-lg hover:bg-red-900 transition duration-300">Cari</button>
                </form>
            </div>

            <!-- Table for larger screens, Cards for smaller screens -->
            <div class="w-full max-w-[1240px] mx-auto">
                <div class="bg-white shadow-md rounded-t-xl border border-gray-200 overflow-hidden">
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Foto
                                            <svg class="ml-1 w-3 h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.99967 1.33334V10.6667M5.99967 10.6667L10.6663 6.00001M5.99967 10.6667L1.33301 6.00001" stroke="#101828" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </th>
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
                                            Nama PT
                                            <svg class="ml-1 w-3 h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.99967 1.33334V10.6667M5.99967 10.6667L10.6663 6.00001M5.99967 10.6667L1.33301 6.00001" stroke="#101828" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Deskripsi
                                            <svg class="ml-1 w-3 h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.99967 1.33334V10.6667M5.99967 10.6667L10.6663 6.00001M5.99967 10.6667L1.33301 6.00001" stroke="#101828" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Tgl Terdaftar
                                            <svg class="ml-1 w-3 h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.99967 1.33334V10.6667M5.99967 10.6667L10.6663 6.00001M5.99967 10.6667L1.33301 6.00001" stroke="#101828" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            Status
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
                            <tbody class="bg-white divide-y divide-gray-200" id="laporanTableBody">
                                @foreach($summaries as $index => $summary)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}" data-status="{{ $summary->status }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <img src="{{ asset('storage/images/profile/' . $summary->foto_pp) }}" width="50" height="50" alt="Profile picture" class="object-cover rounded-full">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{$summary->nama_mitra}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{$summary->nama}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ Str::limit($summary->deskripsi, 15, '...') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{$summary->formatted_created_at}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($summary->status == 'guest')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#FEF3F2] text-[#B42318]">
                                            Non Aktif
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#ECFDF3] text-[#027A48]">
                                            Aktif
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <a href="{{ route('dashboard.user.show', $summary->id) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 hover:bg-indigo-200 px-3 py-1 rounded-md transition duration-300">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden">
                        @foreach($summaries as $index => $summary)
                            <div class="p-4 border-b {{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}" data-status="{{ $summary->status }}">
                                <div class="flex items-center mb-2">
                                    <img src="{{ asset('storage/images/profile/' . $summary->foto_pp) }}" width="50" height="50" alt="Profile picture" class="object-cover rounded-full mr-4">
                                    <h3 class="font-semibold text-lg">{{ $summary->nama_mitra }}</h3>
                                </div>
                                <p class="text-sm mb-1"><span class="font-medium">Nama PT:</span> {{ $summary->nama }}</p>
                                <p class="text-sm mb-1"><span class="font-medium">Deskripsi:</span> {{ Str::limit($summary->deskripsi, 30, '...') }}</p>
                                <p class="text-sm mb-1"><span class="font-medium">Tgl Terdaftar:</span> {{ $summary->formatted_created_at }}</p>
                                <p class="text-sm mb-2">
                                    <span class="font-medium">Status:</span>
                                    @if($summary->status == 'guest')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#FEF3F2] text-[#B42318]">
                                        Non Aktif
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#ECFDF3] text-[#027A48]">
                                        Aktif
                                    </span>
                                    @endif
                                </p>
                                <a href="{{ route('dashboard.user.show', $summary->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 hover:bg-indigo-200 px-3 py-1 rounded-md transition duration-300 inline-block mt-2">
                                    Detail
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white border-t border-gray-200 px-4 py-3 sm:px-6 rounded-b-xl">
                    {{ $summaries->appends(request()->except('page'))->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.kategori-filter');
        const tableRows = document.querySelectorAll('#laporanTableBody tr');
        const quarterFilter = document.getElementById('quarterFilter');
        const applyFilterButton = document.getElementById('applyFilter');
        const searchInput = document.getElementById('searchInput');

        // Fungsi untuk menambahkan event listener jika elemen ada
        function addEventListenerIfExists(element, event, handler) {
            if (element) {
                element.addEventListener(event, handler);
            }
        }

        // Fungsi filter table
        function filterTable() {
            const status = document.querySelector('.kategori-filter.bg-[#98100A]').getAttribute('data-status');
            const quarter = quarterFilter.value;

            tableRows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowDate = new Date(row.querySelector('td:nth-child(5)').textContent);
                const rowQuarter = Math.floor((rowDate.getMonth() + 3) / 3);

                const statusMatch = status === 'semua' || rowStatus === status;
                const quarterMatch = quarter === '' || quarterMatch(rowQuarter, quarter);

                if (statusMatch && quarterMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function quarterMatch(rowQuarter, selectedQuarter) {
            return selectedQuarter === '' || rowQuarter === parseInt(selectedQuarter);
        }

        filterButtons.forEach(button => {
            addEventListenerIfExists(button, 'click', function() {
                const status = this.getAttribute('data-status');
                
                // Ubah warna tombol
                filterButtons.forEach(btn => btn.classList.remove('bg-[#98100A]', 'text-white'));
                filterButtons.forEach(btn => btn.classList.add('bg-gray-200', 'text-gray-700'));
                this.classList.remove('bg-gray-200', 'text-gray-700');
                this.classList.add('bg-[#98100A]', 'text-white');

                // Filter tabel
                filterTable();
            });
        });

        // Tambahkan event listener ke input pencarian
        addEventListenerIfExists(searchInput, 'input', function() {
            const searchTerm = this.value.toLowerCase();
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Tambahkan event listener ke tombol apply filter
        addEventListenerIfExists(applyFilterButton, 'click', function(e) {
            e.preventDefault();
            filterTable();
        });

        // Fungsi untuk mendapatkan parameter filter
        function getFilterParams() {
            return `quarter=${quarterFilter.value}&search=${searchInput.value}`;
        }

        // Tambahkan event listener ke tombol download CSV dan PDF
        const downloadButtons = document.querySelectorAll('a[href*="download"]');
        downloadButtons.forEach(button => {
            addEventListenerIfExists(button, 'click', function(e) {
                e.preventDefault();
                const filterParams = getFilterParams();
                window.location.href = `${this.href}?${filterParams}`;
            });
        });
    });
    </script>
    @endpush

    @if(auth()->user()->level === 'admin')
        <footer class="bg-black text-white mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-gray-300 text-sm">© 2024 Corporate Social Responsibility Kabupaten Cirebon</p>
                    <p class="text-gray-400 text-xs mt-1">Pemkab Kabupaten Cirebon, Badan Pendapatan Daerah (Bapenda) Kabupaten Cirebon.</p>
                </div>
                <a href="{{ url('/') }}" class="px-4 py-2 rounded-md text-white flex items-center border border-white hover:bg-[#2D3748] hover:text-gray-200 transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali Ke Halaman Utama
                </a>
            </div>
        </footer>
    @else
        <footer class="bg-black text-white mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-gray-300 text-sm">© 2024 Corporate Social Responsibility Kabupaten Cirebon</p>
                    <p class="text-gray-400 text-xs mt-1">Pemkab Kabupaten Cirebon, Badan Pendapatan Daerah (Bapenda) Kabupaten Cirebon.</p>
                </div>
                <a href="{{ url('/') }}" class="px-4 py-2 rounded-md text-white flex items-center border border-white hover:bg-[#2D3748] hover:text-gray-200 transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali Ke Halaman Utama
                </a>
            </div>
        </footer>
    @endif
</x-app-layout>
@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif