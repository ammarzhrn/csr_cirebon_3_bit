<div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md mt-16">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Lengkapi Profil Anda
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Untuk mengakses dashboard, silakan lengkapi informasi di bawah ini.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form id="profile-form" method="POST" action="{{ route('summary.update', $summary->id ?? 0) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Foto Profil -->
                <div>
                    <label for="foto_pp" class="block text-sm font-medium text-gray-700">
                        Foto Profil
                    </label>
                    <div class="mt-1 flex items-center">
                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                        <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                            Ubah
                        </button>
                        <input type="file" name="foto_pp" id="foto_pp" accept="image/*" class="hidden">
                    </div>
                </div>


                <div>
                    <label for="nama_mitra" class="block text-sm font-medium text-gray-700">
                        Nama Mitra
                    </label>
                    <div class="mt-1">
                        <input type="text" name="nama_mitra" id="nama_mitra" value="{{ old('nama_mitra', $summary->nama_mitra ?? '') }}" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                  <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">
                        Nama
                    </label>
                    <div class="mt-1">
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $summary->nama ?? '') }}" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <div class="mt-1">
                        <input type="email" name="email" id="email" value="{{ old('email', $summary->email ?? $user->email) }}" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="no_telp" class="block text-sm font-medium text-gray-700">
                        Nomor Telepon
                    </label>
                    <div class="mt-1">
                        <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $summary->no_telp ?? '') }}" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">
                        Alamat
                    </label>
                    <div class="mt-1">
                        <textarea name="alamat" id="alamat" rows="3" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">{{ old('alamat', $summary->alamat ?? '') }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                        Deskripsi
                    </label>
                    <div class="mt-1">
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">{{ old('deskripsi', $summary->deskripsi ?? '') }}</textarea>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#98100A] hover:bg-[#7A0D08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                        Simpan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('profile-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitButton = this.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = 'Menyimpan...';

    fetch(this.action, {
        method: 'POST',
        body: new FormData(this),
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = '{{ route('dashboard') }}';
        } else {
            throw new Error(data.message || 'Terjadi kesalahan saat menyimpan profil.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'Terjadi kesalahan. Silakan coba lagi.');
    })
    .finally(() => {
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
    });
});

document.querySelector('button[type="button"]').addEventListener('click', function() {
    document.getElementById('foto_pp').click();
});

document.getElementById('foto_pp').addEventListener('change', function(e) {
    if (e.target.files.length > 0) {
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.inline-block').innerHTML = `<img src="${e.target.result}" alt="Profile" class="h-12 w-12 rounded-full">`;
        }
        reader.readAsDataURL(file);
    }
});
</script>