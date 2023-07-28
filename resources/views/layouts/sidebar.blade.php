<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/dashboard" id="dashboard" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="surat-masuk" id="suratMasuk" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Surat Masuk</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="surat-keluar" id="suratKeluar" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Surat Keluar</p>
          </a>
        </li>
       
        <li class="nav-item">
          <a href="jenis-surat" id="jenisSurat" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Jenis Surat</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="arsip" id="arsip" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Arsip</p>
          </a>
        </li>
      
        
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  const getId = (id) => document.getElementById(id)

  const checkActiveMenu = () => {
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    const routePath = url.pathname;   // route name

    if (routePath === '/dashboard') {
      getId('dashboard').classList.add('active')
    } else if(routePath === '/surat-masuk') {
      getId('suratMasuk').classList.add('active')
    } else if (routePath === '/surat-keluar') {
      getId('suratKeluar').classList.add('active')
    } else if (routePath === '/jenis-surat') {
      getId('jenisSurat').classList.add('active')
    } else if (routePath === '/arsip') {
      getId('arsip').classList.add('active')
    }
  }
  checkActiveMenu()

</script>