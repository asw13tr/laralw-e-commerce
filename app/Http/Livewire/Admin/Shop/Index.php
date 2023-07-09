<?php

namespace App\Http\Livewire\Admin\Shop;

use App\Helpers\MetaValues;
use App\Models\User;
use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    private int $limitPerPage = 25;

    public string|null $searchedValue = null;
    public Shop|null $shopObject = null;


    // LISTEN ON EMITS
    protected $listeners = [ 'deleteShop' => 'deleteShop' ];





    // GET USERS FROM ORM
    private function getShops(){
        return Shop::with(['user', 'category'])
            ->orderBy('id', 'desc')
            ->paginate($this->limitPerPage);
    }


    // GET SEARCHED USERS FROM DB
    private function getSearchedShops(){
        return Shop::query()->orderBy('id', 'desc')
            ->Where('name', 'LIKE', "%{$this->searchedValue}%")
            ->orWhere('owner', 'LIKE', "%{$this->searchedValue}%")
            ->orWhere('phone', 'LIKE', "%{$this->searchedValue}%")
            ->orWhere('email', 'LIKE', "%{$this->searchedValue}%")
            ->paginate($this->limitPerPage);
    }

    // DELETE SHOP TTOAST
    public function showModalForDelete(Shop $shop){
        $this->emit('showModalForDelete', [
            'title' => 'Mağaza silinecek.',
            'text'  => $shop->name.' mağazasını silmek üzeresiniz bu işlem bir daha geri alınamaz emin misiniz.',
            'emit' => [
                'name' => 'deleteShop',
                'params' => $shop->id
            ]
        ]);
    }

    // DELETE SHOP FORM DATABASE
    public function deleteShop(Shop $shop): void{
        $deletedItem = $shop->delete();
        if(!$deletedItem){
            $this->emit('showToast', ['type'=>'danger', 'message'=>'Mağaza silme işlemi sırasında bir sorun oluştu', 'status'=>false]);
        }else{
            $this->emit('showToast', ['message'=>$shop->name.' mağazası silindi.', 'status'=>true]);
        }
    }


    // LOADED
    public function mount(){
        MetaValues::set('Mağazalar', 'shop');
    }


    // RENDER
    public function render(){
        $datas = [
            'shops' => (strlen($this->searchedValue)>2?  $this->getSearchedShops() :  $this->getShops()),
        ];
        return view('livewire.admin.shop.index', $datas)->layout('layouts.panel');
    }

}
