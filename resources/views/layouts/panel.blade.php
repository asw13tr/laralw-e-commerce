<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $GLOBALS['META_VALUES']['title'] ?? 'Atabasch Panel' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        body *{
            font-family: 'Nunito Sans', sans-serif;
        }
    </style>
    @vite('resources/css/app.css')
    @livewireStyles
    @yield('head')
</head>
<body style="background: rgba(0,0,0,0.075)">
@livewire('admin.components.navbar')
<div class="row justify-content-center mx-0 px-0">
    <div class="mt-3 col-12 col-xxl-11 d-flex justify-content-between align-items-end">
        <h1 class="h5 m-0 p-0"><i class="bi bi-{{ $GLOBALS['META_VALUES']['icon'] ?? 'chevron-right' }}"></i> {{ $GLOBALS['META_VALUES']['title'] ?? 'Yönetici Paneli' }}</h1>
        @hasSection('dropdownActions')
            <div class="dropdown">
                <button class="btn btn-light btn-sm rounded-square dropdown-toggle" data-bs-toggle="dropdown"><em class="bi bi-three-dots-vertical"></em></button>
                <ul class="dropdown-menu">
                    @yield('dropdownActions')
                </ul>
            </div>
        @endif
    </div>

    <div class="mt-2 col-12 col-xxl-11">
        <div class="p-3 bg-white ">
            {{ $slot  }}
        </div>
    </div>
</div>
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/assets/panel/js/main.js"></script>
<script>
    Livewire.on('showToast', function (result){
        showToast({
            type: result.type || 'success',
            message: result.message
        })
    });

    Livewire.on('showModalForDelete', function (datas={}){
        showModalForDelete(datas);
    });
</script>
@yield('footer')

</body>
</html>
