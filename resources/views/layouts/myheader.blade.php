
<div class="sidebar">
    <div class="links">
        <div class="back_side">
            ✖️
        </div>
        <a href="{{ route('home') }}"><img src="{{ asset('assetsmerchant/img/allgood_logo.png') }}" class="logo" alt=""></a>
    <ul>
            <li><a href="{{ route('orders') }}" class="@if(str_contains(url()->current(), '/orders')) active @endif">Заказы</a></li>
            <li><a href="{{ route('myclients') }}" class="application @if(str_contains(url()->current(), '/myclients')) active @endif">Мои клиенты</a></li>
            <li><a href="{{ route('products') }}" class="application @if(str_contains(url()->current(), '/products')) active @endif">Товары</a></li>
            <li><a href="{{ route('finance') }}" class="application @if(str_contains(url()->current(), '/finance')) active @endif">Финансы</a></li>
            <li><a href="{{ route('scoring') }}" class="application @if(str_contains(url()->current(), '/scoring')) active @endif">Скоринг</a></li>
            {{--
            @if (app()->getLocale() == 'uz')
                <li><a href="{{ route('lang', ['lang'=>'ru']) }}" class="application">Русский</a></li>
            @else
                <li><a href="{{ route('lang', ['lang'=>'uz']) }}" class="application">O'zbekcha</a></li>
            @endif
            --}}

            <li><a href="javascript:;" onclick="document.getElementById('logout').submit();" class="application">Выход</a></li>
            <form action="{{ route('logout') }}" id="logout" method="POST" style="display: none;">
                {{csrf_field()}}
           </form>
        </ul>
    </div>
</div>
