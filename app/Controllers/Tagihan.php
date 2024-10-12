<?php

namespace App\Controllers;

use App\Models\BiayaPemeliharaan;
use App\Models\MeterAir;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\TagihanModel;

class Tagihan extends BaseController
{
    public function index(): string
    {
        $model = new TagihanModel();
        $data['tagihan'] = $model->pelanggan();
        return view('administrasi/data-tagihan/index', $data);
    }

    public function tambah()
    {
        $model = new Pelanggan();
        $modelBiaya = new BiayaPemeliharaan();
        $data['pelanggan'] = $model->findAll();
        $data['biaya'] = $modelBiaya->first();
        return view('administrasi/data-tagihan/tambah', $data);
    }

    public function create()
    {
        $session = session();

        $modelTagihan = new TagihanModel();

        $modelMeter = new MeterAir();

        $post = $this->request->getPost();

        $bulan = date('m', strtotime($post['bulan']));

        $tahun = date('Y', strtotime($post['bulan']));

        $dataTagihan = $modelTagihan->where('pelanggan_id', $post['pelanggan'])->where('bulan', $bulan)->where('tahun', $tahun)->first();

        if ($dataTagihan) {
            $session->setFlashdata('error', 'Sudah ada data tagihan!!!');
            return redirect()->back();
        }

        $data = [
            'pelanggan_id' => $post['pelanggan'],	
            'bulan' => $bulan,	
            'tahun' => $tahun,	
            'jumlah_pemakaian' => $post['total_pemakaian'],	
            'total_tagihan' => $post['total_tagihan'],
            'status' => 'belum_dibayar',
        ];

        $modelTagihan->save($data);

        $data = [
            'pelanggan_id' => $post['pelanggan'],	
            'bulan' => $bulan,	
            'tahun' => $tahun, 
            'pembacaan_awal' => $post['pemakaian_bulan_lalu'],	
            'pembacaan_akhir' => $post['pemakaian_bulan_ini'],
        ];

        $modelMeter->save($data);
        
        return redirect()->to('data-tagihan');
    }

    public function delete($id)
    {
        $model = new TagihanModel();

        $model->where('id', $id)->delete();

        echo json_encode(['status' => true]);

    }

    public function bayar($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $model = new TagihanModel();
        $model2 = new Pembayaran();

        $model->where('id', $id)->set('status', 'dibayar')->update();

        $dataTagihan = $model->find($id);

        $data = [
            'tagihan_id' => $dataTagihan['id'],	
            'pelanggan_id' => $dataTagihan['pelanggan_id'],	
            'tanggal_pembayaran' => date("Y-m-d"),	
            'jumlah_dibayar' => $dataTagihan['total_tagihan'],	
        ];

        $model2->save($data);
        
        return redirect()->to('data-tagihan');
    }

    public function bayarDebt()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('pelanggan_id');

        $model = new TagihanModel();
        $model2 = new Pembayaran();

        $model->where('id', $id)->set('status', 'dibayar')->update();

        $dataTagihan = $model->find($id);

        $data = [
            'tagihan_id' => $dataTagihan['id'],	
            'pelanggan_id' => $dataTagihan['pelanggan_id'],	
            'tanggal_pembayaran' => date("Y-m-d"),	
            'jumlah_dibayar' => $dataTagihan['total_tagihan'],	
        ];

        $model2->save($data);
        
        return redirect()->to('data-tagihan');
    }
}
