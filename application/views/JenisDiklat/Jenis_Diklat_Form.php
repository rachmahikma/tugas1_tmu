<!DOCTYPE html>
<html>
<head>
  <title><?= isset($row) ? 'Edit' : 'Tambah' ?> Jenis Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
  <h4><?= isset($row) ? 'Edit' : 'Tambah' ?> Jenis Diklat</h4>

  <form method="post" action="<?= isset($row) ? site_url('JenisDiklat/update/' . $row->id) : site_url('JenisDiklat/insert') ?>">

    <?php if (!isset($row)) : ?>
    <div class="mb-3">
      <label>ID (unik)</label>
      <input type="text" name="id" class="form-control" required>
    </div>
    <?php endif; ?>

    <!-- Dropdown Jenis Diklat -->
    <div class="mb-3">
      <label>Jenis Diklat</label>
      <select name="jenis_diklat" class="form-select" required>
        <option value="">-- Pilih Jenis Diklat --</option>
        <?php foreach ($dropdown_jenis as $j): ?>
          <option value="<?= $j->jenis_diklat ?>" <?= isset($row) && $row->jenis_diklat == $j->jenis_diklat ? 'selected' : '' ?>>
            <?= $j->jenis_diklat ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>

    <!-- Category -->
    <div class="mb-3">
      <label>Category</label>
      <input type="text" name="category" class="form-control" value="<?= $row->category ?? '' ?>" required>
    </div>

    <!-- Sorting -->
    <div class="mb-3">
      <label>Sorting</label>
      <input type="number" name="sorting" class="form-control" value="<?= $row->sorting ?? '' ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('JenisDiklat') ?>" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
