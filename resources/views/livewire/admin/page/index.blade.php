<div>
    <table class="table table-md table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th width="70">#</th>
            <th><input type="search" class="form-control form-control-sm" wire:model="searchedValue" placeholder="Sayfa adınfa arayabilirsiniz."></th>
            <th>Anahtar Kelimeler</th>
            <th>Yazar</th>
            <th width="174">Tarihler</th>
            <th width="1"></th>
            <th width="116"></th>
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

@section('buttonActions')
    <a href="{{ url()->route('panel.page.create')  }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Yeni Sayfa</a>
@endsection
