<?php
namespace App\Rules;

class ShopRules{

    public static function create():array{
        return [
            'shop.user_id'      => 'required|unique:shops,user_id',
            'shop.name'         => 'required|min:3|max:255',
            'shop.description'  => 'max:255',
            'shop.owner'        => 'required|min:5|max:128',
            'shop.tax_office'   => 'required|min:3|max:255',
            'shop.tax_number'   => 'required|min:5|max:128',
            'shop.email'        => 'required|min:5|max:128|email:rfc,dns|unique:shops,email',
            'shop.phone'        => 'required|min:5|max:128|unique:shops,phone',
            'shop.country_id'   => 'required',
            'shop.city'         => 'required|min:2|max:128',
            'shop.district'     => 'required|min:2|max:128',
            'shop.postcode'    => 'required|min:1|max:12',
            'shop.address'      => 'required|min:5|max:256',
            'shop.category_id'     => 'required',
        ];
    } // create


    public static function update($shop):array{
        return [
            'shop.user_id'      => 'required|unique:shops,user_id,'.$shop['id'],
            'shop.name'         => 'required|min:3|max:255',
            'shop.description'  => 'max:255',
            'shop.owner'        => 'required|min:5|max:128',
            'shop.tax_office'   => 'required|min:3|max:255',
            'shop.tax_number'   => 'required|min:5|max:128',
            'shop.email'        => 'required|min:5|max:128|email:rfc,dns|unique:shops,email,'.$shop['id'],
            'shop.phone'        => 'required|min:9|max:16|unique:shops,phone,'.$shop['id'],
            'shop.country_id'   => 'required',
            'shop.city'         => 'required|min:2|max:128',
            'shop.district'     => 'required|min:2|max:128',
            'shop.postcode'    => 'required|min:1|max:12',
            'shop.address'      => 'required|min:5|max:256',
            'shop.category_id'     => 'required',
        ];
    } // update


    public static function messages():array{
        return [
            'shop.user_id.unique'       => 'Bu kullanıcıya ait bir mağaza zaten var.',
            'shop.user_id'              => 'Mağaza kullanıcısı belirtilmedi',
            'shop.name'                 => '3 ila 255 karakter arasında uygun bir mağaza adı yazın.',
            'shop.description'          => 'Açıklama en fazla 255 karakter olabilir.',
            'shop.owner'                => '5 ila 128 karakter arasında geçerli bir mağaza sahibi adı ve soyadı yazın.',
            'shop.tax_office'           => '3 veya daha fazla karakterden oluşan bir veri dairesi adı girin',
            'shop.tax_number'           => 'Geçerli bir vergi dairesi numarası yazın',
            'shop.email.unique'         => 'Bu E-posta adresini kullanan bir mağaza zaten var.',
            'shop.email'                => 'Lütfen geçerli bir e-posta adresi girin.',
            'shop.phone'                => 'Geçerli bir telefon numarası girin.',
            'shop.country_id'           => 'Ülke seçilmeli',
            'shop.city'                 => 'Bir şehir yazın',
            'shop.district'             => 'Adres için bir ilçe girilmedi',
            'shop.postcode'            => 'Posta kodu eksik bırakılamaz',
            'shop.address'              => 'Lütfen geçerli bir mağaza adresi yazın',
            'shop.category_id'             => 'Mağaza kategorisi seçilmek zorundadır.',
        ];
    } // messages

}


?>
