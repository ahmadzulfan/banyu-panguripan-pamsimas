<?= $this->extend('template/dashboard-admin2.php')?>
<?= $this->section('app') ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Input Pengguna Baru</h4>
                            <form method="post" class="forms-sample">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="pelanggan_id">Pelanggan</label>
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['pelanggan_id']) ? session()->getFlashdata('validation')['pelanggan_id'] : '' ?></small>
                                <select id="pelanggan_id" name="pelanggan_id" class="choices form-select m-0">
                                    <option value="">Cari pelanggan</option>
                                    <?php foreach ($pelanggan as $key => $value) : ?>
                                        <?php if ($value['id'] != old('pelanggan_id')) : ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $value['id'] ?>" selected><?= $value['nama'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="alamat" class="form-control" name="alamat" placeholder="alamat" value="<?= old('alamat') ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">No Telepon</label>
                                <input type="no_telepon" class="form-control" name="no_telepon" placeholder="no_telepon" value="<?= old('no_telepon') ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="username" class="form-control" name="username" placeholder="username" value="<?= old('username') ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['username']) ? session()->getFlashdata('validation')['username'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email (Optional)</label>
                                <input type="email" class="form-control" name="email" placeholder="email" value="<?= old('email') ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['email']) ? session()->getFlashdata('validation')['email'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Role</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role1" value="Bendahara">
                                    <label class="form-check-label" for="role1">
                                        Bendahara
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role2" value="Petugas">
                                    <label class="form-check-label" for="role2">
                                        Petugas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role3" value="Pelanggan" checked>
                                    <label class="form-check-label" for="role3">
                                        Pelanggan
                                    </label>
                                </div>
                            </div>
                            <button type="save" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
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
        const alamat = $('[name="alamat"]');
        const no_telepon = $('[name="no_telepon"]');
        const email = $('[name="email"]');

        $.ajax({
            method: 'POST',
            url: '<?= base_url() ?>ajax/data-pelanggan',
            data: {id: id_tagihan},
            success: function(response) {
                data = JSON.parse(response);
                alamat.val(data.alamat);
                no_telepon.val(data.no_telepon);
                email.val(data.email);
            }
        });

    });

  </script>
<?= $this->endSection() ?>