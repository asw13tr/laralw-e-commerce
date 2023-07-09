<?php

namespace App\Http\Livewire\Admin\Shop;

use App\Helpers\MetaValues;
use App\Models\Shop;
use Livewire\Component;

class Detail extends Component{

    private Shop $shop;
    protected $listeners = [
        'deleteShop' => 'deleteShop'
    ];

    public function mount($id){
        $this->shop = Shop::with(['user', 'category', 'country'])->find($id);
        MetaValues::set($this->shop->name.' mağazası bilgileri', 'shop');
    }

    // DELETE SHOP
    public function deleteShop(Shop $shop){
        $deleted = $shop->delete();
        if(!$deleted){
            $this->emit('shotToast', ['type'=>'error', 'status'=>false, 'message'=>'Mağaza silme işlemi başarısız oldu.']);
        }else{
            $this->emit('shotToast', ['type'=>'success', 'status'=>true, 'message'=>'Mağaza silindi.']);
            return redirect()->route('panel.shop.index');
        }
    }

    // GET SHOP DETAIL FROM PUBLIC $shop VARIABLE
    public function getShop(){
        return $this->shop;
    }

    public function render(){
        $datas = [
            'shop' => $this->shop
        ];
        return view('livewire.admin.shop.detail', $datas)->layout('layouts.panel');
    }
}
