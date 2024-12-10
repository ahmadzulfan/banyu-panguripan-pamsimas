<?= $this->extend('template/dashboard-admin2.php')?>
<?= $this->section('app') ?>
<?php
    helper('form');
    $this->authorize = service('authorization');
    $this->auth      = service('authentication');
?>
    <div class="row">
        <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12 col-md-21">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                <h3>Akun Saya</h3>
                                <p class="text-subtitle text-muted">Halaman untuk manajemen data kas minggu ini seperti melihat, mengubah dan
                                            menghapus.
                                </p>
                        </div>
                    </div>
                </div>
        <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                                <h5 class="card-title">Detail Akun Saya</h5>
                            </div>
                    <div class="card-body">
                        
                        <form method="post" class="forms-sample" action="<?= base_url() ?>profile/update/<?= $user->id ?>"> 
                            <?php if ($this->authorize->inGroup('Pelanggan', $this->auth->user()->id)) : ?>
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="<?= $user->nama ?>">
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Your username" value="<?= $user->username ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['username']) ? session()->getFlashdata('validation')['username'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" value="<?= $user->email ?>">
                                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['email']) ? session()->getFlashdata('validation')['email'] : '' ?></small>
                            </div>
                            <?php if ($this->authorize->inGroup('Pelanggan', $this->auth->user()->id)) : ?>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" value="<?= $user->no_telepon ?>">
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-danger alert-dismissible show fade">
                                <span class="fw-bold">Gagal, </span><?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?> 
                        <form method="post" class="forms-sample" action="<?= base_url() ?>resetpassword"> 
                            <div class="form-group my-2">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control" placeholder="Enter your current password"
                                    value="">
                                <small class="text-danger"><?= validation_show_error('current_password') ?></small>
                            </div>
                            <div class="form-group my-2">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter new password" value="">
                                <small class="text-danger"><?= validation_show_error('password') ?></small>
                            </div>
                            <div class="form-group my-2">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control" placeholder="Enter confirm password" value="">
                                <small class="text-danger"><?= validation_show_error('confirm_password') ?></small>
                            </div>

                            <div class="form-group my-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
<?= $this->endSection() ?>