<?php
namespace App\Rules;

class ProductCategoryRules{

    public static function create(): array{
        return [
            'category.title'        => 'required|min:3|max:128',
            'category.slug'         => 'required|min:3|max:128',
            'category.description'  => 'max:512',
            'cover'                 => 'nullable|image|max:1024|mimes:png,jpg,svg,webp',
            'category.cover'        => 'nullable',
            'category.status'       => '',
            'category.parent'       => '',
        ];
    } // create

    public static function update(): array{
        return self::create();
    } // update

    public static function messages(): array{
        return [
            'category.title'        => '3 ila 128 karakter uzunluğu arasında bir başlık girilmeli.',
            'category.slug'         => '3 ila 128 karakter uzunluğu arasında bir başlık girilmeli.',
            'category.description'  => 'Açıklama en fazla 512 karakter uzunluğunda olabilir.',
            'cover'                 => 'Geçerli bir kapak fotoğrafı seçin',
            'category.cover'        => 'Geçerli bir kapak fotoğrafı seçin',
            'category.status'       => '',
            'category.parent'       => '',
        ];
    } // messages

}

?>
