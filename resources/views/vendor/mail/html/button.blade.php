@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])

@php
    // Map the color name to the desired color code
    $buttonStyles = [
        'primary' => '#3490dc',
        'success' => '#38c172',
        'error' => '#e3342f',
        'custom' => '#98100A', // Your custom color
    ];

    // Use the color code if it's defined, otherwise fall back to 'primary'
    $buttonColor = $buttonStyles[$color] ?? $color;
@endphp

<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button button-{{ $color }}" target="_blank" rel="noopener" style="background-color: {{ $buttonColor }}; color: #ffffff; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block;">
    {{ $slot }}
</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
