<?= $this->extend('template/dashboard-admin2.php') ?>
<?= $this->section('app') ?>
    <div class="content-wrapper">
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-md-21">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                        <h3>Data Pengguna PAMSIMAS</h3>
                        <p class="text-subtitle text-muted">Halaman untuk manajemen data kas minggu ini seperti melihat, mengubah dan
                                    menghapus.
                        </p>
                    </div>
                </div>
            </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="<?= base_url() ?>data-user/tambah">
                            <button type="button" class="btn btn-primary btn-sm mb-3">
                                <i class="bi bi-plus-circle"></i> Tambah Pelanggan 
                            </button>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Username </th>
                                <th> Email </th>
                                <th> Status </th>
                                <th> Role </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            use Myth\Auth\Models\GroupModel;
                            $groupModel = model(GroupModel::class);

                            foreach ($users as $key => $user) : ?>
                                <tr>
                                    <td> <?= $key+1 ?> </td>
                                    <td> <?= $user->username ?> </td>
                                    <td> <?= $user->email ?> </td>
                                    <td>
                                        <?php if ($user->active == 0) : ?>
                                            <span class="badge rounded-pill text-bg-danger text-white">non-aktif</span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill text-bg-success text-white">aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $groupModel->getGroupsForUser($user->id)[0]['name'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>data-user/edit/<?= $user->id ?>" type="button" class="btn btn-primary btn-sm" >
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser(<?= $user->id ?>)"> 
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
 function deleteUser(id)
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
                    url: "<?= base_url() ?>data-user/delete/"+id,
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
                        alert(err)
                    }
                })
            }
        });
    }
  </script>
<?= $this->endSection() ?>