<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function month_indo($month)
{
	$months = array (1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
	return $months[$month];
}

function months_indo()
{
	return array (1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
}

function hari_export($filterTanggal)
{
    date_default_timezone_set('Asia/Jakarta');
	$tahun = $filterTanggal['tahun'];
	$bulan = $filterTanggal['bulan'];
	$tanggalAkhir = date("Y-m-d", strtotime("last day of $tahun-$bulan"));
	return tgl_indo($tanggalAkhir);
}

function first_date_by_month($filterTanggal)
{
    date_default_timezone_set('Asia/Jakarta');
	$tahun = $filterTanggal['tahun'];
	$bulan = $filterTanggal['bulan'];
	$tanggalAkhir = date("Y-m-d", strtotime("first day of $tahun-$bulan"));
	return $tanggalAkhir;
}

function first_date_by_prev_month($filterTanggal)
{
    date_default_timezone_set('Asia/Jakarta');
	$tahun = $filterTanggal['tahun'];
	$bulan = $filterTanggal['bulan'];
	$tanggalAkhir = date("Y-m-d", strtotime("first day of $tahun-$bulan -1 month"));
	return $tanggalAkhir;
}

function last_date_by_month($filterTanggal)
{
    date_default_timezone_set('Asia/Jakarta');
	$tahun = $filterTanggal['tahun'];
	$bulan = $filterTanggal['bulan'];
	$tanggalAkhir = date("Y-m-d", strtotime("last day of $tahun-$bulan"));
	return $tanggalAkhir;
}