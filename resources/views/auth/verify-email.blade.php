<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Terimakasih telah meregistrasikan akun sebagai Mitra! Untuk alasan keamanan, Terdapat Verifikasi Email yang dikirim melalui inbox GMAIL anda. Jika email tidak terkirim, Klik tombol Resend Email Verifikasi dibawah.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Email Verifikasi Baru telah dikirim.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Email Verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
