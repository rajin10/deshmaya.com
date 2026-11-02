@props([
    'eyebrow' => null,
    'title',
    'description' => null,
    'center' => false,
])

<div @class(['section-heading', 'section-heading--center' => $center]) data-reveal>
    @if($eyebrow)<p class="eyebrow">{{ $eyebrow }}</p>@endif
    <h2>{{ $title }}</h2>
    @if($description)<p class="section-heading__description">{{ $description }}</p>@endif
</div>
