<?php

namespace App\Models;

use CodeIgniter\Model;

class DanaMasukModel extends Model
{
    protected $table            = 'dana_masuk';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['tanggal_masuk', 'jumlah_masuk', 'keterangan'];

}
