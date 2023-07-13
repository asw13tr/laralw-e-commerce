<?php

namespace App\Http\Livewire\Admin\Post;

use App\Helpers\FileUploader;
use App\Helpers\MetaValues;
use App\Models\Post;
use Livewire\Component;

class Index extends Component{
    public string|null $searchedValue = null;
    private int $limitPerPage = 20;

    protected $listeners = [
        'deletePost' => 'deletePost',
        'updateStatus' => 'updateStatus',
    ];

    public function deletePost(Post $post){
        $deleted = $post->delete();
        if(!$deleted){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Makale silinirken bir sorun oluştu.']);
        }else{
            $post->categories()->detach();
            FileUploader::delete($post->cover);
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>$post->title . ' başlıklı yazı silindi.']);
        }
        return $deleted;
    }


    public function updateStatus(Post $post){
        $post->status = !$post->status;
        $updated = $post->save();
        if(!$updated){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Makale durumu güncellenemedi.']);
        }else{
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Makale durumu günellendi.']);
        }
    }


    public function mount(){
        MetaValues::set('Makale Listesi', 'text-left');
    }


    // GET POSTS
    public function getPosts(){
        return Post::with(['categories', 'author'])
            ->where('type', 'post')
            ->where('title', 'LIKE', "%{$this->searchedValue}%")
            ->paginate($this->limitPerPage);
    }

    // RENDER
    public function render(){
        return view('livewire.admin.post.index', [
            'posts' => $this->getPosts()
        ])->layout('layouts.panel');
    }
}
