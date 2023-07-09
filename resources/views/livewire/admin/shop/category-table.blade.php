<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="30">#</th>
            <th>Kategori</th>
            <th>Açıklama</th>
            <th width="90"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category['id'] }}</td>
                <td>{{ $category['title'] }}</td>
                <td>{{ $category['description'] }}</td>
                <td>
                    <button wire:click="setCurrentCategory({{ $category  }})" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></button>
                    <button wire:click="showModalForDelete({{ $category  }})" data-bs-toggle="modal" data-bs-target="#userDeleteModal" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

