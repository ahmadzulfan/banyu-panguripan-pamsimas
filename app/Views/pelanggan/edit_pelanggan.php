<?= $this->extend('template/dashboard-admin2.php')?>
<?= $this->section('app') ?>

    <div class="content-wrapper">
        <div class="row">
            
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Pelanggan </h4>
                        <p class="card-description"> form ini digunakan untuk mengedit data Pelanggan </p>
                            <form method="post" class="forms-sample" action="<?= base_url() ?>data-pelanggan/update/<?=$pelanggan['id']?>">
                            <div class="form-group">
                                <div class="form-group">
                                <label for="nomor_pelanggan">Nomor Pelanggan</label>
                                <input type="text" class="form-control" name="nomor_pelanggan" placeholder="Nomor Pelanggan" value="<?= old('nomor_pelanggan', $pelanggan['nomor_pelanggan']) ?>" readonly>
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['nomor_pelanggan']) ? session()->getFlashdata('validation')['nomor_pelanggan'] : '' ?></small>
                            </div>

                                <label for="nama">Nama</label>
                                <input type="nama" class="form-control" name="nama" placeholder="nama" value="<?= old('nama', $pelanggan['nama']) ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['nama']) ? session()->getFlashdata('validation')['nama'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="alamat" class="form-control" name="alamat" placeholder="alamat" value="<?= old('alamat', $pelanggan['alamat']) ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['alamat']) ? session()->getFlashdata('validation')['alamat'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">No Telepon</label>
                                <input type="no_telepon" class="form-control" name="no_telepon" placeholder="no_telepon" value="<?=old('no_telepon', $pelanggan['no_telepon'])?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['no_telepon']) ? session()->getFlashdata('validation')['no_telepon'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="email" value="<?=old('email', $pelanggan['email'])?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['email']) ? session()->getFlashdata('validation')['email'] : '' ?></small>
                            </div>
                            <button type="save" class="btn btn-primary me-2">Submit</button>
                            <a href="<?= base_url()?>data-pelanggan" class="btn btn-light">Cancel</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
  </div>
<?= $this->endSection() ?>