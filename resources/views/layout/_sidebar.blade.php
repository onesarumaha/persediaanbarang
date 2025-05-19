<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
        <div class="navbar-wrapper ">
            <div class="navbar-brand header-logo" style="color:white">
                Inventory
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Menu</label>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Master</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{url('/user')}}" class="">User</a></li>
                            <li class=""><a href="{{url('/barang')}}" class="">Barang</a></li>
                            <li class=""><a href="{{url('/supplier')}}" class="">Supplier</a></li>
                            <li class=""><a href="{{url('/satuan')}}" class="">Satuan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Transaksi</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{url('/barang-keluar')}}" class="">Barang Keluar</a></li>
                            <li class=""><a href="{{url('/barang-masuk')}}" class="">Barang Masuk</a></li>
                        </ul>
                    </li>

                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Laporan</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{url('/barang-w')}}" class="">Barang Keluar</a></li>
                            <li class=""><a href="{{url('/barang-a')}}" class="">Barang Masuk</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
