@isset($items)
    @foreach($items as $item)
        <option value="{{ $item->id }}">{{ str_repeat('--', $factor) }} {{ $item->title }}</option>
        @if($item->children->isNotEmpty())
            @include('livewire.admin.page.page-dropdown-items', ['items'=>$item->children, 'factor'=>($factor ?? 0)+1])
        @endif
    @endforeach
@endisset
