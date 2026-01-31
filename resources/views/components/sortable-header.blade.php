@props(['column', 'label', 'currentSort' => null, 'currentDirection' => 'asc'])

@php
    $isActive = request('sort') === $column || (request('sort') === null && $currentSort === $column);
    $direction = $isActive && request('direction', 'asc') === 'asc' ? 'desc' : 'asc';
    $icon = $isActive 
        ? (request('direction', 'asc') === 'asc' ? 'fa-sort-up' : 'fa-sort-down')
        : 'fa-sort';
    $url = request()->fullUrlWithQuery(['sort' => $column, 'direction' => $direction]);
@endphp

<a href="{{ $url }}" class="text-decoration-none text-dark d-flex align-items-center gap-1">
    {{ $label }}
    <i class="fas {{ $icon }} {{ $isActive ? 'text-primary' : 'text-muted' }}" style="font-size: 0.75em;"></i>
</a>
