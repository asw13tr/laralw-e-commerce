<div class="row">
    <div class="col">

        <div class="mb-3">
            <label for="" class="form-label">Başlık</label>
            <input wire:model="post.title" type="text" class="form-control"/>
            @include('livewire.admin.components.input-error', ['key'=>'post.title'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Özet</label>
            <textarea wire:model="post.description" rows="3" class="form-control"></textarea>
            @include('livewire.admin.components.input-error', ['key'=>'post.description'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Anahtar Kelimeler</label>
            <input wire:model="post.keywords" type="text" class="form-control"/>
            @include('livewire.admin.components.input-error', ['key'=>'post.keywords'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">İçerik</label>
            @include('livewire.admin.components.input-error', ['key'=>'post.content'])
            <textarea wire:model="post.content" rows="10" class="form-control"></textarea>
        </div>

    </div>

    <div class="col-12 col-sm-4 col-lg-3 col-xxl-2">
        <div class="mb-3">
            <label for="" class="form-label">Kapak Fotoğrafı</label>
            <input wire:model="cover" type="file" class="form-control"/>
            @include('livewire.admin.components.input-error', ['key'=>'cover'])
            @if($post['cover'])
                <img src="{{ url('uploads/' . $post['cover']) }}" alt="" class="img-fluid" class="object-fit-cover" />
            @endif
        </div>

        <div class="mb-3 form-group">
            <label for="" class="form-label">Yazar</label>
            <select wire:model="post.author_id" class="form-select">
                <option value="">Bir yazar seçin</option>
                @if($authors)
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                @endif
            </select>
            @include('livewire.admin.components.input-error', ['key'=>'post.author_id'])
        </div>


        <div class="mb-3">
            <label for="" class="form-label">Kategoriler</label>
            @include('livewire.admin.components.input-error', ['key'=>'selectedCategories'])
            <input type="text" class="form-control border-bottom-0" placeholder="Kategorilerde ara">
            <div class="border" id="category-list">
                <ul class="list-group list-group-flush">
                    @if($categories)
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <input wire:model="selectedCategories" class="form-check-input me-1" type="checkbox" value="{{$category->id}}" id="category__{{$category->id}}">
                                <label class="form-check-label stretched-link" for="category__{{$category->id}}">{{ $category->title }}</label>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

        <div class="mb-3 border-top pt-3 border-bottom pb-3">
            <div class="form-check form-switch">
                <input wire:model="post.status" class="form-check-input" type="checkbox" role="switch" id="postStatus">
                <label class="form-check-label" for="postStatus">Makale Yayında</label>
            </div>
            @include('livewire.admin.components.input-error', ['key'=>'post.status'])
        </div>

        <div class="d-flex justify-content-start gap-2">
            @isset($post['id'])
                <button wire:click="save()" class="btn btn-success"><em class="bi bi-check-square"></em> Güncelle</button>
                <button onclick="showModalForDelete({
                    title:  'Makale Silinecek',
                    text:   '{{ $post['title'] }} makalesini silmek üzeresiniz. Bu işlem bir daha geri alınamaz.',
                    emit: {
                        name: 'deletePost',
                        params: {{ $post['id'] }}
                    }
                })" class="btn btn-danger"><em class="bi bi-trash"></em></button>
            @else
                <button wire:click="save()" class="btn btn-primary"><em class="bi bi-plus-square"></em> Oluştur</button>
            @endisset
                <button wire:click="goBack()" class="link-dark ms-auto"><em class="bi bi-chevron-left"></em> Geri</button>
        </div>


    </div>
</div>

@section('head')
    <style>
        #category-list{
            max-height: 370px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        #category-list li label{
            cursor: pointer;
        }
        #category-list li:hover{
            background: rgba(0,0,0,0.05);
        }
    </style>
@endsection

@section('buttonActions')
    <a href="{{ route('panel.post.create')  }}" class="btn btn-primary me-2 btn-sm"><em class="bi bi-plus-square"></em> Makale Yaz</a>
    <a href="{{ route('panel.post.categories')  }}" class="btn btn-dark btn-sm"><em class="bi bi-list"></em> Kategoriler</a>
@endsection
