<!DOCTYPE html>
<html>
<head>
  <title>Daftar Jenis Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .btn-purple {
      background-color: #7e22ce;
      color: white;
    }
    .btn-purple:hover {
      background-color: #6b21a8;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="d-flex justify-content-between mb-3">
    <h4>Daftar Jenis Diklat</h4>
    <a href="<?= site_url('JenisDiklat/add') ?>" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Add Jenis Diklat
    </a>
  </div>

  <table class="table table-hover table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th style="width: 50px;">No.</th>
        <th>Jenis Tarif</th>
        <th style="width: 150px;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($jenis_diklat)): ?>
        <tr><td colspan="3" class="text-center">Data belum tersedia</td></tr>
      <?php else: ?>
        <?php $no = 1; foreach ($jenis_diklat as $jd): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $jd->jenis_diklat ?></td>
            <td>
              <a href="<?= site_url('JenisDiklat/edit/' . $jd->id) ?>" class="btn btn-sm btn-purple">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="<?= site_url('JenisDiklat/delete/' . $jd->id) ?>" class="btn btn-sm btn-danger">
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
