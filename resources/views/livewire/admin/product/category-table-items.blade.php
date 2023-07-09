@foreach($items as $item)
    <tr>
        <td class="p-1">
            @if($item['cover'])
                <img src="{{ url("uploads/".$item['cover']) }}" class="img-fluid">
            @endif
        </td>
        <td>{{ str_repeat('══', $multiplier)  }} {{ $item['title'] }}</td>
        <td>{{ $item['description'] }}</td>
        <td>
            <div class="form-check form-switch">
                <!-- todo: Switch ile beraber kategorinin durumunu değiştir. -->
                <input {{ $item['status']? 'checked' : null }} class="form-check-input" id="category-{{ $item['id']  }}" type="checkbox" role="switch" >
            </div>
        </td>
        <td>
            <button wire:click="setCategory({{ $item }})" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></button>
            <button onclick="showModalForDelete({
                    title: 'Kategori Silinecek',
                    text:   '<strong>{{ $item->title }}</strong> kategorisi ve kategoriye ait tüm alt kategoriler silinecek. İşlem bir daha geri alınamaz.',
                    emit:   {
                        name: 'deleteCategory',
                        params: {{ $item['id']  }}
                    }
                })" data-bs-toggle="modal" data-bs-target="#userDeleteModal" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
        </td>
    </tr>
    @if($item->children->isNotEmpty())
        @include('livewire.admin.product.category-table-items', ['items' => $item->children, 'multiplier'=>$multiplier+1])
    @endif
@endforeach
