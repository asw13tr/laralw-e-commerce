<h5 class="h5 pb-2 border-bottom mb-2"><em class="bi bi-list"></em> Kategori Listesi</h5>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="20">#</th>
            <th>Kategori</th>
            <th width="30">Sıra</th>
            <th width="20">D.</th>
            <th width="30">Yazı</th>
            <th width="90"></th>
        </tr>
    </thead>
    <tbody>

        @if($categories)
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->sort_no }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input {{ $category->status? 'checked' : '' }} wire:change="updateCategoryStatus({{ $category }})" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        </div>
                    </td>
                    <td>{{ $category->posts->count()}}</td>
                    <td>
                        <button wire:click="setCategory({{ $category }})" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></button>
                        <button onclick="showModalForDelete({
                            title:  'Kategori Silinecek',
                            text:   '{{ $category->title }} kategorisini silmek üzeresiniz. Bu işlem bir daha geri alınamaz.',
                            emit:   {
                                name:   'deleteCategory',
                                params: {{ $category->id  }}
                            }
                        })" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

    </tbody>
</table>
