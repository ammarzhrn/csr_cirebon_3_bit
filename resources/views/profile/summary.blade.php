<x-app-layout>
    @include('notification.notification-all')

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
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
                            <span class="font-semibold text-sm text-red-600">
                                {{ __('Profile') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-[28px] font-semibold leading-[44px] tracking-[-0.02em] text-left font-inter">Profil Pengguna</h2>
                            <a href="{{ route('summary.edit', $summary->id) }}" class="flex items-center justify-center w-[150px] h-[52px] px-[18px] py-[10px] gap-2 rounded-lg border border-[#98100A] bg-[#98100A] text-white hover:bg-[#7a0d08] focus:ring-4 focus:ring-red-300 font-medium text-sm shadow-[0px_1px_2px_0px_#1018280D]">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.0003 1.66602L18.3337 4.99935M1.66699 18.3327L2.73066 14.4326C2.80006 14.1781 2.83475 14.0509 2.88802 13.9323C2.93531 13.8269 2.99343 13.7268 3.06142 13.6334C3.138 13.5283 3.23125 13.4351 3.41775 13.2486L12.0289 4.63742C12.1939 4.47241 12.2764 4.38991 12.3716 4.359C12.4553 4.33181 12.5454 4.33181 12.6291 4.359C12.7242 4.38991 12.8067 4.47241 12.9717 4.63742L15.3623 7.02794C15.5273 7.19295 15.6098 7.27546 15.6407 7.37059C15.6679 7.45428 15.6679 7.54442 15.6407 7.62811C15.6098 7.72324 15.5273 7.80575 15.3623 7.97075L6.75108 16.5819C6.56458 16.7684 6.47134 16.8617 6.36623 16.9383C6.2729 17.0062 6.17276 17.0644 6.06742 17.1117C5.94878 17.1649 5.82156 17.1996 5.56711 17.269L1.66699 18.3327Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Ubah Profile
                            </a>
                        </div>
                        <div class="flex justify-center items-center">
                            <div class="bg-white shadow sm:rounded-lg mt-6" style="width: 1240px; padding: 40px; border-radius: 12px; border-top: 1px solid transparent;">
                                <div class="flex flex-col md:flex-row justify-between">
                                    <div class="w-full md:w-5/12 mb-4 md:mb-0">
                                        <div class="w-full h-[300px] rounded-xl bg-[#E7EEF7] flex items-center justify-center relative">
                                            <img src="{{ $user->summary && $user->summary->foto_pp ? asset('storage/images/profile/' . $user->summary->foto_pp) : asset('storage/images/profile/profile.png') }}" alt="Foto Profil" class="max-w-full max-h-full object-contain rounded-xl">
                                        </div>
                                    </div>
                                    <div class="w-full md:w-6/12">
                                        <div class="w-full space-y-4">
                                            <h3 class="text-2xl font-semibold">{{ $user->summary->nama_mitra ?? 'Nama Mitra belum diisi' }}</h3>

                                            <p class="text-xl text-gray-600">{{ $user->name }}</p>

                                            @if($user->level === 'mitra')
                                         
                                                <div class="flex items-center">
                                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                                        <rect x="2" y="2" width="32" height="32" rx="16" fill="#FFDDDC"/>
                                                        <rect x="2" y="2" width="32" height="32" rx="16" stroke="#FFF1F0" stroke-width="4"/>
                                                        <path d="M11.333 14.666L16.7763 18.4763C17.2171 18.7849 17.4375 18.9391 17.6772 18.9989C17.8889 19.0517 18.1104 19.0517 18.3222 18.9989C18.5619 18.9391 18.7823 18.7849 19.2231 18.4763L24.6663 14.666M14.533 23.3327H21.4663C22.5864 23.3327 23.1465 23.3327 23.5743 23.1147C23.9506 22.9229 24.2566 22.617 24.4484 22.2407C24.6663 21.8128 24.6663 21.2528 24.6663 20.1327V15.866C24.6663 14.7459 24.6663 14.1859 24.4484 13.758C24.2566 13.3817 23.9506 13.0757 23.5743 12.884C23.1465 12.666 22.5864 12.666 21.4663 12.666H14.533C13.4129 12.666 12.8529 12.666 12.425 12.884C12.0487 13.0757 11.7427 13.3817 11.551 13.758C11.333 14.1859 11.333 14.7459 11.333 15.866V20.1327C11.333 21.2528 11.333 21.8128 11.551 22.2407C11.7427 22.617 12.0487 22.9229 12.425 23.1147C12.8529 23.3327 13.4129 23.3327 14.533 23.3327Z" stroke="#98100A" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <span>{{ $user->email }}</span>
                                                </div>

                                                <div class="flex items-center">
                                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                                        <rect x="2" y="2" width="32" height="32" rx="16" fill="#FFDDDC"/>
                                                        <rect x="2" y="2" width="32" height="32" rx="16" stroke="#FFF1F0" stroke-width="4"/>
                                                        <path d="M15.5869 15.9022C16.0508 16.8686 16.6834 17.7744 17.4844 18.5755C18.2855 19.3765 19.1912 20.009 20.1577 20.473C20.2408 20.5129 20.2823 20.5329 20.3349 20.5482C20.5218 20.6027 20.7513 20.5636 20.9096 20.4502C20.9542 20.4183 20.9923 20.3802 21.0685 20.304C21.3016 20.071 21.4181 19.9544 21.5353 19.8782C21.9772 19.5909 22.5469 19.5909 22.9889 19.8782C23.106 19.9544 23.2226 20.071 23.4556 20.304L23.5856 20.4339C23.9398 20.7882 24.117 20.9654 24.2132 21.1556C24.4046 21.534 24.4046 21.9809 24.2132 22.3592C24.117 22.5495 23.9399 22.7266 23.5856 23.0809L23.4805 23.186C23.1274 23.5391 22.9508 23.7156 22.7108 23.8505C22.4445 24.0001 22.0308 24.1077 21.7253 24.1068C21.45 24.1059 21.2619 24.0525 20.8856 23.9457C18.8633 23.3718 16.9551 22.2888 15.3631 20.6968C13.7711 19.1048 12.6881 17.1966 12.1142 15.1743C12.0074 14.798 11.9539 14.6098 11.9531 14.3345C11.9522 14.0291 12.0598 13.6154 12.2094 13.3491C12.3442 13.109 12.5208 12.9325 12.8739 12.5794L12.979 12.4743C13.3332 12.12 13.5104 11.9429 13.7007 11.8467C14.079 11.6553 14.5259 11.6553 14.9042 11.8467C15.0945 11.9429 15.2716 12.12 15.6259 12.4743L15.7559 12.6042C15.9889 12.8373 16.1055 12.9539 16.1816 13.071C16.469 13.513 16.469 14.0827 16.1816 14.5246C16.1055 14.6418 15.9889 14.7583 15.7559 14.9914C15.6796 15.0676 15.6415 15.1057 15.6096 15.1503C15.4963 15.3085 15.4572 15.538 15.5117 15.725C15.527 15.7775 15.5469 15.8191 15.5869 15.9022Z" stroke="#98100A" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <span>{{ $user->summary->no_telp ?? 'Nomor telepon belum diisi' }}</span>
                                                </div>

                                                <div class="flex items-center">
                                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                                        <rect x="2" y="2" width="32" height="32" rx="16" fill="#FFDDDC"/>
                                                        <rect x="2" y="2" width="32" height="32" rx="16" stroke="#FFF1F0" stroke-width="4"/>
                                                        <path d="M18.0003 18.334C19.1049 18.334 20.0003 17.4386 20.0003 16.334C20.0003 15.2294 19.1049 14.334 18.0003 14.334C16.8958 14.334 16.0003 15.2294 16.0003 16.334C16.0003 17.4386 16.8958 18.334 18.0003 18.334Z" stroke="#98100A" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M18.0003 24.6673C19.3337 22.0007 23.3337 20.2795 23.3337 16.6673C23.3337 13.7218 20.9458 11.334 18.0003 11.334C15.0548 11.334 12.667 13.7218 12.667 16.6673C12.667 20.2795 16.667 22.0007 18.0003 24.6673Z" stroke="#98100A" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <span>{{ $user->summary->alamat ?? 'Alamat belum diisi' }}</span>
                                                </div>
                                            @endif
                                            <h3 class="text-xl font-semibold">Deskripsi</h3>
                                            <p class="text-gray-700">
                                                {{ $user->summary->deskripsi ?? 'Deskripsi belum ditambahkan' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer section -->
        <footer class="bg-black text-white border-t border-gray-300 py-[70px]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left">
                    <p class="text-gray-300 text-sm">
                        © 2024 Corporate Social Responsibility Kabupaten Cirebon
                    </p>
                    <p class="text-gray-300 text-xs mt-1">
                        Pemkab Kabupaten Cirebon, Badan Pendapatan Daerah (Bapenda) Kabupaten Cirebon.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="/" class="border border-gray-300 px-4 py-2 rounded-md text-white flex items-center">
                        Kembali ke halaman utama
                    </a>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>
