<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table      = 'tagihan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['pelanggan_id', 'bulan', 'tahun', 'jumlah_pemakaian', 'total_tagihan', 'status'];

    public function pelanggan()
    {
        return $this->select('*, tagihan.id as id_tagihan, pelanggan.id as pelanggan_id')
                    ->join('pelanggan', 'tagihan.pelanggan_id = pelanggan.id')
                    ->where('pelanggan.deleted_at =', null);
    }

    public function getDetailTagihanById($id)
    {
        return $this->select('tagihan.id as id_tagihan, pelanggan.id as pelanggan_id, pelanggan.nama as nama, pembayaran.tanggal_pembayaran as tgl_bayar, meter_air.pembacaan_awal as bln_lalu, meter_air.pembacaan_akhir as bln_ini, tagihan.jumlah_pemakaian as pemakaian, pembayaran.jumlah_dibayar as dibayar')
                    ->join('pelanggan', 'tagihan.pelanggan_id = pelanggan.id')
                    ->join('meter_air', 'tagihan.id = meter_air.tagihan_id')
                    ->join('pembayaran', 'tagihan.id = pembayaran.tagihan_id')
                    ->where('tagihan.id', $id)->first();
    }

    public function statusTagihan($month, $year)
    {
        return $this->select("COUNT(CASE WHEN tagihan.status = 'dibayar' THEN 1 END) as dibayar, COUNT(CASE WHEN tagihan.status = 'belum_dibayar' THEN 1 END) as belum_dibayar", FALSE)
                    ->where('bulan', $month)
                    ->where('tahun', $year)->first();
    }

    public function filterData($filter)
    {
        return $this->pelanggan()
                    ->join('pembayaran', 'tagihan.id = pembayaran.tagihan_id')
                    ->where('MONTH(tanggal_pembayaran)', $filter['month'])
                    ->where('YEAR(tanggal_pembayaran)', $filter['year'])->findAll();
    }
}