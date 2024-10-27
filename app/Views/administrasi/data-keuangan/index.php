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
			<div class="col-12">
				<div class="card">
					<div class="card-body px-3 py-4-4">
						<div class="d-flex justify-content-center gap-3">
							<div class="stats-icon">
								<i class="iconly-boldChart"></i>
							</div>
							<div>
								<h6 class="text-muted font-semibold">Dana Kas</h6>
								<h6 class="font-extrabold mb-0">
									Rp<?= number_format($danaMasuk, 0, '.', '.') ?>
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
								<h6 class="font-extrabold mb-0">
									Rp<?= number_format($danaMasuk, 0, '.', '.') ?>
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
								<h6 class="font-extrabold mb-0">
									Rp<?= number_format($danaKeluar, 0, '.', '.') ?>
								</h6>
							</div>
						</div>
					</div>
				</div>
			</div>

				
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-end gap-2">
							<a href="<?= base_url() ?>data-pelanggan/tambah">
								<button type="button" class="btn btn-success btn-sm mb-3" z>
									<i class="bi bi-file-earmark-spreadsheet" style="font-size: 18px;"></i> Excel
								</button>
							</a>
							<a href="<?= base_url() ?>data-keuangan/pdf/generate" target="_blank">
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
									<th> Periode </th>
									<th> Dana Masuk</th>
									<th> Dana Keluar </th>
									<th> Laba </th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Oktober</td>
									<td>Rp46.000</td>
									<td>Rp0</td>
									<td>Rp46.000</td>
								</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
  	</div>
<?= $this->endSection() ?>