<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Pendaftaran Diklat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h3>Form Pendaftaran Diklat</h3>
    <form method="post" action="<?php echo site_url('pendaftaran/simpan'); ?>">
        <div class="mb-3">
            <label for="diklat_id" class="form-label">Pilih Diklat</label>
            <select name="diklat_id" id="diklat_id" class="form-select" required>
                <option value="">-- Pilih Diklat --</option>
                <?php foreach($list_diklat as $d): ?>
                    <option value="<?php echo $d->id; ?>"><?php echo $d->nama_diklat; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tahun_id" class="form-label">Pilih Tahun</label>
            <select name="tahun_id" id="tahun_id" class="form-select" required>
                <option value="">-- Pilih Tahun --</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jadwal_id" class="form-label">Pilih Jadwal</label>
            <select name="jadwal_id" id="jadwal_id" class="form-select" required>
                <option value="">-- Pilih Jadwal --</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
<script>
$(function(){
    $('#diklat_id').change(function(){
        var diklat_id = $(this).val();
        $('#tahun_id').html('<option value="">-- Pilih Tahun --</option>');
        $('#jadwal_id').html('<option value="">-- Pilih Jadwal --</option>');
        if(diklat_id) {
            $.getJSON('<?php echo site_url('pendaftaran/get_tahun/'); ?>'+diklat_id, function(data){
                $.each(data, function(i, item){
                    $('#tahun_id').append('<option value="'+item.id+'">'+item.tahun+'</option>');
                });
            });
        }
    });
    $('#tahun_id').change(function(){
        var tahun_id = $(this).val();
        $('#jadwal_id').html('<option value="">-- Pilih Jadwal --</option>');
        if(tahun_id) {
            $.getJSON('<?php echo site_url('pendaftaran/get_jadwal/'); ?>'+tahun_id, function(data){
                $.each(data, function(i, item){
                    $('#jadwal_id').append('<option value="'+item.id+'">'+item.nama_jadwal+' ('+item.tanggal+')</option>');
                });
            });
        }
    });
});
</script>
</body>
</html>
