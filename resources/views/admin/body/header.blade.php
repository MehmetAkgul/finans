<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a data-toggle="dropdown" href="#" class="nav-link"> <i class="fa fa-plus"></i> Yeni Bir... </a>
            <div class="dropdown-menu  dropdown-menu-md  dropdown-menu-right">
                <a class="dropdown-item " href="{{route('fatura.create',['type'=>FATURA_GELIR])}}"> <i class="fa fa-file-invoice"></i> Gelir Faturası
                </a>
                <a class="dropdown-item" href="{{route('fatura.create',['type'=>FATURA_GIDER])}}"> <i class="fa fa-file-invoice-dollar"></i> Gider
                    Faturası </a>
                <a class="dropdown-item" href="{{route('islem.create',['type'=>ISLEM_ODEME])}}"> <i class="fas fa-paypal"></i> Ödeme Yap </a>
                <a class="dropdown-item" href="{{route('islem.create',['type'=>ISLEM_TAHSILAT])}}"> <i class="fas fa-cc-paypal"></i> Tahsilat Al </a>

            </div>
        </li>

    </ul>

    <ul class="navbar-nav  ">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{count(\App\Models\Reminder::faturaHatirlatici())}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


                @if(count(\App\Models\Reminder::faturaHatirlatici())!=0)
                    <span class="dropdown-item dropdown-header">{{count(\App\Models\Reminder::faturaHatirlatici())}} Bildirimin Var</span>
                    @foreach(\App\Models\Reminder::faturaHatirlatici() as $k=>$v)
                        <div class="dropdown-divider"></div>
                        <a href="{{$v['url']}}" class="dropdown-item">
                            <i class="fas fa-file-invoice mr-2"></i>
                            {{$v['name']}} / {{$v['musteri']}}
                            <span class="float-right text-muted text-sm"> {{$v['fiyat']}} TL</span>
                        </a>
                    @endforeach
                @else
                    <span class="dropdown-item dropdown-header">Hiç Bildirimimiz Kalmadı </span>
                @endif

            </div>
        </li>
    </ul>

    <ul class="navbar-nav ">
        <li class="nav-item dropdown">


            <a data-toggle="dropdown" href="#" class="nav-link">
                {{\Auth::user()->name}}
                <img src="{{asset(\App\Models\User::getPhoto())}}" class="img-circle  " style="width: 35px;">
            </a>

            <div class="dropdown-menu  dropdown-menu-md  dropdown-menu-right">
                <a class="dropdown-item " href="{{route('profil.index')}}"> Profilim </a>
                <a class="dropdown-item" href="{{route('logout')}}"> <i class="fa fa-sign-out-alt"></i> Çıkış </a>

            </div>
        </li>

    </ul>


</nav>
<!-- /.navbar -->
