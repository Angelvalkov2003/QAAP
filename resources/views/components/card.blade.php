@props(['EMEA' => "", 'AMS' => "", 'APAC' => "", 'Closed' => ""])

<div @class(['EMEA' => $EMEA, 'AMS' => $AMS, 'APAC' => $APAC,'Closed' => $Closed, 'card'])>
{{ $slot }}
<a href="{{ $attributes->get('href') }}" class="btn">View Details</a>
</div>
