<?php

namespace App\Models;

use CodeIgniter\Model;

class BiayaPemeliharaan extends Model
{
    protected $table      = 'biaya_pemeliharaan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['biaya_admin', 'biaya_perm', 'status',];

}