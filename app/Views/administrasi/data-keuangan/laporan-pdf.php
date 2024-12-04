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
    <table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 2.5rem; text-align:center;">  
        <thead>    
            <tr align=center>  
                
                <td width="5%">PERIODE</td>
                <td width="15%">KETERANGAN</td>  
                <td width="15%">DANA KAS</td>  
                
            </tr>    
        </thead> 
        <?php $totDanaMasuk = 0; $totDanaKeluar=0; $pendapatan = 0; foreach ($danaMasuk as $key => $dana) : ?>
								<?php 
									$d_keluar = 0;
									$totDanaMasuk += $dana['dana_masuk'];
								?>
   
   <tbody>
        <tr>
            
            <td><?= month_indo($dana['periode']) ?></td>
            <td>Pendapatan PAM bulan <?= month_indo($dana['periode']) ?></td>
            <td>Pemasukan : Rp <?= number_format($dana['dana_masuk'], 0, '.', '.') ?></td>
        </tr>
        <?php if (!empty($danaKeluar[$dana['periode']])) : ?>
            <?php foreach ($danaKeluar[$dana['periode']] as $key => $dk) : ?>
                <?php $d_keluar += $dk['dana_keluar'] ?>
                <tr>
                    <td><?= month_indo($dana['periode']) ?></td>
                    <td><?= $dk['keterangan'] ?></td>
                    <td>Pengeluaran : Rp <?= number_format($dk['dana_keluar'], 0, '.', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php 
            $pendapatanPerBulan = $dana['dana_masuk'] - $d_keluar;
            $pendapatan += $pendapatanPerBulan;
            $totDanaKeluar += $d_keluar; 
        ?>
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
</body>  

</html>