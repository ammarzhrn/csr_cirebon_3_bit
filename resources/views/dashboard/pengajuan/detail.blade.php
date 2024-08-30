@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-admin')

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-20">
                    <!-- Breadcrumb -->
                    <div class="mb-6">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.66667 14.1663H13.3333M9.18141 2.30297L3.52949 6.6989C3.15168 6.99276 2.96278 7.13968 2.82669 7.32368C2.70614 7.48667 2.61633 7.67029 2.56169 7.86551C2.5 8.0859 2.5 8.32521 2.5 8.80384V14.833C2.5 15.7664 2.5 16.2331 2.68166 16.5896C2.84144 16.9032 3.09641 17.1582 3.41002 17.318C3.76654 17.4996 4.23325 17.4996 5.16667 17.4996H14.8333C15.7668 17.4996 16.2335 17.4996 16.59 17.318C16.9036 17.1582 17.1586 16.9032 17.3183 16.5896C17.5 16.2331 17.5 15.7664 17.5 14.833V8.80384C17.5 8.32521 17.5 8.0859 17.4383 7.86551C17.3837 7.67029 17.2939 7.48667 17.1733 7.32368C17.0372 7.13968 16.8483 6.99276 16.4705 6.69891L10.8186 2.30297C10.5258 2.07526 10.3794 1.9614 10.2178 1.91763C10.0752 1.87902 9.92484 1.87902 9.78221 1.91763C9.62057 1.9614 9.47418 2.07526 9.18141 2.30297Z" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <a href="{{ route('dashboard.pengajuan.index') }}" class="text-gray-500 hover:text-gray-700">
                                {{ __('Pengajuan') }}
                            </a>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="font-semibold text-sm text-red-600">
                                {{ __('Detail') }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Pengajuan</h2>
                            
                            @if(isset($pengajuan) && $pengajuan)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white">
                                        <tbody>
                                            <tr class="bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nama</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pengajuan->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nama Instansi</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pengajuan->nama_instansi }}</td>
                                            </tr>
                                            <tr class="bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No Telp</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pengajuan->no_telp }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Alamat</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pengajuan->alamat }}</td>
                                            </tr>
                                            <tr class="bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mitra CSR</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pengajuan->mitra_csr }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nama Program</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pengajuan->nama_program }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-red-500">Data Pengajuan Tidak Ditemukan</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('dashboard.pengajuan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center transition duration-300">
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer section -->
        <footer class="bg-black text-white border-t border-gray-300 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-sm">
                        © 2024 Corporate Social Responsibility Kabupaten Cirebon
                    </p>
                    <p class="text-xs mt-1">
                        Pemkab Kabupaten Cirebon, Badan Pendapatan Daerah (Bapenda) Kabupaten Cirebon.
                    </p>
                </div>
                <div>
                    <a href="/" class="inline-block border border-white px-4 py-2 rounded-md text-sm hover:bg-white hover:text-black transition duration-300">
                        Kembali ke halaman utama
                    </a>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>
@else
<x-app-layout>
    @include('errors.404')
</x-app-layout>
@endif