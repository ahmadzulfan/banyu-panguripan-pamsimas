<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembayaran extends Model
{
    protected $table      = 'pembayaran';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;
    
    protected $allowedFields = ['pelanggan_id',	'tagihan_id', 'tanggal_pembayaran',	'jumlah_dibayar', 'status'];

    public function pelanggan($filter)
    {
        return $this->select('*')->join('pelanggan', 'pembayaran.pelanggan_id = pelanggan.id')
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
}