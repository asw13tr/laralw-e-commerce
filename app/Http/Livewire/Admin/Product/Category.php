<?php

namespace App\Http\Livewire\Admin\Product;

use App\Helpers\MetaValues;
use App\Models\ProductCategory;
use App\Rules\ProductCategoryRules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Category extends Component{

    use WithFileUploads;
    use WithPagination;

    public $cover = null;
    public array $category = [
        'title' => '',
        'slug' => '',
        'description' => '',
        'cover' => null,
        'status' => true,
        'parent' => 0,
    ];

    protected $listeners = [ 'deleteCategory' => 'delete' ];
    private $limitPerPage = 25;

    public function resetCategory(){
        $this->category = [
            'title' => '',
            'slug' => '',
            'description' => '',
            'cover' => null,
            'status' => true,
            'parent' => 0,
        ];
    } // resetCategory

    public function setCategory(ProductCategory|null $category=null){
        if(!$category){
            $this->resetCategory();
        }else{
            $this->category = $category->toArray();
        }
    } // setCategory

    public function uploadCover(): string|null{
        $filename = $this->category['cover'];
        if($this->cover){
            $uploadedImgPath = $this->cover->storePublicly('product_category', 'uploads');
            $this->deleteCover($filename);
            $filename = $uploadedImgPath;
        }
        return $filename;
    } // uploadCover

    public function deleteCover($filename=null){
        if(!is_null($filename) && @strlen($filename)>5){
            File::delete(public_path('uploads/'.$filename));
        }
    } // deleteCover


    public function save(){
        $this->category['slug'] = Str::slug($this->category['title'], '-', config('app.lang'));
        if(isset($this->category['id'])){
            $this->update();
        }else{
            $this->create();
        }
        $this->resetCategory();
    }// save

    private function create(){
        $this->validate(ProductCategoryRules::create(), ProductCategoryRules::messages());
        $this->category['cover'] = $this->uploadCover();
        $created = ProductCategory::create($this->category);
        if(!$created->id){
            $this->emit('showToast', ['type'=>'danger', 'status'=>false, 'message'=>'Kategori oluşturulamadı.']);
        }else{
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Kategori oluşturma başarılı.']);
        }
    } // create

    private function update(){
        $this->validate(ProductCategoryRules::update(), ProductCategoryRules::messages());
        $this->category['cover'] = $this->uploadCover();
        $updated = ProductCategory::find($this->category['id'])->update($this->category);
        if(!$updated){
            $this->emit('showToast', ['type'=>'danger', 'status'=>false, 'message'=>'Kategori güncelleme başarısız.']);
        }else{
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Kategori güncellendi.']);
        }
    } // update

    public function delete(ProductCategory $category){
        $coverFilanem = $category->cover;
        $deleted = $category->delete();
        if(!$deleted){
            $this->emit('showToast', ['type'=>'danger', 'status'=>false, 'message'=>'Kategori silme başarısız.']);
        }else{
            // todo: product_category tablosunda bu categoriye ait olanları sil.
            $this->deleteCover($coverFilanem);
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Kategori başarıyla silindi.']);
        }
    } // delete


    private function getCategories(){
        return ProductCategory::where('parent', 0)->orderBy('id', 'desc')->get();
    } // getCategories

    public function mount(){
        MetaValues::set('Ürün Kategorileri', 'list');
    }

    public function render(){
        return view('livewire.admin.product.category', [
          'categories' => $this->getCategories(),
        ])->layout('layouts.panel');
    }
}
