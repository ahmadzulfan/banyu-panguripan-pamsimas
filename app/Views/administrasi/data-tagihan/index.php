<?= $this->extend('template/dashboard-admin2.php') ?>
<?= $this->section('app') ?>

    <?php
        $months = array (1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mai',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
    ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url() ?>data-tagihan/tambah">
                                <button type="button" class="btn btn-primary btn-sm mb-3" z>
                                    <i class="bi bi-plus-circle"></i> Tambah Tagihan 
                                </button>
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Nama </th>
                                    <th> bulan </th>
                                    <th> Jumlah Pemakaian </th>
                                    <th> Total Tagihan </th>
                                    <th> Status</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tagihan as $key => $value) : ?>
                                    <tr>
                                        <td> <?= $key+1 ?> </td>
                                        <td> <?= $value['nama'] ?> </td>
                                        <td> <?= $months[(int)$value['bulan']] ?> </td>
                                        <td> <?= $value['jumlah_pemakaian'] ?> m³ </td>
                                        <td> Rp <?= number_format($value['total_tagihan'], 0, '.', '.') ?> </td>
                                        <td>
                                            <?php if ($value['status'] == 'belum_dibayar') : ?>
                                                <span class="badge rounded-pill text-bg-danger text-white"><?= $value['status'] ?></span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill text-bg-success text-white"><?= $value['status'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td> 
                                            <button id="btn-detail" type="button" class="btn btn-primary btn-sm" 
                                                    data-id="<?= $value['id_tagihan'] ?>" 
                                                    data-pelanggan_id="<?= $value['pelanggan_id'] ?>" 
                                                    data-status="<?= $value['status'] ?>" 
                                                    data-nama="<?= $value['nama'] ?>"
                                                    data-tagihan="Rp <?= number_format($value['total_tagihan'], 0, '.', '.') ?>" 
                                                    data-pemakaian="<?= $value['jumlah_pemakaian'] ?> m³"
                                                    data-admin="Rp <?= number_format(2000, 0, '.', '.') ?>"
                                                    data-biayaperm="Rp <?= number_format(1000, 0, '.', '.') ?>/m³">
                                                    <i class="bi bi-info-circle"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteTagihan(<?= $value['id_tagihan'] ?>)">  
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

    <!-- Modal -->
    <div class="modal fade" id="detailTagihan" tabindex="-1" aria-labelledby="detailTagihanLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-body">
                <h4>Detail Tagihan</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <td scope="row">Nama Pelanggan</th>
                            <td id="nama">Mark</td>
                        </tr>
                        <tr>
                            <td scope="row">Biaya Admin</th>
                            <td id="biaya_admin">Jacob</td>
                        </tr>
                        <tr>
                            <td scope="row">Status Tagihan</th>
                            <td id="status">Jacob</td>
                        </tr>
                        <tr>
                            <td scope="row">Biya Pemakaian</th>
                            <td id="biaya_pemakaian">Jacob</td>
                        </tr>
                        <tr>
                            <td scope="row">Jumlah Pemakaian</th>
                            <td id="pemakaian">Jacob</td>
                        </tr>
                        <tr>
                            <td scope="row">Total Tagihan</th>
                            <td id="tagihan">Jacob</td>
                        </tr>
                    </tbody>
                </table>
                <div id="detail-tagihan"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-cicil" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cicilBayar">
                    Cicil Bayar
                </button>
                <form id="form-bayar" method="post">
                    <button type="submit" class="btn btn-primary">Lunasi</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Cicil Bayar Modal -->
    <div class="modal fade" id="cicilBayar" tabindex="-1" aria-labelledby="cicilBayarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-body">
            <form action="<?= base_url() ?>data-tagihan/bayar-debt" id="form-cicil" method="post">
                <input type="number" name="tagihan_id" class="form-control" required>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                    <input type="number" name="jumlah_bayar" class="form-control" placeholder="Jumlah bayar..." required>
                </div>
                <div class="d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    const months = ['Januari','Februari','Maret','April','Mai','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    function numberFormat(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
<script>
    $(document).on('click', '#btn-detail', function(e) {
        data = $(this).data();
        pelangganId = data.pelanggan_id;
        tagihanId = data.id;
        $('#nama').html(data.nama);
        $('#pemakaian').html(data.pemakaian);
        $('#tagihan').html(data.tagihan);
        $('#status').html(data.status);
        $('#biaya_admin').html(data.admin);
        $('#biaya_pemakaian').html(data.biayaperm);
        $('#form-bayar').attr('action', '<?= base_url() ?>data-tagihan/bayar/'+tagihanId);
        $('input[name="pelanggan_id"]').val(tagihanId);

        if (data.status == 'belum_dibayar') {
            $('#form-bayar').removeClass('d-none');
            $('#btn-cicil').removeClass('d-none');
        }else{
            $('#form-bayar').addClass('d-none');
            $('#btn-cicil').addClass('d-none');
        }

        getAllTagihanByPelangganId(pelangganId, tagihanId);

        $('#detailTagihan').modal('show');
    });

    $('#form-bayar').on('submit',function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Yakin ingin menyelesaikan tagihan untuk pembayaran ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, selesaikan!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#form-bayar').submit();
            }
        });
    })

    function deleteTagihan(id)
    {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>data-tagihan/delete/"+id,
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

    function bayarPelunasan(id)
    {
        Swal.fire({
            title: "Are you sure?",
            text: "Apakah anda yakin ingin melunasi tagihan ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>data-tagihan/bayar/"+id,
                    success: function(result){
                        Swal.fire({
                            allowOutsideClick: false,
                            title: "Pembayaran Berhasil!",
                            text: "Tagihan berhasil di lunasi.",
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

    function getAllTagihanByPelangganId(pelanggan_id, tagihan_id)
    {
        let html = `<h4>Daftar Tagihan Sebelumnya</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Bulan</th>
                                <th scope="col">Jumlah Tagihan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>`;

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>ajax/data-tagihan/getbyidpelanggan",
            data:{
                pelanggan_id,
                tagihan_id
            },
            success: function(result){
                datas = JSON.parse(result);
                if (datas.length > 0) {
                    datas.forEach((data, i) => {
                        html += `<tr>
                                    <th scope="row">${i+1}</th>
                                    <td>${months[parseInt(data.bulan) - 1]}</td>
                                    <td>Rp${numberFormat(parseInt(data.total_tagihan))}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="bayarPelunasan(${data.id})">  
                                            <i class="bi bi-credit-card"></i>
                                        </button> 
                                    </td>
                                </tr>`;
                    });
                    html += `</tbody></table>`;
                }else{
                    html += `<tr class="text-center">
                                <td colspan="4">tidak ada data tagihan.</td>
                            </tr>`;
                }

                $('#detail-tagihan').html(html);
            },
            error:function(err){
                alert(err)
            }
        })
    }

</script>
<?= $this->endSection() ?>