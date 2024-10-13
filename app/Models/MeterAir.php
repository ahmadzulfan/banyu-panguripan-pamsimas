<?php

namespace App\Models;

use CodeIgniter\Model;

class MeterAir extends Model
{
    protected $table      = 'meter_air';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    
    protected $allowedFields = ['pelanggan_id',	'bulan',	'tahun', 'pembacaan_awal',	'pembacaan_akhir'];

    public function getLatestMeter($customerId)
    {
        return $this->where('pelanggan_id', $customerId)->orderBy('bulan', 'desc')->first();
    }
}