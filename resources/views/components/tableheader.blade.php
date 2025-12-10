@props(['label', 'field', 'sortable' => true])

@php
    $currentSort = request('sort');
    $currentDirection = request('direction', 'asc');
    $newDirection = $currentSort === $field && $currentDirection === 'asc' ? 'desc' : 'asc';
@endphp

<th>
    @if ($sortable)
        <a href="{{ request()->fullUrlWithQuery(['sort' => $field, 'direction' => $newDirection]) }}"
            class="text-decoration-none text-dark d-flex align-items-center justify-content-between"
            style="white-space: nowrap;">
            <span>{{ $label }}</span>
            @if ($currentSort === $field)
                <i class="fas fa-sort-{{ $currentDirection === 'asc' ? 'up' : 'down' }}"></i>
            @else
                <i class="fas fa-sort text-muted"></i>
            @endif
        </a>
    @else
        {{ $label }}
    @endif
</th>
