<x-app-layout>
    @include('notification.notification-all')

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Breadcrumb -->
                    <div class="mb-6">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.66667 14.1663H13.3333M9.18141 2.30297L3.52949 6.6989C3.15168 6.99276 2.96278 7.13968 2.82669 7.32368C2.70614 7.48667 2.61633 7.67029 2.56169 7.86551C2.5 8.0859 2.5 8.32521 2.5 8.80384V14.833C2.5 15.7664 2.5 16.2331 2.68166 16.5896C2.84144 16.9032 3.09641 17.1582 3.41002 17.318C3.76654 17.4996 4.23325 17.4996 5.16667 17.4996H14.8333C15.7668 17.4996 16.2335 17.4996 16.59 17.318C16.9036 17.1582 17.1586 16.9032 17.3183 16.5896C17.5 16.2331 17.5 15.7664 17.5 14.833V8.80384C17.5 8.32521 17.5 8.0859 17.4383 7.86551C17.3837 7.67029 17.2939 7.48667 17.1733 7.32368C17.0372 7.13968 16.8483 6.99276 16.4705 6.69891L10.8186 2.30297C10.5258 2.07526 10.3794 1.9614 10.2178 1.91763C10.0752 1.87902 9.92484 1.87902 9.78221 1.91763C9.62057 1.9614 9.47418 2.07526 9.18141 2.30297Z"
                                        stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <a href="{{ url('/dashboard/laporan') }}" class="text-sm text-gray-500 hover:text-gray-700">
                                {{ __('Laporan') }}
                            </a>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="font-semibold text-sm text-red-600">
                                {{ __('Detail Laporan') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2
                                class="text-[28px] font-semibold leading-[44px] tracking-[-0.02em] text-left font-inter">
                                Detail Laporan</h2>
                        </div>

                        <!-- Main content -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-8 text-gray-900">
                                @if(auth()->user()->level === 'mitra')
                                <div class="mb-6">
                                    @if($laporan->status === 'revisi')
                                    <div class="flex p-4 mb-4 text-sm border rounded-lg bg-yellow-50 text-yellow-800 border-yellow-300"
                                        role="alert">
                                        <svg width="20" height="17" viewBox="0 0 20 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="flex-shrink-0 inline w-5 h-5 mr-3">
                                            <path
                                                d="M9.99963 6.50019V9.83353M9.99963 13.1669H10.008M8.84573 2.24329L1.99166 14.0821C1.61149 14.7388 1.4214 15.0671 1.4495 15.3366C1.474 15.5716 1.59714 15.7852 1.78828 15.9242C2.00741 16.0835 2.38679 16.0835 3.14556 16.0835H16.8537C17.6125 16.0835 17.9919 16.0835 18.211 15.9242C18.4021 15.7852 18.5253 15.5716 18.5498 15.3366C18.5779 15.0671 18.3878 14.7388 18.0076 14.0821L11.1535 2.24329C10.7747 1.58899 10.5853 1.26184 10.3382 1.15196C10.1227 1.05612 9.8766 1.05612 9.66105 1.15196C9.41394 1.26184 9.22454 1.58899 8.84573 2.24329Z"
                                                stroke="#DC6803" stroke-width="1.66667" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <div>
                                            <span class="font-medium">Laporan perlu direvisi</span>
                                            <p>{{ $laporan->pesan_admin }}</p>
                                        </div>
                                    </div>
                                    @elseif($laporan->status === 'tolak')
                                    <div id="statusAlert" class="mb-4 relative">
                                        <div class="flex p-4 text-sm border rounded-lg bg-red-50 text-red-800 border-red-300"
                                            role="alert">
                                            <svg class="flex-shrink-0 inline w-5 h-5 mr-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                            </svg>
                                            <div>
                                                <span class="font-medium">Laporan ditolak</span>
                                                <p>{{ $laporan->pesan_admin }}</p>
                                            </div>
                                        </div>
                                        <button onclick="closeStatusAlert()"
                                            class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @elseif($laporan->status === 'terbit')
                                    <div id="statusAlert" class="mb-4 relative">
                                        <div class="flex p-4 text-sm border rounded-lg bg-green-50 text-green-800 border-green-300"
                                            role="alert">
                                            <svg class="flex-shrink-0 inline w-5 h-5 mr-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                            </svg>
                                            <div>
                                                <span class="font-medium">Laporan diterbitkan</span>
                                                <p>{{ $laporan->pesan_admin }}</p>
                                            </div>
                                        </div>
                                        <button onclick="closeStatusAlert()"
                                            class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @elseif($laporan->status === 'pending')
                                    <div class="flex p-4 mb-4 text-sm border rounded-lg bg-blue-50 text-blue-800 border-blue-300"
                                        role="alert">
                                        <svg class="flex-shrink-0 inline w-5 h-5 mr-3" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm1 13.5a1 1 0 0 1-2 0V7.5a1 1 0 0 1 2 0v6.5Zm-1-8.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <div>
                                            <span class="font-medium">Laporan sedang ditinjau</span>
                                            <p>{{ $laporan->pesan_admin ?: 'Laporan Anda sedang dalam proses peninjauan oleh admin' }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <div class="mb-6">
                                    <div class="flex space-x-2 mb-2">
                                        @if($laporan->status === 'terbit')
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                            Diterbitkan
                                        </span>
                                        @elseif($laporan->status === 'tolak')
                                        <span
                                            class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                                            Ditolak
                                        </span>
                                        @elseif($laporan->status === 'draf')
                                        <span
                                            class="px-3 py-1 bg-red-100 text-gray-700 rounded-full text-sm font-medium">
                                            Draft
                                        </span>
                                        @endif
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium">
                                            {{ $laporan->sektor->nama_sektor ?? 'Tidak ada sektor' }}
                                        </span>
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium">
                                            {{ $laporan->program->nama_program ?? 'Tidak ada program' }}
                                        </span>
                                    </div>

                                    <div class="flex items-start pb-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="mt-1 mr-3">
                                            <path
                                                d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z"
                                                stroke="#98100A" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M3 9H21" stroke="#98100A" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M9 21V9" stroke="#98100A" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex-grow">
                                            <h1 class="text-2xl font-bold text-gray-900">{{ $laporan->judul_laporan }}
                                            </h1>
                                            <p class="text-base font-semibold leading-8 text-left text-gray-500 mt-2">
                                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('j F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-b border-gray-200 mb-6"></div>

                                <!-- Image Preview Section -->
                                <div class="mb-8">
                                    @php
                                    $images = is_string($laporan->images) ? json_decode($laporan->images, true) :
                                    ($laporan->images ?? []);
                                    @endphp

                                    @if(!empty($images) && is_array($images))
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-[11.18px]">
                                        @foreach($images as $index => $image)
                                        @if($index < 4) <div
                                            class="w-full aspect-[300/183.29] rounded-[8.94px] overflow-hidden relative image-preview">
                                            <img src="{{ Storage::url($image) }}" alt="Gambar Laporan {{ $index + 1 }}"
                                                class="w-full h-full object-cover">
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @else
                                <p class="text-gray-600">Tidak ada gambar tersedia untuk laporan ini.</p>
                                @endif
                            </div>

                            <!-- Informasi Detail Laporan -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                                <div class="bg-[#FFF1F0] rounded-lg p-4 border-l-4 border-[#98100A]">
                                    <p class="text-sm font-normal leading-5 text-gray-500">Realisasi</p>
                                    <p class="text-base font-semibold leading-6">Rp
                                        {{ number_format($laporan->realisasi, 0, ',', '.') }}</p>
                                </div>
                                <div class="bg-[#FFF1F0] rounded-lg p-4 border-l-4 border-[#98100A]">
                                    <p class="text-sm font-normal leading-5 text-gray-500">Nama Proyek</p>
                                    <p class="text-base font-semibold leading-6">
                                        {{ $laporan->proyek->nama_proyek ?? 'Tidak ada proyek' }}</p>
                                </div>
                                <div class="bg-[#FFF1F0] rounded-lg p-4 border-l-4 border-[#98100A]">
                                    <p class="text-sm font-normal leading-5 text-gray-500">Kecamatan</p>
                                    <p class="text-base font-semibold leading-6">
                                        {{ $laporan->proyek->lokasi ?? 'Tidak ada lokasi' }}</p>
                                </div>
                                <div class="bg-[#FFF1F0] rounded-lg p-4 border-l-4 border-[#98100A]">
                                    <p class="text-sm font-normal leading-5 text-gray-500">Tanggal Realisasi</p>
                                    <p class="text-base font-semibold leading-6">{{ $laporan->tanggal }}
                                        {{ $laporan->bulan }} {{ $laporan->tahun }}</p>
                                </div>
                            </div>

                            <!-- Rincian Laporan -->
                            <div class="mb-8">
                                <h4 class="text-2xl font-semibold leading-7 mb-4">Rincian Laporan</h4>
                                <div class="text-lg font-normal leading-7 text-gray-700 space-y-4">
                                    @php
                                    $paragraphs = explode("\n", $laporan->deskripsi);
                                    @endphp
                                    @foreach($paragraphs as $paragraph)
                                    @if(trim($paragraph) !== '')
                                    <p>{{ $paragraph }}</p>
                                    @endif
                                    @endforeach
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                @if(auth()->user()->level === 'admin')
                @if($laporan->status !== 'tolak' && $laporan->status !== 'terbit')
                <div
                    class="mt-8 w-full max-w-[1240px] h-[84px] px-6 py-4 bg-white border border-[#EAECF0] rounded-lg flex items-center justify-between">
                    <button onclick="showPopup('tolak')"
                        class="flex items-center justify-center w-[250px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#98100A] bg-[#FFF1F0] text-[#98100A] hover:bg-[#FDE8E7] transition duration-150 ease-in-out">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 1.29492L1 11.2949M1 1.29492L11 11.2949" stroke="#98100A" stroke-width="1.66667"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-base font-semibold leading-6">Tolak</span>
                    </button>
                    <button onclick="showPopup('revisi')"
                        class="flex items-center justify-center w-[250px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#2C5586] bg-[#F4F7FB] text-[#2C5586] hover:bg-[#E9EFF5] transition duration-150 ease-in-out">
                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.9998 0.960938L18.3332 4.29427M1.6665 17.6276L2.73017 13.7275C2.79957 13.473 2.83426 13.3458 2.88753 13.2272C2.93482 13.1218 2.99294 13.0217 3.06093 12.9284C3.13752 12.8233 3.23076 12.73 3.41726 12.5435L12.0284 3.93234C12.1934 3.76734 12.2759 3.68483 12.3711 3.65392C12.4548 3.62673 12.5449 3.62673 12.6286 3.65392C12.7237 3.68483 12.8062 3.76733 12.9712 3.93234L15.3618 6.32287C15.5268 6.48787 15.6093 6.57038 15.6402 6.66551C15.6674 6.7492 15.6674 6.83934 15.6402 6.92303C15.6093 7.01817 15.5268 7.10067 15.3618 7.26568L6.75059 15.8769C6.5641 16.0633 6.47085 16.1566 6.36574 16.2332C6.27241 16.3012 6.17227 16.3593 6.06693 16.4066C5.94829 16.4598 5.82107 16.4945 5.56662 16.5639L1.6665 17.6276Z"
                                stroke="#2C5586" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-base font-semibold leading-6">Revisi</span>
                    </button>
                    <button onclick="showPopup('terbit')"
                        class="flex items-center justify-center w-[250px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#2C5586] bg-[#2C5586] text-white hover:bg-[#234A75] transition duration-150 ease-in-out shadow-[0px_1px_2px_0px_#1018280D]">
                        <svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.1668 1.29492L5.00016 10.4616L0.833496 6.29492" stroke="white"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-base font-semibold leading-6">Terbit</span>
                    </button>
                </div>
                @else
                <div
                    class="mt-8 w-full max-w-[1240px] h-[84px] px-6 py-4 bg-white border border-[#EAECF0] rounded-lg flex items-center">
                    <p class="text-gray-600">Tindakan admin tidak diperlukan lagi untuk laporan ini.</p>
                </div>
                @endif

                <!-- Popup -->
                <div id="popup" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden"
                    onclick="closePopupOnOverlayClick(event)">
                    <div class="relative top-20 mx-auto p-4 sm:p-6 border w-full max-w-[521px] bg-white rounded-[12px]"
                        style="box-shadow: 0px 8px 8px -4px rgba(16, 24, 40, 0.03), 0px 20px 24px -4px rgba(16, 24, 40, 0.08);">
                        <div class="flex flex-col gap-4 sm:gap-6">
                            <div class="flex flex-col items-start gap-2">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            stroke="#2C5586" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 8V12" stroke="#2C5586" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 16H12.01" stroke="#2C5586" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-lg font-semibold" id="popupTitle"></h3>
                                    <p id="popupDescription" class="text-sm text-gray-500"></p>
                                </div>
                            </div>
                            <div id="reasonContainer" class="hidden">
                                <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Alasan</label>
                                <textarea id="reason" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    placeholder="Masukan Alasan"></textarea>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-4 w-full">
                                <button onclick="hidePopup()"
                                    class="w-full sm:w-1/2 px-4 py-2 bg-white text-gray-800 rounded-md border border-gray-300 hover:bg-gray-100">Batal</button>
                                <button onclick="submitAction()" id="submitButton"
                                    class="w-full sm:w-1/2 px-4 py-2 bg-[#98100A] text-white rounded-md border border-[#98100A] hover:bg-[#7A0D08] shadow-[0px_1px_2px_0px_#1018280D]">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    let currentAction = '';

                    function showPopup(action) {
                        currentAction = action;
                        const popup = document.getElementById('popup');
                        const title = document.getElementById('popupTitle');
                        const description = document.getElementById('popupDescription');
                        const reasonContainer = document.getElementById('reasonContainer');
                        const submitButton = document.getElementById('submitButton');

                        popup.classList.remove('hidden');

                        if (action === 'tolak') {
                            title.textContent = 'Tolak';
                            description.textContent = 'Laporan akan ditolak dan tidak akan dipublikasikan';
                            reasonContainer.classList.remove('hidden');
                            submitButton.textContent = 'Tolak';
                        } else if (action === 'revisi') {
                            title.textContent = 'Revisi';
                            description.textContent =
                                'Laporan akan diberikan kepada mitra untuk merevisi beberapa hal yang tidak sesuai';
                            reasonContainer.classList.remove('hidden');
                            submitButton.textContent = 'Kirim';
                        } else if (action === 'terbit') {
                            title.textContent = 'Terbit';
                            description.textContent = 'Laporan akan diterbitkan dan dapat dilihat oleh publik';
                            reasonContainer.classList.add('hidden');
                            submitButton.textContent = 'Terbitkan';
                        }
                    }

                    function hidePopup() {
                        document.getElementById('popup').classList.add('hidden');
                    }

                    function submitAction() {
                        const reason = document.getElementById('reason').value;
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch('{{ route("dashboard.laporan.update-status", $laporan) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    status: currentAction,
                                    pesan_admin: currentAction === 'terbit' ? null :
                                        reason // Kirim null jika terbit
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                if (data.success) {
                                    hidePopup();
                                    location.reload(); // Reload halaman untuk menampilkan perubahan
                                } else {
                                    alert(data.message || 'Terjadi kesalahan saat memperbarui status.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menghubungi server.');
                            });
                    }

                    function closePopupOnOverlayClick(event) {
                        const popupContent = document.querySelector('#popup > div');
                        if (!popupContent.contains(event.target)) {
                            hidePopup();
                        }
                    }

                    function submitLaporan(laporanId) {
                        if (!confirm('Apakah Anda yakin ingin mengirim laporan ini untuk ditinjau?')) {
                            return;
                        }

                        $.ajax({
                            url: `/dashboard/laporan/${laporanId}/submit`,
                            type: 'PUT',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.success) {
                                    alert(response.message);
                                    $('#status-badge').text(response.newStatus);
                                    $('#status-badge').removeClass('bg-gray-100 text-gray-800')
                                        .addClass('bg-yellow-100 text-yellow-800');
                                    $('#submit-button').hide();
                                    $('.status-message').html(`
                    <div class="flex p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Laporan sedang ditinjau!</span>
                            <p>Laporan Anda telah berhasil dikirim dan sedang menunggu peninjauan dari admin.</p>
                        </div>
                    </div>
                `);
                                } else {
                                    alert('Gagal mengirim laporan: ' + response.message);
                                }
                            },
                            error: function (xhr) {
                                alert('Terjadi kesalahan: ' + (xhr.responseJSON ? xhr.responseJSON.message :
                                    'Unknown error'));
                            }
                        });
                    }

                </script>
                @endif
            </div>
        </div>
    </div>
    @if(auth()->user()->level === 'mitra')
    @if($laporan->status === 'draf')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-6 flex justify-center items-center gap-6 shadow-sm">
            <form action="{{ route('dashboard.laporan.destroy', $laporan) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="flex items-center justify-center w-[177px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.167 5.29427H18.3337V6.96094H16.667V17.7943C16.667 18.0153 16.5792 18.2272 16.4229 18.3835C16.2666 18.5398 16.0547 18.6276 15.8337 18.6276H4.16699C3.94598 18.6276 3.73402 18.5398 3.57774 18.3835C3.42146 18.2272 3.33366 18.0153 3.33366 17.7943V6.96094H1.66699V5.29427H5.83366V2.79427C5.83366 2.57326 5.92146 2.3613 6.07774 2.20502C6.23402 2.04873 6.44598 1.96094 6.66699 1.96094H13.3337C13.5547 1.96094 13.7666 2.04873 13.9229 2.20502C14.0792 2.3613 14.167 2.57326 14.167 2.79427V5.29427ZM15.0003 6.96094H5.00033V16.9609H15.0003V6.96094ZM7.50033 9.46094H9.16699V14.4609H7.50033V9.46094ZM10.8337 9.46094H12.5003V14.4609H10.8337V9.46094ZM7.50033 3.6276V5.29427H12.5003V3.6276H7.50033Z"
                            fill="#344054" />
                    </svg>
                    <span class="text-base font-semibold leading-6">Hapus Laporan</span>
                </button>
            </form>

            <a href="{{ route('dashboard.laporan.edit', $laporan) }}"
                class="flex items-center justify-center w-[177px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#2C5586] bg-[#F4F7FB] text-[#2C5586] hover:bg-[#E9EFF5] transition duration-150 ease-in-out">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.0003 1.96094L18.3337 5.29427M1.66699 18.6276L2.73066 14.7275C2.80006 14.473 2.83475 14.3458 2.88802 14.2272C2.93531 14.1218 2.99343 14.0217 3.06142 13.9284C3.138 13.8233 3.23125 13.73 3.41775 13.5435L12.0289 4.93234C12.1939 4.76734 12.2764 4.68483 12.3716 4.65392C12.4553 4.62673 12.5454 4.62673 12.6291 4.65392C12.7242 4.68483 12.8067 4.76733 12.9717 4.93234L15.3623 7.32287C15.5273 7.48787 15.6098 7.57038 15.6407 7.66551C15.6679 7.7492 15.6679 7.83934 15.6407 7.92303C15.6098 8.01817 15.5273 8.10067 15.3623 8.26568L6.75108 16.8769C6.56458 17.0633 6.47134 17.1566 6.36623 17.2332C6.2729 17.3012 6.17276 17.3593 6.06742 17.4066C5.94878 17.4598 5.82156 17.4945 5.56711 17.5639L1.66699 18.6276Z"
                        stroke="#2C5586" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-base font-semibold leading-6">Edit Laporan</span>
            </a>

            <form action="{{ route('dashboard.laporan.submit', $laporan) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin mengirim laporan ini untuk ditinjau?');">
                @csrf
                @method('PUT')
                @if($laporan->status === 'draf')
                <button onclick="submitLaporan({{ $laporan->id }})" id="submit-button"
                    class="flex items-center justify-center w-[177px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-transparent bg-[#98100A] text-white hover:bg-[#7D0D08] transition duration-150 ease-in-out">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.0003 4.16602V15.8327M10.0003 15.8327L15.8337 9.99935M10.0003 15.8327L4.16699 9.99935"
                            stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-base font-semibold leading-6">Kirim Laporan</span>
                </button>
                @endif
            </form>
        </div>
    </div>
    
    @elseif($laporan->status === 'revisi')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-6 flex justify-center items-center gap-6 shadow-sm">
            <form action="{{ route('dashboard.laporan.destroy', $laporan) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="flex items-center justify-center w-[177px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.167 5.29427H18.3337V6.96094H16.667V17.7943C16.667 18.0153 16.5792 18.2272 16.4229 18.3835C16.2666 18.5398 16.0547 18.6276 15.8337 18.6276H4.16699C3.94598 18.6276 3.73402 18.5398 3.57774 18.3835C3.42146 18.2272 3.33366 18.0153 3.33366 17.7943V6.96094H1.66699V5.29427H5.83366V2.79427C5.83366 2.57326 5.92146 2.3613 6.07774 2.20502C6.23402 2.04873 6.44598 1.96094 6.66699 1.96094H13.3337C13.5547 1.96094 13.7666 2.04873 13.9229 2.20502C14.0792 2.3613 14.167 2.57326 14.167 2.79427V5.29427ZM15.0003 6.96094H5.00033V16.9609H15.0003V6.96094ZM7.50033 9.46094H9.16699V14.4609H7.50033V9.46094ZM10.8337 9.46094H12.5003V14.4609H10.8337V9.46094ZM7.50033 3.6276V5.29427H12.5003V3.6276H7.50033Z"
                            fill="#344054" />
                    </svg>
                    <span class="text-base font-semibold leading-6">Hapus Laporan</span>
                </button>
            </form>

            <a href="{{ route('dashboard.laporan.edit', $laporan) }}"
                class="flex items-center justify-center w-[177px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-transparent bg-[#98100A] text-white hover:bg-[#7D0D08] transition duration-150 ease-in-out">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.0003 1.96094L18.3337 5.29427M1.66699 18.6276L2.73066 14.7275C2.80006 14.473 2.83475 14.3458 2.88802 14.2272C2.93531 14.1218 2.99343 14.0217 3.06142 13.9284C3.138 13.8233 3.23125 13.73 3.41775 13.5435L12.0289 4.93234C12.1939 4.76734 12.2764 4.68483 12.3716 4.65392C12.4553 4.62673 12.5454 4.62673 12.6291 4.65392C12.7242 4.68483 12.8067 4.76733 12.9717 4.93234L15.3623 7.32287C15.5273 7.48787 15.6098 7.57038 15.6407 7.66551C15.6679 7.7492 15.6679 7.83934 15.6407 7.92303C15.6098 8.01817 15.5273 8.10067 15.3623 8.26568L6.75108 16.8769C6.56458 17.0633 6.47134 17.1566 6.36623 17.2332C6.2729 17.3012 6.17276 17.3593 6.06742 17.4066C5.94878 17.4598 5.82156 17.4945 5.56711 17.5639L1.66699 18.6276Z"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-base font-semibold leading-6">Revisi Laporan</span>
            </a>
        </div>
    </div>
    @endif
    @endif
    <!-- Footer section -->
    <footer class="bg-black text-white border-t border-gray-300 py-[50px]">
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
