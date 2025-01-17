<?= $this->extend('template/dashboard-admin2.php')?>
<?= $this->section('app') ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Input Pengguna Baru</h4>
                        <p class="card-description"> Harap Mengisikan data sesuai format </p>
                            <form method="post" class="forms-sample">
                            <?= csrf_field() ?>
                             <!-- Nomor Pelanggan -->
                             <div class="form-group">
                                <label for="nomor_pelanggan">Nomor Pelanggan</label>
                                <input type="text" class="form-control" name="nomor_pelanggan" value="<?= 'PLG-' . str_pad($last_id + 1, 5, '0', STR_PAD_LEFT) ?>" readonly>
                            </div>
                            <!-- Nama -->
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="nama" class="form-control" name="nama" placeholder="nama" value="<?= old('nama') ?>" required>
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['nama']) ? session()->getFlashdata('validation')['nama'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="alamat" class="form-control" name="alamat" placeholder="alamat" value="<?= old('alamat') ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['alamat']) ? session()->getFlashdata('validation')['alamat'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">No Telepon</label>
                                <input type="no_telepon" class="form-control" name="no_telepon" placeholder="no_telepon" value="<?= old('no_telepon') ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['no_telepon']) ? session()->getFlashdata('validation')['no_telepon'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="email" value="<?= old('email') ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['email']) ? session()->getFlashdata('validation')['email'] : '' ?></small>
                            </div>
                            <button type="save" class="btn btn-primary me-2">Simpan</button>
                            
                            </form>
                    </div>
                </div>
            </div>
        </div>
  </div>
<?= $this->endSection() ?>