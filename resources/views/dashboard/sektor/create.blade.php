@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-admin')

    <div class="flex flex-col min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Breadcrumb -->
                <div class="mb-6">
                    <div class="flex flex-wrap items-center space-x-2">
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.66667 14.1663H13.3333M9.18141 2.30297L3.52949 6.6989C3.15168 6.99276 2.96278 7.13968 2.82669 7.32368C2.70614 7.48667 2.61633 7.67029 2.56169 7.86551C2.5 8.0859 2.5 8.32521 2.5 8.80384V14.833C2.5 15.7664 2.5 16.2331 2.68166 16.5896C2.84144 16.9032 3.09641 17.1582 3.41002 17.318C3.76654 17.4996 4.23325 17.4996 5.16667 17.4996H14.8333C15.7668 17.4996 16.2335 17.4996 16.59 17.318C16.9036 17.1582 17.1586 16.9032 17.3183 16.5896C17.5 16.2331 17.5 15.7664 17.5 14.833V8.80384C17.5 8.32521 17.5 8.0859 17.4383 7.86551C17.3837 7.67029 17.2939 7.48667 17.1733 7.32368C17.0372 7.13968 16.8483 6.99276 16.4705 6.69891L10.8186 2.30297C10.5258 2.07526 10.3794 1.9614 10.2178 1.91763C10.0752 1.87902 9.92484 1.87902 9.78221 1.91763C9.62057 1.9614 9.47418 2.07526 9.18141 2.30297Z" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <a href="{{ route('dashboard.sektor.index') }}" class="text-gray-500 hover:text-gray-700">
                            Sektor
                        </a>
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="font-semibold text-sm text-red-600">
                            {{ __('Buat Sektor Dan Program') }}
                        </span>
                    </div>
                </div>

                <h2 class="text-2xl sm:text-[28px] font-semibold leading-tight sm:leading-[44px] tracking-[-0.02em] text-left font-inter mb-4">Buat Sektor dan Program Baru</h2>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('dashboard.sektor.store') }}" method="POST" enctype="multipart/form-data" id="createForm">
                            @csrf

                            <!-- Thumbnail Upload -->
                            <div class="mb-4">
                                <label for="thumbnail-input" class="block text-sm font-medium text-gray-700">Foto Thumbnail *</label>
                                <div class="relative flex flex-col items-center justify-center gap-1 border border-gray-300 rounded-md p-2 h-[138px]" id="thumbnailContainer">
                                    <div class="absolute inset-0 bg-cover bg-center" id="thumbnailPreview"></div>
                                    <div class="relative z-10 flex flex-col items-center justify-center" id="uploadPrompt">
                                        <div class="flex items-center justify-center w-12 h-12 bg-[#FFDDDC] rounded-full">
                                            <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="3" width="40" height="40" rx="20" fill="#FFDDDC"/>
                                                <rect x="3" y="3" width="40" height="40" rx="20" stroke="#FFF1F0" stroke-width="6"/>
                                                <path d="M16.3327 26.5352C15.3277 25.8625 14.666 24.7168 14.666 23.4167C14.666 21.4637 16.1589 19.8594 18.0658 19.6828C18.4559 17.3101 20.5162 15.5 22.9993 15.5C25.4825 15.5 27.5428 17.3101 27.9329 19.6828C29.8398 19.8594 31.3327 21.4637 31.3327 23.4167C31.3327 24.7168 30.671 25.8625 29.666 26.5352M19.666 26.3333L22.9993 23M22.9993 23L26.3327 26.3333M22.9993 23V30.5" stroke="#98100A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span class="text-red-500">Klik untuk unggah atau seret dan lepas kesini</span>
                                        <span class="text-gray-400 text-sm" id="fileTypeText">PNG, JPG up to 10MB</span>
                                    </div>
                                </div>
                                <input type="file" name="thumbnail" id="thumbnail-input" class="hidden" accept="image/*" required>
                            </div>

                            <!-- Nama Sektor -->
                            <div class="mb-4">
                                <label for="nama-sektor-input" class="block text-sm font-medium text-gray-700">Nama Sektor</label>
                                <input type="text" name="nama_sektor" id="nama-sektor-input" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-4">
                                <label for="deskripsi-input" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi-input" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                            </div>

                            <!-- Daftar Program -->
                            <div class="mb-4">
                                <div class="flex flex-wrap justify-between items-center mb-2">
                                    <h3 class="font-semibold text-lg text-gray-800 mb-2 sm:mb-0">Daftar Program</h3>
                                    <button type="button" id="addProgram" class="px-4 py-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white shadow-sm hover:bg-[#7d0d08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                                        Tambah Program
                                    </button>
                                </div>
                                <div id="programsContainer">
                                    <!-- Program akan ditambahkan di sini oleh JavaScript -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Buat Button -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
                    <div class="bg-white border-b border-gray-200">
                        <div class="flex items-center justify-end px-6 py-4 border border-gray-200 rounded-lg">
                            <button type="submit" form="createForm" class="flex items-center justify-center w-[119px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white shadow-sm hover:bg-[#7d0d08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.74928 11.2501L17.4993 2.50014M8.85559 11.5235L11.0457 17.1552C11.2386 17.6513 11.3351 17.8994 11.4741 17.9718C11.5946 18.0346 11.7381 18.0347 11.8587 17.972C11.9978 17.8998 12.0946 17.6518 12.2881 17.1559L17.78 3.08281C17.9547 2.63516 18.0421 2.41133 17.9943 2.26831C17.9528 2.1441 17.8553 2.04663 17.7311 2.00514C17.5881 1.95736 17.3643 2.0447 16.9166 2.21939L2.84349 7.71134C2.34759 7.90486 2.09965 8.00163 2.02739 8.14071C1.96475 8.26129 1.96483 8.40483 2.02761 8.52533C2.10004 8.66433 2.3481 8.7608 2.84422 8.95373L8.47589 11.1438C8.5766 11.183 8.62695 11.2026 8.66935 11.2328C8.70693 11.2596 8.7398 11.2925 8.7666 11.3301C8.79685 11.3725 8.81643 11.4228 8.85559 11.5235Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-base font-semibold">Buat</span>
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const thumbnailInput = document.getElementById('thumbnail-input');
                        const thumbnailContainer = document.getElementById('thumbnailContainer');
                        const thumbnailPreview = document.getElementById('thumbnailPreview');
                        const uploadPrompt = document.getElementById('uploadPrompt');
                        const fileTypeText = document.getElementById('fileTypeText');

                        thumbnailContainer.addEventListener('click', function() {
                            thumbnailInput.click();
                        });

                        thumbnailContainer.addEventListener('dragover', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            this.style.backgroundColor = '#f8f8f8';
                        });

                        thumbnailContainer.addEventListener('dragleave', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            this.style.backgroundColor = '';
                        });

                        thumbnailContainer.addEventListener('drop', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            this.style.backgroundColor = '';
                            if (e.dataTransfer.files.length) {
                                thumbnailInput.files = e.dataTransfer.files;
                                updateThumbnailPreview(e.dataTransfer.files[0]);
                            }
                        });

                        thumbnailInput.addEventListener('change', function(e) {
                            if (this.files.length) {
                                updateThumbnailPreview(this.files[0]);
                            }
                        });

                        function updateThumbnailPreview(file) {
                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    thumbnailPreview.style.backgroundImage = `url(${e.target.result})`;
                                    thumbnailPreview.style.backgroundSize = 'cover';
                                    thumbnailPreview.style.backgroundPosition = 'center';
                                    thumbnailPreview.style.backgroundRepeat = 'no-repeat';
                                    uploadPrompt.style.display = 'none';  // Hide upload prompt
                                    fileTypeText.textContent = file.name;
                                    fileTypeText.className = 'absolute top-2 left-2 text-sm text-white bg-black bg-opacity-50 px-2 py-1 rounded';
                                    fileTypeText.style.display = 'block';  // Ensure file name is visible
                                }
                                reader.readAsDataURL(file);
                            } else {
                                alert('Please select an image file.');
                            }
                        }

                        document.getElementById('addProgram').addEventListener('click', function () {
                            const programCount = document.querySelectorAll('.program').length;
                            const programHtml = `
                                <div class="program mb-6 flex flex-wrap items-start">
                                    <div class="w-full md:w-1/3 pr-2 mb-2 md:mb-0">
                                        <label for="nama-program-${programCount}" class="block text-sm font-medium text-gray-700">Nama Program</label>
                                        <input type="text" name="nama_program[]" id="nama-program-${programCount}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div class="w-full md:w-3/5 px-2 mb-2 md:mb-0">
                                        <label for="deskripsi-program-${programCount}" class="block text-sm font-medium text-gray-700">Deskripsi Program</label>
                                        <textarea name="deskripsi_program[]" id="deskripsi-program-${programCount}" rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                                    </div>
                                    <div class="w-full md:w-auto mt-2 md:mt-0 md:ml-auto">
                                        <button type="button" class="flex items-center justify-center w-full md:w-[52px] h-[52px] p-4 border border-[#D0D5DD] rounded-[8px] shadow-[0px_1px_2px_0px_#1018280D] opacity-100 hover:bg-gray-100 removeProgram">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.166 3.99935H17.3327V5.66602H15.666V16.4993C15.666 16.7204 15.5782 16.9323 15.4219 17.0886C15.2657 17.2449 15.0537 17.3327 14.8327 17.3327H3.16602C2.945 17.3327 2.73304 17.2449 2.57676 17.0886C2.42048 16.9323 2.33268 16.7204 2.33268 16.4993V5.66602H0.666016V3.99935H4.83268V1.49935C4.83268 1.27834 4.92048 1.06637 5.07676 0.910093C5.23304 0.753813 5.445 0.666016 5.66602 0.666016H12.3327C12.5537 0.666016 12.7657 0.753813 12.9219 0.910093C13.0782 1.06637 13.166 1.27834 13.166 1.49935V3.99935ZM13.9993 5.66602H3.99935V15.666H13.9993V5.66602ZM6.49935 8.16602H8.16602V13.166H6.49935V8.16602ZM9.83268 8.16602H11.4993V13.166H9.83268V8.16602ZM6.49935 2.33268V3.99935H11.4993V2.33268H6.49935Z" fill="#141414"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            `;
                            document.getElementById('programsContainer').insertAdjacentHTML('beforeend', programHtml);
                        });

                        document.getElementById('programsContainer').addEventListener('click', function (e) {
                            if (e.target.closest('.removeProgram')) {
                                const programs = document.querySelectorAll('.program');
                                if (programs.length > 1) {
                                    e.target.closest('.program').remove();
                                } else {
                                    alert('Minimal satu program harus ada.');
                                }
                            }
                        });

                        // Add initial program
                        document.getElementById('addProgram').click();
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif