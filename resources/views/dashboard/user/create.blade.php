@if(auth()->user()->level === 'admin')
<x-app-layout>
    <div class="flex flex-col min-h-screen">
    @include('notification.notification-admin')

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
                            <a href="{{ route('dashboard.user') }}" class="text-gray-500 hover:text-gray-700">
                                <span class="font-semibold text-sm text-gray-500 hover:text-gray-700">
                                    {{ __('User') }}
                                </span>
                            </a>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="#667085" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="font-semibold text-sm text-red-600">
                                {{ __('Buat User') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl sm:text-[28px] font-semibold leading-tight sm:leading-[44px] tracking-[-0.02em] text-left font-inter">Buat User Baru</h2>
                        </div>

                        <!-- Form container -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full sm:w-[1240px] p-4 sm:p-6 space-y-6 border border-gray-200">
                            <form id="user-form" action="{{ route('dashboard.user.store') }}" method="POST" class="space-y-6">
                                @csrf                                
                                <!-- Nama Perusahaan -->
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-semibold leading-5">Nama Perusahaan <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" id="name" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Masukan nama perusahaan Anda" required value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Email Input -->
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-semibold leading-5">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Masukan email Anda" required value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="space-y-2">
                                    <label for="password" class="block text-sm font-semibold leading-5">Kata Sandi <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Masukan kata sandi" required>
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
                                <div class="space-y-2">
                                    <label for="password_confirmation" class="block text-sm font-semibold leading-5">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full h-12 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Konfirmasi kata sandi" required>
                                        <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="flex justify-end">
                                    <button type="submit" class="flex items-center justify-center w-full sm:w-52 h-[52px] px-4 sm:px-[18px] py-[10px] gap-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white shadow-sm hover:bg-[#7d0d08] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98100A]">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                            <path d="M8.74928 11.2501L17.4993 2.50014M8.85559 11.5235L11.0457 17.1552C11.2386 17.6513 11.3351 17.8994 11.4741 17.9718C11.5946 18.0346 11.7381 18.0347 11.8587 17.972C11.9978 17.8998 12.0946 17.6518 12.2881 17.1559L17.78 3.08281C17.9547 2.63516 18.0421 2.41133 17.9943 2.26831C17.9528 2.1441 17.8553 2.04663 17.7311 2.00514C17.5881 1.95736 17.3643 2.0447 16.9166 2.21939L2.84349 7.71134C2.34759 7.90486 2.09965 8.00163 2.02739 8.14071C1.96475 8.26129 1.96483 8.40483 2.02761 8.52533C2.10004 8.66433 2.3481 8.7608 2.84422 8.95373L8.47589 11.1438C8.5766 11.183 8.62695 11.2026 8.66935 11.2328C8.70693 11.2596 8.7398 11.2925 8.7666 11.3301C8.79685 11.3725 8.81643 11.4228 8.85559 11.5235Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Daftar
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
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
        }

        document.getElementById('user-form').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
            console.log('Form data:', new FormData(this));
            this.submit();
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

    @stack('scripts')
</x-app-layout>
@else
<x-app-layout>
    @include(404)
</x-app-layout>
@endif