@php
    $route=Route::currentRouteName();
    $one=@explode(".",$route)[0];
    $two=@explode(".",$route)[1];



@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("admin.dashboard")}}" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Web Çözüm Evi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Ara" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('dashboard')}}" class="nav-link {{$one=='dashboard'?"active":""}}">--}}
                {{--                        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
                {{--                        Dashboard--}}
                {{--                    </a>--}}
                {{--                </li>--}}


                <li class="nav-item {{$one=='musteriler'?" menu-is-opening menu-open":""}}">
                    <a href="#" class="nav-link {{$one=='musteriler'?"active":""}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Müşteriler <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>

                        </p>
                    </a>
                    <ul class="nav nav-treeview " style=" {{$one=='musteriler'?"display: block;":""}}">
                        <li class="nav-item ">
                            <a href="{{route('musteriler.create')}}" class="nav-link {{$two=='create'?"active":""}}">
                                <i class=" fas fa-shopping-cart  nav-icon"></i> Yeni Ekle</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('musteriler.index')}}" class="nav-link {{$two=='index'?"active":""}}">
                                <i class="fas fa-bars nav-icon"></i> Müşteri Listesi </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{$one=='kalem'?" menu-is-opening menu-open":""}}">
                    <a href="#" class="nav-link {{$one=='kalem'?"active":""}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Gelir & Gider Kalemi <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>

                        </p>
                    </a>
                    <ul class="nav nav-treeview " style=" {{$one=='kalem'?"display: block;":""}}">
                        <li class="nav-item ">
                            <a href="{{route('kalem.create')}}" class="nav-link {{$two=='create'?"active":""}}">
                                <i class=" fas fa-shopping-cart  nav-icon"></i>Yeni Ekle</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('kalem.index')}}" class="nav-link {{$two=='liste'?"index":""}}">
                                <i class="fas fa-bars nav-icon"></i>Listesi</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{$one=='islem'?" menu-is-opening menu-open":""}}">
                    <a href="#" class="nav-link {{$one=='islem'?"active":""}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>İşlemler<i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>

                        </p>
                    </a>
                    <ul class="nav nav-treeview " style=" {{$one=='islem'?"display: block;":""}}">
                        <li class="nav-item ">
                            <a href="{{route('islem.odeme')}}" class="nav-link {{$two=='odeme'?"active":""}}">
                                <i class=" fas fa-shopping-cart  nav-icon"></i>Ödeme Yap</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('islem.tahsilat')}}" class="nav-link {{$two=='tahsilat'?"active":""}}">
                                <i class="fas fa-bars nav-icon"></i>Tahsilat Al</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{$one=='fatura'?" menu-is-opening menu-open":""}}">
                    <a href="#" class="nav-link {{$one=='fatura'?"active":""}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Faturalar <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>

                        </p>
                    </a>
                    <ul class="nav nav-treeview " style=" {{$one=='fatura'?"display: block;":""}}">
                        <li class="nav-item ">
                            <a href="{{route('fatura.create',0)}}" class="nav-link {{$two=='create'?"active":""}}">

                                <i class=" fas fa-shopping-cart  nav-icon"></i>Yeni Gelir Ekle</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('fatura.create',1)}}" class="nav-link {{$two=='create'?"active":""}}">

                                <i class=" fas fa-shopping-cart  nav-icon"></i>Yeni Gider Ekle</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('fatura.index')}}" class="nav-link {{$two=='index'?"active":""}}">
                                <i class="fas fa-bars nav-icon"></i>Listesi</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{$one=='banka'?" menu-is-opening menu-open":""}}">
                    <a href="#" class="nav-link {{$one=='banka'?"active":""}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Bankalar <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>

                        </p>
                    </a>
                    <ul class="nav nav-treeview " style=" {{$one=='banka'?"display: block;":""}}">
                        <li class="nav-item ">
                            <a href="{{route('banka.yeni')}}" class="nav-link {{$two=='yeni'?"active":""}}">

                                <i class=" fas fa-shopping-cart  nav-icon"></i>Yeni Banka Ekle</a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('banka.liste')}}" class="nav-link {{$two=='liste'?"active":""}}">
                                <i class="fas fa-bars nav-icon"></i>Bankaları Listesi</a>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
