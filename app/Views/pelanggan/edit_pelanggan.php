<?= $this->extend('template/dashboard-admin2.php')?>
<?= $this->section('app') ?>

    <div class="content-wrapper">
        <div class="row">
            
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h1>tatat</h1>
                        <h4 class="card-title">Form Edit Pengguna </h4>
                        <p class="card-description"> Basic form layout </p>
                            <form method="post" class="forms-sample" action="<?= base_url() ?>data-pelanggan/update/<?=$pelanggan['id']?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="nama" class="form-control" name="nama" placeholder="nama" value="<?=$pelanggan['nama']?>">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="alamat" class="form-control" name="alamat" placeholder="alamat" value="<?=$pelanggan['alamat']?>">
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">No Telepon</label>
                                <input type="no_telepon" class="form-control" name="no_telepon" placeholder="no_telepon" value="<?=$pelanggan['no_telepon']?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="email" value="<?=$pelanggan['email']?>">
                            </div>
                            <button type="save" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
  </div>
<?= $this->endSection() ?>