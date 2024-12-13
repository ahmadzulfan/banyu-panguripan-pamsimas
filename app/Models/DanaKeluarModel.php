<?php

namespace App\Models;

use CodeIgniter\Model;

class DanaKeluarModel extends Model
{
    protected $table            = 'dana_keluar';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['tanggal_keluar', 'jumlah_keluar', 'keterangan'];

    public function getDataByMonth($month)
    {
        return $this->select('MONTH(tanggal_keluar) as bulan, YEAR(tanggal_keluar) as tahun, jumlah_keluar as dana_keluar, tanggal_keluar as tanggal, keterangan')
                    ->where('MONTH(tanggal_keluar)', $month)->findAll();
    }
}
