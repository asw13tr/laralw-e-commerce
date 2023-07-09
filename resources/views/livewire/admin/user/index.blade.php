<div>
    <div class="row  mb-3 border-bottom pb-3">
        <div class="col-12 col-sm-6">
            <input type="search" class="form-control" wire:model="searchedValue" placeholder="Kullanıcılarda ara">
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-end">
            <a href="{{ url()->route('panel.user.create')  }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Yeni Hesap</a>
        </div>
    </div>


    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="40">#</th>
                <th width="50"></th>
                <th>Hesap Sahibi</th>
                <th>Kullanıcı Adı</th>
                <th>E-Posta</th>
                <th width="100">Seviye</th>
                <th width="30">Durum</th>
                <th width="90"></th>
            </tr>
        </thead>
        <tbody>

            @if($users)
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $user->id  }}</td>
                        <td>
                            @if($user->level=='seller')
                                <?php $shopUrl = isset($user->shop)? url()->route('panel.shop.detail', ['id'=>$user->shop->id]) : url()->route('panel.shop.create', ['user'=>$user->id]) ?>
                                <a href="{{ $shopUrl }}" class="btn-sm bi bi-shop btn btn-{{ $user->shop()->exists()? 'primary' : 'secondary' }}"></a>
                            @endif

                        </td>
                        <td>{{ $user->profile->getFullName()  }}</td>
                        <td>{{ $user->name  }}</td>
                        <td>{{ $user->email  }}</td>
                        <td>{{ $user->getLevelValue()  }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" <?php echo $user->status==1? 'checked' : null; ?> role="switch" disabled />
                            </div>
                        </td>

                        <td class="d-flex justify-content-between">
                            <a href="{{ url()->route('panel.user.edit', ['id'=>$user->id])  }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil fw-bold text-light"></i></a>
                            <button onclick="showModalForDelete({
                                title: `Emin misiniz?`,
                                text: `<strong>{{ $user->name  }}</strong> kullanıcı adına sahip hesap silinecek. Bu işlem bir daha geri alınamayabilir. İşlemi yapmak istediğinizden emin misiniz?`,
                                emit: {
                                    name: 'deleteUser',
                                    params: {{ $user->id  }}
                                }
                            })" class="btn btn-danger btn-sm"><i class="bi bi-trash fw-bold text-light"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $users->links() }}
    </div>


</div>
