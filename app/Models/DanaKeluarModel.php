<?php

namespace App\Models;

use CodeIgniter\Model;

class DanaKeluarModel extends Model
{
    protected $table            = 'dana_keluar';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['tanggal_keluar', 'jumlah_keluar', 'keterangan'];

}
