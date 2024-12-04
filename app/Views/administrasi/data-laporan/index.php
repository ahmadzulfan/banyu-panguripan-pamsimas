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
							<h3>Data Laporan PAMSIMAS</h3>
							<p class="text-subtitle text-muted">Halaman untuk manajemen data kas minggu ini seperti melihat, mengubah dan
										menghapus.
							</p>
						</div>
					</div>
				</div>
			<div class="col-6 col-lg-6 col-md-6">
				<div class="card">
					<div class="card-body px-3 py-4-4">
						<div class="row">
							<div class="col-md-4">
								<div class="stats-icon">
									<i class="iconly-boldChart"></i>
								</div>
							</div>
							<div class="col-md-8">
								<h6 class="text-muted font-semibold">Total Bulan 
								<?php if (!empty($_REQUEST['month'])) : ?>
									<?= $months[$_REQUEST['month']] ?>
								<?php else: ?>
									Ini
								<?php endif; ?>
								</h6>
								<h6 class="font-extrabold mb-0">
									Rp<?= number_format($pendapatanByMonth['pendapatan'], 0, '.', '.') ?>
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
								<div class="stats-icon">
									<i class="iconly-boldChart"></i>
								</div>
							</div>
							<div class="col-md-8">
								<h6 class="text-muted font-semibold">Total Tahun 
									<?php if (!empty($_REQUEST['year'])) : ?>
										<?= $_REQUEST['year'] ?>
									<?php else: ?>
										Ini
									<?php endif; ?>
								</h6>
								<h6 class="font-extrabold mb-0">
									Rp<?= number_format($pendapatanByYear['pendapatan'], 0, '.', '.') ?>
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
								<h6 class="text-muted font-semibold">Sudah Membayar</h6>
								<h6 class="font-extrabold mb-0">
									<?= $statusTagihan['dibayar'] ?>
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
								<h6 class="text-muted font-semibold">Belum Membayar</h6>
								<h6 class="font-extrabold mb-0">
									<?= $statusTagihan['belum_dibayar'] ?>
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
						<div class="d-flex justify-content-end gap-2">
						<a href="<?= base_url() ?>data-laporan/excel/generate">
							<button type="button" class="btn btn-success btn-sm mb-3" z>
								<i class="bi bi-file-earmark-spreadsheet" style="font-size: 18px;"></i> Excel
							</button>
						</a>
						<a href="<?= base_url() ?>data-laporan/pdf/generate?month=<?=$lblmonths?>&year=<?=$lbyears?>" target="_blank">
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
									<th> Tanggal Pembayaran </th>
									<th> Nama Pelanggan</th>
									
									<th> Jumlah Pembayaran </th>
									<th> Action </th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($pembayaran as $key => $value) : ?>
								<tr>
									<td> <?= $key+1 ?> </td>
									<td> <?= tgl_indo($value['tanggal_pembayaran']) ?> </td>
									<td> <?= $value['nama'] ?> </td>
									<td> Rp <?= number_format($value['jumlah_dibayar'], 0, '.', '.') ?> </td>
									<td> 
										<a href="<?= base_url() ?>data-laporan/struk/<?=$value['id_tagihan']?>" target="_blank" class="btn btn-primary">
											<i class="bi bi-printer"></i> Cetak Struk
										</a> 
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
<?= $this->endSection() ?>