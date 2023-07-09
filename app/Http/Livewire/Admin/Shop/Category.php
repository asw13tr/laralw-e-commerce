<?php

namespace App\Http\Livewire\Admin\Shop;

use App\Helpers\FlashMessage;
use App\Helpers\MetaValues;
use App\Models\CompanyCategory;
use App\Rules\CompanyCategoryRules;
use Illuminate\Support\Str;
use Livewire\Component;

class Category extends Component{

    protected $listeners = [
        'deleteCompanyCategory' => 'deleteCompanyCategory'
    ];

    public array $currentCategory = [
        'title' => '',
        'slug' => '',
        'description' => ''
    ];

    // INIT
    public function mount(){
        MetaValues::set('Mağaza Kategorileri', 'buildings');
    }

    public function setCurrentCategory($category=null){
        if(!$category){
            $this->currentCategory = ['title' => '',  'slug' => '',  'description' => ''];
        }else{
            $this->currentCategory = $category;
        }
    }
    // SAVE
    public function saveCategory(){
        $this->currentCategory['slug'] = Str::slug($this->currentCategory['title'], '-', config('app.lang'));
        if(!isset($this->currentCategory['id'])){
            $this->createCategory();
        }else{
            $this->updateCategory();
        }
        $this->setCurrentCategory(false);
    }

    // CREATE
    public function createCategory(){
        $this->validate(CompanyCategoryRules::create(), CompanyCategoryRules::messages());
        $newCategory  = CompanyCategory::create($this->currentCategory);
        if($newCategory->id){
            $this->emit('showToast', ['message'=>'Yeni mağaza kategorisi oluşturuldu']);
        }else{
            $this->emit('showToast', ['message'=>'Mağaza kategorisi oluşturulurken bir sorun meydana geldi', 'type'=>'danger']);
        }
    }

    // UPDATE
    public function updateCategory(){
        $this->validate(CompanyCategoryRules::update($this->currentCategory['id']), CompanyCategoryRules::messages());
        $update = CompanyCategory::find($this->currentCategory['id'])->update($this->currentCategory);
        if($update){
            $this->emit('showToast', ['message'=>'Mağaza kategorisi güncellendi']);
        }else{
            $this->emit('showToast', ['message'=>'Mağaza kategorisi güncelleştirilirken bir sorun meydana geldi', 'type'=>'danger']);
        }
    }

    // SHOW MODAL POPUP FOR DELETE
    public function showModalForDelete(CompanyCategory $category){
        $this->emit('showModalForDelete', [
            'title' => 'Mağaza Kategorisi Silinecek!',
            'text'  => $category->title.' kategorisini silmek üzeresiniz bu işlem bir daha geri alınamaz.',
            'emit' => [
                'name' => 'deleteCompanyCategory',
                'params' => $category->id
            ]
        ]);
    }

    // DELETE
    public function deleteCompanyCategory(CompanyCategory $category){
        $delete = $category->delete();
        if(!$delete){
            $this->emit('showToast', ['type'=>'danger', 'message'=>'Kategori silme işlemi sırasında bir sorun oluştu', 'status'=>false]);
        }else{
            $this->emit('showToast', ['message'=>$category->title.' Mağaza kategorisi silindi..', 'status'=>true]);
        }
    }


    private function getCategories(){
        return CompanyCategory::query()->orderBy('id', 'DESC')->get();
    }


    // RENDER
    public function render(){
        return view('livewire.admin.shop.category', ['categories' => $this->getCategories()])->layout('layouts.panel');
    }
}
