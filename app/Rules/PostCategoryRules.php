<?php
namespace App\Rules;

class PostCategoryRules{

    public static function create(): array{
        return [
            'category.title'         => 'required|min:3|max:64',
            'category.slug'          => 'required|min:3|max:64|unique:post_categories,slug',
            'category.sort_no'       => 'integer',
            'category.description'   => 'nullable|max:255',
            'category.status'        => 'boolean',
        ];
    } // create

    public static function update($category): array{
        return [
            'category.title'         => 'required|min:3|max:64',
            'category.slug'          => 'required|min:3|max:64|unique:post_categories,slug,'.$category['id'],
            'category.sort_no'       => 'integer',
            'category.description'   => 'nullable|max:255',
            'category.status'        => 'boolean',
        ];
    } // update

    public static function messages(): array{
        return [
            'category.title'         => '3 ila 64 karakter arasında bir kategori adı girilmeli',
            'category.slug.unique'   => 'Muhtemelen aynı isimde başka bir kategori var.',
            'category.slug'          => '3 ila 64 karakter arasında bir kategori adı girilmeli.',
            'category.sort_no'       => 'Sıra numarası tma sayı bir değer olmalı',
            'category.description'   => 'Açıklama satırı en fazla 255 karakter olabilir',
            'category.status'        => 'Lütfen 1 yada 0 değerinde bir durum girin',
        ];
    } // messages


}
?>
