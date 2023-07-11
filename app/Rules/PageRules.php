<?php
namespace App\Rules;
use Illuminate\Validation\Rule;

class PageRules{

    public static function create(): array{
        return [
            'page.title'        => 'required|min:3|max:255',
            'page.slug'         => 'required|min:3|max:255|unique:posts,slug',
            'page.description'  => 'nullable|max:255',
            'page.keywords'     => 'nullable|max:255',
            'page.parent'       => 'integer',
            'page.author_id'    => 'integer|required',
            'page.cover'        => 'nullable|max:255',
            'page.content'      => 'nullable',
            'page.type'         => ['required', Rule::in(['post', 'page'])],
            'page.status'       => 'required|boolean',
            'cover'             => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048'
        ];
    } // create

    public static function update($page): array{
        return [
            'page.title'        => 'required|min:3|max:255',
            'page.slug'         => 'required|min:3|max:255|unique:posts,slug,'.$page['id'],
            'page.description'  => 'nullable|max:255',
            'page.keywords'     => 'nullable|max:255',
            'page.parent'       => 'integer',
            'page.author_id'    => 'integer|required',
            'page.cover'        => 'nullable|max:255',
            'page.content'      => 'nullable',
            'page.type'         => ['required', Rule::in(['post', 'page'])],
            'page.status'       => 'required|boolean',
            'cover'             => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048'
        ];
    } // update

    public static function messages(): array{
        return [
            'page.title'        => 'Lütfen 3 ila 255 karakter arasında bir başlık girin.',
            'page.slug'         => 'Aynı başlığa sahip başka bir sayfa var lütfen başlığı değiştirin.',
            'page.description'  => 'Açıklama en fazla 255 karakter olabilir.',
            'page.keywords'     => 'En fazla 255 karakter uzunluğunda anahtar kelime dizisi girilebilir.',
            'page.parent'       => 'Ebeveyn sayfa değeri integer olmalı.',
            'page.cover'        => 'Kapak fotoğrafı için çok uzun isim.',
            'page.content'      => 'nullable',
            'page.author_id'    => 'Sayfa için bir yazar girilmeli.',
            'page.type'         => 'İçerik tipi sadece "sayfa" veya "yazı" olabilir.',
            'page.status'       => 'Sayfa durumu true yada false olmalı.',
            'cover.mimes'       => 'Kapak fotoğrafı için izin verilmeyen uzantı. Sadece jpg,jpeg,png,webp,svg uzantıları kullanılabilir.',
            'cover.max'         => 'Kapak fotoğrafı 2mb dan daha büyük olamaz.',
            'cover'             => 'Lütfen geçerli bir görsel yüklemeyi deneyin.'
        ];
    } // delete


}
?>
