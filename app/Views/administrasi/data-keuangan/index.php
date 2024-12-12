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
                        <h3>Data Keuangan PAMSIMAS</h3>
                        <p class="text-subtitle text-muted">
							Halaman untuk manajemen data kas seperti melihat, mengubah dan menghapus.
                        </p>
                    </div>
                </div>
            </div>
			<div class="col-12">
				<div class="card">
					<div class="card-body px-3 py-4-4">
						<div class="d-flex justify-content-center gap-3">
							<div class="stats-icon">
								<i class="iconly-boldChart"></i>
							</div>
							<div>
								<h6 class="text-muted font-semibold">Dana Kas</h6>
								<h6 id="dana_kas" class="font-extrabold mb-0">
									Rp<?= number_format(0, 0, '.', '.') ?>
								</h6>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-6 col-lg-6 col-md-6">
				<div class="card">
					<div class="card-body px-3 py-4-4">
						<div class="row">
							<div class="col-md-4">
								<div class="stats-icon green">
									<i class="iconly-boldActivity"></i>
								</div>
							</div>
							<div class="col-md-8">
								<h6 class="text-muted font-semibold">Dana Masuk</h6>
								<h6 id="dana_masuk" class="font-extrabold mb-0">
								</h6>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-6 col-lg-6 col-md-6">
				<div class="card">
					<div class="card-body px-3 py-4-4">
						<div class="row">
							<div class="col-md-4">
								<div class="stats-icon red">
									<i class="iconly-boldActivity"></i>
								</div>
							</div>
							<div class="col-md-8">
								<h6 class="text-muted font-semibold">Dana Keluar</h6>
								<h6 id="dana_keluar" class="font-extrabold mb-0">
								</h6>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card text-center">
					<div class="card-header">
						<h4>Filter Data dengan Rentang Tanggal</h4>
					</div>
					<div class="card-body">
						<form action="" method="GET">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group has-icon-left">
										<label for="month">Bulan:</label>
										<div class="position-relative">
											<select name="month" id="month" class="form-control">
												<?php foreach ($months as $key => $month) : ?>
													<option value="<?= $key ?>" <?php if ($key == $lblmonths) {
														echo 'selected';
													} ?>><?= $month ?></option>
												<?php endforeach; ?>
											</select>
											<div class="form-control-icon">
												<i class="bi bi-calendar2-fill"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group has-icon-left">
										<label for="year">Tahun:</label>
										<div class="position-relative">
											<select name="year" id="year" class="form-control">
												<?php for ($i=2023; $i<=date('Y'); $i++) : ?>
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
						<div class="d-flex justify-content-end gap-2">
							<a href="<?= base_url() ?>data-keuangan/excel/export">
								<button type="button" class="btn btn-success btn-sm mb-3" z>
									<i class="bi bi-file-earmark-spreadsheet" style="font-size: 18px;"></i> Excel
								</button>
							</a>
							<a href="<?= base_url() ?>data-keuangan/pdf/export?month=<?= date('m') ?>&year=<?= date('Y') ?>" target="_blank">
								<button type="button" class="btn btn-danger btn-sm mb-3" z>
									<i class="bi bi-filetype-pdf" style="font-size: 18px;"></i> PDF
								</button>
							</a>
						</div>
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped">
							<thead>
								<tr>
									<th> No </th>
									<th> Tanggal Transaksi </th>
									<th> Periode </th>
									<th> Keterangan </th>
									<th> Uang Masuk </th>
									<th> Uang Keluar </th>
									<th> Sisa KAS</th>
								</tr>
							</thead>
							<?php $no=1; $danaKas=0; $totDanaMasuk = 0; $totDanaKeluar=0; $pendapatan = 0; foreach ($danaMasuk as $key => $dana) : ?>
								<?php 
									$d_keluar = 0;
									$totDanaMasuk += $dana['dana_masuk'];
									$danaKas += $dana['dana_masuk'];
								?>

							<tbody>
								
								<tr>
									<td><?= $no ?></td>
									<td><?= tgl_indo($dana['tanggal']) ?></td>
									<td><?= month_indo($dana['periode']) ?></td>
									<td>Pendapatan PAM bulan <?= month_indo($dana['periode']) ?></td>
									<td>Rp<?= number_format($dana['dana_masuk'], 0, '.', '.') ?></td>
									<td></td>
									<td>Rp<?= number_format($danaKas, 0, '.', '.') ?></td>
								</tr>
								<?php if (!empty($danaKeluar[$dana['periode']])) : ?>
									<?php foreach ($danaKeluar[$dana['periode']] as $key => $dk) : ?>
										<?php $d_keluar += $dk['dana_keluar']; $danaKas -= $dk['dana_keluar']; $no++;?>
										<tr>
											<td><?= $no ?></td>
											<td><?= tgl_indo($dk['tanggal']) ?></td>
											<td><?= month_indo($dana['periode']) ?></td>
											<td><?= $dk['keterangan'] ?></td>
											<td></td>
											<td>Rp<?= number_format($dk['dana_keluar'], 0, '.', '.') ?></td>
											<td>Rp<?= number_format($danaKas, 0, '.', '.') ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
								<?php 
									$pendapatanPerBulan = $dana['dana_masuk'] - $d_keluar;
									$pendapatan += $pendapatanPerBulan;
									$totDanaKeluar += $d_keluar; 
								?>
							</tbody>
							<?php $no++; endforeach; ?>
							<tfoot>
								<tr>
									<th colspan="2"></th>
									<th colspan="3">Dana KAS</th>
									<th id="total_pendapatan">Rp <?= number_format($pendapatan, 0, '.', '.') ?></th>
								</tr>
							</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
  	</div>

	<?php
	$dm = 'Rp '.number_format($totDanaMasuk, 0, '.', '.');
	$dk = 'Rp '.number_format($totDanaKeluar, 0, '.', '.');
	?>
	<script>
		const contentKas = document.getElementById('dana_kas');
		const contentMasuk = document.getElementById('dana_masuk');
		const contentKeluar = document.getElementById('dana_keluar');
		const total = document.getElementById('total_pendapatan').textContent;

		contentMasuk.innerHTML = '<?= $dm ?>';
		contentKeluar.innerHTML = '<?= $dk ?>';
		contentKas.innerHTML = total;
		
	</script>
<?= $this->endSection() ?>