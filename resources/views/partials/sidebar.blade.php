<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">General</li>
      <li class="nav-item">
          <a class="nav-link" href="{{ url('categories') }}">
              <i class="fa fa-bars menu-icon"></i>
              <span class="menu-title">Kategori</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ url('products') }}">
              <i class="fa fa-cubes menu-icon"></i>
              <span class="menu-title">Produk</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.transaksi') }}">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">Transaksi</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
            <i class="menu-icon mdi mdi-file-document"></i>
            <span class="menu-title">Laporan</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="reports">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reports.sales') }}">Laporan Penjualan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reports.stock') }}">Laporan Stok</a>
                </li>
            </ul>
        </div>
    </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">
              <i class="menu-icon mdi mdi-logout"></i>
              <span class="menu-title">Logout</span>
          </a>
      </li>
    </ul>
  </nav>