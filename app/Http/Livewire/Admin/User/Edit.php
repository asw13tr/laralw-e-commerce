<?php

namespace App\Http\Livewire\Admin\User;

use App\Helpers\FlashMessage;
use App\Helpers\MetaValues;
use App\Models\User;
use App\Rules\UserRules;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
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

    public $currentUser = null;
    public $validatedData = [];

    // KOMPONENT OLUŞTURULURKEN KULLANICI BULUNUP PUBLIC DEĞİŞKENLERE ATANIYOR
    public function mount($id){
        $this->currentUser   = User::query()->where('id', $id)->with(['profile'])->first();
        $this->user         = $this->currentUser->toArray();
        $this->profile      = $this->currentUser->profile->toArray();
        MetaValues::set('Hesabı Düzenle: ['.$this->user['name'].']', 'pencil');
    }



    private function getModelDataOfTheUser(): array{
        $result = $this->validatedData['user'];
        if(isset($this->validatedData['user']['password']) && @strlen($this->validatedData['user']['password']) > 5){
            $result['password'] = Hash::make($this->validatedData['user']['password']);
        }else{
            unset($result['password']);
        }
        return $result;
    }



    private function getModelDataOfTheProfile($user): array{
        return array_merge(
            $this->validatedData['profile'], [
            'user_id' => $user->id
        ]);
    }



    public function saveUser(){

        $this->validatedData = $this->validate(UserRules::edit($this->currentUser), UserRules::messages());

        $update = $this->currentUser->update($this->getModelDataOfTheUser());

        if($update){
            $this->currentUser->profile()->update($this->getModelDataOfTheProfile($this->currentUser));
            FlashMessage::set('Kullanıcı hesabı güncellendi.');
            return redirect()->route('panel.user.edit', ['id' => $this->currentUser->id]);
        }

        FlashMessage::set('Kullanıcı hesabı güncellenirken bir sorun meydana geldi:');
    } // createUser




    public function render(){
        return view('livewire.admin.user.form')->layout('layouts.panel');
    }
}
