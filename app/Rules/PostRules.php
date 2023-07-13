<?php
namespace App\Rules;

use Illuminate\Validation\Rule;

class PostRules{


    public static function create(): array{
        return [
            'post.title'         => 'required|min:3|max:160|unique:posts,title',
            'post.slug'          => 'required|min:3|max:160|unique:posts,slug',
            'post.description'   => 'nullable|max:255',
            'post.keywords'      => 'nullable|max:255',
            'post.author_id'     => 'required|integer|min:1',
            'post.cover'         => 'nullable|max:255',
            'post.content'       => 'nullable',
            'post.type'          => ['string', Rule::in(['post'])],
            'post.status'        => 'boolean',
            'cover'              => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048|dimensions:min_width=450,min_height=300',
            'selectedCategories' => 'required|array',
        ];
    } // create

    public static function update($post): array{
        return [
            'post.title'         => 'required|min:3|max:160|unique:posts,title,'.$post['id'],
            'post.slug'          => 'required|min:3|max:160|unique:posts,slug,'.$post['id'],
            'post.description'   => 'nullable|max:255',
            'post.keywords'      => 'nullable|max:255',
            'post.author_id'     => 'required|integer|min:1',
            'post.cover'         => 'nullable|max:255',
            'post.content'       => 'nullable',
            'post.type'          => ['string', Rule::in(['post'])],
            'post.status'        => 'boolean',
            'cover'              => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048|dimensions:min_width=450,min_height=300',
            'selectedCategories' => 'required|array'
        ];
    } // update

    public static function messages(): array{
        return [
            'post.title'         => 'Makale başlığı gerekli',
            'post.title.unique'  => 'Aynı başlıkta bir makale zaten yazılmış',
            'post.slug'          => '',
            'post.slug.unique'   => 'Aynı başlıkta bir makale zaten yazılmış',
            'post.description'   => 'Açıklama en fazla 255 karakterden oluşmalı.',
            'post.keywords'      => 'Anahtar kelimeler en fazla 255 karakterden oluşmalı.',
            'post.author_id'     => 'Bir yazar seçilmeli',
            'post.cover'         => 'Kapak fotoğrafı adı geçersiz.',
            'post.content'       => '',
            'post.type'          => 'Hatalı içerik türü',
            'post.status'        => 'İçerik durumu hatalı',
            'cover'              => 'En çok 2mb boyutunda, en az 450x300px boyutlarında ve sadece jpg,jpeg,png,svg,webp uzantısına sahip görseller yüklenebilir.',
            'selectedCategories' => 'En az 1 kategori seçilmeli'
        ];
    } // messages



}
?>
