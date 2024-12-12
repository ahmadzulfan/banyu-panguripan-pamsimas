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
                <div class="title-text">LAPORAN DATA Tagihan</div>
                <div class="title-text">PAMSIMAS - BANYU PANGURIPAN</div>
            </div>
        </div>
        <div class="bulan" style="text-transform: uppercase;">Periode Bulan <?=month_indo($_REQUEST['month'] )?>  <?=($_REQUEST['year'] )?></div>
    </header>
    
    <table border=1 width=100% cellpadding=2 cellspacing=0 style=" text-align:center;">  
        <thead>    
            <tr align=center style="font-weight: bold;">  
                <td width="2%">No</td>  
                <td width="5%">Nama</td>  
                <td width="15%">Bulan</td>  
                <td width="15%">Jumlah Pemakaian</td>  
                <td width="15%">Total Tagihan</td>
                <td width="15%">Status</td>
            </tr>    
        </thead>    
        <tbody> 
            <?php $total=0; $tpemakaian=0; $ttotal = 0; $tlunas = 0; $tbelumlunas = 0; ?>

            <?php foreach ($tagihan as $key => $value) : ?>
                <?php $tpemakaian += $value['jumlah_pemakaian']; $ttotal += $value['total_tagihan']; ?>
                <tr>
                    <td> <?= $key+1 ?> </td>
                    <td> <?= $value['nama'] ?> </td>
                    <td> <?= month_indo($value['bulan']) ?> </td>
                    <td> <?= $value['jumlah_pemakaian'] ?> m³ </td>
                    <td> Rp<?= number_format($value['total_tagihan'], 0, '.', '.') ?> </td>
                    <td>
                        <?php if ($value['status'] == 'dibayar') : ?>
                            Lunas
                        <?php $tlunas += $value['total_tagihan']; else: ?>
                            Belum Lunas
                        <?php $tbelumlunas += $value['total_tagihan']; endif; ?>
                    </td>

                </tr>
                <?php endforeach; ?>
        </tbody>
    </table> 
    <!-- Header Section -->
    <div style="margin-top: 1rem;">
        <div class="title-text">DETAIL RINCIAN</div>
        <table border=1 width=100% cellpadding=2 cellspacing=0 style=" text-align:center;">  
            <thead>    
                <tr align=center style="font-weight: bold;">  
                    <td width="25%">Total Pemaikaian</td>  
                    <td width="25%">Total Tagihan</td>  
                    <td width="25%">Tagihan Lunas</td>  
                    <td width="25%">Tagihan Belum Lunas</td>
                </tr>    
            </thead>
            <tbody>
                <tr>
                    <td><?= $tpemakaian ?>m³</td>
                    <td>Rp<?= number_format($ttotal, 0, '.', '.') ?></td>
                    <td>Rp<?= number_format($tlunas, 0, '.', '.') ?></td>
                    <td>Rp<?= number_format($tbelumlunas, 0, '.', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="width: 100%; text-align: center; font-size: 14px;">
        <table style="width: 100%; margin-top: 1rem;">
            <tr>
                <td style="text-align: left; width: 50%; font-size: 14px;">
                    <p style="margin-left: 30px;">Mengetahui,</p>
                    <p><strong>Pimpinan PAMSIMAS</strong></p>
                    <br><br>
                    <p>________________________</p>
                </td>
                <td style="text-align: right; width: 50%; font-size: 14px;">
                    <p style="margin-right: ;">Pekalongan, <?= hari_export($dateExport) ?></p>
                    <p style="margin-right: 50px;"><strong>Petugas Lapangan</strong></p>
                    <br><br>
                    <p>________________________</p>
                </td>
            </tr>
        </table>
    </div>
</html>