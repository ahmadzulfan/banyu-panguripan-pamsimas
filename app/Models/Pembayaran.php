<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembayaran extends Model
{
    protected $table      = 'pembayaran';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    
    protected $allowedFields = ['tagihan_id', 'tanggal_pembayaran',	'jumlah_dibayar', 'status'];

    public function pelanggan($filter)
    {
        return $this->select('pembayaran.tanggal_pembayaran, pelanggan.nama, pembayaran.jumlah_dibayar, tagihan.id as id_tagihan, pelanggan.id as pelanggan_id')
                    ->join('tagihan', 'pembayaran.tagihan_id = tagihan.id')
                    ->join('pelanggan', 'tagihan.pelanggan_id = pelanggan.id')
                    ->where('MONTH(tanggal_pembayaran)', $filter['month'])
                    ->where('YEAR(tanggal_pembayaran)', $filter['year'])
                    ->findAll();
    }

    public function pendapatanByMonth($month)
    {
        return $this->select('MONTH(tanggal_pembayaran) as bulan, SUM(jumlah_dibayar) as pendapatan')->where('MONTH(tanggal_pembayaran)', $month)->first();
    }

    public function pendapatanByYear($year)
    {
        return $this->select('YEAR(tanggal_pembayaran) as year, SUM(jumlah_dibayar) as pendapatan')->where('YEAR(tanggal_pembayaran)', $year)->first();
    }

    public function danaMasuk()
    {
        return $this->select('SUM(jumlah_dibayar) as pendapatan')->first()['pendapatan'];
    }
}