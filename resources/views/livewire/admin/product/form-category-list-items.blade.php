@foreach($items as $category)
    <li class="list-group-item">
        <input wire:model="selectedCategories" class="form-check-input me-1" type="checkbox" value="{{$category->id}}" id="category__{{$category->id}}">
        <label class="form-check-label stretched-link" for="category__{{$category->id}}">{{ str_repeat('- ', $factor) }}{{ $category->title }}</label>
    </li>
    @if($category->children->isNotEmpty())
        @include('livewire.admin.product.form-category-list-items', ['items'=>$category->children, 'factor'=>$factor + 1])
    @endif
@endforeach
