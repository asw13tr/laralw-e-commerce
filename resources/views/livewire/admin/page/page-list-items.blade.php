@if($items)
    @foreach($items as $key => $page)
        <tr>
            <td>{{ $page->id  }}</td>
            <td>{{ str_repeat('— ', $factor) }} {{ $page->title  }}</td>
            <td><!-- todo: author alt kategorilerde çağırılmıyor neden --></td>
            <td>{{ $page->keywords  }}</td>
            <td>{{ $page->created_at->format('d F Y H:i')  }}</td>
            <td>{{ $page->updated_at->format('d F Y H:i') }}</td>
            <td>
                <div class="form-check form-switch">
                    <input {{ $page->status? 'checked' : ''  }} class="form-check-input" type="checkbox" role="switch" id="pageStatus">
                </div>
            </td>
            <td>
                <a href="{{ url()->route('panel.page.edit', ['id'=>$page->id])  }}" class="btn btn-info btn-sm"><i class="bi bi-eye fw-bold text-light"></i></a>
                <a href="{{ url()->route('panel.page.edit', ['id'=>$page->id])  }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></a>
                <button wire:click="showModalForDelete({{ $page }})" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
            </td>
        </tr>
        @if($page->children->isNotEmpty())
            @include('livewire.admin.page.page-list-items', ['items'=>$page->children, 'factor'=>($factor ?? 0)+1])
        @endif
    @endforeach
@endif
