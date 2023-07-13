<?php

namespace App\Http\Livewire\Admin\Post;

use App\Helpers\FileUploader;
use App\Helpers\MetaValues;
use App\Models\Post;
use App\Rules\PostRules;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component{
    use WithFileUploads;

    protected $listeners = [
        'deletePost' => 'deletePost'
    ];

    public $cover = null;
    public array|null $selectedCategories = [];
    public array $post = [];
    private $store = null;

    public function boot(){
        $this->store = new Store();
        $this->post = $this->store->post;
    }

    public function mount(Post $id){
        $this->post = $id->toArray();
        $this->selectedCategories = array_map(function($category){
            return $category['id'];
        }, $id->categories->toArray());
        MetaValues::set('Düzenle: ' . $this->post['title'], 'input-cursor-text');
    }

    public function goBack(){
        return redirect()->route('panel.post.index');
    }

    public function uploadCover(){
        $result = FileUploader::image($this->cover, 'posts');
        if($result->isUploaded){
            FileUploader::delete($this->post['cover']);
            $this->post['cover'] = $result->filename;
        }
    } // uploadCover

    public function save(){
        $this->post['slug'] =  Str::slug($this->post['title'], '-', config('app.lang'));
        $this->validate(PostRules::update($this->post), PostRules::messages());
        $this->uploadCover();
        $post = Post::find($this->post['id']);
        $updatedPost = $post->update($this->post);
        if(!$updatedPost){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Makale güncelleştirilirken bir sorun oluştu.']);
        }else{
            $post->categories()->sync($this->selectedCategories);
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Makale günellendi.']);
        }
    }




    public function deletePost(Post $post){
        $PostIndexObject = new Index();
        $deleted = $PostIndexObject->deletePost($post);
        if($deleted){
            return redirect()->route('panel.post.index');
        }
    }

    public function render(){
        return view('livewire.admin.post.edit', [
            'authors'       => $this->store->getAuthors(),
            'categories'    => $this->store->getCategories()
        ])->layout('layouts.panel');
    }
}
