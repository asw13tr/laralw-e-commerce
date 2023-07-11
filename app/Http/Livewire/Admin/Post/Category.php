<?php

namespace App\Http\Livewire\Admin\Post;

use App\Helpers\MetaValues;
use App\Models\Post;
use App\Models\PostCategory;
use App\Rules\PostCategoryRules;
use Illuminate\Support\Str;
use Livewire\Component;

class Category extends Component{

    protected $listeners = [
        'deleteCategory'=>'deleteCategory',
        'updateCategoryStatus'=>'updateCategoryStatus',
    ];
    public array $category = [];

    // INIT
    public function mount(){
        $this->resetCategory();
        MetaValues::set('Yazı Kategorileri', 'text-left');
    }

    // RESET
    public function resetCategory(){
        $this->category = [
            'title' => '',
            'slug'  => '',
            'sort_no' => $this->getCategories()->count() + 1,
            'description' => '',
            'status' => true,
        ];
    }

    // SAVE
    public function save(){
        $this->category['slug'] = Str::slug($this->category['title'], '-', config('app.lang'));
        if(!isset($this->category['id'])){
            $this->create();
        }else{
            $this->update();
        }
        $this->resetCategory();
    }

    // CREATE
    public function create(){
        $this->validate(PostCategoryRules::create(), PostCategoryRules::messages());
        $createdCategory = PostCategory::create($this->category);
        if(!$createdCategory->id){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Kategori oluşturma başarısız']);
        }else{
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Kategori oluşturuldu']);
        }
    }

    // UPDATE
    public function update(){
        $this->validate(PostCategoryRules::update($this->category), PostCategoryRules::messages());
        $updatedCategory = PostCategory::find($this->category['id'])->update($this->category);
        if(!$updatedCategory){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Kategori güncelleme başarısız']);
        }else{
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Kategori güncellendi']);
        }
    }

    // DELETE CATEGORY
    public function deleteCategory(PostCategory $category){
        $deletedCategory = $category->delete();
        if(!$deletedCategory){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Kategori silme işlemi başarısız']);
        }else{
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Kategori silindi']);
        }
    }

    // UPDATE STATUS OF CATEGORY
    public function updateCategoryStatus(PostCategory $category){
        $category->status = !$category->status;
        $category->save();
    }

    // SET CATEGORY
    public function setCategory(PostCategory $category){
        $this->category = $category->toArray();
    }

    // GET ITEMS
    public function getCategories(){
        return PostCategory::orderBy('sort_no', 'asc')->get();
    }

    // RENDER
    public function render(){
        return view('livewire.admin.post.category', [
            'categories' => $this->getCategories()
        ])
            ->layout('layouts.panel');
    }
}
