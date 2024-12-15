<?php

namespace App\Models;

use CodeIgniter\Model;

class DanaKeluarModel extends Model
{
    protected $table            = 'dana_keluar';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['tanggal_keluar', 'jumlah_keluar', 'keterangan'];

    public function getDataByMonth($year, $month)
    {
        return $this->select('MONTH(tanggal_keluar) as bulan, YEAR(tanggal_keluar) as tahun, jumlah_keluar as dana_keluar, tanggal_keluar as tanggal, keterangan')
                    ->where('MONTH(tanggal_keluar)', $month)
                    ->where('YEAR(tanggal_keluar)', $year)
                    ->findAll();
    }

    public function getDataSinceMonth($tahun, $bulan)
    {
        date_default_timezone_set('Asia/Jakarta');
        $startDate = date("Y-m-d", strtotime("last day of $tahun-$bulan -1 month"));

        return $this->select('MONTH(tanggal_keluar) as bulan, SUM(jumlah_keluar) as pengeluaran')
                    ->where('tanggal_keluar <=', $startDate)
                    ->findAll();
    }
}
