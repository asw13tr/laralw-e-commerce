<?php

namespace App\Http\Livewire\Admin\Shop;

use App\Helpers\MetaValues;
use App\Models\CompanyCategory;
use App\Models\Country;
use App\Models\Shop;
use App\Models\User;
use App\Rules\ShopRules;
use Livewire\Component;

class Edit extends Component{

    public array $shop = [
        'user_id' => null,
        'name' => '',
        'description' => '',
        'owner' => '',
        'tax_office' => '',
        'tax_number' => '',
        'email' => '',
        'phone' => '',
        'country_id' => null,
        'city' => '',
        'district' => '',
        'postcode' => null,
        'address' => '',
        'category_id' => null,
    ];

    public function mount(Shop $id){
        $this->shop = $id->toArray();
        $this->shop['id'] = $id->id;
        MetaValues::set('"'.$id->name.'" mağaza bilgilerini güncelle', 'building-add');
    } // mount

    // GET COMPANY CATEGORIES FROM DATABASE
    private function getCompanyCategories(){
        return CompanyCategory::query()->orderBy('id', 'desc')->get();
    }

    private function getCountries(){
        return Country::select(['id', 'name', 'name_tr'])->get();
    }

    // SAVE A SHOP
    public function save(){
        $validatedData = $this->validate(ShopRules::update($this->shop), ShopRules::messages());
        $shop = Shop::find($this->shop['id'])->first();
        $update = $shop->update($validatedData['shop']);
        if(!$update){
            $this->emit('showToast', ['type'=>'danger', 'message'=>'Mağaza güncellenirken bir sorun oluştu.', 'status'=>false]);
        }else{
            $this->emit('showToast', ['type'=>'success', 'message'=>'Mağaza güncelleme başarılı.', 'status'=>true]);
        }
    }

    // RENDER
    public function render(){
        $datas = [
            'companyCategories' => $this->getCompanyCategories(),
            'countries' => $this->getCountries(),
        ];
        return view('livewire.admin.shop.create', $datas)->layout('layouts.panel');
    }
}
