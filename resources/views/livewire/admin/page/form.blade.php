<form class="row" wire:submit.prevent="save()">
    <div class="col">

        <div class="mb-3">
            <label for="" class="form-label">Sayfa Başlığı</label>
            <input wire:model="page.title" type="text" class="form-control" />
            @include('livewire.admin.components.input-error', ['key'=>'page.title'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Anahtar Kelimeler</label>
            <input wire:model="page.keywords" type="text" class="form-control" />
            @include('livewire.admin.components.input-error', ['key'=>'page.keywords'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Açıklama</label>
            <textarea wire:model="page.description" rows="3" class="form-control"></textarea>
            @include('livewire.admin.components.input-error', ['key'=>'page.description'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Sayfa İçeriği</label>
            <!-- todo: buraya zengin metin editörü koy-->
            {{--                @livewire('admin.components.quill', ['value'=>$page['content']])--}}
            <textarea wire:model="page.content" class="form-control" cols="30" rows="10"></textarea>
            @include('livewire.admin.components.input-error', ['key'=>'page.content'])
        </div>

    </div>

    <div class="col-12 col-sm-4 col-md-3 col-xxl-2 ">

        <div class="mb-3">
            <label for="" class="form-label">Kapak Fotoğrafı</label>
            <input wire:model="cover" type="file" class="form-control" />
            @include('livewire.admin.components.input-error', ['key'=>'cover'])
            @isset($page['cover'])
                <img src="{{ url('uploads/'.  $page['cover']) }}" alt="" class="mt-2 img-fluid" />
            @endisset
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Üst Sayfa</label>
            <select wire:model="page.parent" class="form-select">
                <option value="0">Üst Sayfa Yok</option>
                @include('livewire.admin.page.page-dropdown-items', ['items'=>$pages, 'factor'=>0])
            </select>
            @include('livewire.admin.components.input-error', ['key'=>'page.parent'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Yazar</label>
            <select wire:model="page.author_id" class="form-select">
                <option value="0">Bir yazar seçin</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name  }}</option>
                @endforeach
            </select>
            @include('livewire.admin.components.input-error', ['key'=>'page.author_id'])
        </div>

        <div class="mb-3">
            <div class="form-check form-switch">
                <input wire:model="page.status" class="form-check-input" type="checkbox" role="switch" id="pageStatus">
                <label class="form-check-label" for="pageStatus">Sayfa Yayında</label>
            </div>
            @include('livewire.admin.components.input-error', ['key'=>'page.status'])
        </div>

        <div class="mb-3 pt-3 border-top d-flex justify-content-start">
            @isset($page['id'])
                <button class="btn btn-success"><em class="bi bi-check-square"></em> Güncelle</button>

                <a href="/" onclick="showModalForDelete({
                    title:  'Sayfa Silinecek',
                    text:   '{{ $page['title'] }} sayfasını silmek üzeresiniz. Bu işlem bir daha geri alınamaz.',
                    emit:   {
                        name:   'deletePost',
                        params: {{ $page['id']  }}
                    }
                }, event)" class="btn btn-danger ms-2"><em class="bi bi-x-square"></em> Sil</a>
            @else
                <button class="btn btn-primary"><em class="bi bi-plus-square"></em> Oluştur</button>
            @endisset

        </div>


    </div>
</form>

@section('buttonActions')
    <a href="{{ url()->route('panel.page.create')  }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Yeni Sayfa</a>
@endsection
