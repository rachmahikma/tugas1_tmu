<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tahun Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h4 class="mb-4 fw-bold">Daftar Tahun Diklat</h4>

  <!-- Flash Message -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
  <?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
  <?php endif; ?>

  <!-- ✅ Ganti ID dengan Nama Diklat & Jenis Diklat -->
    <div class="alert alert-info">
        <strong>Diklat:</strong> <?= $diklat_nama ?> <span class="text-muted">(<?= $jenis_diklat ?>)</span>
    </div>

  <!-- Form Tambah Tahun -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="post" action="<?= site_url('Diklat/tambah_tahun/' . $diklat_id) ?>">
        <div class="mb-3">
          <label for="tahun" class="form-label">Tahun</label>
          <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Contoh: 2025" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Tahun</button>
      </form>
    </div>
  </div>

  <!-- Tabel Tahun -->
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Tahun</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php $no = 1; foreach ($tahun_diklat as $row): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row->tahun) ?></td>
        <td>
          <a href="<?= site_url('Schedule/index/' . $row->tahun) ?>" class="btn btn-sm btn-info">Schedule</a>
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row->id ?>">Edit</button>
          <a href="<?= site_url('Diklat/hapus_tahun/' . $diklat_id . '/' . $row->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
      </tr>

      <!-- Modal Edit Tahun -->
      <div class="modal fade" id="editModal<?= $row->id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row->id ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= site_url('Diklat/update_tahun/' . $diklat_id) ?>">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?= $row->id ?>">Edit Tahun Diklat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" value="<?= $row->id ?>">
                <div class="mb-3">
                  <label for="tahun<?= $row->id ?>" class="form-label">Tahun</label>
                  <input type="text" class="form-control" id="tahun<?= $row->id ?>" name="tahun" value="<?= htmlspecialchars($row->tahun) ?>" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    <?php endforeach ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
