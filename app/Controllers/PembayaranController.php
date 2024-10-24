<?php

namespace App\Controllers;

use App\Models\Pembayaran;
use App\Models\TagihanModel;

class PembayaranController extends BaseController
{
    private $tagihanModel, $pembayaranModel;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->tagihanModel = new TagihanModel();
        $this->pembayaranModel = new Pembayaran();
    } 

    public function bayar($id)
    {

        $this->tagihanModel->where('id', $id)->set('status', 'dibayar')->update();

        $dataTagihan = $this->tagihanModel->find($id);

        $data = [
            'tagihan_id' => $dataTagihan['id'],	
            'tanggal_pembayaran' => date("Y-m-d"),	
            'jumlah_dibayar' => $dataTagihan['total_tagihan'],	
        ];

        $this->pembayaranModel->save($data);
        
        return redirect()->to('data-laporan/struk/'.$dataTagihan['id']);
    }

    public function bayarDebt()
    {
        $id = $this->request->getPost('pelanggan_id');

        $this->tagihanModel->where('id', $id)->set('status', 'dibayar')->update();

        $dataTagihan = $this->tagihanModel->find($id);

        $data = [
            'tagihan_id' => $dataTagihan['id'],	
            'tanggal_pembayaran' => date("Y-m-d"),	
            'jumlah_dibayar' => $dataTagihan['total_tagihan'],	
        ];

        $this->pembayaranModel->save($data);
        
        return redirect()->to('data-tagihan');
    }
}
