<div class="row">
<div class="col-12 col-md-8 col-lg-6 col-xxl-5">
<form wire:submit.prevent="save()">

    <h2 class="h4 pb-2 border-bottom ">Genel Bilgiler</h2>
    @include('livewire.admin.components.input-error', ['key'=>'shop.user_id'])

    <div class="mb-3">
        <label for="" class="form-label">Mağaza Adı</label>
        <input wire:model="shop.name" type="text" class="form-control" />
        @include('livewire.admin.components.input-error', ['key'=>'shop.name'])
    </div>

    <div class="mb-3">
        <label for="" class="form-label">İş Kategorisi</label>
        <select wire:model="shop.category_id" class="form-select">
            <option value="">Bir kategori seçin</option>
            @foreach($companyCategories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
        @include('livewire.admin.components.input-error', ['key'=>'shop.category_id'])
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Mağaza Sahibi (Ad ve Soyad)</label>
        <input wire:model="shop.owner" type="text" class="form-control" />
        @include('livewire.admin.components.input-error', ['key'=>'shop.owner'])
    </div>


    <div class="mb-3">
        <label for="" class="form-label">Mağaza Açıklaması</label>
        <textarea wire:model="shop.description" cols="30" rows="5" class="form-control"></textarea>
    </div>


    <h2 class="h4 pb-2 border-bottom ">Vergi Bilgileri</h2>

    <div class="mb-3">
        <label for="" class="form-label">Vergi Dairesi</label>
        <input wire:model="shop.tax_office" type="text" class="form-control" />
        @include('livewire.admin.components.input-error', ['key'=>'shop.tax_office'])
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Vergi Numarası</label>
        <input wire:model="shop.tax_number" type="text" class="form-control" />
        @include('livewire.admin.components.input-error', ['key'=>'shop.tax_number'])
    </div>

    <h2 class="h4 pb-2 border-bottom ">İletişim Bilgileri</h2>

    <div class="row mb-3 pb-3 border-bottom">
        <div class="col">
            <label for="" class="form-label">Telefon Numarası</label>
            <input wire:model="shop.phone" type="text" class="form-control" />
            @include('livewire.admin.components.input-error', ['key'=>'shop.phone'])
        </div>
        <div class="col">
            <label for="" class="form-label">E-Posta Adresi</label>
            <input wire:model="shop.email" type="text" class="form-control" />
            @include('livewire.admin.components.input-error', ['key'=>'shop.email'])
        </div>
    </div>



    <div class="row mb-3">
        <div class="col">
            <label for="" class="form-label">Ülke</label>
            <select wire:model="shop.country_id" class="form-control">
                <option value="">Ülke Seçin</option>
                @isset($countries)
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name_tr }}</option>
                    @endforeach
                @endisset
            </select>
            @include('livewire.admin.components.input-error', ['key'=>'shop.country_id'])
        </div>
        <div class="col">
            <label for="" class="form-label">Şehir/Eyalet</label>
            <input wire:model="shop.city" type="text" class="form-control" />
            @include('livewire.admin.components.input-error', ['key'=>'shop.city'])
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="" class="form-label">İlçe/Semt</label>
            <input wire:model="shop.district" type="text" class="form-control" />
            @include('livewire.admin.components.input-error', ['key'=>'shop.district'])
        </div>
        <div class="col">
            <label for="" class="form-label">Posta Kodu</label>
            <input wire:model="shop.postcode" type="text" class="form-control" />
            @include('livewire.admin.components.input-error', ['key'=>'shop.postcode'])
        </div>
    </div>



    <div class="mb-3">
        <label for="" class="form-label">Açık Adres</label>
        <textarea wire:model="shop.address" cols="30" rows="3" class="form-control"></textarea>
        @include('livewire.admin.components.input-error', ['key'=>'shop.address'])
    </div>

    <div class="d-flex justify-content-end pt-3 border-top">
        @isset($shop['id'])
            <button class="btn btn-success"><i class="bi bi-check-lg"></i> Güncelle</button>
        @else
            <button class="btn btn-primary"><i class="bi bi-check-lg"></i> Oluştur</button>
        @endisset
    </div>

</form>
</div>
</div>
