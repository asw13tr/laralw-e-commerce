<?php

namespace App\Http\Livewire\Admin\Page;

use App\Helpers\FileUploader;
use App\Helpers\MetaValues;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{

    use WithPagination;

    public string $searchedValue = '';
    private int $limitPerPage = 10;
    protected $listeners = ['deletePost' => 'deletePost'];

    // INIT
    public function mount(){
        MetaValues::set('Sayfalar', 'justify-left');
    }

    // DELETE
    public function deletePost(Post $post){
        $coverName = $post->cover;
        $deleted = $post->delete();
        if(!$deleted){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'messages' => $post->title. ' sayfasını silme işlemi başarısız oldu.']);
        }else{
            $post->children()->delete();
            FileUploader::delete($coverName);
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'messages' => $post->title. ' sayfası silindi.']);
        }
    }

    // GET
    public function getPages(){
        return Post::with('children')
            ->where('parent', 0)
            ->where('type', 'page')
            ->paginate($this->limitPerPage);
    }

    public function getPagesBySearch(){
        return Post::with('children')
            ->where('title', 'LIKE', "%{$this->searchedValue}%" )
            ->where('type', 'page')
            ->paginate($this->limitPerPage);
    }

    // RENDER
    public function render(){
        return view('livewire.admin.page.index', [
            'pages' => strlen($this->searchedValue)>2? $this->getPagesBySearch() : $this->getPages()
        ])->layout('layouts.panel');
    }
}
