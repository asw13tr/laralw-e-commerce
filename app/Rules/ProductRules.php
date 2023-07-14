<?php

namespace App\Rules;

use Illuminate\Validation\Rules\File;

class ProductRules{


    public static function create(): array{
        return [
            'product.title'                 => 'string|required|min:6|max:200',
            'product.sno'                   => 'string|nullable|min:6|max:32',
            'product.barcode'               => 'string|nullable|min:6|max:32',
            'product.sku'                   => 'string|required|min:6|max:32',
            'product.stock'                 => 'integer|digits_between:0,10000',
            'product.keywords'              => 'nullable|max:256',
            'product.description'           => 'nullable|max:512',
            'product.status'                => 'boolean',
            'product.is_virtual'            => 'boolean',
            'product.content'               => 'nullable',
            'product.shop_id'               => 'integer|required|min_digits:1',
            'product.price'                 => 'required|decimal:0,2|min:0',
            'product.tax'                   => 'required|decimal:0,2|min:0|max:100',
            'product.delivery_price'        => 'required|decimal:0,2|min:0',
            'product.free_delivery'         => 'boolean',
            'product.free_delivery_price'   => 'nullable|decimal:0,2|min:0',
            'product.discount_id'           => 'integer',
            'product.cover'                 => 'string|nullable|max:256',
            'selectedCategories'            => 'array|required',
            'cover'                         => ['image', 'nullable', File::types(['jpg','png', 'jpeg', 'webp'])->min(12)->max(1024*2)]
        ];
    } // create

    public static function update(): array{
        return self::create();
    } // update

    public static function messages(): array{
        return [
            'product.title'                 => ':min - :max karakter arasında bir ürün adı girilmeli.',
            'product.sno'                   => 'Ürün seri numarası :min - :max karakter arasında olmalı',
            'product.barcode'               => 'Barkod :min - :max karakter arasında olmalı',
            'product.sku'                   => 'Ürünü tanımlayan :min - :max karakter arası tanımlayıcı bir kod oluşturun',
            'product.stock'                 => 'Geçerli bir stok adeti sayısı girilmeli',
            'product.keywords'              => 'Anahtar kelimeler 256 karakterden fazla olamaz',
            'product.description'           => 'En çok :max karakterden oluşan bir açıklama girilmeli',
            'product.status'                => 'boolean',
            'product.is_virtual'            => 'boolean',
            'product.content'               => 'nullable',
            'product.shop_id'               => 'Ürün tedarikçi mağazası seçilmeli',
            'product.price'                 => 'Geçerli bir ürün fiyatı girilmeli',
            'product.tax'                   => '0,00 - 100 arasında bir vergi yüzdesi girin.',
            'product.delivery_price'        => 'Kargo ücreti girilmeli ücretsiz ise 0 yazın',
            'product.free_delivery'         => 'boolean',
            'product.free_delivery_price'   => 'Ücretsiz kargo alt limiti hatalı',
            'product.discount_id'           => 'Kampanya id numarası integer türünde olmalı',
            'product.cover'                 => 'Kapak fotoğrafı adı :max karakterden fazla olamaz',
            'selectedCategories'            => 'En az 1 en fazla 5 ürün kategorisi seçilmeli',
            'cover'                         => 'en çok 2mb ve en az 450x300px boyutlarında jpg,jpeg,png formatlarından birine sahip bir kapak fotoğrafı seçilmeli.'
        ];
    } // messages


}
