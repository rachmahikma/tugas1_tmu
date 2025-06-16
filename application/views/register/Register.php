<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5" style="max-width: 500px;">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center mb-4">Registrasi</h3>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('register/proses') ?>" method="post">
                <div class="mb-3">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tipe</label>
                    <select name="type" class="form-control" required>
                        <option value="A">Admin</option>
                        <option value="OL">Operator Loket</option>
                        <option value="OK">Operator Kesehatan</option>
                        <option value="OP">Operator Pelatihan</option>
                        <option value="OA">Operator Akademik</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Daftar</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
