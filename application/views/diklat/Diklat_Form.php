<!DOCTYPE html>
<html>
<head>
  <title><?= isset($row) ? 'Edit' : 'Tambah' ?> Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
  <h4><?= isset($row) ? 'Edit' : 'Tambah' ?> Diklat</h4>

  <form method="post" action="<?= isset($row) ? site_url('Diklat/update/' . $row->id) : site_url('Diklat/insert') ?>">

    <!-- ID (hanya saat tambah) -->
    <?php if (!isset($row)) : ?>
    <div class="mb-3">
      <label>ID (unik)</label>
      <input type="text" name="id" class="form-control" required>
    </div>
    <?php endif; ?>

    <!-- Jenis Diklat (Dropdown) -->
    <div class="mb-3">
      <label>Jenis Diklat</label>
      <select name="jenis_diklat_id" class="form-select" required>
        <option value="">-- Pilih Jenis Diklat --</option>
        <?php foreach ($kategori_list as $k): ?>
          <option value="<?= $k->id ?>" <?= isset($row) && $row->jenis_diklat_id == $k->id ? 'selected' : '' ?>>
            <?= $k->jenis_diklat ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>

    <!-- Kode Diklat -->
    <div class="mb-3">
      <label>Kode Diklat</label>
      <input type="text" name="kode_diklat" class="form-control" value="<?= $row->kode_diklat ?? '' ?>" required>
    </div>

    <!-- Nama Diklat -->
    <div class="mb-3">
      <label>Nama Diklat</label>
      <input type="text" name="nama_diklat" class="form-control" value="<?= $row->nama_diklat ?? '' ?>" required>
    </div>

    <!-- Pemeriksaan Kesehatan -->
    <div class="mb-3">
      <label>Perlu Pemeriksaan Kesehatan?</label>
      <select name="check_kesehatan" class="form-select" required>
        <option value="1" <?= isset($row) && $row->check_kesehatan == 1 ? 'selected' : '' ?>>Ya</option>
        <option value="0" <?= isset($row) && $row->check_kesehatan == 0 ? 'selected' : '' ?>>Tidak</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('Diklat') ?>" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
