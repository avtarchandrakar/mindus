<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("A4", "potrait");
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf",array("Attachment"=>0));
//        file_put_contents('PDF/'.$filename.".pdf", $dompdf->output());
    } else {
        return $dompdf->output();
    }
}
?>