<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
class Pdf
{
    public $filename;
    public function __construct(){
        $this->filename = 'Calculate_'.rand().'.pdf';
    }

    protected function ci()
    {
        return get_instance();
    }

    public function generate($view, $data = array())
    {
        $html = $this->ci()->load->view($view, $data, TRUE);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');

        // render as PDF
        $dompdf->render();
        ob_clean();
        $dompdf->stream($this->filename, array("Attachment" => false));
    }
}