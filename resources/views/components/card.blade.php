@props(['region' => "AMS"])

<div @class(['region' => $region, 'card'])>
{{ $slot }}
<a href="{{ $attributes->get('href') }}" class="btn">View Details</a>
</div>
