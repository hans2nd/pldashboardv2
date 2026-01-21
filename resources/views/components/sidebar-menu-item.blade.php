@props(['menuKey', 'menu', 'activeMenu'])

@php
    $isActive = false;
    $activeKeys = [];
    
    // Check direct items
    if (isset($menu['items'])) {
        foreach ($menu['items'] as $key => $item) {
            $activeKeys[] = $key;
            if ($key === $activeMenu) {
                $isActive = true;
            }
        }
    }
    
    // Check nested children
    if (isset($menu['children'])) {
        foreach ($menu['children'] as $child) {
            if (isset($child['items'])) {
                foreach ($child['items'] as $key => $item) {
                    $activeKeys[] = $key;
                    if ($key === $activeMenu) {
                        $isActive = true;
                    }
                }
            }
        }
    }
@endphp

<li class="nav-item {{ $isActive ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#{{ $menu['collapse_id'] }}">
        <i class="{{ $menu['icon'] }}"></i>
        <p>{{ $menu['label'] }}</p>
        <span class="caret"></span>
    </a>
    
    <div class="collapse {{ $isActive ? 'show' : '' }}" id="{{ $menu['collapse_id'] }}">
        <ul class="nav nav-collapse{{ isset($menu['children']) ? '' : ' subnav' }}">
            {{-- Render direct items --}}
            @if(isset($menu['items']))
                @foreach($menu['items'] as $itemKey => $item)
                    @if(!isset($item['permission']) || auth()->user()->can($item['permission']))
                        <li class="nav-item {{ $activeMenu === $itemKey ? 'active' : '' }}">
                            <a href="{{ route($item['route']) }}">
                                <span class="sub-item">{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
            
            {{-- Render nested children (sub-submenu) --}}
            @if(isset($menu['children']))
                @foreach($menu['children'] as $childKey => $child)
                    @if(!isset($child['permission']) || auth()->user()->can($child['permission']))
                        <li>
                            <a data-bs-toggle="collapse" href="#{{ $child['collapse_id'] }}">
                                <span class="sub-item">{{ $child['label'] }}</span>
                                <span class="caret"></span>
                            </a>
                            @php
                                $childActive = false;
                                if (isset($child['items'])) {
                                    foreach ($child['items'] as $key => $item) {
                                        if ($key === $activeMenu) {
                                            $childActive = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp
                            <div class="collapse {{ $childActive ? 'show' : '' }}" id="{{ $child['collapse_id'] }}">
                                <ul class="nav nav-collapse subnav">
                                    @foreach($child['items'] as $itemKey => $item)
                                        @if(!isset($item['permission']) || auth()->user()->can($item['permission']))
                                            <li class="nav-item {{ $activeMenu === $itemKey ? 'active' : '' }}">
                                                <a href="{{ route($item['route']) }}">
                                                    <span class="sub-item">{{ $item['label'] }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</li>
