<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Portal Pendaftaran Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    .login-link {
      color: #007bff;
      font-weight: 500;
      text-decoration: none;
      padding: 8px 12px;
      border-radius: 5px;
      transition: all 0.2s ease-in-out;
    }
    .sidebar .nav-link {
      color: #000;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link:focus {
      background-color: #e9ecef;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand text-primary fw-bold" href="#">Portal Pendaftaran Diklat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center gap-3">
        <?php
        $namaPengguna = $this->session->userdata('nama') ?? 'User';
        $inisial = strtoupper(substr($namaPengguna, 0, 1));
        ?>
        <!-- Avatar Profil dengan Inisial -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px; font-size: 16px;">
              <?= $inisial ?>
            </div>
            <span class="d-none d-sm-inline fw-semibold"><?= $namaPengguna ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><i class="fa fa-user me-2"></i> Profil Saya</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= site_url('login/logout') ?>" id="logout-link"><i class="fa fa-sign-out-alt me-2"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Layout -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 bg-light vh-100 p-3 sidebar">
      <div class="list-group">
        <a href="<?= site_url('dashboard') ?>" class="list-group-item list-group-item-action active">
          <i class="fa fa-home me-2"></i> Beranda
        </a>

        <!-- Dropdown Menu: Data Master -->
        <div class="list-group-item px-0">
          <a class="d-flex justify-content-between align-items-center text-decoration-none text-dark px-3 py-2"
             data-bs-toggle="collapse" href="#submenuMaster" role="button" aria-expanded="false" aria-controls="submenuMaster" id="toggleMasterMenu">
            <div><i class="fa fa-book me-2"></i> Data Master</div>
            <i class="fa fa-chevron-down" id="masterMenuIcon"></i>
          </a>

          <div class="collapse" id="submenuMaster">
            <div class="list-group list-group-flush">
              <a class="list-group-item list-group-item-action border-0 ps-5" href="<?= site_url('diklat') ?>">
                <i class="fa fa-book-open me-2"></i> Diklat
              </a>
              <a class="list-group-item list-group-item-action border-0 ps-5" href="<?= site_url('jenisdiklat') ?>">
                <i class="fa fa-layer-group me-2"></i> Jenis Diklat
              </a>
              <a class="list-group-item list-group-item-action border-0 ps-5" href="<?= site_url('Persyaratan') ?>">
                <i class="fa fa-list-check me-2"></i> Persyaratan
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-10 p-4">
      <h2 class="mb-4">Selamat Datang di Portal Pendaftaran Diklat</h2>
      <p class="mb-4">Silakan gunakan menu di sebelah kiri untuk mengelola data diklat.</p>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ✅ Konfirmasi Logout -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const logoutLink = document.getElementById("logout-link");
    logoutLink.addEventListener("click", function (e) {
      const confirmLogout = confirm("Apakah Anda yakin ingin logout?");
      if (!confirmLogout) {
        e.preventDefault();
      }
    });

    const submenu = document.getElementById("submenuMaster");
    const icon = document.getElementById("masterMenuIcon");

    submenu.addEventListener("show.bs.collapse", () => {
      icon.classList.remove("fa-chevron-down");
      icon.classList.add("fa-chevron-up");
    });

    submenu.addEventListener("hide.bs.collapse", () => {
      icon.classList.remove("fa-chevron-up");
      icon.classList.add("fa-chevron-down");
    });
  });
</script>

</body>
</html>
