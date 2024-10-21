<?php

namespace App\Controllers;

use App\Models\BiayaPemeliharaan;
use App\Models\MeterAir;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\TagihanModel;

class Tagihan extends BaseController
{
    private $session, $tagihanModel, $meterAirModel, $pembayaranModel, $pelangganModel, $feeModel;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->session = service('session');
        $this->pelangganModel = new Pelanggan();
        $this->tagihanModel = new TagihanModel();
        $this->pembayaranModel = new Pembayaran();
        $this->feeModel = new BiayaPemeliharaan();
        $this->meterAirModel = new MeterAir();
    } 

    public function index(): string
    {
        $data['tagihan'] = $this->tagihanModel->pelanggan();
        return view('administrasi/data-tagihan/index', $data);
    }

    public function tambah()
    {
        $data['pelanggan'] = $this->pelangganModel->findAll();
        $data['biaya'] = $this->feeModel->first();
        return view('administrasi/data-tagihan/tambah', $data);
    }

    public function create()
    {
        $validation = service('validation');
        $session = session();
        $post = $this->request->getPost();
        $bulanName = date('M', strtotime($post['bulan']));
        $bulan = date('m', strtotime($post['bulan']));
        $tahun = date('Y', strtotime($post['bulan']));
        $pelangganId = $post['pelanggan_id'];

        if (!$validation->run($post, 'createTagihan')) {
            return redirect()->back()->withInput()->with('errors', $validation->listErrors());
        }

        $dataTagihan = $this->tagihanModel->where('pelanggan_id', $pelangganId)->where('bulan', $bulan)->where('tahun', $tahun)->first();

        if ($dataTagihan) {
            $session->setFlashdata('error', 'data tagihan bulan '.$bulanName.' untuk pelanggan id '.$pelangganId.' sudah ada.');
            return redirect()->back()->withInput();
        }

        $jumlahPemakaian = $post['total_pemakaian'];

        $data = [
            'pelanggan_id' => $pelangganId,	
            'bulan' => $bulan,	
            'tahun' => $tahun,	
            'jumlah_pemakaian' => $jumlahPemakaian,	
            'total_tagihan' => $post['total_tagihan'],
            'status' => 'belum_dibayar',
        ];

        $this->tagihanModel->save($data);

        $currentTagihanID = $this->tagihanModel->insertID; 

        $data = [
            'pelanggan_id' => $pelangganId,	
            'tagihan_id' => $currentTagihanID,
            'bulan' => $bulan,
            'tahun' => $tahun, 
            'pembacaan_awal' => $post['pemakaian_bulan_lalu'],	
            'pembacaan_akhir' => $post['pemakaian_bulan_ini'],
        ];

        $this->meterAirModel->save($data);
        
        return redirect()->to('data-tagihan');
    }

    public function delete($id)
    {
        $this->tagihanModel->where('id', $id)->delete();

        echo json_encode(['status' => true]);

    }

    public function bayar($id)
    {

        $this->tagihanModel->where('id', $id)->set('status', 'dibayar')->update();

        $dataTagihan = $this->tagihanModel->find($id);

        $data = [
            'tagihan_id' => $dataTagihan['id'],	
            'pelanggan_id' => $dataTagihan['pelanggan_id'],	
            'tanggal_pembayaran' => date("Y-m-d"),	
            'jumlah_dibayar' => $dataTagihan['total_tagihan'],	
        ];

        $this->pembayaranModel->save($data);
        
        return redirect()->to('data-tagihan');
    }

    public function bayarDebt()
    {
        $id = $this->request->getPost('pelanggan_id');

        $this->tagihanModel->where('id', $id)->set('status', 'dibayar')->update();

        $dataTagihan = $this->tagihanModel->find($id);

        $data = [
            'tagihan_id' => $dataTagihan['id'],	
            'pelanggan_id' => $dataTagihan['pelanggan_id'],	
            'tanggal_pembayaran' => date("Y-m-d"),	
            'jumlah_dibayar' => $dataTagihan['total_tagihan'],	
        ];

        $this->pembayaranModel->save($data);
        
        return redirect()->to('data-tagihan');
    }
}
