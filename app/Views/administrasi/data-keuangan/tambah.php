<?= $this->extend('template/dashboard-admin2'); ?>
<?= $this->section('app') ?>
<?php
    helper('form');
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <?php if (!empty(validation_list_errors())) : ?>
                    <div class="alert alert-danger alert-dismissible show fade">
                        <span class="fw-bold">Gagal, </span> harap masukan informasi yang diperlukan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger alert-dismissible show fade">
                        <span class="fw-bold">Gagal, </span><?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Input Tagihan</h4>
                            <form method="post">
                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <input id="bulan" type="date" class="form-control" name="bulan" placeholder="bulan" value="<?= date('Y-m-d') ?>">
                                </div>
                               
                                <div class="form-group">
                                    <label for="pemakaian_bulan_lalu">input nominal</label>
                                    <small class="text-danger">*<?= validation_show_error('pemakaian_bulan_lalu') ?></small>
                                    <input id="pemakaian_bulan_lalu" type="number" class="form-control" name="pemakaian_bulan_lalu" placeholder="pemakaian_bulan_lalu" value="<?= old('pemakaian_bulan_lalu') ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="pemakaian_bulan_ini"> Keterangan</label>
                                    <small class="text-danger">*<?= validation_show_error('pemakaian_bulan_ini') ?></small>
                                    <input id="pemakaian_bulan_ini" type="number" class="form-control" name="pemakaian_bulan_ini" placeholder="pemakaian_bulan_ini" value="<?= old('pemakaian_bulan_ini') ?>">
                                </div>
                                                             
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>

    $(document).on('change', '#pelanggan_id', function(e) {
        const id_tagihan = $(this).val();

        $.ajax({
            method: 'POST',
            url: '<?= base_url() ?>ajax/data-tagihan',
            data: {id: id_tagihan},
            success: function(response) {
                if (response !== 'null') {
                    data = JSON.parse(response);
                    $('#pemakaian_bulan_lalu').val(data.pembacaan_akhir);
                }else{
                    $('#pemakaian_bulan_lalu').val(0);
                }
                $('#pemakaian_bulan_ini').val('');
                $('#total_pemakaian').val('');
                $('#total_tagihan').val('');
                $('#total_tagihan_tampil').val('');
            }
        });

    });

    $(document).on('change', '#pemakaian_bulan_ini', function(e) {

        const biaya_admin = parseInt($('#biaya_admin').val());
        const biaya_perm = parseInt($('#biaya_perm').val());
        const pemakaian_bulan_ini = parseInt($('#pemakaian_bulan_ini').val());
        const pemakaian_bulan_lalu = parseInt($('#pemakaian_bulan_lalu').val());

        let totalPemakaian = pemakaian_bulan_ini - pemakaian_bulan_lalu;
        let totalTagihan = totalPemakaian * biaya_perm + biaya_admin;

        $('#total_pemakaian').val(totalPemakaian);
        $('#total_tagihan').val(totalTagihan);
        $('#total_tagihan_tampil').val('Rp '+ totalTagihan);

    });

  </script>
<?= $this->endSection() ?>