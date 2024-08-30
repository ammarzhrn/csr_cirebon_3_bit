<x-mail::message>
{{-- <x-slot:header>
    <a href="{{ config('app.url') }}">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Application Logo">
    </a>
</x-slot:header> --}}

{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Terimakasih telah Meregistrasikan diri sebagai Mitra!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ 'Anda bisa klik tombol dibawah untuk melakukan Verifikasi Email' }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'custom',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ 'Jika anda merasa tidak meregistrasikan Akun, Hiraukan email ini.' }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ 'Pemerintah Kota Cirebon' }}
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
