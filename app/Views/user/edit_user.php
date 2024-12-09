<?= $this->extend('template/dashboard-admin2.php')?>
<?= $this->section('app') ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Data Pengguna</h4>
                            <form method="post" class="forms-sample">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="pelanggan_id">Pelanggan</label>
                                <input type="text" class="form-control" name="nama" placeholder="nama" value="<?= ($pelanggan->nama) ?? '' ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="alamat" class="form-control" name="alamat" placeholder="alamat" value="<?= old('alamat', ($pelanggan->alamat) ?? '') ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">No Telepon</label>
                                <input type="no_telepon" class="form-control" name="no_telepon" placeholder="no_telepon" value="<?= old('no_telepon', ($pelanggan->no_telepon) ?? '') ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="username" class="form-control" name="username" placeholder="username" value="<?= old('username', $user->username) ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['username']) ? session()->getFlashdata('validation')['username'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email (Optional)</label>
                                <input type="email" class="form-control" name="email" placeholder="email" value="<?= old('email', ($pelanggan->email) ?? $user->email) ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['email']) ? session()->getFlashdata('validation')['email'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password (Optional)</label>
                                <input type="password" class="form-control" name="password" placeholder="password" value="">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['password']) ? session()->getFlashdata('validation')['password'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Role</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role1" value="Bendahara" <?php if ($role['name'] == 'Bendahara') {
                                        echo 'checked';
                                    } ?>>
                                    <label class="form-check-label" for="role1">
                                        Bendahara
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role2" value="Petugas" <?php if ($role['name'] == 'Petugas') {
                                        echo 'checked';
                                    } ?>>
                                    <label class="form-check-label" for="role2">
                                        Petugas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role3" value="Pelanggan" <?php if ($role['name'] == 'Pelanggan') {
                                        echo 'checked';
                                    } ?>>
                                    <label class="form-check-label" for="role3">
                                        Pelanggan
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_aktif" value="1" <?php if ($user->active == 1) {
                                        echo 'checked';
                                    } ?>>
                                    <label class="form-check-label" for="status_aktif">
                                        Aktif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_nonaktif" value="0" <?php if ($user->active == 0) {
                                        echo 'checked';
                                    } ?>>
                                    <label class="form-check-label" for="status_nonaktif">
                                        Non-aktif
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            
                            <a href="<?= base_url()?>data-user" class="btn btn-light">Cancel</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
  </div>
<?= $this->endSection() ?>