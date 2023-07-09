    <div class="mb-3">
        <label for="" class="form-label">Kategori Adı</label>
        <input wire:model="currentCategory.title" wire:keydown.enter="saveCategory();" type="text" class="form-control">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Açıklama</label>
        <textarea wire:model="currentCategory.description" name="" id="" cols="30" rows="4" class="form-control"></textarea>
    </div>

    <div class="d-flex py-2 border-top justify-content-end">
        @isset($currentCategory['id'])
            <button wire:click="setCurrentCategory(false);" class="btn btn-danger me-2"><i class="bi bi-check2-square"></i> Vazgeç</button>
            <button wire:click="saveCategory();" class="btn btn-success"><i class="bi bi-check2-square"></i> Güncelle</button>
        @else
            <button wire:click="saveCategory();" class="btn btn-primary"><i class="bi bi-plus-square"></i> Oluştur</button>
        @endisset
    </div>
