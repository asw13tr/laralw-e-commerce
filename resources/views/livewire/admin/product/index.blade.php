<div>
    <div class="row  mb-3 border-bottom pb-3">
        <div class="col-12 col-sm-6">
            <input type="search" class="form-control" wire:model="searchedValue" placeholder="Ürünlerde ara">
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('panel.product.categories')  }}" class="link-primary fw-bold px-2"><i class="bi bi-list"></i> Ürün Kategorileri</a>
        </div>
    </div>


    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th width="40">#</th>
            <th>Ürün</th>
            <th>Fiyat</th>
            <th>Stok</th>
            <th>Mağaza</th>
            <th>Kategoriler</th>
            <th>Durum</th>
            <th>Tarihler</th>
            <th width="120"></th>
        </tr>
        </thead>
        <tbody>

        @if($products)
            @foreach($products as $key => $shop)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->id  }}</td>
                    <td>{{ $product->id  }}</td>
                    <td>{{ $product->id  }}</td>
                    <td>{{ $product->id  }}</td>
                    <td>{{ $product->id  }}</td>
                    <td>{{ $product->id  }}</td>
                    <td>{{ $product->id  }}</td>
                    <td>{{ $product->id  }}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $products->links() }}
    </div>


</div>
