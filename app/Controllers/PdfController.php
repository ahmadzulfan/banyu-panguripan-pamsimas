<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagihanModel;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    public function struk($id)
    {
        $model = new TagihanModel();
        $data['transaction'] = $model->getDetailTagihanById($id);
        return view('struk/struk', $data);
    }

    public function generate()
    {
        $filename = date('y-m-d-H-i-s'). '-qadr-labs-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('administrasi/data-laporan/laporan-pdf'));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}
