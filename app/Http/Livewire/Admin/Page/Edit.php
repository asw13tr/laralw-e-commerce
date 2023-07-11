<?php

namespace App\Http\Livewire\Admin\Page;

use App\Helpers\FileUploader;
use App\Helpers\MetaValues;
use App\Models\Post;
use App\Models\User;
use App\Rules\PageRules;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component{

    use WithFileUploads;

    public $cover = null;
    public array $page = [
        'title' => '',
        'slug' => '',
        'description' => '',
        'keywords' => '',
        'parent' => 0,
        'cover' => null,
        'content' => '',
        'author_id' => 0,
        'type' => 'page',
        'status' => true,
    ];

    public function mount(Post $id){
        MetaValues::set('Sayfayı Düzenle: ' . $id->title, 'pencil-square');
        $this->page = $id->toArray();
    }

    // UPLOAD COVER IMAGE
    private function uploadCover(){
        $upload = FileUploader::image($this->cover, 'posts');
        if($upload->isUploaded){
            FileUploader::delete($this->page['cover']);
            return $upload->filename;
        }else{
            return $this->page['cover'];
        }
    }

    // UPLOAD A PAGE
    public function save(){
        $this->page['slug'] = Str::slug($this->page['title'], '-', config('app.lang'));
        $this->validate(PageRules::update($this->page), PageRules::messages());
        $this->page['cover'] = $this->uploadCover();

        $updated = Post::find($this->page['id'])->update($this->page);
        if(!$updated){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Sayfa güncellenemedi']);
        }else{
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Sayfa güncelleme başarılı']);
        }
    }

    private function getAuthors(){
        return User::whereIn('level', ['super', 'admin', 'moderator'])
            ->where('status', true)
            ->orderBy('name', 'asc')
            ->get();
    } // getAuthors

    private function getPages(){
        return Post::with('children')
            ->where('parent', '=',0)
            ->where('type', '=','page')
            ->get();
    } // getAuthors

    public function render(){
        return view('livewire.admin.page.edit', [
            'authors' => $this->getAuthors(),
            'pages' => $this->getPages()
        ])->layout('layouts.panel');
    }
}
