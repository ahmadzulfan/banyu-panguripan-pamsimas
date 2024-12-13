<?php

namespace App\Models;

use CodeIgniter\Model;

class DanaMasukModel extends Model
{
    protected $table            = 'dana_masuk';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['tanggal_masuk', 'jumlah_masuk', 'keterangan'];

    public function getDataByMonth($month)
    {
        return $this->select('MONTH(tanggal_masuk) as bulan, YEAR(tanggal_masuk) as tahun, jumlah_masuk as pendapatan, tanggal_masuk as tanggal, keterangan')
                    ->where('MONTH(tanggal_masuk)', $month)->findAll();
    }
}
