@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-admin')

    <div class="flex flex-col min-h-screen">
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
                        <a href="{{ route('dashboard.kegiatan.index') }}" class="text-gray-500 hover:text-gray-700">Kegiatan</a>
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="font-semibold text-sm text-red-600">
                            {{ __('Edit Kegiatan') }}
                        </span>
                    </div>
                </div>

                <h2 class="text-2xl sm:text-[28px] font-semibold leading-tight sm:leading-[44px] tracking-[-0.02em] text-left font-inter mb-4">Edit Kegiatan</h2>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('dashboard.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                            @csrf
                            @method('PUT')

                            <!-- Foto Upload -->
                            <div class="mb-4">
                                <label for="foto-input" class="block text-sm font-medium text-gray-700">Foto *</label>
                                <div class="relative flex flex-col items-center justify-center gap-1 border border-gray-300 rounded-md p-2 h-[138px]" id="fotoContainer">
                                    <div class="absolute inset-0 bg-cover bg-center" id="fotoPreview" style="background-image: url('{{ asset('storage/' . $kegiatan->foto) }}');"></div>
                                    <div class="relative z-10 flex flex-col items-center justify-center" id="uploadPrompt">
                                        <div class="flex items-center justify-center w-12 h-12 bg-[#FFDDDC] rounded-full">
                                            <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="3" width="40" height="40" rx="20" fill="#FFDDDC"/>
                                                <rect x="3" y="3" width="40" height="40" rx="20" stroke="#FFF1F0" stroke-width="6"/>
                                                <path d="M16.3327 26.5352C15.3277 25.8625 14.666 24.7168 14.666 23.4167C14.666 21.4637 16.1589 19.8594 18.0658 19.6828C18.4559 17.3101 20.5162 15.5 22.9993 15.5C25.4825 15.5 27.5428 17.3101 27.9329 19.6828C29.8398 19.8594 31.3327 21.4637 31.3327 23.4167C31.3327 24.7168 30.671 25.8625 29.666 26.5352M19.666 26.3333L22.9993 23M22.9993 23L26.3327 26.3333M22.9993 23V30.5C22.9993 30.5 22.9993 30.5 22.9993 30.5Z" stroke="#98100A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span class="text-red-500">Klik untuk unggah <span class="text-black text-sm">atau seret dan lepas kesini</span></span>
                                        <span class="text-black text-sm" id="fileTypeText">PNG, JPG up to 10MB</span>
                                    </div>
                                </div>
                                <input type="file" name="foto" id="foto-input" class="hidden" accept="image/*">
                            </div>

                            <!-- Judul Kegiatan -->
                            <div class="mb-4">
                                <label for="judul-kegiatan-input" class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                                <input type="text" name="judul_kegiatan" id="judul-kegiatan-input" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $kegiatan->judul_kegiatan }}" required>
                            </div>

                            <!-- Tags -->
                            <div class="mb-4">
                                <label for="tags-input" class="block text-sm font-medium text-gray-700">Tags</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="tag-input" id="tag-input" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" placeholder="Ketik tag dan tekan Enter">
                                    <button type="button" id="add-tag-btn" class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        Tambah
                                    </button>
                                </div>
                                <div id="tags-container" class="mt-2 flex flex-wrap gap-2"></div>
                                <input type="hidden" name="tags" id="tags-hidden" value="{{ $kegiatan->tags }}">
                            </div>

                            <!-- Deskripsi dengan Summernote -->
                            <div class="mb-4">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" class="summernote">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Container untuk tombol-tombol -->
                <div class="bg-white w-[1240px] px-6 py-4 mt-6 border border-gray-200 rounded-lg shadow-sm">
                    <div class="flex justify-end items-center space-x-4">
                        <!-- Tombol Simpan Sebagai Draft -->
                        <button type="submit" form="editForm" name="action" value="draf" class="flex items-center justify-center w-[232px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#D0D5DD] bg-white text-[#344054] shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                <path d="M11.5 5.66667H6.16667C5.69996 5.66667 5.4666 5.66667 5.28834 5.57584C5.13154 5.49594 5.00406 5.36846 4.92416 5.21166C4.83333 5.0334 4.83333 4.80004 4.83333 4.33333V1.5M13.1667 16.5V11.1667C13.1667 10.7 13.1667 10.4666 13.0758 10.2883C12.9959 10.1315 12.8685 10.0041 12.7117 9.92416C12.5334 9.83333 12.3 9.83333 11.8333 9.83333H6.16667C5.69996 9.83333 5.4666 9.83333 5.28834 9.92416C5.13154 10.0041 5.00406 10.1315 4.92416 10.2883C4.83333 10.4666 4.83333 10.7 4.83333 11.1667V16.5M16.5 6.77124V12.5C16.5 13.9001 16.5 14.6002 16.2275 15.135C15.9878 15.6054 15.6054 15.9878 15.135 16.2275C14.6002 16.5 13.9001 16.5 12.5 16.5H5.5C4.09987 16.5 3.3998 16.5 2.86502 16.2275C2.39462 15.9878 2.01217 15.6054 1.77248 15.135C1.5 14.6002 1.5 13.9001 1.5 12.5V5.5C1.5 4.09987 1.5 3.3998 1.77248 2.86502C2.01217 2.39462 2.39462 2.01217 2.86502 1.77248C3.3998 1.5 4.09987 1.5 5.5 1.5H11.2288C11.6364 1.5 11.8402 1.5 12.0321 1.54605C12.2021 1.58688 12.3647 1.65422 12.5138 1.7456C12.682 1.84867 12.8261 1.9928 13.1144 2.28105L15.719 4.88562C16.0072 5.17387 16.1513 5.318 16.2544 5.48619C16.3458 5.63531 16.4131 5.79789 16.4539 5.96795C16.5 6.15976 16.5 6.36358 16.5 6.77124Z" stroke="#344054" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Simpan Sebagai Draft
                        </button>

                        <!-- Tombol Terbitkan Kegiatan -->
                        <button type="submit" form="editForm" name="action" value="terbit" id="submit-button" class="flex items-center justify-center w-[232px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white shadow-sm hover:bg-[#7d0d08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                <path d="M8.74928 11.2501L17.4993 2.50014M8.85559 11.5235L11.0457 17.1552C11.2386 17.6513 11.3351 17.8994 11.4741 17.9718C11.5946 18.0346 11.7381 18.0347 11.8587 17.972C11.9978 17.8998 12.0946 17.6518 12.2881 17.1559L17.78 3.08281C17.9547 2.63516 18.0421 2.41133 17.9943 2.26831C17.9528 2.1441 17.8553 2.04663 17.7311 2.00514C17.5881 1.95736 17.3643
                                .00514C17.5881 1.95736 17.3643 2.0447 16.9166 2.21939L2.84349 7.71134C2.34759 7.90486 2.09965 8.00163 2.02739 8.14071C1.96475 8.26129 1.96483 8.40483 2.02761 8.52533C2.10004 8.66433 2.3481 8.7608 2.84422 8.95373L8.47589 11.1438C8.5766 11.183 8.62695 11.2026 8.66935 11.2328C8.70693 11.2596 8.7398 11.2925 8.7666 11.3301C8.79685 11.3725 8.81643 11.4228 8.85559 11.5235Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Terbitkan Kegiatan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fotoInput = document.getElementById('foto-input');
            const fotoContainer = document.getElementById('fotoContainer');
            const fotoPreview = document.getElementById('fotoPreview');
            const uploadPrompt = document.getElementById('uploadPrompt');
            const fileTypeText = document.getElementById('fileTypeText');

            fotoContainer.addEventListener('click', function() {
                fotoInput.click();
            });

            fotoContainer.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.backgroundColor = '#f8f8f8';
            });

            fotoContainer.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.backgroundColor = '';
            });

            fotoContainer.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.backgroundColor = '';
                if (e.dataTransfer.files.length) {
                    fotoInput.files = e.dataTransfer.files;
                    updateFotoPreview(e.dataTransfer.files[0]);
                }
            });

            fotoInput.addEventListener('change', function(e) {
                if (this.files.length) {
                    updateFotoPreview(this.files[0]);
                }
            });

            function updateFotoPreview(file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        fotoPreview.style.backgroundImage = `url(${e.target.result})`;
                        fotoPreview.style.backgroundSize = 'cover';
                        fotoPreview.style.backgroundPosition = 'center';
                        fotoPreview.style.backgroundRepeat = 'no-repeat';
                        uploadPrompt.style.display = 'none';
                        fileTypeText.textContent = file.name;
                        fileTypeText.className = 'absolute top-2 left-2 text-sm text-white bg-black bg-opacity-50 px-2 py-1 rounded';
                        fileTypeText.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert('Please select an image file.');
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tagInput = document.getElementById('tag-input');
            const addTagBtn = document.getElementById('add-tag-btn');
            const tagsContainer = document.getElementById('tags-container');
            const tagsHidden = document.getElementById('tags-hidden');
            let tags = tagsHidden.value ? tagsHidden.value.split(',') : [];

            // Fungsi untuk menambahkan tag
            function addTag(tag) {
                if (tag && !tags.includes(tag)) {
                    tags.push(tag);
                    renderTags();
                    tagInput.value = '';
                }
            }

            // Fungsi untuk menghapus tag
            function removeTag(tag) {
                tags = tags.filter(t => t !== tag);
                renderTags();
            }

            // Fungsi untuk merender tags
            function renderTags() {
                tagsContainer.innerHTML = '';
                tags.forEach(tag => {
                    const tagElement = document.createElement('span');
                    tagElement.classList.add('tag-item');
                    tagElement.innerHTML = `
                        <span class="tag-text">${tag}</span>
                        <button type="button" class="tag-remove-btn" onclick="removeTag('${tag}')">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 3L3 9M3 3L9 9" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    `;
                    tagsContainer.appendChild(tagElement);
                });
                tagsHidden.value = tags.join(',');
            }

            // Event listener untuk tombol Tambah
            addTagBtn.addEventListener('click', function() {
                addTag(tagInput.value.trim());
            });

            // Event listener untuk input tag
            tagInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    addTag(tagInput.value.trim());
                }
            });

            // Fungsi global untuk menghapus tag (dipanggil dari onclick di dalam renderTags)
            window.removeTag = removeTag;

            // Inisialisasi tags
            renderTags();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for(let i=0; i < files.length; i++) {
                            uploadImage(files[i]);
                        }
                    },
                    onChange: function(contents, $editable) {
                        // Update hidden input setiap kali konten berubah
                        $('#deskripsi').val(contents);
                    }
                }
            });

            // Tambahkan event listener untuk form submission
            $('#editForm').on('submit', function() {
                // Update nilai textarea dengan konten Summernote sebelum submit
                $('#deskripsi').val($('.summernote').summernote('code'));
            });

            function uploadImage(file) {
                let formData = new FormData();
                formData.append("file", file);
                $.ajax({
                    url: "{{ route('upload.image') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: "post",
                    success: function(url) {
                        let image = $('<img>').attr('src', url.location);
                        $('.summernote').summernote("insertNode", image[0]);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        });
    </script>
</x-app-layout>
@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif