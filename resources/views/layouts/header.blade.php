@guest
                  
@else

  <header class="main-header">
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><b>WELL</b>POS</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ url('/') }}">Dashboard <span class="sr-only">(current)</span></a></li>
            <!-- <li><a href="{{ url('ta-penjualan/new-transaction') }}">Point Of Sales/Kasir</a></li> -->
            <!-- <li><a href="{{ url('ta-penjualan/index') }}">Data Penjualan Barang</a></li> -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Penjualan Barang<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ta-penjualan/new-transaction') }}">Point Of Sales/Kasir</a></li>
                <li><a href="{{ url('ta-penjualan/index') }}">Data Penjualan Barang</a></li>
                <li><a href="{{ url('ta-penjualan/list-item-sold') }}">List Barang Terjual</a></li>
              </ul>
            </li>

           <!--  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Penjualan<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ url('ta-penjualan/new-transaction') }}">Point Of Sales</a></li>
                  <li><a href="{{ url('ta-penjualan/index') }}">Data Penjualan</a></li>
                </ul>
            </li> -->

 <!--            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Penjualan Pulsa<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ta-pulsa/tambah') }}">Tambah Baru</a></li>
                <li><a href="{{ url('ta-pulsa/index') }}">Data Penjualan Pulsa</a></li>
              </ul>
            </li> -->

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Penjualan Jasa<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ta-jasa/tambah') }}">Tambah Baru</a></li>
                <li><a href="{{ url('ta-jasa/index') }}">Data Penjualan Jasa</a></li>
              </ul>
            </li>

            <?php if (auth()->user()->role == 'admin'): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Pembelian Barang<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ta-pembelian/new-transaction') }}">Tambah Baru</a></li>
                <li><a href="{{ url('ta-pembelian/index') }}">Data Pembelian</a></li>
              </ul>
            </li>
            <?php endif ?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Barang <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ref-barang/index') }}">Data Barang</a></li>
                <li><a href="{{ url('ref-kategori/index') }}">Kategori Barang</a></li>
              </ul>
            </li>

            <?php if (auth()->user()->role == 'admin'): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Distributor <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('ref-distributor/tambah') }}">Tambah Baru</a></li>
                <li><a href="{{ url('ref-distributor/index') }}">Data Distributor</a></li>
              </ul>
            </li>
            <?php endif ?>

            <?php if (auth()->user()->role == 'admin'): ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Laporan <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <!-- <li><a href="{{ url('laporan/history-stok') }}">History Stok</a></li> -->
                    <li><a href="{{ url('laporan/penjualan') }}">Laporan Penjualan Barang</a></li>
                    <!-- <li><a href="{{ url('laporan/penjualan-pulsa') }}">Laporan Penjualan Pulsa</a></li> -->
                    <li><a href="{{ url('laporan/penjualan-jasa') }}">Laporan Penjualan Jasa</a></li>
                    <li><a href="{{ url('laporan/pembelian') }}">Laporan Pembelian Barang</a></li>
                  </ul>
                </li>
            <?php endif ?>

            <?php if (auth()->user()->role == 'admin'): ?>
              <li><a href="{{ url('user/index') }}">User</a></li>
            <?php endif ?>
            
          </ul>
        </div>
        <!-- /.navbar-collapse -->

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout ({{ auth()->user()->name }})
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            <!-- <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if (auth()->user()->role == 'admin'): ?>
                  <img src="{{('../adminlte/dist/img/avatar5.png')}}" class="user-image" alt="User Image">
                <?php else: ?>
                  <img src="{{('../adminlte/dist/img/avatar2.png')}}" class="user-image" alt="User Image">
                <?php endif ?>
                <span class="hidden-xs">{{ auth()->user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <?php if (auth()->user()->role == 'admin'): ?>
                    <img src="{{('../../adminlte/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
                  <?php else: ?>
                    <img src="{{('../../adminlte/dist/img/avatar2.png')}}" class="img-circle" alt="User Image">
                  <?php endif ?>
                  <p style="text-transform: uppercase;">
                    {{ auth()->user()->name }}
                    <small style="text-transform: capitalize;">{{ auth()->user()->role }}</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-success btn-flat">Change Password</a>
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
                </li> -->
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