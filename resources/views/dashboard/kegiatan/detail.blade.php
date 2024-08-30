@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-admin')

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <!-- Hero section with full-width image -->
            <div class="relative w-full h-[400px]">
                <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul_kegiatan }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-between py-6">
                        <!-- Breadcrumb and Edit button -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2 text-white">
                                <a href="{{ route('dashboard') }}" class="hover:text-gray-300">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.66667 14.1663H13.3333M9.18141 2.30297L3.52949 6.6989C3.15168 6.99276 2.96278 7.13968 2.82669 7.32368C2.70614 7.48667 2.61633 7.67029 2.56169 7.86551C2.5 8.0859 2.5 8.32521 2.5 8.80384V14.833C2.5 15.7664 2.5 16.2331 2.68166 16.5896C2.84144 16.9032 3.09641 17.1582 3.41002 17.318C3.76654 17.4996 4.23325 17.4996 5.16667 17.4996H14.8333C15.7668 17.4996 16.2335 17.4996 16.59 17.318C16.9036 17.1582 17.1586 16.9032 17.3183 16.5896C17.5 16.2331 17.5 15.7664 17.5 14.833V8.80384C17.5 8.32521 17.5 8.0859 17.4383 7.86551C17.3837 7.67029 17.2939 7.48667 17.1733 7.32368C17.0372 7.13968 16.8483 6.99276 16.4705 6.69891L10.8186 2.30297C10.5258 2.07526 10.3794 1.9614 10.2178 1.91763C10.0752 1.87902 9.92484 1.87902 9.78221 1.91763C9.62057 1.9614 9.47418 2.07526 9.18141 2.30297Z" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <a href="{{ route('dashboard.kegiatan.index') }}" class="hover:text-gray-300">Kegiatan</a>
                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="font-semibold text-red-500 hover:text-red-300 cursor-pointer">
                                    {{ __('Detail') }}
                                </span>
                            </div>
                            <a href="{{ route('dashboard.kegiatan.edit', $kegiatan->id) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                    <path d="M15.0003 1.66602L18.3337 4.99935M1.66699 18.3327L2.73066 14.4326C2.80006 14.1781 2.83475 14.0509 2.88802 13.9323C2.93531 13.8269 2.99343 13.7268 3.06142 13.6334C3.138 13.5283 3.23125 13.4351 3.41775 13.2486L12.0289 4.63742C12.1939 4.47241 12.2764 4.38991 12.3716 4.359C12.4553 4.33181 12.5454 4.33181 12.6291 4.359C12.7242 4.38991 12.8067 4.47241 12.9717 4.63742L15.3623 7.02794C15.5273 7.19295 15.6098 7.27546 15.6407 7.37059C15.6679 7.45428 15.6679 7.54442 15.6407 7.62811C15.6098 7.72324 15.5273 7.80575 15.3623 7.97075L6.75108 16.5819C6.56458 16.7684 6.47134 16.8617 6.36623 16.9383C6.2729 17.0062 6.17276 17.0644 6.06742 17.1117C5.94878 17.1649 5.82156 17.1996 5.56711 17.269L1.66699 18.3327Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Ubah Kegiatan
                            </a>
                        </div>

                        <!-- Title and date -->
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">{{ $kegiatan->judul_kegiatan }}</h1>
                            <p class="text-lg text-white mb-4">{{ $kegiatan->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <!-- Status badge -->
                            <div class="mb-4 flex justify-end">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $kegiatan->status === 'terbit' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($kegiatan->status) }}
                                </span>
                            </div>

                            <!-- Full description -->
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold mb-4">Deskripsi Kegiatan</h2>
                                <div class="prose max-w-none">{!! $kegiatan->deskripsi !!}</div>
                            </div>

                            <!-- Tags -->
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold mb-2">Tags:</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $kegiatan->tags) as $tag)
                                        <span class="px-3 py-1 bg-blue-500 text-white rounded-full text-sm">
                                            {{ trim($tag) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer section -->
        <footer class="bg-black text-white border-t border-gray-300 py-[70px]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left">
                    <p class="text-gray-300 text-sm">
                        © 2024 Corporate Social Responsibility Kabupaten Cirebon
                    </p>
                    <p class="text-gray-300 text-xs mt-1">
                        Pemkab Kabupaten Cirebon, Badan Pendapatan Daerah (Bapenda) Kabupaten Cirebon.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="/" class="border border-gray-300 px-4 py-2 rounded-md text-white flex items-center">
                        Kembali ke halaman utama
                    </a>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>
@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif
