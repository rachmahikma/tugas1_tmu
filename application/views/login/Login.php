<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5" style="max-width: 400px;">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('login/proses') ?>">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>
            <div class="text-center mt-3">
                <a href="<?= base_url('register'); ?>">Belum punya akun? Register di sini</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
