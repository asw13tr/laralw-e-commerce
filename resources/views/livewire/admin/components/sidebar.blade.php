<?php
$sidebarNavItems = [
    [ 'type'=>'item', 'title'=>'Başlangıç', 'url'=>route('panel.index'), 'icon'=>'speedometer2' ],
    [ 'type'=>'divider' ],
    [ 'type'=>'item', 'title'=>'Mağazalar',     'url'=>route('panel.shop.index'), 'icon'=>'shop' ],
    [ 'type'=>'item', 'title'=>'Ürünler',       'url'=>route('panel.product.index'), 'icon'=>'basket' ],
    [ 'type'=>'item', 'title'=>'Siparişler',    'url'=>route('panel.index'), 'icon'=>'cart4' ],
    [ 'type'=>'item', 'title'=>'Kampanyalar',   'url'=>route('panel.index'), 'icon'=>'bag-heart' ],
    [ 'type'=>'divider' ],
    [ 'type'=>'item', 'title'=>'Sayfalar',      'url'=>route('panel.page.index'), 'icon'=>'text-left' ],
    [ 'type'=>'item', 'title'=>'Yazılar',       'url'=>route('panel.post.index'), 'icon'=>'text-left' ],
    [ 'type'=>'divider' ],
    [ 'type'=>'item', 'title'=>'Kullanıcılar',  'url'=>route('panel.user.index'), 'icon'=>'people' ],
    [ 'type'=>'item', 'title'=>'Navigasyon',    'url'=>route('panel.index'), 'icon'=>'signpost-2' ],
    [ 'type'=>'item', 'title'=>'Medya',         'url'=>route('panel.index'), 'icon'=>'collection' ],
    [ 'type'=>'divider' ],
    [ 'type'=>'item', 'title'=>'Ayarlar', 'url'=>route('panel.index'), 'icon'=>'gear-fill' ],
];
?>
<ul class="nav nav-pills flex-column mb-auto ">

    @foreach($sidebarNavItems as $item)
        @if($item['type']=='divider')
            <li class="nav-item py-3"><hr></li>
        @elseif($item['type']=='item')
            <li class="nav-item"><a class="nav-link link-light {{ ((route('panel.index')!=$item['url']) && strpos(url()->current(), $item['url'])>-1)? 'active' : ''  }}" href="{{ $item['url'] }}"><em class="bi bi-{{ $item['icon'] }}"></em> {{ $item['title'] }}</a></li>
        @else

        @endif
    @endforeach

</ul>
