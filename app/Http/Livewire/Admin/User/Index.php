<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use App\Helpers\MetaValues;
use Livewire\WithPagination;

class Index extends Component{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    private int $limitPerPage = 25;

    public string|null $searchedValue = null;
    public User|null $userObject = null;


    // LISTEN ON EMITS
    protected $listeners = [ 'deleteUser' => 'deleteUser' ];


    // DELETE USER FORM DATABASE
    public function deleteUser(User $user): void{
        //todo: session id ile aynı ise silinemez ve kendinden daha üst bir leveli silemez
        $loggedUserId = 1;
        $loggedUserLevel = 'super';
        if($loggedUserId==$user->id || $user->level=='super' || $loggedUserLevel==$user->level ){
            $this->emit('showToast', ['type'=>'danger', 'message'=>'Bu hesabı silmek için yeterli yetkiye sahip değilsiniz.', 'status'=>false]);
        }else{
            $deletedUser = $user->delete();
            if(!$deletedUser){
                $this->emit('showToast', ['type'=>'danger', 'message'=>'Hesap silme işlemi sırasında bir sorun oluştu', 'status'=>false]);
            }else{
                $this->emit('showToast', ['message'=>$user->username.' Kullanıcı hesabı silindi..', 'status'=>true]);
            }
        }
    }


    // GET USERS FROM ORM
    private function getUsers(){
        return User::query()->with(['profile', 'shop'])->orderBy('id', 'desc')->paginate($this->limitPerPage);
    }


    // GET SEARCHED USERS FROM DB
    private function getSearchedUsers(){
        return User::query()->with(['profile', 'shop'])->orderBy('id', 'desc')
            ->Where('name', 'LIKE', "%{$this->searchedValue}%")
            ->orWhere('email', 'LIKE', "%{$this->searchedValue}%")
            ->paginate($this->limitPerPage);
    }


    // LOADED
    public function mount(){
        MetaValues::set('Kullanıcı Hesapları', 'people');
    }


    // RENDER
    public function render(){
        $datas = [
            'users' => (strlen($this->searchedValue)>2?  $this->getSearchedUsers() :  $this->getUsers()),
        ];
        return view('livewire.admin.user.index', $datas)->layout('layouts.panel');
    }


} // Component
