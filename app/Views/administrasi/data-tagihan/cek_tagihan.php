<?= $this->extend('template/main.php') ?>
<?= $this->section('app') ?>
<?php
	$lblmonths = date('m');
	$lbyears = date('Y');
    $months = array (1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mai',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
	if (!empty($_REQUEST['month']) && !empty($_REQUEST['year'])) {
		$lblmonths = $_REQUEST['month'];
		$lbyears = $_REQUEST['year'];
	}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Hasil Pengecekan Tagihan</h4>
                    <p class="card-description">Nomor Pelanggan: <strong><?= $pelanggan['nomor_pelanggan'] ?></strong></p>
                    <p class="card-description">Nama Pelanggan: <strong><?= $pelanggan['nama'] ?></strong></p>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> bulan </th>
                                    <th> Tahun </th>
                                    <th> Jumlah Pemakaian </th>
                                    <th> Total Tagihan </th>
                                    <th> Status</th>
                                    <th> Cetak Struk</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($tagihan as $key => $value) : ?>
                                    <tr>
                                        <td> <?= $key+1 ?> </td>
                                        <td> <?= $months[(int)$value['bulan']] ?> </td>
                                        <td> <?= $value['tahun'] ?> </td>
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
                                        <?php if ($value['status'] == 'dibayar') : ?>
                                            <a href="<?= base_url() ?>data-laporan/struk/<?=$value['id']?>" target="_blank" class="btn btn-primary">
											<i class="bi bi-printer"></i> Cetak Struk
										    </a> 
                                            
                                            <?php endif; ?>
                                        <?php endforeach; ?>
									</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <a href="<?= base_url('check') ?>" class="btn btn-secondary mt-3">Cek Tagihan Lain</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
