<html>
<head>
<title>Faktur Pembayaran</title>
<style>
 
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family: monospace;'>
    <?php $biaya_perm = 2000; $biaya_admin = 2000; ?>
<center>

    <div style="width: 58mm; height:100mm;">
        <div style="padding: 2mm;">
        <center>
            <table style='font-size:11pt; font-family: monospace; border-collapse: collapse;' border = '0'>
        <td align='CENTER' vertical-align:top'><span style='color:black;'>
        <b>PAMSIMAS BANYU PANGURIPAN</b></br><span style='font-size:9pt'>Desa Sembung Jambu Rt 09/02</span></span></br>
        
        <span style='font-size:9pt'>(62) 893 7362 5121</span>
        <!-- <span style='font-size:8pt'>No. : 11, 11 Oktober 2024 (user:saya), 11:57:50</span> -->
        </br>
        </td>
        </table>
<style>
hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
} 
</style>
<table id="struk" style='font-size:9pt; font-family: monospace;  border-collapse: collapse; width:100%' border='0'>
<tr>
<td colspan='5'><hr></td>
</tr>
<tr>
<td colspan="5">Pelanggan: <?= $transaction['nama'] ?></td>
</tr>
<tr>
<td colspan="5">Tanggal: <?= $transaction['tgl_bayar'] ?></td>
</tr>
<tr>
<td colspan='5'><hr></td>
</tr>
<tr>
<td colspan="5" style="font-size: 10pt;">Meter bulan lalu: <?= $transaction['bln_lalu'] ?> m³</td>
</tr>
<tr>
<td colspan="5" style="font-size: 10pt;">Meter bulan ini: <?= $transaction['bln_ini'] ?> m³</td>
</tr>
<tr>
<td colspan="5" style="font-size: 10pt; font-weight:bold;">Total Pemakaian: <?= $transaction['pemakaian'] ?> m³</td>
</tr>
<tr>
<td colspan="1" style="text-align: right;"><?= $transaction['pemakaian'] ?> m³ x <?= number_format($biaya_perm, 0, '', '.') ?></td>
<?php $subtotal =  $transaction['pemakaian'] * $biaya_perm ?>
<?php $total =  $subtotal + $biaya_admin ?>
<?php $kembali =  $total - $transaction['dibayar'] ?>
<td colspan="4" style="text-align: right;"><?= number_format($subtotal, 0, '', '.') ?></td>
</tr>
<tr>
<td colspan='5'><hr></td>
</tr>
<tr>
<td style="font-size: 10pt;">Sub Total</td>
<td style="text-align: right;"><?= number_format($subtotal, 0, '', '.') ?></td>
</tr>
<tr>
<td style="font-size: 10pt;">Biaya Admin</td>
<td style="text-align: right;"><?= number_format($biaya_admin, 0, '', '.') ?></td>
</tr>
<tr style="font-weight: bold;">
<td style="font-size: 10pt;">Total</td>
<td style="text-align: right;"><?= number_format($total, 0, '', '.') ?></td>
</tr>
<tr style="font-weight: bold;">
<td style="font-size: 10pt;">Dibayar</td>
<td style="text-align: right;"><?= number_format($transaction['dibayar'], 0, '', '.') ?></td>
</tr>
<tr style="font-weight: bold;">
<td style="font-size: 10pt;">Kembali</td>
<td style="text-align: right;"><?= number_format($kembali, 0, '', '.') ?></td>
</tr>
</table>
<table style='font-size:9pt;' cellspacing='2'><tr></br><td align='center'>****** TERIMAKASIH ******</br></td></tr></table></center>
        </div>
    </div>
</center>
</body>
</html>