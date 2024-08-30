<x-app-layout>
    @include('notification.notification-all')

    @if(auth()->user()->level === 'admin')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <x-slot name="slot">
            <div class="w-full">
                <div class="relative w-full h-[240px]">
                    <img
                        src="{{ asset('images/mitra-bg.png') }}"
                        alt="Background"
                        class="w-full h-full object-cover"
                    />
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white">
                        <h1 class="text-4xl font-bold mb-2 text-center px-4 md:px-0 md:text-left">Selamat Datang di Admin CSR Kabupaten Cirebon</h1>
                        <p class="text-xl text-center md:text-left">Lapor dan ketahui program CSR Anda</p>
                    </div>
                </div>
                <div class="px-8 py-6">
                    <div class="my-6">
                        @include('components.filter-section')
                    </div>
                    <div class="w-full max-w-[1240px] mx-auto">
                        <h2 class="font-inter text-[28px] font-semibold leading-[44px] tracking-[-0.02em] text-left mb-6">Data Statistik</h2>
                        <div class="flex justify-center items-center">
                            <div class="w-full max-w-[1240px] gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

                                {{-- Card Data --}}
                                <div class="w-full h-full flex flex-col justify-center items-start p-5 rounded-2xl bg-orange-600 space-y-4">
                                    <div class="w-full flex justify-start items-center space-x-3">
                                        <img class="h-10" src="{{url('images/icon_1.png')}}" alt="">
                                        <h1 class="text-lg text-white font-medium">Total Proyek CSR</h1>
                                    </div>
                                    <div class="w-full h-14 justify-start bg-white bg-opacity-20 border rounded-lg p-3">
                                        <h1 class="text-lg text-white font-black">{{$jumlahProyek}}</h1>
                                    </div>
                                </div>

                                <div class="w-full h-full flex flex-col justify-center items-start p-5 rounded-2xl bg-indigo-600 space-y-4">
                                    <div class="w-full flex justify-start items-center space-x-3">
                                        <img class="h-10" src="{{url('images/icon_2.png')}}" alt="">
                                        <h1 class="text-lg text-white font-medium">Proyek Terealisasi</h1>
                                    </div>
                                    <div class="w-full h-14 justify-start bg-white bg-opacity-20 border rounded-lg p-3">
                                        <h1 class="text-lg text-white font-black">{{$jumlahProyekTerealisasi}}</h1>
                                    </div>
                                </div>

                                <div class="w-full h-full flex flex-col justify-center items-start p-5 rounded-2xl bg-emerald-600 space-y-4">
                                    <div class="w-full flex justify-start items-center space-x-3">
                                        <img class="h-10" src="{{url('images/icon_3.png')}}" alt="">
                                        <h1 class="text-lg text-white font-medium">Dana realisasi CSR mitra</h1>
                                    </div>
                                    <div class="w-full h-14 justify-start bg-white bg-opacity-20 border rounded-lg p-3">
                                        <h1 class="text-lg text-white font-black">{{$formattedDanaRealisasiFull}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-[1240px] mx-auto mt-8">
                        <div class="flex justify-start items-center mb-4">
                            <h2 class="text-[28px] font-semibold leading-[44px] tracking-[-0.02em] text-left mb-6">Realisasi Proyek CSR</h2>
                        </div>

                        <div class="relative overflow-x-auto bg-white rounded-lg border">
                            <div class='w-full flex justify-between items-center bg-slate-100 rounded-md max-md:flex-col'>
                                <div class="w-1/2 h-[450px] max-md:w-full">
                                    <h1 class='font-black text-2xl p-5'>Persentase jumlah realisasi proyek per sektor</h1>
                                    <div id="pie-chart"></div>
                                </div>
                                <div class="w-1/2 h-[450px] max-md:w-full">
                                    <h1 class='font-black text-2xl p-5'>Total realisasi proyek per sektor</h1>
                                    <div id="bar-chart-1"></div>
                                </div>
                            </div>
                            <div class='w-full flex justify-between items-center bg-slate-100 rounded-md max-md:flex-col'>
                                <div class="w-1/2 h-[450px] max-md:w-full">
                                    <h1 class='font-black text-2xl p-5'>Jumlah realisasi terbanyak berdasarkan mitra</h1>
                                    <div id="bar-chart-2"></div>
                                </div>
                                <div class="w-1/2 h-[450px] max-md:w-full">
                                    <h1 class='font-black text-2xl p-5'>Jumlah realisasi terbanyak berdasarkan kecamatan</h1>
                                    <div id="bar-chart-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.footer')
        </x-slot>
    @elseif(auth()->user()->level === 'mitra')
        @php
            $summary = auth()->user()->summary;
            $isProfileComplete = $summary && $summary->nama && $summary->nama_mitra && $summary->email && $summary->no_telp && $summary->alamat && $summary->deskripsi;
        @endphp

        @if(!$isProfileComplete)
            <x-slot name="slot">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold mb-4">{{ __('Lengkapi Profil Anda') }}</h3>
                                <p class="mb-4">Silakan lengkapi profil Anda untuk mengakses dashboard.</p>
                                
                                @include('profile.summary-edit-form')
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>
        @else
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>

            <x-slot name="slot">
                <div class="w-full">
                    <div class="relative w-full h-[240px]">
                        <img
                            src="{{ asset('images/mitra-bg.png') }}"
                            alt="Background"
                            class="w-full h-full object-cover"
                        />
                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white">
                            <h1 class="text-4xl font-bold mb-2 text-center px-4 md:px-0 md:text-left">Selamat Datang di Dashboard CSR Kabupaten Cirebon</h1>
                            <p class="text-xl text-center md:text-left">Lapor dan ketahui program CSR Anda</p>
                        </div>
                    </div>
                    <div class="px-8 py-6">
                        <div class="my-6">
                            @include('components.filter-section')
                        </div>
                        <div class="w-full max-w-[1240px] mx-auto">
                            <h2 class="font-inter text-[28px] font-semibold leading-[44px] tracking-[-0.02em] text-left mb-6">Data Statistik</h2>
                            <div class="flex justify-center items-center">
                                <div class="w-full max-w-[1240px] gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

                                    {{-- Card Data --}}
                                    <div class="w-full h-full flex flex-col justify-center items-start p-5 rounded-2xl bg-orange-600 space-y-4">
                                        <div class="w-full flex justify-start items-center space-x-3">
                                            <img class="h-10" src="{{url('images/icon_1.png')}}" alt="">
                                            <h1 class="text-lg text-white font-medium">Total Proyek CSR</h1>
                                        </div>
                                        <div class="w-full h-14 justify-start bg-white bg-opacity-20 border rounded-lg p-3">
                                            <h1 class="text-lg text-white font-black">{{$jumlahProyek}}</h1>
                                        </div>
                                    </div>
    
                                    <div class="w-full h-full flex flex-col justify-center items-start p-5 rounded-2xl bg-indigo-600 space-y-4">
                                        <div class="w-full flex justify-start items-center space-x-3">
                                            <img class="h-10" src="{{url('images/icon_2.png')}}" alt="">
                                            <h1 class="text-lg text-white font-medium">Proyek Terealisasi</h1>
                                        </div>
                                        <div class="w-full h-14 justify-start bg-white bg-opacity-20 border rounded-lg p-3">
                                            <h1 class="text-lg text-white font-black">{{$jumlahProyekTerealisasi}}</h1>
                                        </div>
                                    </div>
    
                                    <div class="w-full h-full flex flex-col justify-center items-start p-5 rounded-2xl bg-emerald-600 space-y-4">
                                        <div class="w-full flex justify-start items-center space-x-3">
                                            <img class="h-10" src="{{url('images/icon_3.png')}}" alt="">
                                            <h1 class="text-lg text-white font-medium">Dana realisasi CSR mitra</h1>
                                        </div>
                                        <div class="w-full h-14 justify-start bg-white bg-opacity-20 border rounded-lg p-3">
                                            <h1 class="text-lg text-white font-black">{{$formattedDanaRealisasiFull}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full max-w-[1240px] mx-auto mt-8">
                            <div class="flex justify-start items-center mb-4">
                                <h2 class="text-[28px] font-semibold leading-[44px] tracking-[-0.02em] text-left mb-6">Realisasi Proyek CSR</h2>
                            </div>
    
                            <div class="relative overflow-x-auto bg-white rounded-lg border">
                                <div class='w-full flex justify-between items-center bg-slate-100 rounded-md max-md:flex-col'>
                                    <div class="w-1/2 h-[450px] max-md:w-full">
                                        <h1 class='font-black text-2xl p-5'>Persentase jumlah realisasi proyek per sektor</h1>
                                        <div id="pie-chart"></div>
                                    </div>
                                    <div class="w-1/2 h-[450px] max-md:w-full">
                                        <h1 class='font-black text-2xl p-5'>Total realisasi proyek per sektor</h1>
                                        <div id="bar-chart-1"></div>
                                    </div>
                                </div>
                                <div class='w-full flex justify-between items-center bg-slate-100 rounded-md max-md:flex-col'>
                                    <div class="w-full h-[450px] max-md:w-full">
                                        <h1 class='font-black text-2xl p-5'>Jumlah realisasi terbanyak berdasarkan kecamatan</h1>
                                        <div id="bar-chart-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full max-w-[1240px] mx-auto mt-8">
                            
                            <div class="w-full max-w-[1240px] mx-auto mt-8">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-2xl font-bold">Laporan Mitra</h2>
                                    @if(auth()->user()->level === 'mitra')
                                        <a href="{{ route('dashboard.laporan') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                         Laporan Mitra
                                        </a>
                                    @endif
                                </div>
    
                                <div class="mb-4">
                                    <input type="text" id="table-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari laporan...">
                                </div>
    
                                @if(isset($laporans) && $laporans->count() > 0)
                                    <!-- Desktop Table -->
                                    <div class="hidden md:block overflow-x-auto bg-white rounded-lg border">
                                        <table class="w-full">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="px-4 py-2 text-left">Judul</th>
                                                    <th class="px-4 py-2 text-left">Lokasi</th>
                                                    <th class="px-4 py-2 text-left">Realisasi</th>
                                                    <th class="px-4 py-2 text-left">Tanggal Realisasi</th>
                                                    <th class="px-4 py-2 text-left">Laporan Kirim</th>
                                                    <th class="px-4 py-2 text-left">Status</th>
                                                    <th class="px-4 py-2 text-left">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($laporans as $laporan)
                                                    <tr class="border-t">
                                                        <td class="px-4 py-2">{{ $laporan->judul_laporan }}</td>
                                                        <td class="px-4 py-2">{{ $laporan->proyek->lokasi ?? 'Tidak ada lokasi' }}</td>
                                                        <td class="px-4 py-2">Rp {{ number_format($laporan->realisasi, 0, ',', '.') }}</td>
                                                        <td class="px-4 py-2">{{ $laporan->tanggal }} {{ $laporan->bulan }} {{ $laporan->tahun }}</td>
                                                        <td class="px-4 py-2">{{ $laporan->created_at->format('d M Y') }}</td>
                                                        <td class="px-4 py-2">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                {{ $laporan->status === 'terbit' ? 'bg-green-100 text-green-800' : 
                                                                   ($laporan->status === 'revisi' ? 'bg-yellow-100 text-yellow-800' : 
                                                                   ($laporan->status === 'pending' ? 'bg-blue-100 text-blue-800' : 
                                                                   ($laporan->status === 'tolak' ? 'bg-red-100 text-red-800' : 
                                                                   'bg-gray-100 text-gray-800'))) }}">
                                                                {{ ucfirst($laporan->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-2">
                                                            <a href="{{ route('dashboard.laporan.detail', $laporan->id) }}" class="text-blue-600 hover:text-blue-800">Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Mobile Cards -->
                                    <div class="md:hidden space-y-4">
                                        @foreach($laporans as $laporan)
                                            <div class="bg-white p-4 rounded-lg shadow">
                                                <h3 class="font-semibold text-lg mb-2">{{ $laporan->judul_laporan }}</h3>
                                                <p class="text-sm mb-1"><span class="font-medium">Lokasi:</span> {{ $laporan->proyek->lokasi ?? 'Tidak ada lokasi' }}</p>
                                                <p class="text-sm mb-1"><span class="font-medium">Realisasi:</span> Rp {{ number_format($laporan->realisasi, 0, ',', '.') }}</p>
                                                <p class="text-sm mb-1"><span class="font-medium">Tanggal Realisasi:</span> {{ $laporan->tanggal }} {{ $laporan->bulan }} {{ $laporan->tahun }}</p>
                                                <p class="text-sm mb-1"><span class="font-medium">Laporan Kirim:</span> {{ $laporan->created_at->format('d M Y') }}</p>
                                                <p class="text-sm mb-2">
                                                    <span class="font-medium">Status:</span>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        {{ $laporan->status === 'terbit' ? 'bg-green-100 text-green-800' : 
                                                           ($laporan->status === 'revisi' ? 'bg-yellow-100 text-yellow-800' : 
                                                           ($laporan->status === 'pending' ? 'bg-blue-100 text-blue-800' : 
                                                           ($laporan->status === 'tolak' ? 'bg-red-100 text-red-800' : 
                                                           'bg-gray-100 text-gray-800'))) }}">
                                                        {{ ucfirst($laporan->status) }}
                                                    </span>
                                                </p>
                                                <a href="{{ route('dashboard.laporan.detail', $laporan->id) }}" class="text-blue-600 hover:text-blue-800">Detail</a>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-4">
                                        {{ $laporans->links() }}
                                    </div>
                                @else
                                    <p class="text-center py-4">Tidak ada laporan tersedia.</p>
                                @endif
                            </div>
                           
                        </div>
                    </div>
                </div>

                @include('components.footer')
            </x-slot>
        @endif
    @else
        <x-slot name="slot">
            @include('404')
        </x-slot>
    @endif
</x-app-layout>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    var categories = @json($categories);
    var data = @json($data);
    var dataJumlah = @json($dataJumlah);
    var pieData = @json($pieData);
    var pieCategories = @json($pieCategories);
    var topMitraNames = @json($topMitraNames);
    var topMitraLaporanCounts = @json($topMitraLaporanCounts);
    var kecamatanNames = @json($kecamatanNames);
    var totalRealisasiValues = @json($totalRealisasiValues);
        // Bar Chart 1 - Data Jumlah Laporan per Sektor
        var barOptions1 = {
            series: [{
                data: dataJumlah
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: true
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: categories
            }
        };
        var barChart1 = new ApexCharts(document.querySelector("#bar-chart-1"), barOptions1);
        barChart1.render();

        // Bar Chart 2 - Data Jumlah Laporan per Mitra
        var barOptions2 = {
            series: [{
                data: topMitraLaporanCounts
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: true
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: topMitraNames
            }
        };
        var barChart2 = new ApexCharts(document.querySelector("#bar-chart-2"), barOptions2);
        barChart2.render();

        // Bar Chart 3 - Jumlah Laporan per Lokasi
        var barOptions3 = {
            series: [{
                data: totalRealisasiValues
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: true
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: kecamatanNames
            }
        };
        var barChart3 = new ApexCharts(document.querySelector("#bar-chart-3"), barOptions3);
        barChart3.render();

        // Pie Chart - Data per Sektor
        var pieOptions = {
            chart: {
                type: 'pie',
                height: 350
            },
            series: pieData,
            labels: pieCategories,
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val.toFixed(2) + '%'
                    }
                }
            }
        };
        var pieChart = new ApexCharts(document.querySelector("#pie-chart"), pieOptions);
        pieChart.render();
    });
</script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('table-search');
    const tableRows = document.querySelectorAll('table tbody tr');
    const mobileCards = document.querySelectorAll('.md\\:hidden > div');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });

        mobileCards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});
</script>
@endpush