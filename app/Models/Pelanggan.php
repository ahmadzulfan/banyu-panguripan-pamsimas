<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelanggan extends Model
{
    protected $table      = 'pelanggan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nomor_pelanggan', 'nama', 'alamat', 'no_telepon', 'email'];
    protected $deletedField  = 'deleted_at';

   
}