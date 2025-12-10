@props([
    'action' => '#', // route tujuan pencarian
    'placeholder' => 'Cari data...',
    'value' => request('search') ?? '',
    'button' => 'Cari',
])

<form method="GET" action="{{ $action }}" class="d-flex align-items-center gap-2 mb-3">
    <input type="text" name="search" value="{{ $value }}" placeholder="{{ $placeholder }}" class="form-control"
        style="max-width: 250px;">

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search me-1"></i> {{ $button }}
    </button>

    @if (request('search'))
        <a href="{{ $action }}" class="btn btn-outline-secondary">
            <i class="fas fa-times"></i> Reset
        </a>
    @endif
</form>
