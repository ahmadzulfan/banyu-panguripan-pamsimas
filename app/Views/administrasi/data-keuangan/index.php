<?= $this->extend('template/dashboard-admin2.php') ?>
<?= $this->section('app') ?>

<?php
    // Mendapatkan bulan dan tahun saat ini
    $lblmonths = date('m');
    $lbyears = date('Y');
    $months = months_indo(); // Mengambil array bulan dalam bahasa Indonesia
    // Jika bulan dan tahun dipilih melalui URL (GET), maka nilai bulan dan tahun akan diubah
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
                <!-- Card untuk menampilkan total Dana Kas -->
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
                                        Rp<?= number_format(0, 0, '.', '.') ?> <!-- Nilai awal Dana Kas 0 -->
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card untuk menampilkan Dana Masuk -->
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
                                    <h6 id="dana_masuk" class="font-extrabold mb-0"></h6> <!-- Nilai Dana Masuk akan diisi di JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card untuk menampilkan Dana Keluar -->
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
                                    <h6 id="dana_keluar" class="font-extrabold mb-0"></h6> <!-- Nilai Dana Keluar akan diisi di JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card untuk filter data berdasarkan bulan dan tahun -->
                <div class="col-12">
                    <div class="card text-center">
                        <div class="card-header">
                            <h4>Filter Data dengan Rentang Tanggal</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ```php
has-icon-left">
                                            <label for="month">Bulan:</label>
                                            <div class="position-relative">
                                                <select name="month" id="month" class="form-control">
                                                    <?php foreach ($months as $key => $month) : ?>
                                                        <option value="<?php
                                                            // Menampilkan bulan dengan format dua digit
                                                            echo (strlen((string)$key) < 2) ? "0".$key : $key;
                                                        ?>" <?php if ($key == $lblmonths) { echo 'selected'; } ?>>
                                                            <?= $month ?>
                                                        </option>
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
                                                    <?php for ($i = 2023; $i <= date('Y'); $i++) : ?>
                                                        <option value="<?= $i ?>" <?php if ($i == $lbyears) { echo 'selected'; } ?>>
                                                            <?= $i ?>
                                                        </option>
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

                <!-- Card untuk menampilkan tabel data keuangan -->
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end gap-2">
                                <!-- Tombol untuk mengekspor data ke Excel -->
                                <a href="<?= base_url() ?>data-keuangan/excel/export">
                                    <button type="button" class="btn btn-success btn-sm mb-3">
                                        <i class="bi bi-file-earmark-spreadsheet" style="font-size: 18px;"></i> Excel
                                    </button>
                                </a>
                                <!-- Tombol untuk mengekspor data ke PDF -->
                                <a href="<?= base_url() ?>data-keuangan/pdf/export?month=<?=$lblmonths?>&year=<?=$lbyears?>" target="_blank">
                                    <button type="button" class="btn btn-danger btn-sm mb-3">
                                        <i class="bi bi-filetype-pdf" style="font-size: 18px;"></i> PDF
                                    </button>
                                </a>
                            </div>
                            <!-- Tabel data keuangan -->
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Tanggal Transaksi </th>
                                            <th> Keterangan </th>
                                            <th> Dana Masuk </th>
                                            <th> Dana Keluar </th>
                                            <th> Saldo KAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; $danaKas=0; $totDanaMasuk = 0; $totDanaKeluar=0; foreach ($dataKeuangan as $key => $dana) : ?>
                                            <?php 
                                                // Mendapatkan nilai dana masuk dan dana keluar
                                                $pendapatan = $dana['pendapatan'] ?? 0; // Pendapatan atau 0 jika tidak ada
                                                $d_keluar = $dana['dana_keluar'] ?? 0; // Dana keluar atau 0 jika tidak ada
                                                $totDanaMasuk += $pendapatan; // Menambahkan dana masuk
                                                $totDanaKeluar += $d_keluar; // Menambahkan dana keluar
                                                $danaKas += $pendapatan - $d_keluar; // Mengupdate saldo kas
                                            ?>
                                            
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= tgl_indo($dana['tanggal']) ?></td>
                                                <td>
                                                    <?php if (!empty($dana['keterangan'])) : ?>
                                                        <?= $dana['keterangan'] ?>
                                                    <?php else: ?>
                                                        Pendapatan PAM bulan <?= month_indo($dana['bulan']) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($dana['pendapatan'])) : ?>
                                                        Rp<?= number_format(($dana['pendapatan']), 0, '.', '.') ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($dana['dana_keluar'])) : ?>
                                                        Rp<?= number_format($dana['dana_keluar'], 0, '.', '.') ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>Rp<?= number_format($danaKas, 0, '.', '.') ?></td>
                                            </tr>
                                        <?php $no++; endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3"></th>
                                            <th colspan="2">Saldo Akhir</th>
                                            <th id="total_pendapatan">Rp <?= number_format($danaKas, 0, '.', '.') ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    // Menyiapkan data untuk ditampilkan di JavaScript
    $dm = 'Rp '.number_format($totDanaMasuk, 0, '.', '.');
    $dk = 'Rp '.number_format($totDanaKeluar, 0, '.', '.');
?>
<script>
    // Menampilkan data keuangan di bagian dashboard menggunakan JavaScript
    const contentKas = document.getElementById('dana_kas');
    const contentMasuk = document.getElementById('dana_masuk');
    const contentKeluar = document.getElementById('dana_keluar');
    const total = document.getElementById('total_pendapatan').textContent;

    contentMasuk.innerHTML = '<?= $dm ?>'; // Menampilkan dana masuk
    contentKeluar.innerHTML = '<?= $dk ?>'; // Menampilkan dana keluar
    contentKas.innerHTML = total; // Menampilkan saldo kas
</script>

<?= $this->endSection() ?>