@foreach($items as $item)
    <option value="{{ $item->id }}">{{ str_repeat('- ', $multiplier) }} {{ $item->title }}</option>
    @if($item->children->isNotEmpty())
        @include('livewire.admin.product.category-option-items', ['items' => $item->children, 'multiplier'=>$multiplier+1])
    @endif
@endforeach
