<h5 class="h5 pb-2 border-bottom mb-2">
    @isset($category['id'])
        <em class="bi bi-pencil-circle"></em> Düzenle: {{ $category['title'] }}
    @else
        <em class="bi bi-plus-circle"></em> Yeni Kategori Oluştur
    @endisset
</h5>

<div class="mb-3">
    <label for="" class="form-label">Kategori Adı</label>
    <input wire:model="category.title" type="text" class="form-control" />
    @include('livewire.admin.components.input-error', ['key'=>'category.title'])
    @include('livewire.admin.components.input-error', ['key'=>'category.slug'])
</div>

<div class="mb-3">
    <label for="" class="form-label">Sıra Numarası</label>
    {{ $categories->count()  }}
    <input wire:model="category.sort_no" type="number" class="form-control" />
    @include('livewire.admin.components.input-error', ['key'=>'category.sort_no'])
</div>

<div class="mb-3">
    <label for="" class="form-label">Açıklama</label>
    <textarea wire:model="category.description" rows="3" class="form-control"></textarea>
    @include('livewire.admin.components.input-error', ['key'=>'category.description'])
</div>

<div class="mb-3">
    <div class="form-check form-switch">
        <input wire:model="category.status" class="form-check-input" type="checkbox" role="switch" id="postCategory">
        <label class="form-check-label" for="postCategory">Kategoriye ait içerikler gösterilsin</label>
    </div>
    @include('livewire.admin.components.input-error', ['key'=>'category.status'])
</div>


<div class="mt-3 pt-3 border-top">
    @isset($category['id'])
        <button wire:click="save()" class="btn btn-success"><em class="bi bi-check-square"></em> Güncelle</button>
        <button wire:click="resetCategory()" class="btn btn-danger ms-2"><em class="bi bi-x-square"></em> Vazgeç</button>
    @else
        <button wire:click="save()" class="btn btn-primary"><em class="bi bi-check-square"></em> Oluştur</button>
    @endisset
</div>
