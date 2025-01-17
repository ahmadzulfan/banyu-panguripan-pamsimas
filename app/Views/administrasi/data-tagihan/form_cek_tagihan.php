<?= $this->extend('template/main.php') ?>
<?= $this->section('app') ?>
<?php
    helper('form');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 mx-auto grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cek Tagihan Pelanggan</h4>
                    <p class="card-description">Masukkan nomor pelanggan untuk melihat tagihan</p>
                    
                    <?php if (session()->getFlashdata('error_message')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error_message') ?>
                        </div>
                    <?php endif; ?>

                    <form method="get" action="<?= base_url('cek-tagihan') ?>">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="nomor_pelanggan">Nomor Pelanggan</label>
                            <input type="text" name="nomor_pelanggan" class="form-control" placeholder="Masukkan nomor pelanggan" value="<?= old('nomor_pelanggan') ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cek Tagihan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
