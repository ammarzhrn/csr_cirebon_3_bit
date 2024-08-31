@if(auth()->user()->level === 'admin')
<x-app-layout>
    @include('notification.notification-all')

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <div class="py-6 sm:py-12 min-h-screen">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                            <a href="{{ route('dashboard.proyek') }}" class="text-gray-500 hover:text-gray-700">
                                <span class="font-semibold text-sm text-gray-500 hover:text-gray-700">
                                    {{ __('Proyek') }}
                                </span>
                            </a>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="font-semibold text-sm text-red-600">
                                {{ __('Buat Proyek') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl sm:text-[28px] font-semibold leading-tight sm:leading-[44px] tracking-[-0.02em] text-left font-inter">Buat Proyek Baru</h2>
                        </div>

                        <!-- Form container -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full sm:w-[1240px] p-4 sm:p-6 space-y-6 border border-gray-200">
                            <form id="proyek-form" action="{{ route('dashboard.proyek.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf                                
                                <!-- Nama Proyek -->
                                <div class="space-y-2">
                                    <label for="nama_proyek" class="block text-sm font-semibold leading-5">Nama Proyek <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_proyek" id="nama_proyek" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Masukan nama proyek" required value="{{ old('nama_proyek') }}">
                                </div>

                                <!-- Sektor dan Program -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label for="id_sektor" class="block text-sm font-semibold leading-5">Sektor <span class="text-red-500">*</span></label>
                                        <select name="id_sektor" id="id_sektor" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                                            <option value="">Pilih sektor</option>
                                            @foreach($sektors as $sektor)
                                                <option value="{{ $sektor->id }}" {{ old('id_sektor') == $sektor->id ? 'selected' : '' }}>{{ $sektor->nama_sektor }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="space-y-2">
                                        <label for="id_program" class="block text-sm font-semibold leading-5">Program <span class="text-red-500">*</span></label>
                                        <select name="id_program" id="id_program" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                                            <option value="">Pilih program</option>
                                            @foreach($programs as $program)
                                                <option value="{{ $program->id }}" {{ old('id_program') == $program->id ? 'selected' : '' }}>{{ $program->nama_program }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Lokasi -->
                                <div class="space-y-2">
                                    <label for="lokasi" class="block text-sm font-semibold leading-5">Lokasi <span class="text-red-500">*</span></label>
                                    <select name="lokasi" id="lokasi" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                                        <option value="">Pilih lokasi</option>
                                        @foreach(['Arjawinangun', 'Astanajapura', 'Babakan', 'Beber', 'Ciwaringin', 'Ciledug', 'Depok', 'Dukupuntang', 'Gebang', 'Gegesik', 'Gempol', 'Greged', 'Gunungjati', 'Jamblang', 'Karangsembung', 'Karangwareng', 'Kapetakan', 'Kedawung', 'Kejawanan', 'Klangenan', 'Lemahwungkuk', 'Mundu', 'Palimanan', 'Pabedilan', 'Pamanukan', 'Pangandaran', 'Pangenan', 'Pasawahan', 'Plered', 'Sedong', 'Sumber', 'Suranenggala', 'Talun', 'Tengah Tani', 'Weru', 'Waled', 'Wargabinangun', 'Wertasari', 'Winduhaji'] as $loc)
                                            <option value="{{ $loc }}" {{ old('lokasi') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tanggal Awal dan Akhir -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label for="tgl_awal" class="block text-sm font-semibold leading-5">Tanggal Awal <span class="text-red-500">*</span></label>
                                        <input type="date" name="tgl_awal" id="tgl_awal" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required value="{{ old('tgl_awal') }}">
                                    </div>
                                    <div class="space-y-2">
                                        <label for="tgl_akhir" class="block text-sm font-semibold leading-5">Tanggal Akhir <span class="text-red-500">*</span></label>
                                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required value="{{ old('tgl_akhir') }}">
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div class="space-y-2">
                                    <label for="deskripsi" class="block text-sm font-semibold leading-5">Deskripsi Proyek</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Deskripsi proyek">{{ old('deskripsi') }}</textarea>
                                </div>

                                <!-- Thumbnail -->
                                <div class="space-y-2">
                                    <label for="thumbnail" class="block text-sm font-semibold leading-5">Thumbnail Proyek <span class="text-red-500">*</span></label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" accept="image/*" required>
                                    <div id="thumbnail-preview" class="mt-2 hidden">
                                        <img src="" alt="Thumbnail Preview" class="max-w-xs max-h-48 object-cover rounded-lg">
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="flex justify-end">
                                    <button type="submit" class="flex items-center justify-center w-full sm:w-52 h-[52px] px-4 sm:px-[18px] py-[10px] gap-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white shadow-sm hover:bg-[#7d0d08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                            <path d="M8.74928 11.2501L17.4993 2.50014M8.85559 11.5235L11.0457 17.1552C11.2386 17.6513 11.3351 17.8994 11.4741 17.9718C11.5946 18.0346 11.7381 18.0347 11.8587 17.972C11.9978 17.8998 12.0946 17.6518 12.2881 17.1559L17.78 3.08281C17.9547 2.63516 18.0421 2.41133 17.9943 2.26831C17.9528 2.1441 17.8553 2.04663 17.7311 2.00514C17.5881 1.95736 17.3643 2.0447 16.9166 2.21939L2.84349 7.71134C2.34759 7.90486 2.09965 8.00163 2.02739 8.14071C1.96475 8.26129 1.96483 8.40483 2.02761 8.52533C2.10004 8.66433 2.3481 8.7608 2.84422 8.95373L8.47589 11.1438C8.5766 11.183 8.62695 11.2026 8.66935 11.2328C8.70693 11.2596 8.7398 11.2925 8.7666 11.3301C8.79685 11.3725 8.81643 11.4228 8.85559 11.5235Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Submit Proyek
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @once
        @push('scripts')
        <script>
        if (typeof window.appConfig === 'undefined') {
            window.appConfig = {};
        }
        window.appConfig.MAX_IMAGES = 4;

        document.getElementById('proyek-form').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
            console.log('Form data:', new FormData(this));
            this.submit();
        });

        function handleMultipleImages(input) {
            const container = document.getElementById('image-container');
            const uploadBox = document.getElementById('upload-box');
            const maxImages = window.appConfig.MAX_IMAGES;
            const currentImages = container.querySelectorAll('.image-preview').length;
            
            if (input.files && input.files.length > 0) {
                for (let i = 0; i < Math.min(input.files.length, maxImages - currentImages); i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'w-[300px] h-[183.29px] rounded-[8.94px] overflow-hidden relative image-preview';
                        div.style.opacity = '1';
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
            
            // Hide upload box if max images reached
            if (container.querySelectorAll('.image-preview').length >= maxImages) {
                uploadBox.style.display = 'none';
            }
        }

        function removePreview(button) {
            const preview = button.closest('.image-preview');
            const container = document.getElementById('image-container');
            const uploadBox = document.getElementById('upload-box');
            const input = document.getElementById('images');

            // Hapus preview
            preview.remove();

            // Reset input file jika semua preview dihapus
            if (container.querySelectorAll('.image-preview').length === 0) {
                input.value = '';
            }

            // Tampilkan kembali upload box jika jumlah gambar kurang dari batas maksimum
            if (container.querySelectorAll('.image-preview').length < window.appConfig.MAX_IMAGES) {
                uploadBox.style.display = 'flex';
            }
        }

        document.getElementById('thumbnail').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('thumbnail-preview');
            const previewImage = preview.querySelector('img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });
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
    document.getElementById('proyek-form').addEventListener('submit', function(e) {
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