<?= $this->extend('template/dashboard-admin2.php') ?>
<?= $this->section('app') ?>
<?php
	$lblmonths = date('m');
	$lbyears = date('Y');
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
                        <p class="text-subtitle text-muted">Halaman untuk manajemen data kas minggu ini seperti melihat, mengubah dan
                                    menghapus.
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

				
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-end gap-2">
							<a href="<?= base_url() ?>data-keuangan/tambah">
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
							<table class="table table-striped">

							<thead>
								<tr>
									<th> Periode </th>
									<th> Keterangan </th>
									<th> Dana KAS</th>
								</tr>
							</thead>
							<?php $totDanaMasuk = 0; $totDanaKeluar=0; $pendapatan = 0; foreach ($danaMasuk as $key => $dana) : ?>
								<?php $pendapatanPerBulan = $dana['dana_masuk'] - $danaKeluar[$dana['periode']];
									$totDanaMasuk += $dana['dana_masuk'];
									$totDanaKeluar += $danaKeluar[$dana['periode']];
									$pendapatan += $pendapatanPerBulan; 
								?>

							<tbody>
									<tr>
										<td><?= month_indo($dana['periode']) ?></td>
										<td>Pendapatan PAM bulan Rp <?= month_indo($dana['periode']) ?></td>
										<td>Pemasukan : Rp <?= number_format($dana['dana_masuk'], 0, '.', '.') ?></td>
									</tr>
									<tr>
										<td><?= month_indo($dana['periode']) ?></td>
										<td>Pulsa Listrik Rp <?= month_indo($dana['periode']) ?></td>
										<td>Pengeluaran : Rp <?= number_format($danaKeluar[$dana['periode']], 0, '.', '.') ?></td>
									</tr>
									<tr>
									<th colspan="2">Pendapatan Bulan <?= month_indo($dana['periode']) ?></td>
									<th>Rp <?= number_format($pendapatanPerBulan, 0, '.', '.') ?></th>
								</tr>
							</tbody>
							<?php endforeach; ?>
							<tfoot>
								<tr>
									<th colspan="2">Total Pendapatan</th>
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