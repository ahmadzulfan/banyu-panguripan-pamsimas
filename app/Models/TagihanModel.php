<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table      = 'tagihan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;
    
    protected $allowedFields = ['pelanggan_id',	'bulan',	'tahun',	'jumlah_pemakaian',	'total_tagihan','status'];

    public function pelanggan()
    {
        return $this->select('*, tagihan.id as id_tagihan, pelanggan.id as pelanggan_id')->join('pelanggan', 'tagihan.pelanggan_id = pelanggan.id')->findAll();
    }

    public function statusTagihan($month, $year)
    {
        return $this->select('COUNT(CASE WHEN tagihan.status = "dibayar" THEN 1 END) as dibayar, COUNT(CASE WHEN tagihan.status = "belum_dibayar" THEN 1 END) as belum_dibayar', FALSE)
                    ->where('bulan', $month)
                    ->where('tahun', $year)->first();
    }
}