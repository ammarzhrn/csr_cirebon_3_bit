@if(auth()->user()->level === 'admin')
<x-app-layout class="flex flex-col min-h-screen">
    @include('notification.notification-admin')

    <div class="py-12 flex-grow">
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
                    <a href="{{ route('summary.show') }}" class="font-semibold text-sm text-gray-500 ">
                        {{ __('Profile') }}
                    </a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-semibold text-sm text-red-600">
                        {{ __('Edit Profile') }}
                    </span>
                </div>
            </div>

            <h2 class="text-2xl font-semibold mb-6">{{ __('Edit Profile') }}</h2>

            <div class="bg-white shadow-sm rounded-lg p-6">
                <form id="profile-form" method="POST" action="{{ route('user.update', $summary->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                        

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Foto Profil -->
                        <div class="col-span-1 md:col-span-2 flex flex-col md:flex-row gap-6">
                            <div class="w-full md:w-5/12 mb-4 md:mb-0">
                                <div id="drop-area" class="w-full h-[300px] rounded-xl bg-[#E7EEF7] flex items-center justify-center relative">
                                    <img id="preview-image" src="{{ $summary->foto_pp ? asset('storage/images/profile/' . $summary->foto_pp) : asset('storage/images/profile/profile.png') }}" alt="Foto Profil" class="max-w-full max-h-full object-contain rounded-xl">
                                    <div id="cancel-overlay" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-xl opacity-0 transition-opacity duration-300 cursor-pointer invisible">
                                        <span class="text-white text-lg font-semibold">Klik untuk membatalkan</span>
                                    </div>
                                    <div id="drag-overlay" class="absolute inset-0 bg-blue-500 bg-opacity-50 flex items-center justify-center rounded-xl opacity-0 transition-opacity duration-300 pointer-events-none">
                                        <span class="text-white text-lg font-semibold">Lepaskan untuk mengunggah</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-7/12">
                                <label for="foto_pp" class="block text-sm font-medium text-gray-700">{{ __('Foto') }} <span class="text-red-600">*</span></label>
                                <div class="mt-1 flex items-center justify-center w-full">
                                    <label for="foto_pp" class="flex flex-col items-center justify-center w-full h-[138px] p-[20px_12px_24px_12px] gap-2 rounded-lg border border-solid bg-white shadow-[0px_1px_2px_0px_#1018280D] cursor-pointer" style="border-image-source: linear-gradient(0deg, var(--Brand-Primary, #28458B), var(--Brand-Primary, #28458B)), linear-gradient(0deg, #EAECF0, #EAECF0);">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-2">
                                                <rect x="3" y="3" width="40" height="40" rx="20" fill="#FFDDDC"/>
                                                <rect x="3" y="3" width="40" height="40" rx="20" stroke="#FFF1F0" stroke-width="6"/>
                                                <path d="M16.3337 26.5352C15.3287 25.8625 14.667 24.7168 14.667 23.4167C14.667 21.4637 16.1599 19.8594 18.0668 19.6828C18.4568 17.3101 20.5172 15.5 23.0003 15.5C25.4835 15.5 27.5438 17.3101 27.9339 19.6828C29.8407 19.8594 31.3337 21.4637 31.3337 23.4167C31.3337 24.7168 30.672 25.8625 29.667 26.5352M19.667 26.3333L23.0003 23M23.0003 23L26.3337 26.3333M23.0003 23V30.5" stroke="#98100A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <p class="mb-1 text-sm font-inter text-left">
                                                <span class="font-semibold text-[14px] leading-[20px] text-[#98100A]">Klik untuk unggah</span>
                                                <span class="font-medium text-[14px] leading-[20px] text-gray-500"> atau seret kesamping kiri</span>
                                            </p>
                                            <p id="selected-file-name" class="text-[14px] font-medium leading-[18px] text-center text-gray-500 font-inter">PNG, JPG up to 10MB</p>
                                        </div>
                                        <input id="foto_pp" name="foto_pp" type="file" class="hidden" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if(Auth::user()->level === 'admin')
                            <!-- Nama -->
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">{{ __('Nama') }} <span class="text-red-600">*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $summary->nama ?? $user->name) }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }} <span class="text-red-600">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $summary->email ?? $user->email) }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-span-1 md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">{{ __('Deskripsi') }}</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Deskripsi" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('deskripsi', $summary->deskripsi ?? '') }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <!-- Fields for mitra users -->
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">{{ __('Nama') }} <span class="text-red-600">*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $summary->nama ?? $user->name) }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nama_mitra" class="block text-sm font-medium text-gray-700">{{ __('Nama Mitra') }} <span class="text-red-600">*</span></label>
                                <input type="text" name="nama_mitra" id="nama_mitra" value="{{ old('nama_mitra', $summary->nama_mitra ?? '') }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('nama_mitra')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }} <span class="text-red-600">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $summary->email ?? $user->email) }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="no_telp" class="block text-sm font-medium text-gray-700">{{ __('Nomor Telepon') }} <span class="text-red-600">*</span></label>
                                <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $summary->no_telp ?? '') }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('no_telp')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="alamat" class="block text-sm font-medium text-gray-700">{{ __('Alamat') }}</label>
                                <textarea name="alamat" id="alamat" rows="3" placeholder="Alamat" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('alamat', $summary->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">{{ __('Deskripsi') }}</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Deskripsi" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('deskripsi', $summary->deskripsi ?? '') }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div>

                   

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                </form>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6 flex justify-between mt-6">
                <div class="space-x-3">
                    <button type="button" onclick="history.back()" class="inline-flex items-center justify-center w-[122px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm font-medium shadow-[0px_1px_2px_0px_#1018280D] hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.8337 10H4.16699M4.16699 10L10.0003 15.8333M4.16699 10L10.0003 4.16667" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ __('Kembali') }}
                    </button>
                    <button type="button" onclick="document.getElementById('profile-form').submit();" class="inline-flex items-center justify-center w-[122px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white text-sm font-medium shadow-[0px_1px_2px_0px_#1018280D] hover:bg-[#7A0D08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 6.66667H7.16667C6.69996 6.66667 6.4666 6.66667 6.28834 6.57584C6.13154 6.49594 6.00406 6.36846 5.92416 6.21166C5.83333 6.0334 5.83333 5.80004 5.83333 5.33333V2.5M14.1667 17.5V12.1667C14.1667 11.7 14.1667 11.4666 14.0758 11.2883C13.9959 11.1315 13.8685 11.0041 13.7117 10.9242C13.5334 10.8333 13.3 10.8333 12.8333 10.8333H7.16667C6.69996 10.8333 6.4666 10.8333 6.28834 10.9242C6.13154 11.0041 6.00406 11.1315 5.92416 11.2883C5.83333 11.4666 5.83333 11.7 5.83333 12.1667V17.5M17.5 7.77124V13.5C17.5 14.9001 17.5 15.6002 17.2275 16.135C16.9878 16.6054 16.6054 16.9878 16.135 17.2275C15.6002 17.5 14.9001 17.5 13.5 17.5H6.5C5.09987 17.5 4.3998 17.5 3.86502 17.2275C3.39462 16.9878 3.01217 16.6054 2.77248 16.135C2.5 15.6002 2.5 14.9001 2.5 13.5V6.5C2.5 5.09987 2.5 4.3998 2.77248 3.86502C3.01217 3.39462 3.39462 3.01217 3.86502 2.77248C4.3998 2.5 5.09987 2.5 6.5 2.5H12.2288C12.6364 2.5 12.8402 2.5 13.0321 2.54605C13.2021 2.58688 13.3647 2.65422 13.5138 2.7456C13.682 2.84867 13.8261 2.9928 14.1144 3.28105L16.719 5.88562C17.0072 6.17387 17.1513 6.318 17.2544 6.48619C17.3458 6.63531 17.4131 6.79789 17.4539 6.96795C17.5 7.15976 17.5 7.36358 17.5 7.77124Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ __('Simpan') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Add this script at the end of the file or in a separate JS file -->
<script>
function previewImage(input) {
    const file = input.files ? input.files[0] : input;
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
        }
        reader.readAsDataURL(file);

        // Menampilkan nama file
        var fileName = file.name;
        document.getElementById('selected-file-name').textContent = fileName;

        // Menampilkan overlay batal
        document.getElementById('cancel-overlay').classList.remove('invisible');
        document.getElementById('cancel-overlay').style.pointerEvents = 'auto';
    }
}

function cancelUpload() {
    // Reset input file
    document.getElementById('foto_pp').value = '';

    // Reset preview image
    document.getElementById('preview-image').src = "{{ asset('storage/images/profile/profile.png') }}";

    // Reset teks nama file
    document.getElementById('selected-file-name').textContent = 'PNG, JPG up to 10MB';

    // Sembunyikan overlay batal
    document.getElementById('cancel-overlay').classList.add('invisible');
    document.getElementById('cancel-overlay').style.pointerEvents = 'none';
}

// Tambahkan event listener untuk input file
document.getElementById('foto_pp').addEventListener('change', function() {
    previewImage(this);
});

// Tambahkan event listener untuk drag and drop
document.addEventListener('DOMContentLoaded', function() {
    var dropArea = document.getElementById('drop-area');
    var fileInput = document.getElementById('foto_pp');
    var cancelOverlay = document.getElementById('cancel-overlay');
    var dragOverlay = document.getElementById('drag-overlay');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dragOverlay.style.opacity = '1';
    }

    function unhighlight() {
        dragOverlay.style.opacity = '0';
    }

    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        var dt = e.dataTransfer;
        var file = dt.files[0];
        fileInput.files = dt.files;
        previewImage(file);
    }

    dropArea.addEventListener('mouseenter', function() {
        if (!cancelOverlay.classList.contains('invisible')) {
            cancelOverlay.style.opacity = '1';
        }
    });

    dropArea.addEventListener('mouseleave', function() {
        cancelOverlay.style.opacity = '0';
    });

    cancelOverlay.addEventListener('click', cancelUpload);
});
</script>
@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif