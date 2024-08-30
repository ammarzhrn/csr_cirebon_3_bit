

<!-- Company Name Input -->
<div>
    <label for="name" class="block text-sm font-medium text-gray-700">
        Nama Perusahaan <span class="text-red-500">*</span>
    </label>
    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukan nama perusahaan Anda" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
    @error('name')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

<!-- Email Input -->
<div>
    <label for="email" class="block text-sm font-medium text-gray-700">
        Email <span class="text-red-500">*</span>
    </label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukan email Anda" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
    @error('email')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>



<!-- Password Input -->
<div>
    <label for="password" class="block text-sm font-medium text-gray-700">
        Kata Sandi <span class="text-red-500">*</span>
    </label>
    <div class="relative">
        <input type="password" id="password" name="password" placeholder="Masukan kata sandi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        <button type="button" onclick="togglePasswordVisibility('password')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </button>
    </div>
    @error('password')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

<!-- Password Confirmation Input -->
<div>
    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
        Konfirmasi Kata Sandi <span class="text-red-500">*</span>
    </label>
    <div class="relative">
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi kata sandi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </button>
    </div>
</div>
