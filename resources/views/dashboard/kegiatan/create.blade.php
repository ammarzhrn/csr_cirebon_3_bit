@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-admin')

    <div class="flex flex-col min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-20 px-4">
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
                        <a href="{{ route('dashboard.kegiatan.index') }}" class="text-gray-500 hover:text-gray-700">Kegiatan</a>
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="font-semibold text-sm text-red-600">
                            {{ __('Buat Kegiatan') }}
                        </span>
                    </div>
                </div>

                <h2 class="text-2xl sm:text-[28px] font-semibold leading-tight sm:leading-[44px] tracking-[-0.02em] text-left font-inter mb-4">Buat Kegiatan Baru</h2>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('dashboard.kegiatan.store') }}" method="POST" enctype="multipart/form-data" id="createForm">
                            @csrf

                            <!-- Foto Upload -->
                            <div class="mb-4">
                                <label for="foto-input" class="block text-sm font-medium text-gray-700 mb-2">Foto *</label>
                                <div class="relative flex flex-col items-center justify-center gap-1 border-2 border-dashed border-gray-300 rounded-md p-4 h-[200px] sm:h-[250px]" id="fotoContainer">
                                    <div class="absolute inset-0 bg-cover bg-center" id="fotoPreview"></div>
                                    <div class="relative z-10 flex flex-col items-center justify-center text-center" id="uploadPrompt">
                                        <div class="flex items-center justify-center w-12 h-12 bg-[#FFDDDC] rounded-full mb-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 15V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V15M17 8L12 3M12 3L7 8M12 3V15" stroke="#98100A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <p class="text-red-500 font-medium mb-1">Klik untuk unggah atau seret dan lepas</p>
                                        <p class="text-gray-400 text-sm" id="fileTypeText">PNG, JPG up to 10MB</p>
                                    </div>
                                </div>
                                <input type="file" name="foto" id="foto-input" class="hidden" accept="image/*" required>
                            </div>

                            <!-- Judul Kegiatan -->
                            <div class="mb-4">
                                <label for="judul-kegiatan-input" class="block text-sm font-medium text-gray-700 mb-2">Judul Kegiatan</label>
                                <input type="text" name="judul_kegiatan" id="judul-kegiatan-input" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>

                            <!-- Tags -->
                            <div class="mb-4">
                                <label for="tags-input" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="tag-input" id="tag-input" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" placeholder="Ketik tag dan tekan Enter">
                                    <button type="button" id="add-tag-btn" class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        Tambah
                                    </button>
                                </div>
                                <div id="tags-container" class="mt-2 flex flex-wrap gap-2"></div>
                                <input type="hidden" name="tags" id="tags-hidden">
                            </div>

                            <!-- Deskripsi dengan Summernote -->
                            <div class="mb-4">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" class="summernote"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Container untuk tombol-tombol -->
                <div class="bg-white w-full px-6 py-4 mt-6 border border-gray-200 rounded-lg shadow-sm">
                    <div class="flex flex-col sm:flex-row justify-end items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                        <!-- Tombol Simpan Sebagai Draft -->
                        <button type="submit" form="createForm" name="action" value="draf" class="flex items-center justify-center w-full sm:w-auto px-4 py-2 sm:px-6 sm:py-3 gap-2 rounded-lg border border-[#D0D5DD] bg-white text-[#344054] shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-sm sm:text-base font-semibold">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                <path d="M12.7083 6.25H6.85417C6.33416 6.25 6.07416 6.25 5.87615 6.15205C5.70172 6.06555 5.55945 5.92328 5.47295 5.74885C5.375 5.55084 5.375 5.29084 5.375 4.77083V1.66667M14.625 18.3333V12.3958C14.625 11.8758 14.625 11.6158 14.5271 11.4178C14.4399 11.2434 14.2983 11.1018 14.1239 11.0146C13.9259 10.9167 13.6659 10.9167 13.1458 10.9167H6.85417C6.33416 10.9167 6.07416 10.9167 5.87615 11.0146C5.70172 11.1018 5.55945 11.2434 5.47295 11.4178C5.375 11.6158 5.375 11.8758 5.375 12.3958V18.3333M18.3333 7.52359V13.8889C18.3333 15.4446 18.3333 16.2224 18.0306 16.8167C17.7642 17.3393 17.3393 17.7642 16.8167 18.0306C16.2224 18.3333 15.4446 18.3333 13.8889 18.3333H6.11111C4.55556 18.3333 3.77778 18.3333 3.18334 18.0306C2.66069 17.7642 2.23586 17.3393 1.96944 16.8167C1.66667 16.2224 1.66667 15.4446 1.66667 13.8889V6.11111C1.66667 4.55556 1.66667 3.77778 1.96944 3.18334C2.23586 2.66069 2.66069 2.23586 3.18334 1.96944C3.77778 1.66667 4.55556 1.66667 6.11111 1.66667H12.4764C12.9293 1.66667 13.1558 1.66667 13.3691 1.71783C13.5579 1.76319 13.7385 1.83801 13.9042 1.93955C14.0911 2.05408 14.2512 2.21421 14.5716 2.53449L17.4655 5.42836C17.7858 5.74865 17.9459 5.90879 18.0605 6.09581C18.162 6.26148 18.2368 6.44211 18.2822 6.63085C18.3333 6.84419 18.3333 7.07066 18.3333 7.52359Z" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Simpan Sebagai Draft
                        </button>

                        <!-- Tombol Terbitkan Kegiatan -->
                        <button type="submit" form="createForm" name="action" value="terbit" id="submit-button" class="flex items-center justify-center w-full sm:w-auto px-4 py-2 sm:px-6 sm:py-3 gap-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white shadow-sm hover:bg-[#7d0d08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A] text-sm sm:text-base font-semibold">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                <path d="M8.74928 11.2501L17.4993 2.50014M8.85559 11.5235L11.0457 17.1552C11.2386 17.6513 11.3351 17.8994 11.4741 17.9718C11.5946 18.0346 11.7381 18.0347 11.8587 17.972C11.9978 17.8998 12.0946 17.6518 12.2881 17.1559L17.78 3.08281C17.9547 2.63516 18.0421 2.41133 17.9943 2.26831C17.9528 2.1441 17.8553 2.04663 17.7311 2.00514C17.5881 1.95736 17.3643 2.0447 16.9166 2.21939L2.84349 7.71134C2.34759 7.90486 2.09965 8.00163 2.02739 8.14071C1.96475 8.26129 1.96483.14071C1.96475 8.26129 1.96483 8.40483 2.02761 8.52533C2.10004 8.66433 2.3481 8.7608 2.84422 8.95373L8.47589 11.1438C8.5766 11.183 8.62695 11.2026 8.66935 11.2328C8.70693 11.2596 8.7398 11.2925 8.7666 11.3301C8.79685 11.3725 8.81643 11.4228 8.85559 11.5235Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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
                this.style.borderColor = '#98100A';
            });

            fotoContainer.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.borderColor = '#D1D5DB';
            });

            fotoContainer.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.borderColor = '#D1D5DB';
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
                        uploadPrompt.style.display = 'none';
                        fileTypeText.textContent = file.name;
                        fileTypeText.className = 'absolute bottom-2 left-2 text-sm text-white bg-black bg-opacity-50 px-2 py-1 rounded';
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
            let tags = [];

            function addTag(tag) {
                if (tag && !tags.includes(tag)) {
                    tags.push(tag);
                    renderTags();
                    tagInput.value = '';
                }
            }

            function removeTag(tag) {
                tags = tags.filter(t => t !== tag);
                renderTags();
            }

            function renderTags() {
                tagsContainer.innerHTML = '';
                tags.forEach(tag => {
                    const tagElement = document.createElement('span');
                    tagElement.classList.add('inline-flex', 'items-center', 'px-2.5', 'py-0.5', 'rounded-md', 'text-sm', 'font-medium', 'bg-blue-100', 'text-blue-800');
                    tagElement.innerHTML = `
                        ${tag}
                        <button type="button" class="ml-0.5 inline-flex items-center justify-center h-4 w-4 rounded-full bg-blue-200 text-blue-500 hover:bg-blue-300 focus:outline-none" onclick="removeTag('${tag}')">
                            <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                            </svg>
                        </button>
                    `;
                    tagsContainer.appendChild(tagElement);
                });
                tagsHidden.value = tags.join(',');
            }

            addTagBtn.addEventListener('click', function() {
                addTag(tagInput.value.trim());
            });

            tagInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    addTag(tagInput.value.trim());
                }
            });

            window.removeTag = removeTag;
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
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
                    }
                }
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