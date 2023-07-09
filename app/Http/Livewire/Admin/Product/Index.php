<?php

namespace App\Http\Livewire\Admin\Product;

use App\Helpers\MetaValues;
use App\Models\Product;
use Livewire\Component;

class Index extends Component{

    public string $searchedValue = '';
    private int $limitPerPage = 25;

    // INIT
    public function mount(){
        MetaValues::set('Ürün Listesi', 'basket');
    }

    // GET PRODUCTS FROM MODEL
    public function getProducts(){
        return Product::query()->paginate($this->limitPerPage);
    }

    // RENDER
    public function render(){
        $datas = [
            'products' => $this->getProducts()
        ];
        return view('livewire.admin.product.index', $datas)->layout('layouts.panel');
    }
}
