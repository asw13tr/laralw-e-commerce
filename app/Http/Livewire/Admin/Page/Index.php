<?php

namespace App\Http\Livewire\Admin\Page;

use App\Helpers\MetaValues;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{

    use WithPagination;

    public string $searchedValue = '';
    private int $limitPerPage = 10;

    // INIT
    public function mount(){
        MetaValues::set('Sayfalar', 'justify-left');
    }

    // GET
    public function getPages(){
        return Post::with('children')
            ->where('parent', 0)
            ->where('type', 'page')
            ->paginate($this->limitPerPage);
    }

    // RENDER
    public function render(){
        return view('livewire.admin.page.index', [
            'pages' => $this->getPages()
        ])->layout('layouts.panel');
    }
}
