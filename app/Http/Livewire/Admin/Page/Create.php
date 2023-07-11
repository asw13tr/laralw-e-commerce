<?php

namespace App\Http\Livewire\Admin\Page;

use App\Helpers\FileUploader;
use App\Helpers\MetaValues;
use App\Http\Livewire\Admin\Components\Quill;
use App\Models\Post;
use App\Models\User;
use App\Rules\PageRules;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component{

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

    protected $listeners = [
        Quill::EVENT_VALUE_UPDATED => 'updatedContentValue'
    ];

    public function mount(Post $id){
        MetaValues::set('Yeni Sayfa Oluştur', 'plus-square');
    }

    // UPLOAD COVER IMAGE
    private function uploadCover(){
        $upload = FileUploader::image($this->cover, 'posts');
        return $upload->filename;
    }

    // Quill kullanılırsa o komponentteki güncelleme burada dinleniyor.
    public function updatedContentValue($value){
        $this->page['content'] = $value;
    }

    // CREATE A PAGE
    public function save(){
        $this->page['slug'] = Str::slug($this->page['title'], '-', config('app.lang'));
        $this->validate(PageRules::create(), PageRules::messages());
        $this->page['cover'] = $this->uploadCover();

        $created = Post::create($this->page);
        if(!$created->id){
            $this->emit('showToast', ['type'=>'error', 'status'=>false, 'message'=>'Sayfa oluşturulamadı']);
        }else{
            $this->emit('showToast', ['type'=>'success', 'status'=>true, 'message'=>'Sayfa oluşturuldu']);
            return redirect()->route('panel.page.edit', ['id' => $created->id]);
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
        return view('livewire.admin.page.create', [
            'authors' => $this->getAuthors(),
            'pages' => $this->getPages()
        ])->layout('layouts.panel');
    }
}
