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
                    <?php if (!$this->session->userdata('user')): ?>
                        <a href="<?= site_url('login') ?>" class="nav-link login-link">
                            <i class="fa fa-sign-in-alt me-1"></i> Login
                        </a>
                    <?php else: ?>
                        <a href="<?= site_url('login/logout') ?>" class="nav-link login-link">
                            <i class="fa fa-sign-out-alt me-1"></i> Logout
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Layout -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-light vh-100 p-3">
            <div class="list-group">
                <a href="<?= site_url('Dashboard') ?>" class="list-group-item list-group-item-action active">
                    <i class="fa fa-home me-2"></i> Beranda
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Selamat Datang di Portal Pendaftaran Diklat</h2>
            <p class="mb-4">Silakan lihat daftar diklat yang tersedia dan lakukan pendaftaran setelah login.</p>

            <!-- Info Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card text-bg-info text-center">
                        <div class="card-body">
                            <h4>25</h4>
                            <p class="mb-0">Diklat Tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-bg-success text-center">
                        <div class="card-body">
                            <h4>15</h4>
                            <p class="mb-0">Jenis Diklat</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-bg-warning text-center">
                        <div class="card-body">
                            <h4>100+</h4>
                            <p class="mb-0">Pendaftar Terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Diklat -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Diklat Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Diklat</th>
                                <th>Jenis</th>
                                <th>Durasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Diklat</td>
                                <td>Pengembangan</td>
                                <td>3 Hari</td>
                                <td><span class="badge bg-success">Tersedia</span></td>
                            </tr>
                            <tr>
                                <td>Diklat Dasar</td>
                                <td>Teknologi</td>
                                <td>5 Hari</td>
                                <td><span class="badge bg-success">Tersedia</span></td>
                            </tr>
                            <tr>
                                <td>Diklat Kelas</td>
                                <td>Pendidikan</td>
                                <td>2 Hari</td>
                                <td><span class="badge bg-warning text-dark">Segera Dibuka</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div> <!-- /.col-md-10 -->
    </div> <!-- /.row -->
</div> <!-- /.container-fluid -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
