
<ul class="navbar-nav bg-gradient-dark  sidebar sidebar-dark accordion toggled" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-briefcase"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Toko</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <div class="sidebar-heading mt-3">
      Kasir
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item" data-value="Transaksi">
      <a class="nav-link" href="{{url('/kasir')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Transaksi</span></a>
    </li>
    <li class="nav-item" data-value="Stock">
      <a class="nav-link" href="{{url('/stock')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Stock</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Divider -->
    

    <!-- Heading -->
    <div class="sidebar-heading">
      Barang
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item" data-value="Daftar Barang">
    <a class="nav-link collapsed" href="{{url('/barang')}}"  >
        <i class="fas fa-fw fa-cog"></i>
        <span>Daftar Barang</span>
      </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->

    <li class="nav-item" data-value="Tambah">
    <a class="nav-link collapsed" href=" " data-toggle="collapse" data-target="#collapsePages1" aria-expanded="false" aria-controls="collapsePages1">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Tambah</span>
      </a>
      <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{url('/barang/tambah')}}">Tambah Barang</a>
          <a class="collapse-item" href="{{url('/barang/kategori')}}">Tambah Kategori</a>            
        </div>
      </div>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item" data-value="Manipulasi">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Manipulasi</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Login Screens:</h6>

        <a class="collapse-item" href="{{url('manageakun')}}">Semua Akun</a>
          <a class="collapse-item" href="{{url('manageakun/register')}}">Register</a>
        
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>