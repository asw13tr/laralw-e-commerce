@if($items)
    @foreach($items as $key => $page)
        <tr>
            <td class="p-0">
                @if($page->cover)
                    <img src="{{ url('uploads/'.$page->cover)  }}" loading="lazy" style="height: 70px; width:  70px;" class="object-fit-cover"  alt=""/>
                @endif
            </td>
            <td class="fw-bold">
                <a href="{{ route('panel.page.edit', ['id'=>$page->id])  }}" class="link-dark">{{ str_repeat('— ', $factor) }} {{ $page->title  }}</a>
            </td>
            <td>{{ $page->keywords  }}</td>
            <td>{{ $page->author->name ?? '-'  }}</td>
            <td>
                <span class="text-primary fw-bold"><em class="bi bi-calendar-plus"></em> {{ $page->created_at->format('d F Y H:i') }}</span>
                <div class="pb-1 border-bottom mb-1"></div>
                <span class="text-success fw-bold"><em class="bi bi-calendar-range"></em> {{ $page->updated_at->format('d F Y H:i') }}</span>
            </td>
            <td>
                <div class="form-check form-switch">
                    <input {{ $page->status? 'checked' : ''  }} class="form-check-input" type="checkbox" role="switch" id="pageStatus">
                </div>
            </td>
            <td>
                <a href="{{ url()->route('panel.page.edit', ['id'=>$page->id])  }}" class="btn btn-info btn-sm"><i class="bi bi-eye fw-bold text-light"></i></a>
                <a href="{{ url()->route('panel.page.edit', ['id'=>$page->id])  }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></a>
                <button onclick="showModalForDelete({
                    title:  'Sayfa Silinecek',
                    text:   '{{ $page->title }} sayfasını silmek üzeresiniz. Bu işlem bir daha geri alınamaz.',
                    emit:   {
                        name:   'deletePost',
                        params: {{ $page->id  }}
                    }
                })" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
            </td>
        </tr>
        @if($page->children->isNotEmpty())
            @include('livewire.admin.page.page-list-items', ['items'=>$page->children, 'factor'=>($factor ?? 0)+1])
        @endif
    @endforeach
@endif
