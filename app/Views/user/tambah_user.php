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
                                <label for="username">Username</label>
                                <input type="hidden" name="pelanggan_id" value="0">
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
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['role']) ? session()->getFlashdata('validation')['role'] : '' ?></small>
                            </div>
                            <button type="save" class="btn btn-primary me-2">Submit</button>
                            <a href="<?= base_url()?>data-user" class="btn btn-light">Cancel</a>
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