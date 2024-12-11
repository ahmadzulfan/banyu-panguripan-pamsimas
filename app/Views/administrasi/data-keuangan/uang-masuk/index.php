// VIEW: dana_masuk.php

<?= $this->extend('template/dashboard-admin2'); ?>
<?= $this->section('app') ?>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <h3>Data Dana Masuk</h3>
                            <p class="text-subtitle text-muted">Halaman untuk manajemen data pemasukan seperti melihat, mengubah, dan menghapus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#tambahDanaMasuk">
                                    <i class="bi bi-plus-circle"></i> Tambah Dana Masuk
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="dataTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah Masuk</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($danaMasuk as $key => $dana) : ?>
                                            <tr>
                                                <td><?= $key+1 ?></td>
                                                <td><?= tgl_indo($dana->tanggal_masuk) ?></td>
                                                <td><?= number_format($dana->jumlah_masuk, 0, '.', '.') ?></td>
                                                <td><?= $dana->keterangan ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteDanaMasuk(<?= $dana->id ?>)">  
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button> 
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDanaMasuk" tabindex="-1" aria-labelledby="tambahDanaMasukLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-body">
                        <h4>Tambah Dana Masuk</h4>
                        <div class="form-group">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input id="tanggal_masuk" type="date" class="form-control" name="tanggal_masuk" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_masuk">Jumlah Masuk</label>
                            <input type="text" class="form-control" name="jumlah_masuk" placeholder="Jumlah Masuk" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteDanaMasuk(id) {
            Swal.fire({
                title: "Apakah anda yakin ingin menghapus?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>data-keuangan/dana-masuk/delete/" + id,
                        success: function(result) {
                            Swal.fire({
                                allowOutsideClick: false,
                                title: "Deleted!",
                                text: "Data berhasil dihapus.",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire({
                                allowOutsideClick: false,
                                title: "Error!",
                                text: err.responseJSON.message,
                                icon: "warning"
                            });
                        }
                    });
                }
            });
        }
    </script>
<?= $this->endSection() ?>
