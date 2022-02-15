<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Bildirimler</span>


                @if(count(\App\Models\Reminder::faturaHatirlatici())!=0)
                    @foreach(\App\Models\Reminder::faturaHatirlatici() as $k=>$v)
                        <div class="dropdown-divider"></div>
                        <a href="{{$v['url']}}" class="dropdown-item">
                            <i class="fas fa-file-invoice mr-2"></i>
                            {{$v['name']}} / {{$v['musteri']}}
                            <span class="float-right text-muted text-sm"> {{$v['fiyat']}} TL</span>
                        </a>
                    @endforeach
                @endif

            </div>
        </li>

        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#"> deneme </a>

            <div class="dropdown-menu  dropdown-menu-right">
                <a class="nav-link"   href="#"> deneme </a>
            </div>

        </li>

    </ul>
</nav>
<!-- /.navbar -->
