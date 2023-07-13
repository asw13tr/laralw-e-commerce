<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\PostCategory;
use App\Models\User;
use Livewire\Component;

class Store extends Component{

    public array $post = [
        'title'         => '',
        'slug'          => '',
        'description'   => null,
        'keywords'      => null,
        'author_id'     => 0,
        'cover'         => null,
        'content'       => '',
        'type'          => 'post',
        'status'        => true
    ];

    public function getAuthors(){
        return User::whereIn('level', ['super', 'admin', 'moderator'])
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getCategories(){
        return PostCategory::where('status', true)
            ->orderBy('title', 'asc')
            ->get();
    }


    public function render(){
        return <<<'blade'
            <div>
            </div>
        blade;
    }
}
