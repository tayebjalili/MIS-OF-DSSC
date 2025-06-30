@props(['column', 'label', 'currentSort'])

<th>
    <a href="{{ request()->fullUrlWithQuery([
        'sort' => $column,
        'direction' => $currentSort['field'] === $column && $currentSort['direction'] === 'asc' ? 'desc' : 'asc'
    ]) }}" class="d-flex align-items-center">
        {{ $label }}
        @if($currentSort['field'] === $column)
            <span class="ml-1">
                @if($currentSort['direction'] === 'asc')
                    ↑
                @else
                    ↓
                @endif
            </span>
        @endif
    </a>
</th>
