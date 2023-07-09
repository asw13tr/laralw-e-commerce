<?php
namespace App\Rules;


class UserRules{

    public static function create(): array{
        $userLevels = implode(',', array_keys((config('values.userLevels') ?? [])));
        return [
                'user.name'      => 'required|unique:users,name|min:3|max:12',
                'user.email'     => 'required|unique:users,email|email|max:36',
                'user.password'  => 'required|min:6|max:24',
                'user.level'     => 'required|in:' . $userLevels,
                'user.status'    => 'required|boolean',

                'profile.firstname' => 'required|min:2|max:32',
                'profile.lastname'  => 'required|min:2|max:32',
                'profile.gender'    => 'required|in:none,male,female',
                'profile.birthdate' => '',
                'profile.phone'     => '',
                'profile.avatar' => ''
        ];
    } // create

    public static function edit($user): array{
        $userLevels = implode(',', array_keys((config('values.userLevels') ?? [])));
        return [
            'user.name'      => 'required|min:3|max:12|unique:users,name,'.$user->id,
            'user.email'     => 'required|email|max:36|unique:users,email,'.$user->id,
            'user.password'  => 'min:6|max:24',
            'user.level'     => 'required|in:' . $userLevels,
            'user.status'    => 'required|boolean',

            'profile.firstname' => 'required|min:2|max:32',
            'profile.lastname'  => 'required|min:2|max:32',
            'profile.gender'    => 'required|in:none,male,female',
            'profile.birthdate' => '',
            'profile.phone'     => '',
            'profile.avatar'    => ''
        ];
    } // create

    public static function messages(): array{
        return [
                'user.name.unique'       => 'Kullanıcı adı daha önce alınmış',
                'user.name'              => 'Lütfen :min ve :max karakter uzunluğu arasında uygun bir kullanıcı adı girin',
                'user.email.unique'      => 'Bu E-Posta adresi daha önce kayıt edilmiş',
                'user.email'             => 'Lütfen :min ve :max karakter uzunluğu arasında uygun bir E-Posta adresi girin',
                'user.password'          => 'Lütfen :min ve :max karakter uzunluğu arasında geçerli bir Parola seçin.',
                'user.level'             => 'Geçerli bir kullanıcı seviyesi seçilmedi',
                'user.status'            => 'Hesap durumu seçilmedi',

                'profile.firstname'         => 'En az :min en fazla :max karakter uzunluğunda bir İsim girin',
                'profile.lastname'          => 'En az :min en fazla :max karakter uzunluğunda bir Soyad girin',
                'profile.gender'            => 'Cinsiyet seçilmedi',
                //'birthdate' => '',
                //'phone'     => '',
                //'avatar' => ''
        ];
    } // messages

}
