<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Http\Livewire\Main::class);



// ADMIN PANEL ROUTES
Route::prefix('/panel')->name('panel.')->group(function(){

    // MAİN
    Route::get('/', \App\Http\Livewire\Admin\Main::class)->name('index');

    // USERS
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('/', \App\Http\Livewire\Admin\User\Index::class)->name('index');
        Route::get('/create', \App\Http\Livewire\Admin\User\Create::class)->name('create');
        Route::get('/{id}/edit', \App\Http\Livewire\Admin\User\Edit::class)->name('edit');
        Route::get('/{id}', function($id){ return redirect()->route('panel.user.edit', ['id'=>$id]); })->name('detail');
    }); // USERS

    // COMPANIES - SHOP
    Route::prefix('shop')->name('shop.')->group(function(){
        Route::get('/categories', \App\Http\Livewire\Admin\Shop\Category::class)->name('categories');

        Route::get('/', \App\Http\Livewire\Admin\Shop\Index::class)->name('index');
        Route::get('/create/{user}', \App\Http\Livewire\Admin\Shop\Create::class)->name('create');
        Route::get('/{id}/edit', \App\Http\Livewire\Admin\Shop\Edit::class)->name('edit');
        Route::get('/{id}', \App\Http\Livewire\Admin\Shop\Detail::class)->name('detail');
    });

    // PRODUCTS
    Route::prefix('product')->name('product.')->group(function(){
        Route::get('/categories', \App\Http\Livewire\Admin\Product\Category::class)->name('categories');

        Route::get('/', \App\Http\Livewire\Admin\Product\Index::class)->name('index');
//        Route::get('/{id}/edit', \App\Http\Livewire\Admin\Product\Edit::class)->name('edit');
//        Route::get('/{id}', \App\Http\Livewire\Admin\Product\Detail::class)->name('detail');
    });

    // PAGES
    Route::prefix('page')->name('page.')->group(function(){
        Route::get('/', \App\Http\Livewire\Admin\Page\Index::class)->name('index');
        Route::get('/create', \App\Http\Livewire\Admin\Page\Create::class)->name('create');
        Route::get('/{id}/edit', \App\Http\Livewire\Admin\Page\Edit::class)->name('edit');
    });

    // POSTS
    Route::prefix('post')->name('post.')->group(function(){
//        Route::get('/categories', \App\Http\Livewire\Admin\Product\Category::class)->name('categories');

        Route::get('/', \App\Http\Livewire\Admin\Post\Index::class)->name('index');
//        Route::get('/{id}/edit', \App\Http\Livewire\Admin\Product\Edit::class)->name('edit');
//        Route::get('/{id}', \App\Http\Livewire\Admin\Product\Detail::class)->name('detail');
    });

});
