<div>
    <table class="table table-md table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th width="70">#</th>
            <th><input type="search" class="form-control form-control-sm" wire:model="searchedValue" placeholder="Makale başlıklarında arayabilirsiniz."></th>
            <th>Kategoriler</th>
            <th>Yazar</th>
            <th width="174">Tarihler</th>
            <th width="1"></th>
            <th width="116"></th>
        </tr>
        </thead>
        <tbody>

        @if($posts)
            @foreach($posts as $key => $post)
                <tr>
                    <td class="p-0">
                        @if($post->cover)
                            <img src="{{ url('uploads/'.$post->cover)  }}" loading="lazy" style="height: 70px; width:  70px;" class="object-fit-cover"  alt=""/>
                        @endif
                    </td>
                    <td class="fw-bold">
                        <a href="{{ route('panel.post.edit', ['id'=>$post->id])  }}" class="link-dark">{{ $post->title  }}</a>
                    </td>
                    <td>{{ $post->keywords  }}</td>
                    <td>{{ $post->author->name ?? '-'  }}</td>
                    <td>
                        <span class="text-primary fw-bold"><em class="bi bi-calendar-plus"></em> {{ $post->created_at->format('d F Y H:i') }}</span>
                        <div class="pb-1 border-bottom mb-1"></div>
                        <span class="text-success fw-bold"><em class="bi bi-calendar-range"></em> {{ $post->updated_at->format('d F Y H:i') }}</span>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input {{ $post->status? 'checked' : ''  }} wire:click="updateStatus({{ $post->id }})" class="form-check-input" type="checkbox" role="switch" id="postStatus">
                        </div>
                    </td>
                    <td>
                        <!-- todo: makale sayfasına git -->
                        <a href="/" class="btn btn-info btn-sm"><i class="bi bi-eye fw-bold text-light"></i></a>
                        <a href="{{ url()->route('panel.post.edit', ['id'=>$post->id])  }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></a>
                        <button onclick="showModalForDelete({
                    title:  'Makale Silinecek',
                    text:   '{{ $post->title }} makalesini silmek üzeresiniz. Bu işlem bir daha geri alınamaz.',
                    emit:   {
                        name:   'deletePost',
                        params: {{ $post->id  }}
                    }
                })" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif


        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>


</div>

@section('buttonActions')
    <a href="{{ route('panel.post.create')  }}" class="btn btn-primary me-2 btn-sm"><em class="bi bi-plus-square"></em> Makale Yaz</a>
    <a href="{{ route('panel.post.categories')  }}" class="btn btn-dark btn-sm"><em class="bi bi-list"></em> Kategoriler</a>
@endsection
