<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/index.php">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category">Manajemen Data</li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url() ?>data-pelanggan">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Data Pelanggan</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url() ?>data-user">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Data User</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="menu-icon mdi mdi-card-text-outline"></i>
        <span class="menu-title">Administrasi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>data-tagihan">Data Tagihan</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>data-keuangan">Data Keuangan</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Pengaturan Administrasi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="charts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="../pages/charts/chartjs.html">ChartJs</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="menu-icon mdi mdi-table"></i>
        <span class="menu-title">Data Laporan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="../pages/tables/basic-table.html">Basic table</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>
