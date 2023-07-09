    <h5 class="h5 border-bottom mb-3">{{ !isset($category['id'])? 'Yeni Kategori Oluştur' : 'Düzenle: '.$category['title']  }}</h5>
    <div class="mb-3">
        <label for="" class="form-label">Kategori Adı</label>
        <input wire:model="category.title" type="text" class="form-control">
        @include('livewire.admin.components.input-error', ['key'=>'category.title'])
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Üst Kategori</label>
        <select wire:model="category.parent" class="form-select">
            <option value="0">Üst Kategori Yok</option>
            @include('livewire.admin.product.category-option-items', ['items' => $categories, 'multiplier'=>0])
        </select>
        @include('livewire.admin.components.input-error', ['key'=>'category.parent'])
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Açıklama</label>
        <textarea wire:model="category.description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Kapak Fotoğrafı</label>
        <input wire:model="cover" type="file" class="form-control">
        @include('livewire.admin.components.input-error', ['key'=>'cover'])
        @if($category['cover'])
            <img src="{{ url('uploads/'.$category['cover'])  }}" class="img-fluid mt-2 border" style="max-width: 300px; max-height: 150px;">
        @endif
    </div>

    <div class="mb-3">
        <div class="form-check form-switch">
            <input wire:model="category.status" class="form-check-input" type="checkbox" role="switch" id="cbCategoryStatus">
            <label class="form-check-label" for="cbCategoryStatus">Bu Kategori seçilebilir</label>
        </div>
    </div>

    <div class="mb-3 d-flex justify-content-end">
        @isset($category['id'])
            <button wire:click="resetCategory()"  class="btn btn-danger me-2"><em class="bi bi-x-square"></em> Vazgeç</button>
            <button wire:click="save()" class="btn btn-success"><em class="bi bi-check-square"></em> Güncelle</button>
        @else
            <button wire:click="save()"  class="btn btn-primary"><em class="bi bi-plus-square"></em> Oluştur</button>
        @endisset


    </div>

