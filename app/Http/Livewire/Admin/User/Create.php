<?php

namespace App\Http\Livewire\Admin\User;

use App\Helpers\FlashMessage;
use App\Helpers\MetaValues;
use http\Url;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Rules\UserRules;
use App\Models\User;

class Create extends Component
{

    public array $user = [
        'name'      => '',
        'email'     => '',
        'password'  => '',
        'level'     => 'user',
        'status'    => true,
    ];

    public array $profile = [
        'firstname'     => '',
        'lastname'      => '',
        'gender'        => 'none',
        'birthdate'     => null,
        'phone'         => null,
        'avatar'        => null,
    ];

    private array $validatedData = [];

    public function mount(){
        MetaValues::set('Yeni Hesap Oluştur', 'plus-lg');
    }

    // USER MODELİNE KAYIT YAPMAK İÇİN DATALARI OLUŞTURUR.
    private function getModelDataOfTheUser(): array{
        return array_merge(
            $this->validatedData['user'],
            [ 'password' => Hash::make($this->validatedData['user']['password']) ]
        );
    }

    // PROFİLE TABLOSUNA KAYIT EDİLECEK VERİLERİ OLUŞTUR
    private function getModelDataOfTheProfile($user): array{
        return array_merge(
            $this->validatedData['profile'], [
            'user_id' => $user->id
        ]);
    }

    public function saveUser(){
        $this->validatedData = $this->validate(UserRules::create(), UserRules::messages());

        $user = User::create($this->getModelDataOfTheUser());

        if($user->id){
            $user->profile()->create($this->getModelDataOfTheProfile($user));
            FlashMessage::set('Kullanıcı hesabı oluşturuldu.');
            return redirect()->route('panel.user.edit', ['id' => $user->id]);
        }

        FlashMessage::set('Kullanıcı hesabı oluşturulurken bir sorun meydana geldi:');
    } // createUser


    public function render(){
        return view('livewire.admin.user.form')->layout('layouts.panel');
    }
}
