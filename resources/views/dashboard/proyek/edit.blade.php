@if(auth()->user()->level !== 'mitra')
    <script>window.location = "{{ route('dashboard') }}";</script>
@endif

@if(auth()->user()->level === 'admin')

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
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.66667 14.1663H13.3333M9.18141 2.30297L3.52949 6.6989C3.15168 6.99276 2.96278 7.13968 2.82669 7.32368C2.70614 7.48667 2.61633 7.67029 2.56169 7.86551C2.5 8.0859 2.5 8.32521 2.5 8.80384V14.833C2.5 15.7664 2.5 16.2331 2.68166 16.5896C2.84144 16.9032 3.09641 17.1582 3.41002 17.318C3.76654 17.4996 4.23325 17.4996 5.16667 17.4996H14.8333C15.7668 17.4996 16.2335 17.4996 16.59 17.318C16.9036 17.1582 17.1586 16.9032 17.3183 16.5896C17.5 16.2331 17.5 15.7664 17.5 14.833V8.80384C17.5 8.32521 17.5 8.0859 17.4383 7.86551C17.3837 7.67029 17.2939 7.48667 17.1733 7.32368C17.0372 7.13968 16.8483 6.99276 16.4705 6.69891L10.8186 2.30297C10.5258 2.07526 10.3794 1.9614 10.2178 1.91763C10.0752 1.87902 9.92484 1.87902 9.78221 1.91763C9.62057 1.9614 9.47418 2.07526 9.18141 2.30297Z" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="font-semibold text-sm text-red-600">
                                {{ __('Edit Laporan') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-[28px] font-semibold leading-[44px] tracking-[-0.02em] text-left font-inter">Edit Laporan</h2>
                        </div>

                        <!-- Form container -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-[1240px] p-6 space-y-6 border border-gray-200">
                            <form id="laporan-form" action="{{ route('dashboard.laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id_user" value="{{ auth()->id() }}">
                                
                                <!-- Judul Laporan -->
                                <div class="w-full h-[73px] space-y-2">
                                    <label for="judul_laporan" class="block text-sm font-semibold leading-[16.94px] text-left">Judul Laporan <span class="text-red-500">*</span></label>
                                    <input type="text" name="judul_laporan" id="judul_laporan" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]" placeholder="Masukan nama laporan CSR" value="{{ $laporan->judul_laporan }}" required>
                                </div>

                                <!-- Sektor and Program -->
                                <div class="flex space-x-5">
                                    <div class="w-[586px] space-y-2">
                                        <label for="id_sektor" class="block text-sm font-semibold leading-[16.94px] text-left">Sektor CSR <span class="text-red-500">*</span></label>
                                        <select name="id_sektor" id="id_sektor" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]" required>
                                            <option value="">Pilih sektor CSR</option>
                                            @foreach($sektors as $sektor)
                                                <option value="{{ $sektor->id }}" {{ $laporan->id_sektor == $sektor->id ? 'selected' : '' }}>{{ $sektor->nama_sektor }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-[586px] space-y-2">
                                        <label for="id_program" class="block text-sm font-semibold leading-[16.94px] text-left">Program CSR <span class="text-red-500">*</span></label>
                                        <select name="id_program" id="id_program" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]" required>
                                            <option value="">Pilih program CSR</option>
                                            @foreach($programs as $program)
                                                <option value="{{ $program->id }}" {{ $laporan->id_program == $program->id ? 'selected' : '' }}>{{ $program->nama_program }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Nama Proyek -->
                                <div class="flex space-x-5">
                                    <div class="w-[586px] space-y-2">
                                        <label for="id_proyek" class="block text-sm font-semibold leading-[16.94px] text-left">Nama Proyek CSR</label>
                                        <select name="id_proyek" id="id_proyek" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]">
                                            <option value="">Pilih nama proyek CSR</option>
                                            @foreach($proyeks as $proyek)
                                                <option value="{{ $proyek->id }}" {{ $laporan->id_proyek == $proyek->id ? 'selected' : '' }}>{{ $proyek->nama_proyek }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-sm text-gray-500 mt-1">Kosongkan Apabila Tidak Ada Proyek Yang Sesuai</p>
                                    </div>
                                    <div class="w-[586px]">
                                        <!-- Kosong untuk menjaga layout -->
                                    </div>
                                </div>

                                <!-- Tanggal, Bulan, Tahun, Realisasi -->
                                <div class="flex space-x-5">
                                    <div class="w-[182px] space-y-2">
                                        <label for="tanggal" class="block text-sm font-semibold leading-[16.94px] text-left">Tanggal <span class="text-red-500">*</span></label>
                                        <select name="tanggal" id="tanggal" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]" required>
                                            <option value="">Pilih tanggal</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}" {{ $laporan->tanggal == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-[182px] space-y-2">
                                        <label for="bulan" class="block text-sm font-semibold leading-[16.94px] text-left">Bulan <span class="text-red-500">*</span></label>
                                        <select name="bulan" id="bulan" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]" required>
                                            <option value="">Pilih bulan</option>
                                            @foreach(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'] as $bulan)
                                                <option value="{{ $bulan }}" {{ $laporan->bulan == $bulan ? 'selected' : '' }}>{{ ucfirst($bulan) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-[182px] space-y-2">
                                        <label for="tahun" class="block text-sm font-semibold leading-[16.94px] text-left">Tahun <span class="text-red-500">*</span></label>
                                        <select name="tahun" id="tahun" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]" required>
                                            <option value="">Pilih tahun</option>
                                            @for ($i = date('Y'); $i >= 2000; $i--)
                                                <option value="{{ $i }}" {{ $laporan->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-[586px] space-y-2">
                                        <label for="realisasi" class="block text-sm font-semibold leading-[16.94px] text-left">Realisasi <span class="text-red-500">*</span></label>
                                        <input type="number" name="realisasi" id="realisasi" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]" placeholder="Rp 0" value="{{ $laporan->realisasi }}" required>
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div class="w-full space-y-2">
                                    <label for="deskripsi" class="block text-sm font-semibold leading-[16.94px] text-left">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full h-[100px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-[0px_1px_2px_0px_#1018280D]" placeholder="Deskripsi">{{ $laporan->deskripsi }}</textarea>
                                </div>

                                <!-- Foto Laporan -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold leading-[16.94px] text-left">Foto Laporan Kegiatan <span class="text-red-500">*</span></label>
                                    @php
                                    $images = is_string($laporan->images) ? json_decode($laporan->images, true) : ($laporan->images ?? []);
                                    @endphp

                                    <div id="image-container" class="mt-2 flex flex-wrap gap-4">
                                        @foreach($images as $index => $image)
                                            @if(is_string($image))
                                            <div class="w-[160px] h-[160px] border border-gray-300 rounded-lg overflow-hidden relative image-preview">
                                                <img src="{{ $image === 'images/thumbnail.png' ? asset('images/thumbnail.png') : Storage::url($image) }}" 
                                                     alt="Laporan Image" 
                                                     class="w-full h-full object-cover">
                                                <button onclick="removeExistingImage(this, '{{ $image }}')" type="button" class="absolute top-2 right-2 bg-white rounded-full p-1">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18 6L6 18M6 6L18 18" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            @endif
                                        @endforeach
                                        <div id="upload-box" class="w-[160px] h-[160px] border border-gray-300 border-dashed rounded-lg flex items-center justify-center cursor-pointer overflow-hidden relative">
                                            <input type="file" name="images[]" id="images" class="hidden" accept="image/*" multiple onchange="handleMultipleImages(this)">
                                            <label for="images" class="w-full h-full flex flex-col items-center justify-center">
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M33.75 22.5V27.5C33.75 29.5711 33.75 30.6066 33.371 31.4134C33.0358 32.1257 32.5007 32.7204 31.8432 33.1114C31.0913 33.5625 30.1149 33.5625 28.1622 33.5625H11.8378C9.88506 33.5625 8.90871 33.5625 8.15678 33.1114C7.49928 32.7204 6.96416 32.1257 6.62904 31.4134C6.25 30.6066 6.25 29.5711 6.25 27.5V22.5M26.25 12.5L20 6.25M20 6.25L13.75 12.5M20 6.25V26.25" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span class="mt-2 text-sm text-[#667085]">Klik untuk unggah</span>
                                                <span class="text-xs text-[#667085]">PNG, JPG up to 10MB</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div id="image-error" style="display: none; color: red;">Silakan pilih setidaknya satu gambar.</div>
                                </div>
                            </form>
                        </div>

                        <!-- Container untuk tombol-tombol -->
                        <div class="bg-white w-[1240px] px-6 py-4 mt-6 border border-gray-200 rounded-lg shadow-sm">
                            <div class="flex justify-end items-center space-x-4">
                                

                                <!-- Tombol Simpan Sebagai Draft -->
                                <button type="submit" form="laporan-form" name="save_draft" value="1" class="flex items-center justify-center w-[232px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#D0D5DD] bg-white text-[#344054] shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                        <path d="M11.5 5.66667H6.16667C5.69996 5.66667 5.4666 5.66667 5.28834 5.57584C5.13154 5.49594 5.00406 5.36846 4.92416 5.21166C4.83333 5.0334 4.83333 4.80004 4.83333 4.33333V1.5M13.1667 16.5V11.1667C13.1667 10.7 13.1667 10.4666 13.0758 10.2883C12.9959 10.1315 12.8685 10.0041 12.7117 9.92416C12.5334 9.83333 12.3 9.83333 11.8333 9.83333H6.16667C5.69996 9.83333 5.4666 9.83333 5.28834 9.92416C5.13154 10.0041 5.00406 10.1315 4.92416 10.2883C4.83333 10.4666 4.83333 10.7 4.83333 11.1667V16.5M16.5 6.77124V12.5C16.5 13.9001 16.5 14.6002 16.2275 15.135C15.9878 15.6054 15.6054 15.9878 15.135 16.2275C14.6002 16.5 13.9001 16.5 12.5 16.5H5.5C4.09987 16.5 3.3998 16.5 2.86502 16.2275C2.39462 15.9878 2.01217 15.6054 1.77248 15.135C1.5 14.6002 1.5 13.9001 1.5 12.5V5.5C1.5 4.09987 1.5 3.3998 1.77248 2.86502C2.01217 2.39462 2.39462 2.01217 2.86502 1.77248C3.3998 1.5 4.09987 1.5 5.5 1.5H11.2288C11.6364 1.5 11.8402 1.5 12.0321 1.54605C12.2021 1.58688 12.3647 1.65422 12.5138 1.7456C12.682 1.84867 12.8261 1.9928 13.1144 2.28105L15.719 4.88562C16.0072 5.17387 16.1513 5.318 16.2544 5.48619C16.3458 5.63531 16.4131 5.79789 16.4539 5.96795C16.5 6.15976 16.5 6.36358 16.5 6.77124Z" stroke="#344054" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Simpan Sebagai Draft
                                </button>

                                <!-- Tombol Update -->
                                <button type="submit" form="laporan-form" id="submit-button" class="flex items-center justify-center w-[119px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white shadow-sm hover:bg-[#7d0d08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                        <path d="M8.74928 11.2501L17.4993 2.50014M8.85559 11.5235L11.0457 17.1552C11.2386 17.6513 11.3351 17.8994 11.4741 17.9718C11.5946 18.0346 11.7381 18.0347 11.8587 17.972C11.9978 17.8998 12.0946 17.6518 12.2881 17.1559L17.78 3.08281C17.9547 2.63516 18.0421 2.41133 17.9943 2.26831C17.9528 2.1441 17.8553 2.04663 17.7311 2.00514C17.5881 1.95736 17.3643 2.0447 16.9166 2.21939L2.84349 7.71134C2.34759 7.90486 2.09965 8.00163 2.02739 8.14071C1.96475 8.26129 1.96483 8.40483 2.02761 8.52533C2.10004 8.66433 2.3481 8.7608 2.84422 8.95373L8.47589 11.1438C8.5766 11.183 8.62695 11.2026 8.66935 11.2328C8.70693 11.2596 8.7398 11.2925 8.7666 11.3301C8.79685 11.3725 8.81643 11.4228 8.85559 11.5235Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @once
        @push('scripts')
        <script>
        window.removedImages = window.removedImages || [];

        function removeExistingImage(button, imagePath) {
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                button.closest('.image-preview').remove();
                window.removedImages.push(imagePath);
                
                const imageContainer = document.getElementById('image-container');
                const uploadBox = document.getElementById('upload-box');
                if (imageContainer.querySelectorAll('.image-preview').length < window.appConfig.MAX_IMAGES) {
                    uploadBox.style.display = 'flex';
                }
                
                console.log('Gambar dihapus:', imagePath);
                console.log('Daftar gambar yang dihapus:', window.removedImages);
            }
        }

        if (typeof window.appConfig === 'undefined') {
            window.appConfig = {};
        }
        if (typeof window.appConfig.MAX_IMAGES === 'undefined') {
            window.appConfig.MAX_IMAGES = 5;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('laporan-form');
            const submitButton = document.getElementById('submit-button');
            const draftButton = document.querySelector('button[name="save_draft"]');

            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                submitForm('pending');
            });

            draftButton.addEventListener('click', function(e) {
                e.preventDefault();
                submitForm('draf');
            });

            function submitForm(status) {
                const formData = new FormData(form);
                formData.append('status', status);
                
                if (window.removedImages && window.removedImages.length > 0) {
                    formData.append('removed_images', JSON.stringify(window.removedImages));
                }

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = data.redirect;
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        });

        function handleMultipleImages(input) {
            const container = document.getElementById('image-container');
            const uploadBox = document.getElementById('upload-box');
            const maxImages = window.appConfig.MAX_IMAGES;
            const currentImages = container.querySelectorAll('.image-preview').length;
            
            if (input.files && input.files.length > 0) {
                for (let i = 0; i < input.files.length && (currentImages + i) < maxImages; i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'w-[160px] h-[160px] border border-gray-300 rounded-lg overflow-hidden relative image-preview';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">
                            <button onclick="removePreview(this)" type="button" class="absolute top-2 right-2 bg-white rounded-full p-1">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18M6 6L18 18" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        `;
                        container.insertBefore(div, uploadBox);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }

            if (container.querySelectorAll('.image-preview').length >= maxImages) {
                uploadBox.style.display = 'none';
            }
        }

        function removePreview(button) {
            button.closest('.image-preview').remove();
            const container = document.getElementById('image-container');
            const uploadBox = document.getElementById('upload-box');
            if (container.querySelectorAll('.image-preview').length < window.appConfig.MAX_IMAGES) {
                uploadBox.style.display = 'flex';
            }
        }
        </script>
        @endpush
    @endonce

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tambahkan ini di bagian bawah view -->
    <script>
    document.getElementById('laporan-form').addEventListener('submit', function(e) {
        console.log('Form data:', new FormData(this));
    });
    </script>

    @stack('scripts')
</x-app-layout>
@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif