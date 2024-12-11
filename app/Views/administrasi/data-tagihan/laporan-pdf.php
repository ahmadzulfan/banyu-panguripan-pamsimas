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
            <span style="font-size: large; font-weight:bold;">LAPORAN PEMBAYARAN TAGIHAN</span>
            <img src="public/assets/images/logo-pamsimas.png" alt="Logo" style="height: 50px; vertical-align: middle; margin-left: 10px;">
            <br>
            <span style="font-size: large; font-weight:bold;">PAMSIMAS - BANYU PANGURIPAN</span>
        </div>
        <div align=right style="font-size: large; font-weight:bold;">
        <div class="bulan" style="text-transform: uppercase;">Periode Bulan <?=month_indo($_REQUEST['month'] )?>  <?=($_REQUEST['year'] )?></div>
        </div>
    </x-header>
    <table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 2.5rem; text-align:center;">  
        <thead>    
            <tr align=center>  
                <td width="2%">No</td>  
                <td width="5%">Tanggal Pembayaran</td>  
                <td width="15%">Nama Pelanggan</td>  
                <td width="15%">Bulan Tagihan</td>  
                <td width="15%">Jumlah Pembayaran</td>
            </tr>    
        </thead>    
        <tbody> 
            <?php $total=0; ?>

            <?php foreach ($datas as $key => $data) : ?>
                <?php $total+=$data['total_tagihan'] ?>
                <tr>
                <td><?= $key+1 ?></td>
                <td><?= tgl_indo($data['tanggal_pembayaran']) ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= month_indo($data['bulan']) ?></td>
                <td>Rp<?= number_format($data['total_tagihan'], 0, '', '.') ?></td>
                
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4"> total penghasilan</td>
                <td>Rp<?=number_format($total, 0, '', '.')?></td>
            </tr>
            
        </tbody>
    </table>  
    
    
        
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
                        <p style="margin-right: 40px;">Mengetahui,</p>
                        <p style="margin-right: 20px;"><strong>Petugas Lapangan</strong></p>
                        <br><br>
                        <p>________________________</p>
                    </td>
                </tr>
            </table>

</html>