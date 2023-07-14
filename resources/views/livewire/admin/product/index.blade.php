<div>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th width="65">#</th>
            <th>Ürün</th>
            <th>Fiyat</th>
            <th>Stok</th>
            <th width="200">Mağaza</th>
            <th>Kategoriler</th>
            <th width="10"></th>
            <th width="170">Tarihler</th>
            <th width="122"></th>
        </tr>
        </thead>
        <tbody>

        @if($products)
            @foreach($products as $key => $product)
                <tr>
                    <td class="p-0">
                        @if(strlen($product->cover) > 7)
                            <img src="{{ url('uploads/'.$product->cover)  }}" alt="" width="65" height="65"  style="width: 65px; height: 65px;" class="object-fit-cover" >
                        @endif
                    </td>
                    <td><a href="{{ route('panel.product.edit', ['id'=>$product->id])  }}"  class="fw-bold">{{ $product->title  }}</a></td>
                    <td>{{ config('values.currency.symbol') }} @price($product->price)</td>
                    <td>{{ $product->stock  }}</td>
                    <td>
                        <a href="{{ route('panel.shop.detail', ['id'=>$product->shop->id]) }}" class="btn btn-sm btn-warning fw-bold"><em class="bi bi-shop"></em> {{ $product->shop->name }}</a>
                    </td>
                    <td>
                        @isset($product->categories)
                            @foreach(array_slice($product->categories->toArray(),0,3) as $c)
                                <a href="" class="btn btn-dark btn-sm me-1">{{ $c['title'] }}</a>
                            @endforeach
                        @endisset

                        @if($product->categories->count()-3 > 0)
                            <button class="btn btn-dark btn-sm"><em class="bi bi-plus-lg"></em> {{ $product->categories->count()-3 }}</button>
                            @endif

                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input {{ $product->status? 'checked' : ''  }} class="form-check-input" type="checkbox" role="switch" id="product-status-{{ $product->id }}">
                        </div>
                    </td>
                    <td>
                        <span class="text-primary fs-6 fw-bold"><em class="bi bi-plus-circle"></em> {{ $product->created_at->format('d.m.Y H:i')  }}</span><br>
                        <span class="text-success fs-6 fw-bold"><em class="bi bi-check-circle"></em> {{ $product->updated_at->format('d.m.Y H:i')  }}</span>
                    </td>
                    <td>
                        <a href="/" class="btn btn-info btn-sm"><i class="bi bi-eye fw-bold text-light"></i></a>
                        <a href="{{ route('panel.product.edit', ['id'=>$product->id])  }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></a>
                        <button onclick="showModalForDelete({
                    title:  'Ürün Silinecek',
                    text:   '{{ $product->title }} ürününü silmek üzeresiniz. Bu işlem bir daha geri alınamaz.',
                    emit:   {
                        name:   'deleteProduct',
                        params: {{ $product->id  }}
                    }
                })" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $products->links() }}
    </div>


</div>


@section('buttonActions')
    <a href="{{ route('panel.product.create')  }}" class="btn btn-primary btn-sm mx-2"><i class="bi bi-plus-square"></i> Ürün Ekle</a>
    <a href="{{ route('panel.product.categories')  }}" class="btn btn-sm fw-bold px-2"><i class="bi bi-list"></i> Ürün Kategorileri</a>
@endsection
