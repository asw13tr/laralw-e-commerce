<?php

namespace App\Http\Livewire\Admin\Product;

use App\Helpers\FileUploader;
use App\Helpers\MetaValues;
use App\Models\Product;
use App\Rules\ProductRules;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component{

    use WithFileUploads;

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
    public function mount(){
        MetaValues::set('Yeni Ürün Oluştur', 'bag-plus');
    }

    public function uploadCover(){
        $image = FileUploader::image($this->cover, 'products/'.$this->product['shop_id']);
        if($image->isUploaded){
            $this->product['cover']=$image->filename;
        }
    }

    // SAVE
    public function save(){
        $this->validate(ProductRules::create(), ProductRules::messages());
        $this->uploadCover();

        $createdProduct = Product::create($this->product);
        if(!$createdProduct->id){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Ürün oluşturulamadı.']);
        }else{
            $createdProduct->categories()->attach($this->selectedCategories);
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Ürün oluşturma başarılı.']);
            return redirect()->route('panel.product.edit', ['id'=>$createdProduct->id]);
        }
    } // save



    // RENDER
    public function render(){
        return view('livewire.admin.product.create', [
            'categories'    => $this->store->getCategories(),
            'shops'         => $this->store->getShops(),
        ])->layout('layouts.panel');
    }
}
