<div class="row">
    <div class="col">
        <div class="mb-3">
            <label for="" class="form-label">Ürün Adı</label>
            <input type="text" class="form-control" wire:model="product.title">
            @include('livewire.admin.components.input-error', ['key'=>'product.title'])
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 mb-3">
                <label for="" class="form-label">Seri Numarası: S/N <small class="text-info">(isteğe bağlı)</small></label>
                <input type="text" class="form-control" wire:model="product.sno">
                @include('livewire.admin.components.input-error', ['key'=>'product.sno'])
            </div>

            <div class="col-12 col-sm-6 mb-3">
                <label for="" class="form-label">Barkod <small class="text-info">(isteğe bağlı)</small></label>
                <input type="text" class="form-control" wire:model="product.barcode">
                @include('livewire.admin.components.input-error', ['key'=>'product.barcode'])
            </div>

            <div class="col-12 col-sm-6 mb-3">
                <label for="" class="form-label">*SKU (Ürüne ait benzersiz bir kod) </label>
                <input type="text" class="form-control" wire:model="product.sku">
                @include('livewire.admin.components.input-error', ['key'=>'product.sku'])
            </div>

            <div class="col-12 col-sm-6 mb-3">
                <label for="" class="form-label">Stok Adeti</label>
                <input type="text" class="form-control" wire:model="product.stock">
                @include('livewire.admin.components.input-error', ['key'=>'product.stock'])
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Ürünü tanımlayan anahtar kelimeler <small class="text-info">(isteğe bağlı)</small></label>
            <input type="text" class="form-control" wire:model="product.keywords">
            @include('livewire.admin.components.input-error', ['key'=>'product.keywords'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Özet bir açıklama <small class="text-info">(isteğe bağlı)</small></label>
            <textarea rows="3" class="form-control" wire:model="product.description"></textarea>
            @include('livewire.admin.components.input-error', ['key'=>'product.description'])
        </div>


        <div class="row">
            <div class="col mb-3">
                <div class="form-check form-switch">
                    <input wire:model="product.status" class="form-check-input" type="checkbox" role="switch" id="productStatus">
                    <label class="form-check-label" for="productStatus">Bu ürün şu an satın alınabilir.</label>
                </div>
                @include('livewire.admin.components.input-error', ['key'=>'product.status'])
            </div>
            <div class="col mb-3">
                <div class="form-chec  form-switch">
                    <input wire:model="product.is_virtual" class="form-check-input" type="checkbox" role="switch" id="productVirtual">
                    <label class="form-check-label" for="productVirtual">İndirilebilir Sanal Ürün</label>
                </div>
                @include('livewire.admin.components.input-error', ['key'=>'product.is_virtual'])
            </div>
        </div>


        <div class="mb-3">
            <label for="" class="form-label">Ürün Detayı</label>
            <textarea wire:model="product.content" rows="15" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <h5 class="h6 fw-bold">Ürün Detay Fotoğrafları</h5>
        </div>

    </div><!-- col -->

    <div class="col-12 col-sm-4 col-lg-3">

        <div class="mb-3">
            <label for="" class="form-label">Tedarikçi Mağaza</label>
            <select wire:model="product.shop_id" class="form-select">
                <option value="0">Bir mağaza seçin</option>
                @isset($shops)
                    @foreach($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                    @endforeach
                @endisset
            </select>
            @include('livewire.admin.components.input-error', ['key'=>'product.shop_id'])
        </div>


        <div class="mb-3">
            <label for="" class="form-label">Fiyat</label>
            <div class="input-group">
                <span class="input-group-text">{{ config('values.currency.symbol')  }}</span>
                <input wire:model="product.price" type="text" class="form-control" value="0,00">
            </div>
            @include('livewire.admin.components.input-error', ['key'=>'product.price'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Vergi %?</label>
            <div class="input-group">
                <span class="input-group-text">%</span>
                <input wire:model="product.tax" type="text" class="form-control" value="18">
            </div>
            @include('livewire.admin.components.input-error', ['key'=>'product.tax'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Kargo Ücreti</label>
            <div class="input-group">
                <span class="input-group-text">{{ config('values.currency.symbol')  }}</span>
                <input wire:model="product.delivery_price" type="text" class="form-control" value="0,00">
            </div>
            @include('livewire.admin.components.input-error', ['key'=>'product.delivery_price'])
        </div>

        <div class="mb-3">
            <div class="form-check  form-switch">
                <input  wire:model="product.free_delivery" class="form-check-input" type="checkbox" role="switch" id="productDeliveryStatus">
                <label class="form-check-label" for="productDeliveryStatus">Ücretsiz kargo hizmeti var.</label>
            </div>
            @include('livewire.admin.components.input-error', ['key'=>'product.free_delivery'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Ücretsiz kargo için minimum fiyat sınırı</label>
            <div class="input-group">
                <span class="input-group-text">{{ config('values.currency.symbol')  }}</span>
                <input  wire:model="product.free_delivery_price" type="text" class="form-control" value="0">
            </div>
            @include('livewire.admin.components.input-error', ['key'=>'product.free_delivery_price'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">İndirim Kampanyası</label>
            <select wire:model="product.discount_id" class="form-select">
                <option value="0">İndirim Yok</option>
                <!-- todo: discount - kampanyalar tablosu oluştur ve burada kapmanyaları çek -->
            </select>
            @include('livewire.admin.components.input-error', ['key'=>'product.discount_id'])
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Kategoriler</label>
            @include('livewire.admin.components.input-error', ['key'=>'selectedCategories'])
            <input type="text" class="form-control border-bottom-0" placeholder="Kategorilerde ara">
            <div class="border panel-form-list-items-box">
                <ul class="list-group list-group-flush">
                    @isset($categories)
                        @include('livewire.admin.product.form-category-list-items', ['items'=>$categories, 'factor'=>0])
                    @endisset
                </ul>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Kapak fotoğrafı</label>
            <input  wire:model="cover" type="file" class="form-control">
            @include('livewire.admin.components.input-error', ['key'=>'cover'])
            @if(strlen($product['cover']) > 7)
                <img src="{{ url('uploads/'.$product['cover']) }}" alt="" class="img-fluid">
            @endif
        </div>

        <div class="mb-3 d-flex justify-content-start gap-2 mt-3 border-top pt-3">
            @isset($product['id'])
                <button wire:click="save()" class="btn btn-success"><em class="bi bi-check-square"></em> Güncelle</button>
                <button onclick="showModalForDelete({
                    title:  'Ürün Silinecek',
                    text:   '{{ $product['title'] }} ürününü silmek üzeresiniz. Bu işlem bir daha geri alınamaz.',
                    emit:   {
                        name:   'deleteProduct',
                        params: {{ $product['id']  }}
                    }
                })" class="btn btn-danger"><em class="bi bi-trash"></em> Sil</button>
            @else
                <button wire:click="save()" class="btn btn-primary"><em class="bi bi-plus-square"></em> Oluştur</button>
            @endisset
            <a href="{{ route('panel.product.index') }}" class="link-dark ms-auto"><em class="bi bi-chevron-left"></em> Ürünler</a>
        </div>
    </div><!-- col-12 col-sm-4 col-lg-3 -->
</div>


@section('buttonActions')
    @isset($product['id'])
        <a href="{{ route('panel.product.create') }}" class="btn btn-sm btn-primary"><em class="bi bi-plus-square"></em> Ürün Ekle</a>
    @endisset
@endsection
