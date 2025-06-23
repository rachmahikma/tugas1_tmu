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
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= site_url('login/logout') ?>" class="nav-link login-link">Logout</a>
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

                <!-- Dropdown Menu -->
                <div class="list-group-item">
                    <div class="dropdown">
                        <a class="dropdown-toggle text-decoration-none text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-book me-2"></i> Diklat
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= site_url('diklat') ?>"><i class="fa fa-book-open me-2"></i>Data Diklat</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('jenis_diklat') ?>"><i class="fa fa-layer-group me-2"></i>Jenis Diklat</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Selamat Datang di Portal Pendaftaran Diklat</h2>
            <p class="mb-4">Silakan gunakan menu di sebelah kiri untuk mengelola data diklat.</p>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
