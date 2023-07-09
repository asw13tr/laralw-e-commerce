<?php

namespace App\Http\Livewire\Admin\Shop;

use App\Helpers\MetaValues;
use App\Models\CompanyCategory;
use App\Models\Country;
use App\Models\Shop;
use App\Models\User;
use App\Rules\ShopRules;
use Livewire\Component;

class Create extends Component{


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

    public function mount(User $user){
        if($user->level!=='seller'){
            return redirect()->route('panel.user.index');
        }
        $this->shop['user_id'] = $user->id;
        MetaValues::set('"'.$user->name.'" kullanıcısı için bir Mağaza Oluştur', 'building-add');
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
        $validatedData = $this->validate(ShopRules::create(), ShopRules::messages());
        $newShop = Shop::create($validatedData['shop']);
        if(!$newShop->id){
            $this->emit('showToast', ['type'=>'danger', 'message'=>'Mağaza oluşturulurken bir sorun oluştu.', 'status'=>false]);
        }else{
            $this->emit('showToast', ['type'=>'success', 'message'=>'Mağaza oluşturuldu.', 'status'=>true]);
            return redirect()->route('panel.shop.edit', ['id' => $newShop->id]);
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
