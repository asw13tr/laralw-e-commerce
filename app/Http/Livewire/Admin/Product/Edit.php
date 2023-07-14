<?php

namespace App\Http\Livewire\Admin\Product;

use App\Helpers\FileUploader;
use App\Helpers\MetaValues;
use App\Models\Product;
use App\Rules\ProductRules;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component{

    use WithFileUploads;

    protected $listeners = ['deleteProduct' => 'deleteProduct'];

    public array $selectedCategories;
    public array $product;
    public $cover = null;

    private Store|null $store;

    // BOOT
    public function boot(){
        $this->store = new Store();
        $this->selectedCategories = $this->store->selectedCategories;
        $this->product = $this->store->product;
    }

    // INIT
    public function mount(Product $id){
        $this->product = $id->toArray();
        $this->selectedCategories = array_map(function ($category){
            return $category['id'];
        }, $id->categories->toArray());
        MetaValues::set('Ürün Düzenle: '.$this->product['title'], 'bag-plus');
    }

    public function uploadCover(){
        $image = FileUploader::image($this->cover, 'products/'.$this->product['shop_id']);
        if($image->isUploaded){
            FileUploader::delete($this->product['cover']);
            $this->product['cover']=$image->filename;
        }
    }

    // SAVE
    public function save(){
        $this->validate(ProductRules::update(), ProductRules::messages());
        $this->uploadCover();
        $product = Product::find($this->product['id']);
        $updated = $product->update($this->product);

        if(!$updated){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Ürün güncelleştirilirken bir hata oluştu.']);
        }else{
            $product->categories()->sync($this->selectedCategories);
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Ürün güncelleme başarılı.']);
        }
    } // save



    // DELETE
    public function deleteProduct(Product $product){
        $deleted = $this->store->deleteProduct($product);
        if($deleted){
            return redirect()->route('panel.product.index');
        }
    }



    // RENDER
    public function render(){
        return view('livewire.admin.product.edit', [
            'categories'    => $this->store->getCategories(),
            'shops'         => $this->store->getShops(),
        ])->layout('layouts.panel');
    }

}
