<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jadwal Diklat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h4 class="mb-4 fw-bold">
            Daftar Jadwal Diklat <?= !empty($tahun) ? 'Tahun ' . htmlspecialchars($tahun) : '' ?>
        </h4>

        <!-- ℹ️ Info Diklat -->
        <?php if (!empty($diklat_nama) && $diklat_nama !== '-'): ?>
            <div class="alert alert-info">
                <strong>Diklat:</strong> <?= htmlspecialchars($diklat_nama) ?>
                <?php if (!empty($jenis_diklat) && $jenis_diklat !== '-'): ?>
                    <span class="text-muted">(<?= htmlspecialchars($jenis_diklat) ?>)</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- 📊 Jumlah Data -->
        <div class="alert alert-secondary" style="font-size:14px;">
            <b>Jumlah Data Ditampilkan:</b> <?= isset($jadwal) ? count($jadwal) : 0 ?>
        </div>

        <!-- 📅 Tabel Jadwal -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama Diklat</th>
                    <th>Periode</th>
                    <th>Pelaksanaan Mulai</th>
                    <th>Pelaksanaan Akhir</th>
                    <th>Pendaftaran Mulai</th>
                    <th>Pendaftaran Akhir</th>
                    <th>Jumlah Kelas</th>
                    <th>Kuota</th>
                    <th>Sisa Kursi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($jadwal)): ?>
                    <tr>
                        <td colspan="10" class="text-center">Data tidak ditemukan</td>
                    </tr>
                <?php else:
                    $no = $start + 1;
                    foreach ($jadwal as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row->nama_diklat ?? '-') ?></td>
                            <td><?= htmlspecialchars($row->periode) ?></td>
                            <td><?= htmlspecialchars($row->pelaksanaan_mulai) ?></td>
                            <td><?= htmlspecialchars($row->pelaksanaan_akhir) ?></td>
                            <td><?= htmlspecialchars($row->pendaftaran_mulai) ?></td>
                            <td><?= htmlspecialchars($row->pendaftaran_akhir) ?></td>
                            <td><?= htmlspecialchars($row->jumlah_kelas) ?></td>
                            <td><?= isset($row->kuota) ? htmlspecialchars($row->kuota) : '-' ?></td>
                            <td><?= isset($row->sisa_kursi) ? htmlspecialchars($row->sisa_kursi) : '-' ?></td>
                        </tr>
                    <?php endforeach; endif; ?>
            </tbody>
        </table>

        <!-- 🔁 Pagination & Navigasi -->
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <div><?= $pagination ?></div>
            <?php
                $back_id = !empty($diklat_id) ? $diklat_id : ($jadwal[0]->diklat_id ?? null);
                if (!empty($back_id)):
            ?>
                <a href="<?= site_url('Diklat/tahun/' . $back_id) ?>" class="btn btn-secondary">
                    ← Kembali
                </a>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
