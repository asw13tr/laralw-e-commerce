<?php

namespace App\Http\Livewire\Admin\Product;

use App\Helpers\FileUploader;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shop;
use Livewire\Component;

class Store extends Component{

    public array $selectedCategories = [];
    public array $product = [
        'title'         => '',
        'sno'           => null,
        'barcode'       => null,
        'sku'           => '',
        'stock'         => 1,
        'keywords'      => null,
        'description'   => null,
        'status'        => true,
        'is_virtual'    => false,
        'content'       => '',
        'shop_id'       => null,
        'price'         => 1.50,
        'tax'           => 18,
        'delivery_price' => 0.00,
        'free_delivery' => false,
        'free_delivery_price' => 0.00,
        'discount_id'    => 0,
        'cover'         => null
    ];

    public function deleteProduct(Product $product){
        $deleted = $product->delete();
        if(!$deleted){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Ürün silinirken bir hata oluştu.']);
        }else{
            $product->categories()->detach();
            FileUploader::delete($product->cover);
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Ürün başarılı.']);
        }
        return $deleted;
    }

    public function getCategories(){
        return ProductCategory::with('children')
            ->where('parent', 0)
            ->get();
    } // getCategories

    public function getShops(){
        return Shop::with('user')
            ->where('status', true)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function render(){
        return <<<'blade'

        blade;
    }
}
