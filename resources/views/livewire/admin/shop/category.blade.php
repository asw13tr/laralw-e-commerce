<div class="row">

    <div class="col-12 col-md-9">
        <h4 class="h4 pb-3 border-bottom">Kategori Listesi</h4>
        @include('livewire.admin.shop.category-table')
    </div>


    <div class="col-12 col-md-3">
        <h4 class="h4 pb-3 border-bottom">
            @isset($currentCategory['id'])
                Düzenle: [{{ $currentCategory['title']  }}]
            @else
                Kategori Oluştur
            @endisset
        </h4>
        @include('livewire.admin.shop.category-form')
    </div>

</div>
