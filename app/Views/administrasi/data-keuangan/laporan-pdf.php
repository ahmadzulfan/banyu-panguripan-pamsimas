<?php 
    $months = array (1=>'JAN',2=>'FEB',3=>'MAR',4=>'APR',5=>'MEI',6=>'JUN',7=>'JUL',8=>'AGUS',9=>'SEP',10=>'OKT',11=>'NOV',12=>'DES');
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

        table,tr,td{
            border-color: #000;
        }
    </style>
</head>  

<body>
    <x-header style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:292pt;">
            <span style="font-size: large; font-weight:bold;">LAPORAN DATA KEUANGAN</span><br>
            <span style="font-size: large; font-weight:bold;">PAMSIMAS - BANYU PANGURIPAN</span>
        </div>
        <div align=right style="font-size: large; font-weight:bold;">
            TAHUN 2024
        </div>
    </x-header>
    <table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 2.5rem; text-align:left;">  
        <thead>    
            <tr align=center>  
                <th width="3%">No</th>
                <th width="10%">Tanggal</th>
                <th width="25%">Keterangan</th>  
                <th width="15%">Pemasukan</th> 
                <th width="15%">Pengeluaran</th> 
                
            </tr>    
        </thead> 
        <?php $totDanaMasuk = 0; $totDanaKeluar=0; $pendapatan = 0; $no=1; foreach ($danaMasuk as $dana) : ?>
        <?php 
            $d_keluar = 0;
            $totDanaMasuk += $dana['dana_masuk'];
        ?>
        <tbody>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td><?= tgl_indo($dana['tanggal']) ?></td>
                <td>Pendapatan PAM bulan <?= month_indo($dana['periode']) ?></td>
                <td style="text-align: right;">Rp<?= number_format($dana['dana_masuk'], 0, '.', '.') ?></td>
                <td></td>
            </tr>
            <?php if (!empty($danaKeluar[$dana['periode']])) : ?>
                <?php foreach ($danaKeluar[$dana['periode']] as $dk) : ?>
                    <?php $d_keluar += $dk['dana_keluar']; $no++ ?>
                    <tr>
                        <td style="text-align: center;"><?= $no ?></td>
                        <td><?= tgl_indo($dk['tanggal']) ?></td>
                        <td><?= $dk['keterangan'] ?></td>
                        <td></td>
                        <td style="text-align: right;">Rp<?= number_format($dk['dana_keluar'], 0, '.', '.') ?></td>
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
        <tfoot style="text-align: left;">
            <tr>
                <td style="height: 10;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
			<tr>
                <th></th>
                <th></th>
                <th>Total</th>
                <td id="total_pendapatan" style="text-align: right;">Rp<?= number_format($totDanaMasuk, 0, '.', '.') ?></td>
                <td id="total_pengeluaran" style="text-align: right;">Rp<?= number_format($totDanaKeluar, 0, '.', '.') ?></td>
			</tr>
			<tr>
                <th></th>
                <th></th>
                <th>Saldo Akhir</th>
                <td></td>
                <th id="saldo_akhir" style="text-align: right;">Rp<?= number_format($pendapatan, 0, '.', '.') ?></th>
			</tr>
		</tfoot>
    </table>  
</body>  

</html>