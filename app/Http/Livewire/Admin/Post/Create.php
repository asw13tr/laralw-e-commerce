<?php

namespace App\Http\Livewire\Admin\Post;

use App\Helpers\FileUploader;
use App\Helpers\MetaValues;
use App\Models\Post;
use App\Rules\PostRules;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component{
    use WithFileUploads;


    public $cover = null;
    public array|null $selectedCategories = [];
    public array $post = [];
    private $store = null;

    public function boot(){
        $this->store = new Store();
        $this->post = $this->store->post;
    }

    public function mount(){
        MetaValues::set('Yeni Makale Oluştur', 'input-cursor-text');
    }

    public function goBack(){
        return redirect()->route('panel.post.index');
    }

    public function uploadCover(){
        $result = FileUploader::image($this->cover, 'posts');
        if($result->isUploaded){
            $this->post['cover'] = $result->filename;
        }
    } // uploadCover

    public function save(){
        $this->post['slug'] =  Str::slug($this->post['title'], '-', config('app.lang'));
        $this->validate(PostRules::create(), PostRules::messages());
        $this->uploadCover();
        $createdPost = Post::create($this->post);
        if(!$createdPost->id){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Makale oluşturulurken bir sorun oluştu.']);
        }else{
            $createdPost->categories()->attach($this->selectedCategories);
            return redirect()->route('panel.post.edit', ['id'=>$createdPost->id]);
        }
    }



    public function render(){
        return view('livewire.admin.post.create', [
            'authors'       => $this->store->getAuthors(),
            'categories'    => $this->store->getCategories()
        ])->layout('layouts.panel');
    }
}
