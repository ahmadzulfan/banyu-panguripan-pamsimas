<?php

namespace App\Controllers;

use App\Models\MeterAir;
use App\Models\TagihanModel;

class GetAjax extends BaseController
{
    public function getAllDataTagiahanByPelangganId()
    {
        $model = new TagihanModel();
        $pelanggaId = $this->request->getPost('pelanggan_id');
        $tagihanId = $this->request->getPost('tagihan_id');
        $tagihan = $model->select('id, bulan, total_tagihan')
                        ->where('pelanggan_id', $pelanggaId)
                        ->where('status', 'belum_dibayar')
                        ->whereNotIn('id', [$tagihanId])
                        ->findAll();
        echo json_encode($tagihan);
    }

    public function getDataTagiahanById()
    {
        $model = new MeterAir();
        $tagihan = $model->where('pelanggan_id', $this->request->getPost('id'))->first();
        echo json_encode($tagihan);
    }

}
