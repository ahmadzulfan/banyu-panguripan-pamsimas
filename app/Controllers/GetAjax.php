<?php

namespace App\Controllers;

use App\Models\MeterAir;
use App\Models\TagihanModel;

class GetAjax extends BaseController
{
    public function getAllDataTagiahanByPelangganId()
    {
        $pelanggaId = $this->request->getPost('pelanggan_id');
        $tagihanId = $this->request->getPost('tagihan_id');
        $model = new TagihanModel();
        $tagihan = $model->select('id, bulan, total_tagihan')
                        ->where('pelanggan_id', $pelanggaId)
                        ->where('status', 'belum_dibayar')
                        ->whereNotIn('id', [$tagihanId])
                        ->orderBy('bulan', 'asc')
                        ->findAll();
        echo json_encode($tagihan);
    }

    public function getDataTagiahanById()
    {
        $customerId = $this->request->getPost('id');
        $model = new MeterAir();
        $tagihan = $model->getLatestMeter($customerId);
        echo json_encode($tagihan);
    }

}
