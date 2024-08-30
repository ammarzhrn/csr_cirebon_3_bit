@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-all')

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <div class="py-12 space-y-4">
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
                            <a href="{{ url('/dashboard/proyek') }}" class="text-sm text-gray-500 hover:text-gray-700">
                                {{ __('Proyek') }}
                            </a>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="font-semibold text-sm text-red-600">
                                {{ __('Detail Proyek') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2
                                class="text-[28px] font-semibold leading-[44px] tracking-[-0.02em] text-left font-inter">
                                Detail Proyek</h2>
                        </div>

                        <!-- Main content -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-8 text-gray-900">
                                <div class="mb-6">
                                    <div class="flex space-x-2 mb-2">
                                        @if($proyek->status === 'terbit')
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                            Diterbitkan
                                        </span>
                                        @elseif($proyek->status === 'draf')
                                        <span
                                            class="px-3 py-1 bg-red-100 text-gray-700 rounded-full text-sm font-medium">
                                            Draft
                                        </span>
                                        @endif
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
                                            <h1 class="text-2xl font-bold text-gray-900">{{ $proyek->nama_proyek }}
                                            </h1>
                                            <p class="text-base font-semibold leading-8 text-left text-gray-500 mt-2">
                                                {{ \Carbon\Carbon::parse($proyek->created_at)->format('j F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-b border-gray-200 mb-6"></div>

                                <!-- Thumbnail Proyek -->
                                <div class="mb-6">
                                    <h4 class="text-lg font-semibold mb-2">Thumbnail Proyek</h4>
                                    @if($proyek->thumbnail)
                                        <div class="w-full max-w-md aspect-[300/183.29] rounded-lg overflow-hidden relative">
                                            <img src="{{ asset('storage/' . $proyek->thumbnail) }}" alt="Thumbnail proyek"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <p class="text-gray-500">Tidak ada thumbnail untuk proyek ini.</p>
                                    @endif
                                </div>

                                <!-- Informasi Detail proyek -->
                                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-4 mb-8">
                                    <div class="bg-[#FFF1F0] rounded-lg p-4 border-l-4 border-[#98100A]">
                                        <p class="text-sm font-normal leading-5 text-gray-500">Tanggal</p>
                                        <p class="text-base font-semibold leading-6">
                                            {{ $proyek->tgl_awal ?? 'Tidak ada data' }} - {{ $proyek->tgl_akhir ?? 'Tidak ada data' }}</p>
                                    </div>
                                    <div class="bg-[#FFF1F0] rounded-lg p-4 border-l-4 border-[#98100A]">
                                        <p class="text-sm font-normal leading-5 text-gray-500">Kecamatan</p>
                                        <p class="text-base font-semibold leading-6">
                                            {{ $proyek->lokasi ?? 'Tidak ada lokasi' }}</p>
                                    </div>
                                </div>

                                <!-- Rincian proyek -->
                                <div class="mb-8">
                                    <h4 class="text-2xl font-semibold leading-7 mb-4">Rincian proyek</h4>
                                    <div class="text-lg font-normal leading-7 text-gray-700 space-y-4">
                                        @php
                                        $paragraphs = explode("\n", $proyek->deskripsi);
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
                </div>
                @if(auth()->user()->level === 'admin')
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="w-full bg-white border border-[#EAECF0] rounded-lg shadow-sm">
                        <div class="px-6 py-4">
                            @if($proyek->status !== 'tolak' && $proyek->status !== 'terbit')
                                <div class="flex flex-col items-center space-y-4">
                                    <p class="text-gray-700 font-medium">Status: <span class="font-semibold text-blue-600">Menunggu Persetujuan</span></p>
                                    <button onclick="showPopup('terbit')"
                                        class="flex items-center justify-center px-6 py-2 rounded-lg border border-[#2C5586] bg-[#2C5586] text-white hover:bg-[#234A75] transition duration-150 ease-in-out shadow-sm">
                                        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm font-semibold">Terbitkan</span>
                                    </button>
                                </div>
                            @else
                                <p class="text-gray-600 italic text-center">Tindakan admin tidak diperlukan lagi untuk proyek ini.</p>
                            @endif
                        </div>
                    </div>
                </div>

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
                            description.textContent = 'proyek akan ditolak dan tidak akan dipublikasikan';
                            reasonContainer.classList.remove('hidden');
                            submitButton.textContent = 'Tolak';
                        } else if (action === 'revisi') {
                            title.textContent = 'Revisi';
                            description.textContent =
                                'proyek akan diberikan kepada mitra untuk merevisi beberapa hal yang tidak sesuai';
                            reasonContainer.classList.remove('hidden');
                            submitButton.textContent = 'Kirim';
                        } else if (action === 'terbit') {
                            title.textContent = 'Terbit';
                            description.textContent = 'proyek akan diterbitkan dan dapat dilihat oleh publik';
                            reasonContainer.classList.add('hidden');
                            submitButton.textContent = 'Terbitkan';
                        }
                    }

                    function hidePopup() {
                        document.getElementById('popup').classList.add('hidden');
                    }

                    function submitAction() {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch('{{ route("dashboard.proyek.update-status", $proyek) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    status: 'terbit'
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                if (data.success) {
                                    hidePopup();
                                    location.reload();
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

                    function submitproyek(proyekId) {
                        if (!confirm('Apakah Anda yakin ingin mengirim proyek ini untuk ditinjau?')) {
                            return;
                        }

                        $.ajax({
                            url: `/dashboard/proyek/${proyekId}/submit`,
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
                            <span class="font-medium">proyek sedang ditinjau!</span>
                            <p>proyek Anda telah berhasil dikirim dan sedang menunggu peninjauan dari admin.</p>
                        </div>
                    </div>
                `);
                                } else {
                                    alert('Gagal mengirim proyek: ' + response.message);
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
@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif
