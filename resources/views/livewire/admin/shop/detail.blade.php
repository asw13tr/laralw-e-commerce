@section('dropdownActions')
    <li><a href="{{ url()->route('panel.shop.edit', ['id'=>$shop->id]) }}" class="dropdown-item"><i class="bi bi-pencil"></i> Bilgileri Düzenle</a></li>
    <li><hr class="dropdown-divider"></li>
    <li>
        <button onclick="showModalForDelete({
            title:  'Mağaza Tamamen Kaldırılıcak',
            text:   '<strong>{{ $shop->name }}</strong> isimli mağazayı silmek üzeresiniz. Mağaza tüm ürünleri ile birlikte sistemden silinecek ve bu işlem bir daha geri alınamaz. İşlemi gerçekleştirmek istediğinizden emin misiniz?',
            emit:   {
                'name':     'deleteShop',
                'params':   {{ $shop->id }}
            }
        })" class="dropdown-item text-danger"><em class="bi bi-trash"></em> Mağazayı Sil</button>
    </li>
@endsection

<div class="row">
    <div class="col-12 col-lg-10 col-xl-8 col-xxl-7">
        <h4 class="h6 mb-3 px-1 py-2 border-bottom border-dark-subtle fw-bold mt-2 bg-light">Genel Bilgiler</h4>
        <div class="row">
            <div class="mb-2 col-6"><span class="text-secondary">Oluşturulma:</span><br><strong>{{ $shop->created_at->format('d F Y H:i')  }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Son Güncellenme:</span><br><strong>{{ $shop->updated_at->format('d F Y H:i')  }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Mağaza Adı:</span><br><strong>{{ $shop->name  }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Sahibi:</span><br><strong>{{ $shop->owner  }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Kategorisi:</span><br><strong>{{ $shop->category->title  }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Kullanıcı Hesabı:</span><br><strong>{{ $shop->user->name  }}</strong></div>
            <div class="mb-2 col-12"><span class="text-secondary">Açıklama:</span><br><strong>{{ $shop->description  }}</strong></div>
        </div>

        <h4 class="h6 mb-3 px-1 py-2 border-bottom border-dark-subtle fw-bold mt-2 bg-light">Vergi Dairesi Bilgileri</h4>
        <div class="row">
            <div class="mb-2 col-6"><span class="text-secondary">Vergi Dairesi:</span><br><strong>{{ $shop->tax_office }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Numarası:</span><br><strong>{{ $shop->tax_number }}</strong></div>
        </div>

        <h4 class="h6 mb-3 px-1 py-2 border-bottom border-dark-subtle fw-bold mt-2 bg-light">İletişim Bilgileri</h4>
        <div class="row">
            <div class="mb-2 col-6"><span class="text-secondary">E-Posta:</span><br><strong>{{ $shop->email }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Telefon Numarası:</span><br><strong>{{ $shop->phone }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Ülke:</span><br><strong>{{ $shop->country->name_tr }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Şehir/Bölge/Eyalet:</span><br><strong>{{ $shop->city }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">İlçe/Semt:</span><br><strong>{{ $shop->district }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Posta Kodu:</span><br><strong>{{ $shop->postcode }}</strong></div>
            <div class="mb-2 col-12"><span class="text-secondary">Adres:</span><br><strong>{{ $shop->address }}</strong></div>
        </div>

        <h4 class="h6 mb-3 px-1 py-2 border-bottom border-dark-subtle fw-bold mt-2 bg-light">Kullanıcı Hesabı</h4>
        <div class="row">
            <div class="mb-2 col-6"><span class="text-secondary">Kullanıcı Adı</span><br><strong>{{ $shop->user->name }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Ad ve Soyad</span><br><strong>{{ $shop->user->profile->getFullName() }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">E-Posta:</span><br><strong>{{ $shop->user->email }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Telefon:</span><br><strong>{{ $shop->user->profile->phone }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Cinsiyet:</span><br><strong>{{ $shop->user->profile->getGender() }}</strong></div>
            <div class="mb-2 col-6"><span class="text-secondary">Doğum Tarihi:</span><br><strong>{{ $shop->user->profile->birthdate }}</strong></div>
        </div>
    </div>

</div>
