<div class="row">
    <div class="col-12 col-md-8 col-lg-6 col-xxl-5">

<h2 class="h4 border-bottom pb-2">Kullanıcı Bilgileri @isset($userObject)[{{ $user['name'] }}]@endisset</h2>
{!!  \App\Helpers\FlashMessage::get()   !!}
<form wire:submit.prevent="saveUser()">



<div class="row mb-3">
    <div class="col">
        <label for="" class="form-label">Kullanıcı Adı</label>
        <input type="text" class="form-control" wire:model="user.name"/>
        @include('livewire.admin.components.input-error', ['key'=>'user.name'])
    </div>

    <div class="col">
        <label for="" class="form-label">Şifre</label>
        <input type="password" class="form-control" wire:model="user.password" />
        @include('livewire.admin.components.input-error', ['key'=>'user.password'])
    </div>
</div>


<!-- ----------------------------------- -->
<div class="mb-3">
    <label for="" class="form-label">E-Posta</label>
    <input type="email" class="form-control" wire:model="user.email" />
    @include('livewire.admin.components.input-error', ['key'=>'user.email'])
</div>

<!-- ----------------------------------- -->
<div class="row mb-3">
    <div class="col">
        <label for="" class="form-label">Adı</label>
        <input type="text" class="form-control" wire:model="profile.firstname" />
        @include('livewire.admin.components.input-error', ['key'=>'profile.firstname'])
    </div>

    <div class="col">
        <label for="" class="form-label">Soyadı</label>
        <input type="text" class="form-control" wire:model="profile.lastname" />
        @include('livewire.admin.components.input-error', ['key'=>'profile.lastname'])
    </div>


</div>

<!-- ----------------------------------- -->
<div class="row mb-3">
    <div class="col">
        <label for="" class="form-label">Cinsiyeti</label>
        <select  wire:model="profile.gender" class="form-select">
            <option value="none">Belirtilmedi</option>
            <option value="female">Kadın</option>
            <option value="male">Erkek</option>
        </select>
        @include('livewire.admin.components.input-error', ['key'=>'profile.gender'])
    </div>

    <div class="col">
        <label for="" class="form-label">Doğum Tarihi</label>
        <input type="date" class="form-control" wire:model="profile.birthdate" />
        @include('livewire.admin.components.input-error', ['key'=>'profile.birthdate'])
    </div>

</div>

<!-- ----------------------------------- -->
<div class="row mb-3">
    <div class="col">
        <label for="" class="form-label">Telefon</label>
        <input type="tel" class="form-control" wire:model="profile.phone" />
    </div>

    <div class="col">
        <label for="" class="form-label">Avatar</label>
        <div class="input-group">
            <input type="tel" class="form-control" wire:model="profile.avatar" />
            <button class="btn btn-outline-secondary" type="button">Bul</button>
        </div>
    </div>
</div>

<!-- ----------------------------------- -->
<div class="row mb-3">

    <div class="col">
        <label for="" class="form-label">Kullanıcı Seviyesi</label>
        <select  wire:model="user.level" class="form-select">
            @foreach(config('values.userLevels') as $key => $val)
                <option value="{{ $key  }}" {{ $key=='user' ? 'selected' : null }}>{{ $val  }}</option>
            @endforeach
        </select>
        @include('livewire.admin.components.input-error', ['key'=>'user.level'])
    </div>

    <div class="col">
        <label for="" class="form-label">Hesap Durumu</label>
        <div class="form-check form-switch mt-2">
            <input wire:model="user.status" class="form-check-input" type="checkbox" role="switch" id="userStatus">
            <label class="form-check-label" for="userStatus">Bu hesap ile giriş yapılabilir</label>
        </div>
        @include('livewire.admin.components.input-error', ['key'=>'user.status'])
    </div>
</div>

<!-- ----------------------------------- -->
<div class="d-flex justify-content-end pt-3 border-top">
    @isset($currentUser)
        <button class="btn btn-success"><i class="bi bi-check-lg"></i> Güncelle</button>
    @else
        <button class="btn btn-primary"><i class="bi bi-check-lg"></i> Oluştur</button>
    @endisset
</div>
</form>

    </div>
</div>

