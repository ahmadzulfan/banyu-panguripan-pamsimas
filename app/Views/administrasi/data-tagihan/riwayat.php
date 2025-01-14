<?= $this->extend('template/dashboard-admin2.php') ?>
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
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-md-21">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                            <h3>Data Tagihan PAMSIMAS</h3>
                            <p class="text-subtitle text-muted">Halaman untuk manajemen data kas minggu ini seperti melihat, mengubah dan
                                        menghapus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
				<div class="card text-center">
					<div class="card-body">
						<form action="" method="GET">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group has-icon-left">
										<label for="year">Tahun:</label>
										<div class="position-relative">
											<select name="year" id="year" class="form-control">
												<?php for ($i=2024; $i<=date('Y'); $i++) : ?>
													<option value="<?= $i ?>" <?php if ($i == $lbyears) {
														echo 'selected';
													} ?>><?= $i ?></option>
												<?php endfor; ?>
											</select>
											<div class="form-control-icon">
												<i class="bi bi-calendar2-fill"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary px-5">Filter</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        
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
                                    <th> Cetak Struk</th>
                                   
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
                                        <?php if ($value['status'] == 'dibayar') : ?>
                                            <a href="<?= base_url() ?>data-laporan/struk/<?=$value['id_tagihan']?>" target="_blank" class="btn btn-primary">
											<i class="bi bi-printer"></i> Cetak Struk
										    </a> 
                                            
                                            <?php endif; ?>
										
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
    
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    const months = ['Januari','Februari','Maret','April','Mai','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    function numberFormat(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
<?= $this->endSection() ?>