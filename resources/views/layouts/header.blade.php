@guest
                  
@else
  <header class="main-header">
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><b>SION</b>CELL</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            
            <li><a href="{{ url('/') }}">Dashboard <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Penjualan <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ta-penjualan/new-transaction') }}">Penjualan Baru</a></li>
                <li><a href="{{ url('ta-penjualan/index') }}">Data Penjualan</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Pembelian <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ta-pembelian/new-transaction') }}">Pembelian Baru</a></li>
                <li><a href="{{ url('ta-pembelian/index') }}">Data Pembelian</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Barang <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ref-barang/index') }}">Data Barang</a></li>
                <li><a href="{{ url('ref-kategori/index') }}">Kategori Barang</a></li>
              </ul>
            </li>
            <li><a href="{{ url('ref-pelanggan/index') }}">Pelanggan</a></li>
            <li><a href="{{ url('ref-distributor/index') }}">Distributor</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Laporan <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('laporan/history-stok') }}">History Stok</a></li>
                <li><a href="{{ url('laporan/penjualan') }}">Laporan Penjualan</a></li>
                <li><a href="{{ url('laporan/pembelian') }}">Laporan Pembelian</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{('/adminlte/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                <span class="hidden-xs">Admin</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="{{('/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                  <p>
                    Admin
                    <small>SION CELL</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}" class="btn btn-flat btn-danger" 
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->

      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
@endguest