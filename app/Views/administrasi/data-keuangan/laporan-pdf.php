<?php 
    $months = array (1=>'JAN',2=>'FEB',3=>'MAR',4=>'APR',5=>'MEI',6=>'JUN',7=>'JUL',8=>'AGUS',9=>'SEP',10=>'OKT',11=>'NOV',12=>'DES');

    function imageToBase64($path) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    $imageBase64 = imageToBase64('assets/images/pamsimas.png');
?>

<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>PAMSIMAS - BANYU PANGURIPAN</title>  

    <style>
        body {
            font-size: 12px;
        }

        table, tr, td {
            border-color: #000;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-container img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .title-text {
            font-size: 16px;
            font-weight: bold;
        }

        .bulan {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        table {
            margin-top: 0.5rem;
            text-align: left;
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 8px;
            text-align: center;
        }

        tfoot th, tfoot td {
            text-align: right;
        }
    </style>
</head>  

<body>
    <!-- Header Section -->
    <header style="display: table; width: 100%">
        <div class="logo-container" style="height:70px; display: table-cell; vertical-align: middle;">
            <div style="width: 70px; float: left;">
                <img src="<?=$imageBase64?>" alt="Logo" style="width:70px; height:auto;">
            </div>
            <div style="margin-right: 0;">
                <div class="title-text">LAPORAN SALDO KAS</div>
                <div class="title-text">PAMSIMAS - BANYU PANGURIPAN</div>
            </div>
        </div>
        <div class="bulan" style="text-transform: uppercase;">Periode Bulan <?=month_indo($_REQUEST['month'] )?>  <?=($_REQUEST['year'] )?></div>
    </header>

    <!-- Table Section -->
    <table border="1" cellpadding="2" cellspacing="0">  
        <thead>    
            <tr>  
                <th width="3%">No</th>
                <th width="10%">Tanggal</th>
                <th width="25%">Keterangan</th>  
                <th width="15%">Dana Masuk</th> 
                <th width="15%">Dana Keluar</th> 
                <th width="15%">Saldo Kas</th>
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
                <th colspan="3">Total</th>
                <td>Rp<?= number_format($totDanaMasuk, 0, '.', '.') ?></td>
                <td>Rp<?= number_format($totDanaKeluar, 0, '.', '.') ?></td>
                <td>Rp<?= number_format($danaKas, 0, '.', '.') ?></td>
            </tr>
        </tfoot>
    </table>  

    <!-- Footer Section -->
    <div style="width: 100%; text-align: center; font-size: 14px;">
        <table style="width: 100%; margin-top: 50px;">
            <tr>
                <td style="text-align: left; width: 50%; font-size: 14px;">
                    <p style="margin-left: 30px;">Mengetahui,</p>
                    <p><strong>Pimpinan PAMSIMAS</strong></p>
                    <br><br>
                    <p>________________________</p>
                </td>
                <td style="text-align: right; width: 50%; font-size: 14px;">
                    <p style="margin-right: ;">Pekalongan, <?= hari_export($dateExport) ?></p>
                    <p style="margin-right: 50px;"><strong>Bendahara</strong></p>
                    <br><br>
                    <p>________________________</p>
                </td>
            </tr>
        </table>
    </div>
</body>  

</html>
