<div>
    <div class="row  mb-3 border-bottom pb-3">
        <div class="col-12 col-sm-6">
            <input type="search" class="form-control form-control-sm" wire:model="searchedValue" placeholder="Sayfalarda ara">
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-end align-items-end">
            <a href="{{ url()->route('panel.page.create')  }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Yeni Sayfa</a>
        </div>
    </div>


    <table class="table table-sm table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th width="40">#</th>
            <th>Sayfa Adı</th>
            <th>Yazar</th>
            <th>Anahtar Kelimeler</th>
            <th>Oluşturulma</th>
            <th>Düzenlenme</th>
            <th width="10"></th>
            <th width="120"></th>
        </tr>
        </thead>
        <tbody>
        @include('livewire.admin.page.page-list-items', ['items'=>$pages, 'factor'=>0])
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $pages->links() }}
    </div>


</div>
