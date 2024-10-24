<?= $this->extend('template/dashboard-admin2.php') ?>
<?= $this->section('app') ?>
    <div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="<?= base_url() ?>data-pelanggan/tambah">
                            <button type="button" class="btn btn-primary btn-sm mb-3" z>
                                <i class="bi bi-plus-circle"></i> Tambah Pelanggan 
                            </button>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> Alamat </th>
                                <th> No Telepon </th>
                                <th> Email </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pelanggan as $key => $value) : ?>
                                <tr>
                                    <td> <?= $key+1 ?> </td>
                                    <td> <?= $value['nama'] ?> </td>
                                    <td> <?= $value['alamat'] ?> </td>
                                    <td> <?= $value['no_telepon'] ?> </td>
                                    <td> <?= $value['email'] ?> </td>
                                    <td> 
                                        <?php if ($value['id_user'] == "") : ?>
                                            <form action="<?= base_url() ?>data-pelanggan/tambah-user/<?= $value['id'] ?>" method="post" class="d-inline">
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-person-plus"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <a href="<?= base_url() ?>data-pelanggan/edit/<?= $value['id'] ?>" type="button" class="btn btn-primary btn-sm" >
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deletePelanggan(<?= $value['id'] ?>)"> 
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

  <script>
    function deletePelanggan(id)
    {
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
                    url: "<?= base_url() ?>data-pelanggan/delete/"+id,
                    success: function(result){
                        Swal.fire({
                            allowOutsideClick: false,
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) location.reload();
                        });
                    },
                    error:function(err){
                        Swal.fire({
                            allowOutsideClick: false,
                            title: "Error!",
                            text: err.responseJSON.message,
                            icon: "warning"
                        });
                    }
                })
            }
        });
    }
  </script>
 
<?= $this->endSection() ?>