<div>
    <div class="row  mb-3 border-bottom pb-3">
        <div class="col-12 col-sm-6">
            <input type="search" class="form-control" wire:model="searchedValue" placeholder="Mağazalarda ara">
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-end align-items-center">
            <a href="{{ url()->route('panel.shop.categories')  }}" class="link-primary link-offset-2 link-underline-primary fw-bold px-2"><i class="bi bi-list"></i> Mağaza Kategorileri</a>
        </div>
    </div>


    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th width="40">#</th>
            <th>Mağaza Adı</th>
            <th>Sahip</th>
            <th>E-Posta</th>
            <th>Telefon</th>
            <th>Kategori</th>
            <th>Mağaza Kullanıcısı</th>
            <th width="120"></th>
        </tr>
        </thead>
        <tbody>

        @if($shops)
            @foreach($shops as $key => $shop)
                <tr>
                    <td>{{ $shop->id }}</td>
                    <td>{{ $shop->name  }}</td>
                    <td>{{ $shop->owner  }}</td>
                    <td><a href="mailto:{{ $shop->email }}" class="link-in-table link-secondary"><em class="bi bi-envelope-fill fs-6"></em> {{ $shop->email }}</a></td>
                    <td>{{ $shop->phone }}</td>
                    <td>{{ $shop->category->title  }}</td>
                    <td><a href="{{ url()->route('panel.user.detail', ['id' => $shop->user->id])  }}" class="link-in-table link-info"><i class="bi bi-eye"></i> {{ $shop->user->name }}</a> </td>
                    <td class="d-flex justify-content-between">
                        <a href="{{ url()->route('panel.shop.detail', ['id'=>$shop->id])  }}" class="btn btn-info btn-sm"><i class="bi bi-eye fw-bold text-light"></i></a>
                        <a href="{{ url()->route('panel.shop.edit', ['id'=>$shop->id])  }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></a>
                        <button wire:click="showModalForDelete({{ $shop }})" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $shops->links() }}
    </div>


</div>
