<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagihanModel;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    private $tagihanModel;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->tagihanModel = new TagihanModel();
    } 

    public function struk($id)
    {
        $model = new TagihanModel();
        $data['transaction'] = $model->getDetailTagihanById($id);
        return view('struk/struk', $data);
    }

    public function filter($filterMonth, $filterYear)
    {

        $filter = [
            "month" => $filterMonth,
            "year"  => $filterYear
        ];

        $filteredData = $this->tagihanModel->filterDataPDF($filter);

        return $filteredData;
    }

    public function generate()
    {

        $filterMonth = $this->request->getVar('month');
        $filterYear = $this->request->getVar('year');

        if (!$filterMonth && !$filterYear) {
            $filterMonth = date('m');
            $filterYear = date('Y');
        }
        
        $datas['datas'] = $this->filter($filterMonth, $filterYear);

        $filename = 'Laporan Tagihan PAM - '. date('y-m-d-H-i-s');

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('administrasi/data-laporan/laporan-pdf', $datas));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => 0));

        exit();
    }
}
