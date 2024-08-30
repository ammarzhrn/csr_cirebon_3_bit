<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed w-full z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <x-application-logo class="block h-3 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @auth
                    @if(auth()->user()->level === 'admin')
                        @if(request()->is('dashboard*'))
                            <!-- Admin navigation links for dashboard -->

                            <x-nav-link :href="route('dashboard.kegiatan.index')" :active="request()->routeIs('dashboard.kegiatan.*')">
                                {{ __('Kegiatan') }}
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard.proyek')" :active="request()->routeIs('dashboard.proyek')|| request()->routeIs('dashboard.proyek.show') ">
                                {{ __('Proyek') }}
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard.sektor.index')" :active="request()->routeIs('dashboard.sektor.index') || request()->routeIs('dashboard.sektor.show')">
                                {{ __('Sektor') }}
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard.laporan')" :active="request()->routeIs('dashboard.laporan') || request()->routeIs('dashboard.laporan.show')">
                                {{ __('Laporan') }}
                            </x-nav-link>
                                <x-nav-link :href="route('dashboard.user')" :active="request()->routeIs('dashboard.user') || request()->routeIs('dashboard.user.show')">
                                    {{ __('User') }}
                                </x-nav-link>
                            <x-nav-link :href="route('dashboard.pengajuan.index')" :active="request()->routeIs('dashboard.pengajuan.index') || request()->routeIs('dashboard.pengajuan.show')">
                                {{ __('Pengajuan') }}
                            </x-nav-link>
                        @else
                            <!-- Admin navigation links for other pages -->
                            <x-nav-link :href="url('/')" :active="request()->is('/')">
                                {{ __('Beranda') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/tentang')" :active="request()->is('tentang')">
                                {{ __('Tentang') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/kegiatan')" :active="request()->is('kegiatan')">
                                {{ __('Kegiatan') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/statistik')" :active="request()->is('statistik')">
                                {{ __('Statistik') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/sektor')" :active="request()->is('sektor')">
                                {{ __('Sektor') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/laporan')" :active="request()->is('laporan')">
                                {{ __('Laporan') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/mitra-list')" :active="request()->is('mitra-list')">
                                {{ __('Mitra') }}
                            </x-nav-link>
                        @endif
                    @elseif(auth()->user()->level === 'mitra')
                        @if(request()->routeIs('home'))
                            <!-- Mitra navigation links for home page -->
                            <x-nav-link :href="url('/')" :active="request()->is('/')">
                                {{ __('Beranda') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/tentang')" :active="request()->is('tentang')">
                                {{ __('Tentang') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/kegiatan')" :active="request()->is('kegiatan')">
                                {{ __('Kegiatan') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/statistik')" :active="request()->is('statistik')">
                                {{ __('Statistik') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/sektor')" :active="request()->is('sektor')">
                                {{ __('Sektor') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/laporan')" :active="request()->is('laporan')">
                                {{ __('Laporan') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/mitra-list')" :active="request()->is('mitra-list')">
                                {{ __('Mitra') }}
                            </x-nav-link>
                        @elseif(request()->routeIs('dashboard') || request()->routeIs('summary.show') || request()->routeIs('summary.edit') || request()->routeIs('dashboard.laporan') || request()->routeIs('dashboard.laporan.create') || request()->routeIs('dashboard.laporan.show') || request()->routeIs('dashboard.laporan.edit') || request()->routeIs('#'))
                            <!-- Kosongkan navbar untuk mitra di halaman dashboard, laporan, dan detail laporan -->
                        @else
                            <!-- Mitra navigation links for other pages -->
                            <x-nav-link :href="url('/')" :active="request()->is('/')">
                                {{ __('Beranda') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/tentang')" :active="request()->is('tentang')">
                                {{ __('Tentang') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/kegiatan')" :active="request()->is('kegiatan')">
                                {{ __('Kegiatan') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/statistik')" :active="request()->is('statistik')">
                                {{ __('Statistik') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/sektor')" :active="request()->is('sektor')">
                                {{ __('Sektor') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/laporan')" :active="request()->is('laporan')">
                                {{ __('Laporan') }}
                            </x-nav-link>
                            <x-nav-link :href="url('/mitra-list')" :active="request()->is('mitra-list')">
                                {{ __('Mitra') }}
                            </x-nav-link>
                        @endif
                    @endif
                @else
                    <!-- Navigation links for non-logged in users -->
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/tentang')" :active="request()->is('tentang')">
                        {{ __('Tentang') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/kegiatan')" :active="request()->is('kegiatan')">
                        {{ __('Kegiatan') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/statistik')" :active="request()->is('statistik')">
                        {{ __('Statistik') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/sektor')" :active="request()->is('sektor')">
                        {{ __('Sektor') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/laporan')" :active="request()->is('laporan')">
                        {{ __('Laporan') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/mitra-list')" :active="request()->is('mitra-list')">
                        {{ __('Mitra') }}
                    </x-nav-link>
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth    
                    @if(auth()->user()->level === 'admin' || auth()->user()->level === 'mitra' || auth()->user()->level === 'guest')
                        @if(request()->routeIs('home'))
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md mr-3 hover:bg-blue-700 transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                        @endif
                        
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    @php
                                        $summary = auth()->user()->summary;
                                        $isProfileComplete = $summary && $summary->nama && $summary->nama_mitra && $summary->email && $summary->no_telp && $summary->alamat && $summary->deskripsi;
                                    @endphp
                                    
                                    @if(auth()->user()->level === 'admin' || $isProfileComplete)
                                        <div class="flex items-center space-x-4">
                                            <div class="flex flex-col items-start">
                                                <span class="font-semibold" style="font-size: 16px; font-weight: 500; line-height: 24px; color: #101828;">{{ auth()->user()->name }}</span>
                                                <span class="text-sm ml-auto" style="font-size: 16px; font-weight: 400; line-height: 20px; color: {{ auth()->user()->level === 'guest' ? '#EF4444' : '#667085' }};">
                                                    @if(auth()->user()->level === 'guest')
                                                        Mitra (non-activated)
                                                    @else
                                                        {{ ucfirst(auth()->user()->level) }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                @if(auth()->user()->summary && auth()->user()->summary->foto_pp)
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url('images/profile/' . auth()->user()->summary->foto_pp) }}" alt="{{ auth()->user()->name }}">
                                                @else
                                                    <img class="h-10 w-10 rounded-full" src="{{ Storage::url('images/profile/profile.png') }}" alt="{{ auth()->user()->name }}">
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <span>{{ __('Menu') }}</span>
                                    @endif
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>

                                @if(auth()->user()->level === 'admin' || $isProfileComplete)
                                    <x-dropdown-link :href="route('summary.show')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-red-800 text-white rounded-md hover:bg-red-700 transition duration-150 ease-in-out">
                        Pengajuan
                    </a>
                @endauth
                @auth
                    @if(!request()->routeIs('home') && (auth()->user()->level === 'admin' || auth()->user()->level === 'mitra'))
                        <!-- Notifikasi -->
                        <div class="mr-3">
                            <x-notification />
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->level === 'admin')
                    @if(request()->is('dashboard*'))
                        <!-- Admin responsive navigation links for dashboard -->
                        <x-responsive-nav-link :href="route('dashboard.kegiatan.index')" :active="request()->routeIs('dashboard.kegiatan.*')">
                            {{ __('Kegiatan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('dashboard.proyek')" :active="request()->routeIs('dashboard.proyek') || request()->routeIs('dashboard.proyek.show')">
                            {{ __('Proyek') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('dashboard.sektor.index')" :active="request()->routeIs('dashboard.sektor.index') || request()->routeIs('dashboard.sektor.show')">
                            {{ __('Sektor') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('dashboard.laporan')" :active="request()->routeIs('dashboard.laporan') || request()->routeIs('dashboard.laporan.show')">
                            {{ __('Laporan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('dashboard.user')" :active="request()->routeIs('dashboard.user') || request()->routeIs('dashboard.user.show')">
                            {{ __('User') }}
                        </x-responsive-nav-link>
                    @else
                        <!-- Admin responsive navigation links for other pages -->
                        <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                            {{ __('Beranda') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/tentang')" :active="request()->is('tentang')">
                            {{ __('Tentang') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/kegiatan')" :active="request()->is('kegiatan')">
                            {{ __('Kegiatan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/statistik')" :active="request()->is('statistik')">
                            {{ __('Statistik') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/sektor')" :active="request()->is('sektor')">
                            {{ __('Sektor') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/laporan')" :active="request()->is('laporan')">
                            {{ __('Laporan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/mitra-list')" :active="request()->is('mitra-list')">
                            {{ __('Mitra') }}
                        </x-responsive-nav-link>
                    @endif
                @elseif(auth()->user()->level === 'mitra')
                    @if(request()->routeIs('home'))
                        <!-- Mitra responsive navigation links for home page -->
                        <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                            {{ __('Beranda') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/tentang')" :active="request()->is('tentang')">
                            {{ __('Tentang') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/kegiatan')" :active="request()->is('kegiatan')">
                            {{ __('Kegiatan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/statistik')" :active="request()->is('statistik')">
                            {{ __('Statistik') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/sektor')" :active="request()->is('sektor')">
                            {{ __('Sektor') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/laporan')" :active="request()->is('laporan')">
                            {{ __('Laporan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/mitra-list')" :active="request()->is('mitra-list')">
                            {{ __('Mitra') }}
                        </x-responsive-nav-link>
                    @elseif(request()->routeIs('dashboard') || request()->routeIs('summary.show') || request()->routeIs('summary.edit') || request()->routeIs('dashboard.laporan') || request()->routeIs('dashboard.laporan.create') || request()->routeIs('dashboard.laporan.show') || request()->routeIs('dashboard.laporan.edit') || request()->routeIs('#'))
                        <!-- Kosongkan responsive navbar untuk mitra di halaman dashboard, laporan, dan detail laporan -->
                    @else
                        <!-- Mitra responsive navigation links for other pages -->
                        <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                            {{ __('Beranda') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/tentang')" :active="request()->is('tentang')">
                            {{ __('Tentang') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/kegiatan')" :active="request()->is('kegiatan')">
                            {{ __('Kegiatan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/statistik')" :active="request()->is('statistik')">
                            {{ __('Statistik') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/sektor')" :active="request()->is('sektor')">
                            {{ __('Sektor') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/laporan')" :active="request()->is('laporan')">
                            {{ __('Laporan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="url('/mitra-list')" :active="request()->is('mitra-list')">
                            {{ __('Mitra') }}
                        </x-responsive-nav-link>
                    @endif
                @endif
            @else
                <!-- Responsive navigation links for non-logged in users -->
                <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                    {{ __('Beranda') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/tentang')" :active="request()->is('tentang')">
                    {{ __('Tentang') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/kegiatan')" :active="request()->is('kegiatan')">
                    {{ __('Kegiatan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/statistik')" :active="request()->is('statistik')">
                    {{ __('Statistik') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/sektor')" :active="request()->is('sektor')">
                    {{ __('Sektor') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/laporan')" :active="request()->is('laporan')">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/mitra-list')" :active="request()->is('mitra-list')">
                    {{ __('Mitra') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if(auth()->user()->level === 'admin' || auth()->user()->level === 'mitra')
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(auth()->user()->level === 'admin' || $isProfileComplete)
                        <x-responsive-nav-link :href="route('summary.show')" class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                    @endif
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="flex items-center text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <x-responsive-nav-link :href="route('register')" class="flex items-center justify-center bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-150 ease-in-out py-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        {{ __('Pengajuan') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>