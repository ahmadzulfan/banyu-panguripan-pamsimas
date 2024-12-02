<?= $this->extend('template/dashboard-admin2.php') ?>
<?= $this->section('app') ?>
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