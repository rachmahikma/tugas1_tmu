<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Persyaratan Diklat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h4 class="mb-4 fw-bold">Persyaratan Diklat</h4>
        <div class="alert alert-info"><strong>ID Diklat:</strong> <?= $diklat_id ?></div>

        <div class="row">
            <!-- Template Persyaratan -->
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-white fw-semibold">Template Persyaratan</div>
                    <div class="card-body">
                        <input type="text" id="searchTemplate" class="form-control mb-3" placeholder="Cari persyaratan...">
                        <div id="listTemplate">
                            <?php foreach ($template_persyaratan as $p): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2 template-item" id="item-<?= $p->id ?>">
                                    <span class="persyaratan-text"><?= $p->persyaratan ?></span>
                                    <button class="btn btn-sm btn-primary btn-tambah" data-id="<?= $p->id ?>">Tambahkan</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Persyaratan Dipilih -->
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header text-white fw-semibold bg-primary">Persyaratan yang Dipilih</div>
                    <div class="card-body" id="listDipilih">
                        <?php if (empty($persyaratan_dipilih)): ?>
                            <div class="text-muted fst-italic">Belum ada persyaratan yang dipilih.</div>
                        <?php else: ?>
                            <?php foreach ($persyaratan_dipilih as $p): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="persyaratan-text"><?= $p->persyaratan ?></span>
                                    <a href="<?= site_url('Diklat/hapus_persyaratan/' . $diklat_id . '/' . $p->id) ?>" class="btn btn-sm btn-danger btn-hapus" data-id="<?= $p->id ?>">Hapus</a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('searchTemplate');
            const list = document.getElementById('listTemplate');

            input.addEventListener('input', function() {
                const keyword = this.value.toLowerCase();
                const items = Array.from(list.children); // semua .template-item

                // Pisahkan jadi cocok dan tidak cocok
                const matched = [];
                const unmatched = [];

                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    (keyword && text.includes(keyword) ? matched : unmatched).push(item);
                });

                // Susun ulang DOM: cocok di atas, tidak cocok di bawah
                list.innerHTML = '';
                matched.concat(unmatched).forEach(item => list.appendChild(item));
            });
        });
    </script>


    <!-- Tambah Persyaratan Script -->
    <script>
        $(document).on('click', '.btn-tambah', function() {
            const persyaratanID = $(this).data('id');
            const diklatID = '<?= $diklat_id ?>';

            $.ajax({
                url: '<?= site_url('Diklat/ajax_tambah_persyaratan') ?>',
                type: 'POST',
                data: {
                    diklat_id: diklatID,
                    persyaratan_id: persyaratanID
                },
                success: function(res) {
                    console.log(res);
                    const data = JSON.parse(res);

                    // Hapus teks default jika ada
                    $('#listDipilih .text-muted').remove();

                    // Tambahkan item ke daftar dipilih
                    $('#listDipilih').append(`
                    <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="persyaratan-text">${data.persyaratan}</span>
                    <a href="<?= site_url('Diklat/hapus_persyaratan/') ?>${diklatID}/${data.id}" class="btn btn-sm btn-danger btn-hapus" data-id="${data.id}">Hapus</a>
                    </div>
                    `);

                    // Hapus dari daftar template
                    $('#item-' + persyaratanID).remove();
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();

            const url = $(this).attr('href');
            const container = $(this).closest('.d-flex');
            const persyaratanText = container.find('.persyaratan-text').text(); // ambil teks
            const diklatID = '<?= $diklat_id ?>';
            const persyaratanID = $(this).data('id'); // ambil ID

            $.get(url, function(response) {
                const res = typeof response === 'string' ? JSON.parse(response) : response;

                if (res.status === 'deleted') {
                    container.remove();

                    // Tambahkan kembali ke template (kolom kiri)
                    $('#listTemplate').prepend(`
                    <div class="d-flex justify-content-between align-items-center mb-2 template-item" id="item-${res.id}">
                    <span class="persyaratan-text">${res.persyaratan}</span>
                    <button class="btn btn-sm btn-primary btn-tambah" data-id="${res.id}">Tambahkan</button>
                    </div>
                    `);


                    if ($('#listDipilih .d-flex').length === 0) {
                        $('#listDipilih').html('<div class="text-muted fst-italic">Belum ada persyaratan yang dipilih.</div>');
                    }
                }
            });

        });
    </script>


</body>

</html>
