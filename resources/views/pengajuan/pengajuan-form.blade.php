<div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md mt-16">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Ajukan Surat Rekomendasi CSR
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Untuk memohon rekomendasi CSR. Anda dapat mengisi Form di bawah.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form id="pengajuan-form" method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('POST')

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">
                        Nama
                    </label>
                    <div class="mt-1">
                        <input type="text" name="nama" id="nama" placeholder="Input Nama yang mengajukan" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                  <div>
                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">
                        Tanggal Lahir
                    </label>
                    <div class="mt-1">
                        <input type="date" name="tgl_lahir" id="tgl_lahir" placeholder="Input Tanggal Lahir" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="Alamat" class="block text-sm font-medium text-gray-700">
                        Alamat
                    </label>
                    <div class="mt-1">
                        <textarea name="alamat" id="alamat" rows="3" placeholder="Input Alamat anda" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm"></textarea>
                    </div>
                </div>

                <div>
                    <label for="no_telp" class="block text-sm font-medium text-gray-700">
                        Nomor Telepon
                    </label>
                    <div class="mt-1">
                        <input type="text" name="no_telp" id="no_telp" placeholder="Isi Nomor Telepon anda" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="nama_instansi" class="block text-sm font-medium text-gray-700">
                        Nama Instansi / Perorangan
                    </label>
                    <div class="mt-1">
                        <input type="text" name="nama_instansi" id="nama_instansi" placeholder="Input Nama Instansi" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="nama_instansi" class="block text-sm font-medium text-gray-700">
                        Nama Mitra CSR
                    </label>
                    <div class="mt-1">
                        <input type="text" name="mitra_csr" id="mitra_csr" placeholder="Input Mitra CSR" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="nama_program" class="block text-sm font-medium text-gray-700">
                        Nama Program
                    </label>
                    <div class="mt-1">
                        <input type="text" name="nama_program" id="nama_program" placeholder="Input Nama Program" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#98100A] focus:border-[#98100A] sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#98100A] hover:bg-[#7A0D08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                        Ajukan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>