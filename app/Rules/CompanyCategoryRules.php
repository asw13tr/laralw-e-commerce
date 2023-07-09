<?php

namespace App\Rules;

class CompanyCategoryRules{

    public static function create(): array{
        return [
            'currentCategory.title' => 'required|min:3|max:128|unique:company_categories,title'
        ];
    } // create



    public static function update($categoryId): array{
        return [
            'currentCategory.title' => 'required|min:3|max:128|unique:company_categories,title,'.$categoryId
        ];
    } // update



    public static function messages(): array{
        return [
            'currentCategory.title' => 'Lütfen 3 ila 128 karakter uzunluğu arasında bir başlık yazın'
        ];
    } // messages


}

?>
