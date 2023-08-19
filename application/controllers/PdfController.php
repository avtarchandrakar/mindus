<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PdfController extends CI_Controller {
publicfunction index($id){
$this->load->helper('html');
  $data=array(
  'id'=>$id
  );
  $html = $this->load->view('quotation_print', $data, true);
$this->load->library('pdf');
$this->dompdf->loadHtml($html);
$this->dompdf->setPaper('A4', 'landscape');
$this->dompdf->render();
$this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
}
}
