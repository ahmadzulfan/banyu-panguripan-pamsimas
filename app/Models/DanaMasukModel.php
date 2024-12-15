<?php

namespace App\Models;

use CodeIgniter\Model;

class DanaMasukModel extends Model
{
    protected $table            = 'dana_masuk';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['tanggal_masuk', 'jumlah_masuk', 'keterangan'];

    public function getDataByMonth($year, $month)
    {
        return $this->select('MONTH(tanggal_masuk) as bulan, YEAR(tanggal_masuk) as tahun, jumlah_masuk as pendapatan, tanggal_masuk as tanggal, keterangan')
                    ->where('MONTH(tanggal_masuk)', $month)
                    ->where('YEAR(tanggal_masuk)', $year)
                    ->findAll();
    }

    public function getDataSinceMonth($tahun, $bulan)
    {
        date_default_timezone_set('Asia/Jakarta');
        $startDate = date("Y-m-d", strtotime("last day of $tahun-$bulan -1 month"));

        return $this->select('MONTH(tanggal_masuk) as bulan, SUM(jumlah_masuk) as pendapatan')
                    ->where('tanggal_masuk <=', $startDate)
                    ->findAll();
    }
}
