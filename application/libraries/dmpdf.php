<?php defined('BASEPATH') OR exit('No direct script access allowed');
// Dompdf namespace use Dompdf\Dompdf;
class Pdf{ 
	publicfunction __construct(){
require_once dirname(__FILE__).'/dompdf/autoload.inc.php';
$pdf = new DOMPDF(); $CI = & get_instance();
$CI->dompdf = $pdf; 
} } ?>