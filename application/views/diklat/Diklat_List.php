<!DOCTYPE html>
<html>
<head>
  <title>Daftar Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <div class="d-flex justify-content-between mb-3">
    <h4>Daftar Diklat</h4>
    <a href="<?= site_url('Diklat/add') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Diklat</a>
  </div>

  <!-- Filter -->
  <form method="get" class="mb-3">
    <div class="input-group" style="max-width: 400px;">
      <select name="kategori" class="form-select">
        <option value="">Semua Kategori</option>
        <?php foreach ($kategori_list as $k): ?>
          <option value="<?= $k->id ?>" <?= ($this->input->get('kategori') == $k->id ? 'selected' : '') ?>>
            <?= $k->jenis_diklat ?>
          </option>
        <?php endforeach ?>
      </select>
      <button type="submit" class="btn btn-outline-primary"><i class="bi bi-funnel-fill"></i> Filter</button>
    </div>
  </form>

  <!-- Table -->
  <table class="table table-bordered table-hover align-middle">
    <thead class="table-light">
      <tr>
        <th>No.</th>
        <th>Kategori</th>
        <th>Kode/Nama Diklat</th>
        <th>Manage</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($diklat)): ?>
        <tr><td colspan="5" class="text-center">Data belum tersedia</td></tr>
      <?php else: ?>
        <?php $no = 1; foreach ($diklat as $d): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $d->jenis_diklat ?></td>
            <td><b>(<?= $d->kode_diklat ?>)</b> <?= $d->nama_diklat ?></td>
            <td>
              <a href="<?= site_url('Diklat/persyaratan/' . $d->id) ?>" class="btn btn-sm btn-warning">
                <i class="bi bi-list-task"></i> Persyaratan
              </a>
              <a href="<?= site_url('Diklat/tahun/' . $d->id) ?>" class="btn btn-sm btn-secondary">
                <i class="bi bi-calendar-event"></i> Tahun Diklat
              </a>
            </td>
            <td>
              <a href="<?= site_url('Diklat/edit/' . $d->id) ?>" class="btn btn-sm text-white" style="background-color: #7e22ce;">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="<?= site_url('Diklat/delete/' . $d->id) ?>" class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
  </table>
</div>
</body>
</html>
