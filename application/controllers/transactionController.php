<?
if (!defined('BASEPATH')) exit('No direct script access allowed');

use Dompdf\Dompdf;

class transactionController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('common_helper');
        ini_set('post_max_size', '200M'); 
    }

    function index() {
        
    }

     public function GetState(){
        $this->load->model('helper_model');
        $this->json->jsonReturn($this->helper_model->GetState());
    }
    
  function sales_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->sales_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          echo '            <th>Q. No.</th>';
          echo '            <th>PartyName</th>';
          // echo '            <th>Vehicle No.</th>';
          echo '            <th>Items</th>';
          // echo '            <th>Document</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->quatation_no . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                
                // echo '    <td>' . $row->ledger_mobno . '</td>';
                echo '    <td>' . $row->items . '</td>';
              if ($row->file_path!='') 
              {                
                // echo '    <td> <a href="' . $row->file_path . '" target="_blank">View</a></td>';    
              }
              else
              {
                // echo '    <td> No Docs</td>';   
              }            
              echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        echo '          Q1<!--- <i class="ace-icon fa fa-print bigger-120"></i> --->';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="Print" onclick="GetReport2(' . $row->id .');return false;">';
        echo '          Q2<!--- <i class="ace-icon fa fa-print bigger-120"></i> --->';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


    function sales_list1(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->sales_list1();
      // print_r($result);
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover" style="width:100%;">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th style="width:10%;">No</th>';
          // echo '            <th>Q. No.</th>';
          echo '            <th style="width:30%;">PartyName</th>';

          echo '            <th style="width:10%;">CPO Approve</th>';
          echo '            <th style="width:10%;">Dwaring View</th>';

          echo '            <th   style="width:20%">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
            $if_approve ='';
            if ($row->if_approve=='1') {
              $if_approve = 'Yes';
            }elseif($row->if_approve=='0'){
              $if_approve = 'No';
            }
                echo '<tr class="">';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                // echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->quatation_no . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $if_approve . '</td>';           
                echo '    <td><a href="' .$row->file_path . '" target="_blank">View</a></td>';           

              echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        // echo '        <!---<button class="btn btn-xs btn-info btn-print" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        // echo '          Q1 <i class="ace-icon fa fa-print bigger-120"></i> ';
        // echo '        </button>--->';
        // echo '        <button class="btn btn-xs btn-info btn-print" title="Print" onclick="GetReport2(' . $row->id .');return false;">';
        // echo '           Q1<!---<i class="ace-icon fa fa-print bigger-120"></i>---> ';
        // echo '        </button>';
        // echo '        <button class="btn btn-xs btn-info btn-print" title="Print" onclick="GetReportQ2(' . $row->id .');return false;">';
        // echo '           Q2<!---<i class="ace-icon fa fa-print bigger-120"></i>---> ';
        // echo '        </button>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReport5(' . $row->id .',\'' . $row->quatation_selected .'\');return false;">';
        echo '         <i class="ace-icon fa fa-eye bigger-120"></i> ';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Download" onclick="GetDownload(' . $row->id .',\'' . $row->quatation_selected .'\');return false;">';
        echo '          <i class="ace-icon fa fa-download bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="Whatsapp" onclick="GetWhatsapp(' . $row->id .',' . $row->ledger_id .',\'' . $row->quatation_selected .'\');return false;">';
        echo '          <i class="ace-icon fa fa-send bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Mail" onclick="GetMail(' . $row->id .',' . $row->ledger_id .',\'' . $row->quatation_selected .'\');return false;">';
        echo '          <i class="ace-icon fa fa-envelope bigger-120"></i>';
        echo '        </button>';
        // echo '        <button class="btn btn-xs btn-danger btn-print" title="CPO" onclick="GetCpoFormadd(' . $row->id .');return false;">';
        // echo '         CPO<!--- <i class="ace-icon fa fa-envelope bigger-120"></i>--->';
        // echo '        </button>';
        // if ($row->if_approve=='0') {
        echo '        <!--- <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReport4(' . $row->id .');return false;">';
        echo '           <i class="ace-icon fa fa-eye bigger-120"></i> ';
        echo '        </button>--->';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="CPO" onclick="GetCpoFormadd(' . $row->id .');return false;">';
        echo '         CPO<!--- <i class="ace-icon fa fa-envelope bigger-120"></i>--->';
        echo '        </button>';
            // }
        

        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


    function approve_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->approve_list();
      // $this->load->model('transaction_model');
      // $result=$this->transaction_model->sales_list1();
      // print_r($result);die();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          // echo '            <th>Q. No.</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>CPO Approve</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
            $if_approve ='';
            if ($row->if_approve=='1') {
              $if_approve = 'Yes';
            }elseif($row->if_approve=='0'){
              $if_approve = 'No';
            }
                echo '<tr class="">';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                // echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->quatation_no . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $if_approve . '</td>';           
              echo '    <td>';
              echo '      <div class="   btn-group">';  
              // if ($row->if_approve=='0') {
              // echo '        <button class="btn btn-xs btn-primary btn-print" title="CPO" onclick="GetCpoFormadd(' . $row->cpo_id .',' . $row->id .');return false;">';
              // echo '          <i class="ace-icon fa fa-plus bigger-120"></i>';
              // echo '        </button>';
              // }

              if ($row->if_approve=='1') {
              echo '        <button class="btn btn-xs btn-info btn-print" title="CPO Edit" onclick="GetCpoForm(' . $row->id .',' . $row->q_number .');return false;">';
              echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
              echo '        </button>';
              }

              if ($row->if_approve=='1' && $row->filename!='unknown.jpg') {
              echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReport4(' . $row->id .');return false;">';
              echo '           <i class="ace-icon fa fa-eye bigger-120"></i> ';
              echo '        </button>';
              if ($row->fullpath!='') {
                echo '  <a class="btn btn-xs btn-danger btn_modify"  download href="'.$row->fullpath.'" title="CPO Download" >';
                echo '          <i class="ace-icon fa fa-download bigger-120"></i>';
                echo '        </a>';
                // echo '  <a class="btn btn-xs btn-primary btn_modify" target="_blank" href="'.$row->fullpath.'" title="CPO View" >';
                // echo '          <i class="ace-icon fa fa-eye bigger-120"></i>';
                // echo '        </a>';
                }
              
              }
        
              echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }

    function requisition_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->requisition_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th>Date</th>';
          echo '            <th>Jobcard No</th>';
          // echo '            <th>Q. No.</th>';
          echo '            <th>PartyName</th>';
          // echo '            <th>Items</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                // echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->jobcard . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                // echo '    <td>' . $row->items . '</td>';           
                echo '    <td>';
                echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                echo '        </a>';
                echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReporteye(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-eye bigger-120"></i>';
                echo '        </button>';
                echo '        <button class="btn btn-xs btn-info btn-print" title="Print" onclick="GetReport(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
                echo '        </button>';
                echo '        <button class="btn btn-xs btn-danger btn-print" title="Download" onclick="GetDownload(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-download bigger-120"></i>';
                echo '        </button>';
                // echo '        <button class="btn btn-xs btn-info btn-print" title="Whatsapp" onclick="GetWhatsapp(' . $row->id .',' . $row->ledger_id .');return false;">';
                // echo '          <i class="ace-icon fa fa-send bigger-120"></i>';
                // echo '        </button>';
                // echo '        <button class="btn btn-xs btn-danger btn-print" title="Mail" onclick="GetMail(' . $row->id .',' . $row->ledger_id .');return false;">';
                // echo '          <i class="ace-icon fa fa-envelope bigger-120"></i>';
                // echo '        </button>';
                echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }

    function jobcard_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->jobcard_list();
      // echo $this->input->get('vtype');
      // print_r($result);
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          echo '            <th>Jobcard</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Items</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->jobcard . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->items . '</td>'; 
                echo '    <td>';
                echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                echo '        </a>';
                echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReporteye(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-eye bigger-120"></i>';
                echo '        </button>';
                echo '        <button class="btn btn-xs btn-info btn-print" title="Print" onclick="GetReport(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
                echo '        </button>';
                echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }

    function quatation_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->quatation_list();
      print_r($result);
      
    }


function order_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->order_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          // echo '            <th>POS</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Items</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->items . '</td>';
                // echo '    <td>' . $row->dname . '</td>';                
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }

function sales_return_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->sales_return_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          // echo '            <th>POS</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Vehicle No.</th>';
          echo '            <th>Item Type.</th>';
          echo '            <th>Items</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->ledger_mobno . '</td>';
                echo '    <td>' . $row->item_type . '</td>';
                echo '    <td>' . $row->items . '</td>';
                // echo '    <td>' . $row->dname . '</td>';                
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-danger" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }

    function lr_pending_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->lr_pending_list();
      if(count($result)>0)
      {
          echo '<table class="">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th style="width:60px;border:1px solid black;padding:5px;">Date</th>';
          echo '            <th style="width:100px;border:1px solid black;padding:5px;">No</th>';
          // echo '            <th>POS</th>';
          echo '            <th style="width:120px;border:1px solid black;padding:5px;">PartyName</th>';
          echo '            <th style="width:50px;border:1px solid black;padding:5px;">Vehicle No.</th>';
          echo '            <th style="width:200px;border:1px solid black;padding:5px;">Items</th>';
          echo '            <th style="width:100px;border:1px solid black;padding:5px;">LR No</th>';
          echo '            <th style="width:160px;border:1px solid black;padding:5px;">Transport</th>';
          echo '            <th style="width:80px;border:1px solid black;padding:5px;">Freight</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->builtyno . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->lname;
                if($row->remark!="")
                {
                    echo '<br><span style="font-size:10px;font-weight:bold;">'.$row->remark.'</span>';
                }
                echo '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->ledger_mobno . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->items . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;"><input type="hidden" name="id[]" value="'.$row->id.'"><input type="text" name="lr_no[]" class="col-xs-8 col-sm-10"></td>';
                echo '    <td style="border:1px solid black;padding:5px;"><input type="text" name="transport[]" class="col-xs-8 col-sm-10" ></td>';
                echo '    <td style="border:1px solid black;padding:5px;"><input type="text" name="lr_freight[]" class="col-xs-8 col-sm-10" ></td>';
                              
                echo '</tr>';
          }

      }
      echo '</table>';
          echo '<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
          <button  tabindex="12" class="btn btn-info" type="button" id="jham" onclick="save_lr_entry();return false;" >
            <i class="ace-icon fa fa-check bigger-110"></i>
            Submit
          </button>
          </div>
        </div>  ';
      
    }
    
    public function save_lr_entry()
    {
      $this->load->model('transaction_model');
      $this->transaction_model->save_lr_entry();
    }








    function lr_return_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->lr_return_list();
      if(count($result)>0)
      {
          echo '<table class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          // echo '            <th>POS</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Vehicle No.</th>';
          echo '            <th>Items</th>';
          echo '            <th>LR No</th>';
          echo '            <th>Transport</th>';
          echo '            <th>Freight</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->ledger_mobno . '</td>';
                echo '    <td>' . $row->items . '</td>';
                echo '    <td><input type="hidden" name="id[]" value="'.$row->id.'"><input type="text" name="lr_no[]" class="col-xs-8 col-sm-10"></td>';
                echo '    <td><input type="text" name="transport[]" class="col-xs-8 col-sm-10" ></td>';
                echo '    <td><input type="text" name="lr_freight[]" class="col-xs-8 col-sm-10" ></td>';
                              
                echo '</tr>';
          }

      }
      echo '</table>';
          echo '<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
          <button  tabindex="12" class="btn btn-info" type="button" id="jham" onclick="save_lr_entry();return false;" >
            <i class="ace-icon fa fa-check bigger-110"></i>
            Submit
          </button>
          </div>
        </div>  ';
      
    }
    
    public function save_lr_return_entry()
    {
      $this->load->model('transaction_model');
      $this->transaction_model->save_lr_return_entry();
    }


    function sales_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('sales_print', $data);
//      pdf_create($html, 'Challan');
    }

    function q1_bill_print($id){
      $data=array(
      'id'=>$id,
      'custome_list'=>customes_list(),
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('q1_bill_print', $data);
    }

    function q2_bill_print($id){
      $data=array(
      'id'=>$id,
      'custome_list'=>customes_list(),
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('q2_bill_print', $data);
    }

    function q21_bill_print($id){
      $data=array(
      'id'=>$id,
      'custome_list'=>customes_list(),
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('q21_bill_print', $data);
    }

    function q2_bill_view($id){
      $data=array(
      'id'=>$id,
      'custome_list'=>customes_list(),
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('q2_bill_view', $data);
    }

    function purchase_bill_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('purchase_bill_print', $data);
    }

    function purchase_bill_printeye($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('purchase_bill_printeye', $data);
    }


    function work_order_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('wo_print', $data);
    }

    function work_order_printeye($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('wo_printeye', $data);
    }

    function q3format_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('q3format_print', $data);
    }

    function q3format_printeye($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('q3format_printeye', $data);
    }

    function voucher_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('voucher_print', $data);
    }


    function voucher_printeye($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('voucher_printeye', $data);
    }

    function invoices_bill_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('invoices_bill_print', $data);
    }

    function invoices_bill_printeye($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('invoices_bill_printeye', $data);
    }

    function jobcard_bill_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('jobcard_bill_print', $data);
    }

    function approval_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('approval_print', $data);
    }

    function job_bill_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('job_bill_print', $data);
    }


    function job_bill_printeye($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('job_bill_printeye', $data);
    }

    function requisition_bill_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('requisition_bill_print', $data);
    }


    function requisition_bill_printeye($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
      $this->load->view('requisition_bill_printeye', $data);
    }

    function receipt_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
//      $html = $this->load->view('receipt_print', $data, true);
//      pdf_create($html, 'Receipt');
        $this->load->view('receipt_print', $data);
    }

    function sales_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        
        $i=1;
        $path="./uploads";
            //print_r($_FILES);die;
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
       //print_r($_FILES['photo']);die;
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                // $r=rand(10,1000);                

                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf|dwg';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->sales_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { // For Empty Photo or Update
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->sales_save($tableName, null, $id,$full_path,$fullname);

        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->sales_save($tableName, null, $id,$full_path,$fullname);
       
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }


    function requisition_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        
        $i=1;
        $path="./uploads";
            //print_r($_FILES);die;
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
       //print_r($_FILES['photo']);die;
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                // $r=rand(10,1000);                

                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                        //echo "2"; // Error
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->requisition_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { // For Empty Photo or Update
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->requisition_save($tableName, null, $id,$full_path,$fullname);
        // $pieces = explode(",", $status);
        // if($pieces[0]==true)
        // {
        //  echo '1';
        // }
        // else{
        //  echo '2';
        // }
        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->requisition_save($tableName, null, $id,$full_path,$fullname);
        // $pieces = explode(",", $status);
        // if($pieces[0]==true)
        // {
        //  echo '1';
        // }
        // else{
        //  echo '2';
        // }
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }


    function jobcard_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        
        $i=1;
        $path="./uploads";
            //print_r($_FILES);die;
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
       //print_r($_FILES['photo']);die;
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                // $r=rand(10,1000);                

                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                        //echo "2"; // Error
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->jobcard_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { // For Empty Photo or Update
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->jobcard_save($tableName, null, $id,$full_path,$fullname);
        // $pieces = explode(",", $status);
        // if($pieces[0]==true)
        // {
        //  echo '1';
        // }
        // else{
        //  echo '2';
        // }
        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->jobcard_save($tableName, null, $id,$full_path,$fullname);
        // $pieces = explode(",", $status);
        // if($pieces[0]==true)
        // {
        //  echo '1';
        // }
        // else{
        //  echo '2';
        // }
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }



    function invoices_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        $i=1;
        $path="./uploads";
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];           

                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) 
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->invoices_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { 
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->invoices_save($tableName, null, $id,$full_path,$fullname);
        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->invoices_save($tableName, null, $id,$full_path,$fullname);
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }


    function voucher_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        
        $i=1;
        $path="./uploads";
            //print_r($_FILES);die;
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
       //print_r($_FILES['photo']);die;
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                // $r=rand(10,1000);                

                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                        //echo "2"; // Error
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->voucher_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { // For Empty Photo or Update
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->voucher_save($tableName, null, $id,$full_path,$fullname);
        // $pieces = explode(",", $status);
        // if($pieces[0]==true)
        // {
        //  echo '1';
        // }
        // else{
        //  echo '2';
        // }
        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->voucher_save($tableName, null, $id,$full_path,$fullname);
        // $pieces = explode(",", $status);
        // if($pieces[0]==true)
        // {
        //  echo '1';
        // }
        // else{
        //  echo '2';
        // }
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }


    function purchases_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        
        $i=1;
        $path="./uploads";
            //print_r($_FILES);die;
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
       //print_r($_FILES['photo']);die;
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                // $r=rand(10,1000);                

                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                        //echo "2"; // Error
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->purchases_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { // For Empty Photo or Update
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->purchases_save($tableName, null, $id,$full_path,$fullname);
        // $pieces = explode(",", $status);
        // if($pieces[0]==true)
        // {
        //  echo '1';
        // }
        // else{
        //  echo '2';
        // }
        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->purchases_save($tableName, null, $id,$full_path,$fullname);
        // $pieces = explode(",", $status);
        // if($pieces[0]==true)
        // {
        //  echo '1';
        // }
        // else{
        //  echo '2';
        // }
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }



    function approve_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        $i=1;
        $path="./uploads";
            //print_r($_FILES);die;
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
       // print_r($_FILES['photo']);die;
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf|xlsx|csv|xls|doc|docx';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                // echo $path;die();
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    // echo $full_path;echo $data;die();
                    $status = $this->transaction_model->approve_save($tableName, null, $id,$full_path,$data['file_name']);
                    // echo " dfhdf";
                    echo $status;
                }
            }
            else if(isset($_POST['filepath'])){
                $full_path=$_POST['filepath'];
                $fullname=$_POST['filename'];
                $status = $this->transaction_model->approve_save($tableName, null, $id,$full_path,$fullname);
                echo $status;
            }
            else
            {
              $full_path=base_url().'uploads/'.'unknown.jpg';
              $fullname='unknown.jpg';
              $status = $this->transaction_model->approve_save($tableName, null, $id,$full_path,$fullname);
              echo $status;
            }
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }



    }


    function purchase_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        
        $i=1;
        $path="./uploads";
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->purchase_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { // For Empty Photo or Update
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->purchase_save($tableName, null, $id,$full_path,$fullname);
        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->purchase_save($tableName, null, $id,$full_path,$fullname);
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }


    function work_order_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        
        $i=1;
        $path="./uploads";
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->work_order_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { // For Empty Photo or Update
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->work_order_save($tableName, null, $id,$full_path,$fullname);
        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->work_order_save($tableName, null, $id,$full_path,$fullname);
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }


    function q3format_save($tableName,$id)
    {
        $opt=$this->input->post('status');
        $this->load->model('transaction_model');
        $file_ext='';
        $rename_file_name='';
        
        $i=1;
        $path="./uploads";
        if(is_dir($path)==false)
        {
            $structure = $path;
    
            if(!mkdir($structure, 0, true)) {
    
            }
        }
        try{
            if(!empty($_FILES['photo']["name"]))
            {
                $temp_file_name = $_FILES['photo']['name'];
                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;
                if (!$this->upload->do_upload('photo')) // put the name tag value inside i.e UnderImage
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    foreach ($error as $d){
                        echo $d;
                    }
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path=base_url().'uploads/'.$data['file_name'];
                    $status = $this->transaction_model->q3format_save($tableName, null, $id,$full_path,$data['file_name']);
                }
            }
            else if(isset($_POST['filepath']))
            { // For Empty Photo or Update
        $full_path=$_POST['filepath'];
        $fullname=$_POST['filename'];
        $status = $this->transaction_model->q3format_save($tableName, null, $id,$full_path,$fullname);
        echo $status;
      }
      else
      {
        $full_path=base_url().'uploads/'.'unknown.jpg';
        $fullname='unknown.jpg';
        $status = $this->transaction_model->q3format_save($tableName, null, $id,$full_path,$fullname);
        echo $status;
      }
           
        }
        catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";  
        }
    }

    //  function sales_save(){
    //   $this->load->model('transaction_model');
    //   $this->transaction_model->sales_save();
    // }
     function sales_save_modify(){
      $this->load->model('transaction_model');
      $this->transaction_model->sales_save_modify();
    }
    
    function sales_get()
    { 
        $this->load->model('transaction_model');
        $this->transaction_model->sales_get();
    }

    function q3_get()
    { 
        $this->load->model('transaction_model');
        $this->transaction_model->q3_get();
    }

    function cpo_get()
    { 
        $this->load->model('transaction_model');
        $this->transaction_model->cpo_get();
    }


    function jobcard_get()
    { 
        $this->load->model('transaction_model');
        $this->transaction_model->jobcard_get();
    }


    function requisition_get()
    { 
        $this->load->model('transaction_model');
        $this->transaction_model->requisition_get();
    }



     function inv_get()
    { 
        $this->load->model('transaction_model');
        $this->transaction_model->inv_get();
    }




     function order_save(){
      $this->load->model('transaction_model');
      $this->transaction_model->order_save();
    }
     function order_save_modify(){
      $this->load->model('transaction_model');
      $this->transaction_model->order_save_modify();
    }
     function order_get()
        { 
          $this->load->model('transaction_model');
          $this->transaction_model->order_get();
        }



    function sales_ret_bill_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
 //     $html = $this->load->view('sales_return_print', $data, true);
//      pdf_create($html, 'Challan');
      $this->load->view('sales_ret_bill_print', $data);
    }

    function sales_return_print($id){
      $data=array(
      'id'=>$id
      );
      $this->load->helper(array('dompdfA4', 'file'));
 //     $html = $this->load->view('sales_return_print', $data, true);
//      pdf_create($html, 'Challan');
      $this->load->view('sales_return_print', $data);
    }


    function quotation_print($id,$quotation_print){
      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      if ($quotation_print=='Q1') {
        $html = $this->load->view('quotation_print', $data, true);
      }else{
        $html = $this->load->view('q21_bill_print1', $data, true);
      }
      
      $this->load->helper('file');

        require_once 'vendor/autoload.php';
        $pdf = new DOMPDF();
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream("Quotation.pdf", array("Attachment"=>0));
    }

    function purchase_download($id){
      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('purchase_download', $data, true);
      $this->load->helper('file');

        require_once 'vendor/autoload.php';
        $pdf = new DOMPDF();
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream("Purchase.pdf", array("Attachment"=>0));
    }


    function work_order_download($id){
      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('wo_print', $data, true);
      $this->load->helper('file');
        require_once 'vendor/autoload.php';
        $pdf = new DOMPDF();
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream("Work Order.pdf", array("Attachment"=>0));
    }


    function requisition_download($id){
      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('requisition_bill_print', $data, true);
      $this->load->helper('file');

        require_once 'vendor/autoload.php';
        $pdf = new DOMPDF();
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream("Requisition.pdf", array("Attachment"=>0));
    }

    function invoices_download($id){
      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('invoices_bill_print', $data, true);
      $this->load->helper('file');

        require_once 'vendor/autoload.php';
        $pdf = new DOMPDF();
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream("Invoice.pdf", array("Attachment"=>0));
    }

    function invoices_whatsapp(){

      $id = $this->input->post('gid');
      $ledger_id = $this->input->post('ledger_id');
      $body = $this->input->post('body');
      $name = '';
      $mobileno = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $mobileno = $row->mobileno;
          }
      }
      $ins = '';
      $api = '';
      $query1=$this->db->query('select * from api order by id desc limit 1');
      if($query1->num_rows()>0)    
      {          
          foreach($query1->result() as $row1)
          {
            $ins = $row1->apiins;
            $api = $row1->apikey;
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('invoices_bill_print', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."invoice".$id.".pdf", $output);
      $mobile = $mobileno;
      $media = base_url()."whatsapp/invoice".$id.".pdf";
      $msg = "";
      $msg =$body;
      $filename = "invoice";
      $url = "https://techvakeservices.com/api/send?number=91".$mobile."&type=media&message=".$msg."&media_url=".$media."&filename=".$filename."&instance_id=".$ins."&access_token=".$api;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      echo "1";
    }

    function requisition_whatsapp(){

      $id = $this->input->get('id');
      $ledger_id = $this->input->get('ledger_id');
      // $partylist=ledger_list($ledger_id);
      $name = '';
      $mobileno = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $mobileno = $row->mobileno;
          }
      }
      $ins = '';
      $api = '';
      $query1=$this->db->query('select * from api order by id desc limit 1');
      if($query1->num_rows()>0)    
      {          
          foreach($query1->result() as $row1)
          {
            $ins = $row1->apiins;
            $api = $row1->apikey;
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('requisition_bill_print', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."Requisition".$id.".pdf", $output);
      $mobile = $mobileno;
      $media = base_url()."whatsapp/Requisition".$id.".pdf";
      $msg = "";
      $filename = "Requisition";
      $url = "https://techvakeservices.com/api/send.php?number=91".$mobile."&type=media&message=".$msg."&media_url=".$media."&filename=".$filename."&instance_id=".$ins."&access_token=".$api;
      $options = array(
      'http' => array(
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      )
      );
      $context = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      // echo "<script>history.back();window.close();</script>";
      echo "1";
    }

    function quotation_whatsapp(){

      $id = $this->input->post('gid');
      // print_r($id);die();
      $quotation_print = $this->input->post('quatation_selected');
      $ledger_id = $this->input->post('ledger_id');
      $body = $this->input->post('body');
      // $quotation_print = $this->input->get('quotation_print');

      // $ledger_id = $this->input->get('ledger_id');
      // $partylist=ledger_list($ledger_id);
      $name = '';
      $mobileno = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $mobileno = $row->mobileno;
          }
      }
      $ins = '';
      $api = '';
      $query1=$this->db->query('select * from api order by id desc limit 1');
      if($query1->num_rows()>0)    
      {          
          foreach($query1->result() as $row1)
          {
            $ins = $row1->apiins;
            $api = $row1->apikey;
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html='';
      if ($quotation_print=='Q1') {
        $html = $this->load->view('quotation_print', $data, true);
      }

      if ($quotation_print=='Q2') {
        $html = $this->load->view('q21_bill_print1', $data, true);
      }

      if ($quotation_print=='Q3') {
        $html = $this->load->view('q3format_print', $data, true);
      }

      // echo $html;die();

      // $html = $this->load->view('quotation_print', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."Quotation".$id.".pdf", $output);
      $mobile = "91".$mobileno;
      $mobile = '917470632201';

      $media = base_url()."whatsapp/Quotation".$id.".pdf";

      $msg =$body;
      $filename = "Quotation";
      $url = "https://techvakeservices.com/api/send?number=91".$mobile."&type=media&message=".$msg."&media_url=".$media."&filename=".$filename."&instance_id=".$ins."&access_token=".$api;
      $ch = curl_init();
      $timeout = 5;
      $curl = curl_init( 'https://techvakeservices.com/api/send' );
      curl_setopt( $curl, CURLOPT_POST, true );
      curl_setopt( $curl, CURLOPT_POSTFIELDS, array( 'number' => $mobile, 'type' => 'media', 'message' => $msg, 'media_url' => $media, 'instance_id' => $ins, 'access_token' => $api ) );
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
      $response = curl_exec( $curl );
      curl_close( $curl );
      // print_r($response);
      echo "1";
    }


    function workorder_whatsapp(){

      $id = $this->input->post('gid');
      $ledger_id = $this->input->post('ledger_id');
      $body = $this->input->post('body');
      $name = '';
      $mobileno = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $mobileno = $row->mobileno;
          }
      }
      $ins = '';
      $api = '';
      $query1=$this->db->query('select * from api order by id desc limit 1');
      if($query1->num_rows()>0)    
      {          
          foreach($query1->result() as $row1)
          {
            $ins = $row1->apiins;
            $api = $row1->apikey;
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('wo_print', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."WorkOrder".$id.".pdf", $output);
      $mobile = $mobileno;
      // $mobile = '7470632201';

      $media = base_url()."whatsapp/WorkOrder".$id.".pdf";
      $msg =$body;
      $filename = "WorkOrder";
      $url = "https://techvakeservices.com/api/send?number=91".$mobile."&type=media&message=".$msg."&media_url=".$media."&filename=".$filename."&instance_id=".$ins."&access_token=".$api;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      echo "1";
    }

    function quotation_whatsapp1(){

      $id = $this->input->get('id');
      $ledger_id = $this->input->get('ledger_id');
      // $partylist=ledger_list($ledger_id);
      $name = '';
      $mobileno = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $mobileno = $row->mobileno;
          }
      }
      $ins = '';
      $api = '';
      $query1=$this->db->query('select * from api order by id desc limit 1');
      if($query1->num_rows()>0)    
      {          
          foreach($query1->result() as $row1)
          {
            $ins = $row1->apiins;
            $api = $row1->apikey;
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('q21_bill_print1', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."QuotationQ2".$id.".pdf", $output);
      $mobile = $mobileno;
      $media = base_url()."whatsapp/QuotationQ2".$id.".pdf";
      $msg = "";
      $filename = "Quotation";
      $url = "https://techvakeservices.com/api/send.php?number=91".$mobile."&type=media&message=".$msg."&media_url=".$media."&filename=".$filename."&instance_id=".$ins."&access_token=".$api;
      $options = array(
      'http' => array(
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      )
      );
      $context = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      // echo "<script>history.back();window.close();</script>";
      echo "1";
    }

    function invoices_mail(){
      $this->load->helper('path');
      $id = $this->input->post('gid');
      $ledger_id = $this->input->post('ledger_id');
      $mailbody = $this->input->post('mailbody');
      $subject = $this->input->post('subject');
      $name = '';
      $emailid = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $emailid = strtolower($row->emailid);
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('invoices_bill_print', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."invoice".$id.".pdf", $output);

      $media = base_url()."whatsapp/invoice".$id.".pdf";
      $email = $emailid;
      $to = $emailid;

      $to = $emailid;
      // $to = 'tocabd@gmail.com';

      $smg = $mailbody.'<br>'.$media;
      $header = "From:account@mindus.in \r\n";
      $header .= "Cc:account@mindus.in \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      if(mail($to,$subject,$smg,$header)){
        echo "1";
      }else{
        echo "2";          
      }
    }

    function quotation_mail1(){
      $this->load->helper('path');
      $id = $this->input->get('id');
      $ledger_id = $this->input->get('ledger_id');
      $name = '';
      $emailid = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $emailid = strtolower($row->emailid);
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('q21_bill_print1', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."QuotationQ2".$id.".pdf", $output);

      $media = base_url()."whatsapp/QuotationQ2".$id.".pdf";
      $email = $emailid;
      $to = $emailid;

      $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.gmail.com',
          'smtp_port' => 465,
          'smtp_user' => 'bdewangankonsole420@gmail.com', // change it to yours
          'smtp_pass' => 'fbtsqwikfpikxrtx', // change it to yours
          'mailtype'  => 'html',
          // 'mailpath'  => '',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );
      $smg = 'Metalite Industries<br>
      '.$media.'
      Dear Sir,

      This has with reference to your quotation and our talk, please find herewith attached purchase order.

      Kindly send your acceptance.

      ................
      Warm Regards,
      Venketeshwar Agrawal
      Metalite Industries
      Contact: +91 70528 99999
    <br>';
      $this->load->library('email');
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from($config['smtp_user']); // change it to yours
      $this->email->to($to);// change it to yours
      $this->email->subject('Quotation');
      $this->email->message($smg);
      if($this->email->send()){
        echo "1";
      }else{
        echo "2";          
      }
    }

    function quotation_mail(){
      $this->load->helper('path');
      $id = $this->input->post('gid');
      // print_r($id);die();
      $quotation_print = $this->input->post('quatation_selected');
      $ledger_id = $this->input->post('ledger_id');
      $mailbody = $this->input->post('mailbody');
      $subject = $this->input->post('subject');
      // print_r($subject);die();


      $name = '';
      $emailid = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $emailid = strtolower($row->emailid);
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html='';
      if ($quotation_print=='Q1') {
        $html = $this->load->view('quotation_print', $data, true);
      }

      if ($quotation_print=='Q2') {
        $html = $this->load->view('q21_bill_print1', $data, true);
      }

      if ($quotation_print=='Q3') {
        $html = $this->load->view('q3format_print', $data, true);
      }

      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."Quotation".$id.".pdf", $output);

      $media = base_url()."whatsapp/Quotation".$id.".pdf";
      $email = $emailid;
      $to = $emailid;
      // $to = 'tocabd@gmail.com';

      $smg = $mailbody.'<br>'.$media;
      $header = "From:sales@mindus.in \r\n";
      $header .= "Cc:sales@mindus.in \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      if(mail($to,$subject,$smg,$header)){
        echo "1";
      }else{
        echo "2";          
      }
    }

    function purchase_whatsapp(){

      $id = $this->input->post('gid');
      $ledger_id = $this->input->post('ledger_id');
      $body = $this->input->post('body');
      $name = '';
      $mobileno = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $mobileno = $row->mobileno;
          }
      }
      $ins = '';
      $api = '';
      $query1=$this->db->query('select * from api order by id desc limit 1');
      if($query1->num_rows()>0)    
      {          
          foreach($query1->result() as $row1)
          {
            $ins = $row1->apiins;
            $api = $row1->apikey;
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('purchase_download', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."Purchase".$id.".pdf", $output);
      $mobile = $mobileno;
      $media = base_url()."whatsapp/Purchase".$id.".pdf";
      $msg = "";
      $msg =$body;
      $filename = "Purchase";
      $url = "https://techvakeservices.com/api/send?number=91".$mobile."&type=media&message=".$msg."&media_url=".$media."&filename=".$filename."&instance_id=".$ins."&access_token=".$api;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      echo "1";
    }

    function requisition_mail(){
      $this->load->helper('path');
      $id = $this->input->get('id');
      $ledger_id = $this->input->get('ledger_id');
      $name = '';
      $emailid = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $emailid = strtolower($row->emailid);
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('requisition_bill_print', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."Requisition".$id.".pdf", $output);

      $media = base_url()."whatsapp/Requisition".$id.".pdf";
      $email = $emailid;
      $to = $emailid;

      $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.gmail.com',
          'smtp_port' => 465,
          'smtp_user' => 'bdewangankonsole420@gmail.com', // change it to yours
          'smtp_pass' => 'fbtsqwikfpikxrtx', // change it to yours
          'mailtype'  => 'html',
          // 'mailpath'  => '',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );
      $smg = 'Metalite Industries<br>
      '.$media.'
      Dear Sir,

      This has with reference to your quotation and our talk, please find herewith attached purchase order.

      Kindly send your acceptance.

      ................
      Warm Regards,
      Venketeshwar Agrawal
      Metalite Industries
      Contact: +91 70528 99999
    <br>';
      $this->load->library('email');
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from($config['smtp_user']); // change it to yours
      $this->email->to($to);// change it to yours
      $this->email->subject('Requisition');
      $this->email->message($smg);
      if($this->email->send()){
        echo "1";
      }else{
        echo "2";          
      }
    }

    function purchase_mail(){
      $this->load->helper('path');
      $id = $this->input->post('gid');
      $ledger_id = $this->input->post('ledger_id');
      $mailbody = $this->input->post('mailbody');
      $subject = $this->input->post('subject');
      $name = '';
      $emailid = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $emailid = strtolower($row->emailid);
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('purchase_download', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."Purchase".$id.".pdf", $output);

      $media = base_url()."whatsapp/Purchase".$id.".pdf";
      $email = $emailid;
      $to = $emailid;

      $to = $emailid;
      // $to = 'tocabd@gmail.com';

      $smg = $mailbody.'<br>'.$media;
      $header = "From:purchase@mindus.in \r\n";
      $header .= "Cc:purchase@mindus.in \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      if(mail($to,$subject,$smg,$header)){
        echo "1";
      }else{
        echo "2";          
      }
      
    }


    function workorder_mail(){
      $this->load->helper('path');
      $id = $this->input->post('gid');
      $ledger_id = $this->input->post('ledger_id');
      $mailbody = $this->input->post('mailbody');
      $subject = $this->input->post('subject');
      $name = '';
      $emailid = '';
      $query=$this->db->query('select * from m_ledger where id="'.$ledger_id.'"');
      if($query->num_rows()>0)    
      {          
          foreach($query->result() as $row)
          {
            $name=$row->name;
            $emailid = strtolower($row->emailid);
          }
      }

      $this->load->helper('html');
      $data=array(
      'id'=>$id
      );
      $html = $this->load->view('wo_print', $data, true);
      $this->load->helper('file');
      $filePath = FCPATH."/whatsapp/";
      require_once 'vendor/autoload.php';
      $pdf = new DOMPDF();
      $pdf->set_option('isRemoteEnabled', TRUE);
      $pdf->loadHtml($html);
      $pdf->setPaper('A4', 'portrait');
      $pdf->render();
      $output = $pdf->output();
      file_put_contents($filePath."WorkOrder".$id.".pdf", $output);

      $media = base_url()."whatsapp/WorkOrder".$id.".pdf";
      $email = $emailid;
      $to = $emailid;

      $to = $emailid;
      // $to = 'tocabd@gmail.com';

      $smg = $mailbody.'<br>'.$media;
      $header = "From:purchase@mindus.in \r\n";
      $header .= "Cc:purchase@mindus.in \r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";
      if(mail($to,$subject,$smg,$header)){
        echo "1";
      }else{
        echo "2";          
      }
      
    }

  

     function sales_return_save(){
      $this->load->model('transaction_model');
      $this->transaction_model->sales_return_save();
    }
     function sales_return_save_modify(){
      $this->load->model('transaction_model');
      $this->transaction_model->sales_return_save_modify();
    }
     function sales_return_get()
        { 
          $this->load->model('transaction_model');
          $this->transaction_model->sales_return_get();
        }

     function receipt_save(){
      $this->load->model('transaction_model');
      $this->transaction_model->receipt_save();
    }

     function GetAuto()
        {
          $vtype = $this->input->get("vtype");
          $cdate=date('d-m-Y');
          $builtyno=0;
          $previd=0;

/*          $query=$this->db->query("select max(cdate) as cdate from tbl_trans1 where vtype='".$vtype."' and company_id=".get_cookie("ae_company_id"));
          $result=$query->result();
          if(count($result)>0)
          {
            foreach($result as $row)
            {
              $cdate = date('d-m-Y',strtotime($row->cdate));
            }
          }
*/
          $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_trans1 where cdate='".date('Y-m-d',strtotime($cdate))."' and vtype='".$vtype."' and company_id=".get_cookie("ae_company_id"));
          $result=$query->result();
          if(count($result)>0)
          {
            foreach($result as $row)
            {
              $builtyno = $row->builtyno;
            }
          }
          $builtyno++;

          if(get_cookie('ae_userpermission')==1)
          {
            $query=$this->db->query("select max(id) as id from tbl_trans1 where vtype='sales' and company_id=".get_cookie("ae_company_id"));
          }
          else
          {
            $query=$this->db->query("select max(id) as id from tbl_trans1 where billstatus!='clear' and vtype='sales' and company_id=".get_cookie("ae_company_id"));
          }
          $result=$query->result();
          if(count($result)>0)
          {
            foreach($result as $row)
            {
              $previd=$row->id;
            }
          }

          $data = array(
              "Message"=>"Success",
              "cdate"=>$cdate,
              "builtyno"=>$builtyno,
              "previd"=>$previd
            );
          echo json_encode($data);

        }


        function GetAutoJobcard()
        {
          $vtype = $this->input->get("vtype");

          $maxsno=0;
            $query=$this->db->query("select max(job_sno) as maxsno from tbl_trans1");
            $result=$query->result();
            if($query->num_rows()>0)
            {
              foreach($result as $row)
              {
                $maxsno = intval($row->maxsno)+1;
              }
            }
            $job_sno=$maxsno;
            $maxsno1='';
            if(strlen($maxsno)==1){
              $maxsno1="00".$maxsno;
            }elseif (strlen($maxsno)==2) {
              $maxsno1="0".$maxsno;
            }else{
              $maxsno1=$maxsno;
            }
            $jobcard='MI/JC/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;

            echo $jobcard;

        }


     function GetAutoOrder()
        {
          $vtype = $this->input->get("vtype");
          $cdate=date('d-m-Y');
          $builtyno=0;
          $previd=0;

/*          $query=$this->db->query("select max(cdate) as cdate from tbl_trans1 where vtype='".$vtype."' and company_id=".get_cookie("ae_company_id"));
          $result=$query->result();
          if(count($result)>0)
          {
            foreach($result as $row)
            {
              $cdate = date('d-m-Y',strtotime($row->cdate));
            }
          }
*/
          $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_order1 where cdate='".date('Y-m-d',strtotime($cdate))."' and vtype='".$vtype."' and company_id=".get_cookie("ae_company_id"));
          $result=$query->result();
          if(count($result)>0)
          {
            foreach($result as $row)
            {
              $builtyno = $row->builtyno;
            }
          }
          $builtyno++;

          if(get_cookie('ae_userpermission')==1)
          {
            $query=$this->db->query("select max(id) as id from tbl_order1 where vtype='sales' and company_id=".get_cookie("ae_company_id"));
          }
          else
          {
            $query=$this->db->query("select max(id) as id from tbl_order1 where billstatus!='clear' and vtype='sales' and company_id=".get_cookie("ae_company_id"));
          }
          $result=$query->result();
          if(count($result)>0)
          {
            foreach($result as $row)
            {
              $previd=$row->id;
            }
          }

          $data = array(
              "Message"=>"Success",
              "cdate"=>$cdate,
              "builtyno"=>$builtyno,
              "previd"=>$previd
            );
          echo json_encode($data);

        }

        function receipt_get()
        {
          $this->load->model('transaction_model');
          $this->transaction_model->receipt_get();
        }

///////////////////////


    function payment_get()
        {
          $this->load->model('transaction_model');
          $this->transaction_model->payment_get();
        }

    function crnote_get()
        {
          $this->load->model('transaction_model');
          $this->transaction_model->crnote_get();
        }

    function drnote_get()
        {
          $this->load->model('transaction_model');
          $this->transaction_model->drnote_get();
        }

///////////////////////


        ////////////////////////

        ////////////////////////////

function purchase_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->purchase_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          // echo '            <th>POS</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Items</th>';
          echo '            <th>Document</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->items . '</td>';
                // echo '    <td>' . $row->dname . '</td>';    
                if ($row->file_path!='') 
              {                
                echo '    <td> <a href="' . $row->file_path . '" target="_blank">View</a></td>';    
              }
              else
              {
                echo '    <td> No Docs</td>';   
              }                    
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReporteye(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-eye bigger-120"></i>';
                echo '        </button>';
        echo '        <button class="btn btn-xs btn-info" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Download" onclick="GetDownload(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-download bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="Whatsapp" onclick="GetWhatsapp(' . $row->id .',' . $row->ledger_id .');return false;">';
        echo '          <i class="ace-icon fa fa-send bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Mail" onclick="GetMail(' . $row->id .',' . $row->ledger_id .');return false;">';
        echo '          <i class="ace-icon fa fa-envelope bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


    function wo_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->wo_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          // echo '            <th>POS</th>';
          echo '            <th>PartyName</th>';
          // echo '            <th>Items</th>';
          echo '            <th>Document</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                // echo '    <td>' . $row->items . '</td>';
                // echo '    <td>' . $row->dname . '</td>';    
                if ($row->file_path!='') 
              {                
                echo '    <td> <a href="' . $row->file_path . '" target="_blank">View</a></td>';    
              }
              else
              {
                echo '    <td> No Docs</td>';   
              }                    
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReporteye(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-eye bigger-120"></i>';
                echo '        </button>';
        echo '        <button class="btn btn-xs btn-info" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Download" onclick="GetDownload(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-download bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="Whatsapp" onclick="GetWhatsapp(' . $row->id .',' . $row->ledger_id .');return false;">';
        echo '          <i class="ace-icon fa fa-send bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Mail" onclick="GetMail(' . $row->id .',' . $row->ledger_id .');return false;">';
        echo '          <i class="ace-icon fa fa-envelope bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


     function q3format_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->q3format_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          echo '            <th>SNo</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Dwaring View  </th>';
          echo '            <th   style="width:250px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->quatation_no . '</td>';
                echo '    <td>' . $row->lname . '</td>'; 
                if ($row->file_path!='') 
              {                
                echo '    <td> <a href="' . $row->file_path . '" target="_blank">View</a></td>';    
              }
              else
              {
                echo '    <td> No Docs</td>';   
              }                    
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReporteye(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-eye bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-info" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
        echo '        </button>';
        // echo '        <button class="btn btn-xs btn-danger btn-print" title="Download" onclick="GetDownload(' . $row->id .',\'' . $row->quatation_selected .'\');return false;">';
        // echo '          <i class="ace-icon fa fa-download bigger-120"></i>';
        // echo '        </button>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="Whatsapp" onclick="GetWhatsapp(' . $row->id .',' . $row->ledger_id .',\'' . $row->quatation_selected .'\');return false;">';
        echo '          <i class="ace-icon fa fa-send bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Mail" onclick="GetMail(' . $row->id .',' . $row->ledger_id .',\'' . $row->quatation_selected .'\');return false;">';
        echo '          <i class="ace-icon fa fa-envelope bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="CPO" onclick="GetCpoFormadd(' . $row->id .');return false;">';
        echo '         CPO<!--- <i class="ace-icon fa fa-envelope bigger-120"></i>--->';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }

    function voucher_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->voucher_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th>Date</th>';
          echo '            <th>Payable&nbsp;To</th>';
          echo '            <th>Ref.&nbsp;No</th>';
          echo '            <th>Type&nbsp;Of&nbsp;Payment</th>';
          echo '            <th>Payable&nbsp;Amount</th>';
          echo '            <th>Cash</th>';
          echo '            <th>Card</th>';
          echo '            <th>Bank</th>';
          echo '            <th>UPI</th>';
          echo '            <th>Left&nbsp;Amount</th>';
          echo '            <th>Remark</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->refno . '</td>';   
                echo '    <td>' . $row->typeofpayment . '</td>';              
                echo '    <td>' . $row->payable_amount . '</td>';              
                echo '    <td>' . $row->cash . '</td>';              
                echo '    <td>' . $row->card . '</td>';              
                echo '    <td>' . $row->bank . '</td>';              
                echo '    <td>' . $row->upi . '</td>';              
                echo '    <td>' . $row->total_amt . '</td>';              
                echo '    <td>' . $row->remark . '</td>';              
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReporteye(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-eye bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-info" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
        echo '        </button>';
        // echo '        <button class="btn btn-xs btn-danger btn-print" title="Download" onclick="GetDownload(' . $row->id .');return false;">';
        // echo '          <i class="ace-icon fa fa-download bigger-120"></i>';
        // echo '        </button>';
        // echo '        <button class="btn btn-xs btn-info btn-print" title="Whatsapp" onclick="GetWhatsapp(' . $row->id .',' . $row->ledger_id .');return false;">';
        // echo '          <i class="ace-icon fa fa-send bigger-120"></i>';
        // echo '        </button>';
        // echo '        <button class="btn btn-xs btn-danger btn-print" title="Mail" onclick="GetMail(' . $row->id .',' . $row->ledger_id .');return false;">';
        // echo '          <i class="ace-icon fa fa-envelope bigger-120"></i>';
        // echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


    function invoices_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->invoices_list();
      // print_r($result);
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>INVOICE NO</th>';
          echo '            <th>Quatation</th>';
          echo '            <th>PartyName</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->invoice_no . '</td>';
                echo '    <td>' . $row->quatation . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="View" onclick="GetReporteye(' . $row->id .');return false;">';
                echo '          <i class="ace-icon fa fa-eye bigger-120"></i>';
                echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Download" onclick="GetDownload(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-download bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-info btn-print" title="Whatsapp" onclick="GetWhatsapp(' . $row->id .',' . $row->ledger_id .');return false;">';
        echo '          <i class="ace-icon fa fa-send bigger-120"></i>';
        echo '        </button>';
        echo '        <button class="btn btn-xs btn-danger btn-print" title="Mail" onclick="GetMail(' . $row->id .',' . $row->ledger_id .');return false;">';
        echo '          <i class="ace-icon fa fa-envelope bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


        ////////////////////////////

function purchase_return_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->purchase_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          // echo '            <th>POS</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Type</th>';
          echo '            <th>Items</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->item_type . '</td>';
                echo '    <td>' . $row->items . '</td>';
                // echo '    <td>' . $row->dname . '</td>';                
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-danger" title="Print" onclick="GetReport(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


    function receipt_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->receipt_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>No.</th>';
          echo '            <th>Entry Date</th>';
          echo '            <th>Salesman</th>';
          echo '            <th>Party Name</th>';
          echo '            <th>Rec. Date</th>';
          echo '            <th>Amount</th>';
          echo '            <th>CD</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->edate)) . '</td>';
                echo '    <td>' . $row->salesman . '</td>';
                echo '    <td>' . $row->name . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->tol_freight . '</td>';
                echo '    <td>' . $row->lessadv . '</td>';
                // echo '    <td>' . $row->dname . '</td>';                
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->builtyno .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
          echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="ShowPrint(' . $row->builtyno .');return false;">';
        echo '          <i class="ace-icon fa fa-print bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->builtyno .');return false;">';
        echo '          <i class="ace-icon fa fa-trash-o bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


    function payment_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->payment_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Amount</th>';
          echo '            <th>Remark</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->tol_freight . '</td>';
                echo '    <td>' . $row->remark . '</td>';
                // echo '    <td>' . $row->dname . '</td>';                
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-trash-o bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }

    function crnote_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->crnote_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Amount</th>';
          echo '            <th>Remark</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->tol_freight . '</td>';
                echo '    <td>' . $row->remark . '</td>';
                // echo '    <td>' . $row->dname . '</td>';                
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-trash-o bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }

    function drnote_list(){
      $this->load->model('transaction_model');
      $result=$this->transaction_model->drnote_list();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Amount</th>';
          echo '            <th>Remark</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->tol_freight . '</td>';
                echo '    <td>' . $row->remark . '</td>';
                // echo '    <td>' . $row->dname . '</td>';                
                echo '    <td>';
        echo '      <div class="   btn-group">';  
        echo '        <a class="btn btn-xs btn-info btn_modify" title="view" onclick="GetRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
        echo '        </a>';
        echo '        <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
        echo '          <i class="ace-icon fa fa-trash-o bigger-120"></i>';
        echo '        </button>';
        echo '      </div>';
                echo '    </td>';
                echo '</tr>';
          }
      }
    }


       function purchase_save_old(){
      $this->load->model('transaction_model');
      $this->transaction_model->purchase_save_old();
    }


    //    function purchase_save(){
    //   $this->load->model('transaction_model');
    //   $this->transaction_model->purchase_save();
    // }
     function purchase_save_modify(){
      $this->load->model('transaction_model');
      $this->transaction_model->purchase_save_modify();
    }
     function purchase_get()
        {
          $this->load->model('transaction_model');
          $this->transaction_model->purchase_get();
        }

        function purchase_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_get_item();
           $ti=6;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>
        <select name="itemcode[]" id="item_id" onchange="GetRate(this);return false;" class="col-xs-10 col-sm-12" tabindex="'.$ti++.'">
          <option value="0">Select Item Name</option>';

                foreach(item_list() as $row1)
                {
                    if($row1->id==$row->itemcode)
                    {
                       echo '<option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                    else
                    {
                       echo '<option value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                 }
          echo '</select>
          <input type="hidden" id="order_id" name="orderid_gen[]"/>
                  </td>';

                

                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                
                echo ' <td><input value="'.$row->rate.'" tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->freight.'" tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }

        function purchase_get_item_chalan(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td><input value="'.$row->iname.'" tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" value="'.$row->itemcode.'" name="itemcode[]"/><input type="hidden" id="order_id" value="'.$row->orderid_gen.'" name="orderid_gen[]"/></td>';
                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                
                echo ' <td><input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->freight.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input type="hidden" name="rate[]" id="txt_rate" class="txt_cls"/></td>';
                echo ' <td><input type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }


        function jobcard_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->jobcard_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>
                        <input type="text" id="item_name" name="item_name[]" value="'.$row1->item_name.'" class="txt_cls" placeholder="Item Name"/>
                        <input type="hidden" id="itemcode"  value="'.$row1->name.'" name="itemcode[]"/>
                        <input type="hidden" id="order_id" value="'.$row1->id.'" name="orderid_gen[]"/>
                        </td>';

                
                
                echo ' <td><input value="'.$row->remark.'"  type="text" name="item_remark[]" id="txt_remark" class="txt_cls" />';
                echo ' <td><input value="'.$row->drawing_no.'"  type="text" name="drawing_no[]" id="drawing_no" class="txt_cls" /></td>';
                echo ' <td><input value="'.$row->qtymt.'"  type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';

                // echo '<input value="'.$row->unit.'" type="hidden" name="unit[]" id="txt_unit" class="txt_cls" />';
                
                echo '<input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo '<input value="'.$row->discount.'"  type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo '<input value="'.$row->percent.'"  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input value="'.$row->freight.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><input value="'.$row->unit.'"  type="text" name="unit[]" id="txt_unit" class="txt_cls" /></td>';
                echo ' <td><button  type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td>
                      <select name="itemcode[]" id="item_id" onchange="GetRate(this);return false;" class="col-xs-10 col-sm-12" >
                      <option value="0">Select Item Name</option>';

                foreach(item_list() as $row1)
                {
                    if($row1->id==$row->itemcode)
                    {
                       echo '<option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                    else
                    {
                       echo '<option value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                 }
                echo '</select>
                  <input type="hidden" id="order_id" name="orderid_gen[]"/>
                  <input type="hidden" id="moc" name="moc[]"/>
                  </td>';

                
                
                echo ' <td><input value="'.$row->remark.'"  type="text" name="item_remark[]" id="txt_remark" class="txt_cls" />';
                echo ' <td><input value="'.$row->drawing_no.'"  type="text" name="drawing_no[]" id="drawing_no" class="txt_cls" /></td>';
                echo ' <td><input value="'.$row->qtymt.'"  type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';

                // echo '<input value="'.$row->unit.'" type="hidden" name="unit[]" id="txt_unit" class="txt_cls" />';
                
                echo '<input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo '<input value="'.$row->discount.'"  type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo '<input value="'.$row->percent.'"  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input value="'.$row->freight.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><input value="'.$row->unit.'"  type="text" name="unit[]" id="txt_unit" class="txt_cls" /></td>';
                echo ' <td><button  type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }


        function req_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->jobcard_get_item();
           // print_r($result);die();
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>
                      <input type="text" id="item_name" value="'.$row->item_name.'" name="item_name[]" class="txt_cls" placeholder="Item Name"/>
                      <input type="hidden" id="itemcode" value="'.$row->itemcode.'" name="itemcode[]"/>
                      <input type="hidden" id="order_id" value="'.$row->orderid_gen.'" name="orderid_gen[]"/>
                  </td>';
                echo ' <td><input value="'.$row->remark.'"  type="text" name="item_remark[]" id="txt_remark" class="txt_cls" />';
                echo ' <td><input value="'.$row->drawing_no.'"  type="text" name="drawing_no[]" id="drawing_no" class="txt_cls" /></td>';
                echo ' <td><input value="'.$row->qtymt.'"  type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo '<input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo '<input value="'.$row->discount.'"  type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo '<input value="'.$row->percent.'"  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input value="'.$row->freight.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><input value="'.$row->unit.'"  type="text" name="unit[]" id="txt_unit" class="txt_cls" /></td>';
                echo ' <td><button  type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td>
                      <input type="text" id="item_name"  name="item_name[]" class="txt_cls" placeholder="Item Name"/>
                      <input type="hidden" id="itemcode" name="itemcode[]"/>
                      <input type="hidden" id="order_id"  name="orderid_gen[]"/>
                  </td>';
                echo ' <td><input  type="text" name="item_remark[]" id="txt_remark" class="txt_cls" />';
                echo ' <td><input  type="text" name="drawing_no[]" id="drawing_no" class="txt_cls" /></td>';
                echo ' <td><input type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo '<input type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo '<input  type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo '<input  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><input type="text" name="unit[]" id="txt_unit" class="txt_cls" /></td>';
                echo ' <td><button  type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }

        function sales_get_item1(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_get_item1();
           // print_r($result);die();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>';
                echo '<input type="text" id="item_name" value="'.$row->item_name.'" name="item_name[]" class="txt_cls" placeholder="Item Name"/>
                  <input type="hidden" value="'.$row->itemcode.'" id="itemcode" name="itemcode[]"/>
                  <input type="hidden" value="'.$row->orderid_gen.'" id="order_id" name="orderid_gen[]"/>
                  </td>';
                echo ' <td><input value="'.$row->remark.'"  type="text" name="item_remark[]" id="txt_remark" class="txt_cls" />';
                echo ' <td><input value="'.$row->moc.'"  type="text" name="moc[]" id="txt_unit" class="txt_cls" /></td>';
                echo ' <td><input value="'.$row->qtymt.'"  type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';

                echo '<input value="'.$row->unit.'" type="hidden" name="unit[]" id="txt_unit" class="txt_cls" />';
                
                echo '<input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo '<input value="'.$row->discount.'"  type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo '<input value="'.$row->percent.'"  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input value="'.$row->freight.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button  type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
               echo '<tr>';
                echo ' <td>';
                echo '<input type="text" id="item_name" value="'.$row->item_name.'" name="item_name[]" class="txt_cls" placeholder="Item Name"/>
                  <input type="hidden" value="'.$row->itemcode.'" id="itemcode" name="itemcode[]"/>
                  <input type="hidden" value="'.$row->orderid_gen.'" id="order_id" name="orderid_gen[]"/>
                  </td>';
                echo ' <td><input value="'.$row->remark.'"  type="text" name="item_remark[]" id="txt_remark" class="txt_cls" />';
                echo ' <td><input value="'.$row->moc.'"  type="text" name="moc[]" id="txt_unit" class="txt_cls" /></td>';
                echo ' <td><input value="'.$row->qtymt.'"  type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';

                echo '<input value="'.$row->unit.'" type="hidden" name="unit[]" id="txt_unit" class="txt_cls" />';
                
                echo '<input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo '<input value="'.$row->discount.'"  type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo '<input value="'.$row->percent.'"  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input value="'.$row->freight.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button  type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }






        function sales_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
//                echo ' <td><input value="'.$row->iname.'" tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" readonly="readonly" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" value="'.$row->itemcode.'" name="itemcode[]"/><input type="hidden" id="order_id" value="'.$row->orderid_gen.'" name="orderid_gen[]"/></td>';

                echo ' <td>
        <select name="itemcode[]" id="item_id" onchange="GetRate(this);return false;" class="col-xs-10 col-sm-12" tabindex="'.$ti++.'">
          <option value="0">Select Item Name</option>';

                foreach(item_list() as $row1)
                {
                    if($row1->id==$row->itemcode)
                    {
                       echo '<option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                    else
                    {
                       echo '<option value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                 }
          echo '</select>
                  <input type="hidden" id="order_id" name="orderid_gen[]"/>
                  </td>';

                
                
                echo ' <td><input value="'.$row->remark.'"  type="text" name="item_remark[]" id="txt_remark" class="txt_cls" />';
                echo ' <td><input value="'.$row->moc.'" tabindex="'.$ti++.'" type="text" name="moc[]" id="txt_unit" class="txt_cls" /></td>';
                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';

                echo '<input value="'.$row->unit.'" type="hidden" name="unit[]" id="txt_unit" class="txt_cls" />';
                
                echo '<input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo '<input value="'.$row->discount.'"  type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo '<input value="'.$row->percent.'"  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input value="'.$row->freight.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/></td>';
                 echo ' <td><input tabindex="'.$ti++.'" type="text" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input tabindex="'.$ti++.'" type="text" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }


    function wo_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>
                    <input type="text" value="'.$row->item_name.'" tabindex="'.$ti++.'"  id="item_name" name="item_name[]" class="txt_cls" placeholder="Item Name"/>
                    <input type="hidden" value="'.$row->itemcode.'" tabindex="'.$ti++.'"  id="itemcode" name="itemcode[]"/>
                    <input type="hidden" value="'.$row->order_id.'" tabindex="'.$ti++.'"  id="order_id" name="orderid_gen[]"/>
                  </td>';
                
                echo ' <td><input value="'.$row->remark.'"  type="text" name="item_remark[]" id="txt_remark" class="txt_cls" />';
                echo ' <td><input value="'.$row->moc.'" tabindex="'.$ti++.'" type="text" name="moc[]" id="txt_unit" class="txt_cls" /></td>';
                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';

                echo '<input value="'.$row->unit.'" type="hidden" name="unit[]" id="txt_unit" class="txt_cls" />';
                
                echo '<input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo '<input value="'.$row->discount.'"  type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo '<input value="'.$row->percent.'"  type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input value="'.$row->freight.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/></td>';
                 echo ' <td><input tabindex="'.$ti++.'" type="text" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input tabindex="'.$ti++.'" type="text" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }


        function q3_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->q3_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
               echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" value="'.$row->item_name.'" type="text" id="item_name" name="item_name[]" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo ' <td><input value="'.$row->item_bld.'"  type="text" name="item_bld[]" id="item_bld" class="txt_cls" />';
                echo ' <td><input value="'.$row->moc.'" tabindex="'.$ti++.'" type="text" name="moc[]" id="txt_unit" class="txt_cls" /><input  type="hidden" name="unit[]" id="txt_unit" class="txt_cls" /></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  tabindex="'.$ti++.'" value="'.$row->rate.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/><input tabindex="'.$ti++.'" type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/><input tabindex="'.$ti++.'" type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" value="'.$row->item_remark.'" type="text" name="item_remark[]" id="txt_item_remark" class="item_remark txt_cls" /><input  type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" value="'.$row->item_name.'" type="text" id="item_name" name="item_name[]"  class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo ' <td><input value="'.$row->item_bld.'"  type="text" name="item_bld[]" id="item_bld" class="txt_cls" />';
                echo ' <td><input value="'.$row->moc.'" tabindex="'.$ti++.'" type="text" name="moc[]" id="txt_unit" class="txt_cls" /><input  type="hidden" name="unit[]" id="txt_unit" class="txt_cls" /></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  tabindex="'.$ti++.'" value="'.$row->rate.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/><input tabindex="'.$ti++.'" type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/><input tabindex="'.$ti++.'" type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" value="'.$row->item_remark.'" type="text" name="item_remark[]" id="txt_item_remark" class="item_remark txt_cls" /><input  type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }


        function quatation_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>
                <select name="itemcode[]" id="item_id" onchange="GetRate(this);return false;" class="col-xs-10 col-sm-12" tabindex="'.$ti++.'">
                <option value="0">Select Item Name</option>';

                foreach(item_list() as $row1)
                {
                    if($row1->id==$row->itemcode)
                    {
                       echo '<option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                    else
                    {
                       echo '<option value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                 }
                echo '</select>
                    <input type="hidden" id="order_id" name="orderid_gen[]"/>
                  </td>';

                echo ' <td><input value="'.$row->remark.'" tabindex="'.$ti++.'" type="text" name="item_remark[]" id="txt_remark" class="txt_cls" /></td>';
                
                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';

                echo ' <td><input value="'.$row->unit.'" tabindex="'.$ti++.'" type="text" name="unit[]" id="txt_unit" class="txt_cls" /></td>';
                
                echo ' <td><input value="'.$row->rate.'" tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                echo ' <input value="'.$row->discount.'" type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo ' <input value="'.$row->percent.'" type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->freight.'" tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo ' <td><input  tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/>';
                 echo ' <input type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo ' <input type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }

        function invoices_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->invoices_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>
                    <input type="text" value="'.$row->item_name.'" tabindex="'.$ti++.'"  id="item_name" name="item_name[]" class="txt_cls" placeholder="Item Name"/>
                    <input type="hidden" value="'.$row->itemcode.'" tabindex="'.$ti++.'"  id="itemcode" name="itemcode[]"/>
                    <input type="hidden" value="'.$row->order_id.'" tabindex="'.$ti++.'"  id="order_id" name="orderid_gen[]"/>
                    <input type="hidden" value="'.$row->item_remark.'" tabindex="'.$ti++.'"  id="item_remark" name="item_remark[]"/>
                  </td>';

                echo ' <td><input value="'.$row->hson_no.'" tabindex="'.$ti++.'" type="text" name="hson_no[]" id="hson_no" class="txt_cls" /></td>';
                
                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->unit.'" tabindex="'.$ti++.'" type="text" name="unit[]" id="txt_unit"  class="txt_cls" /></td>';
                echo ' <td><input  value="'.$row->rate.'" tabindex="'.$ti++.'"  type="text" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
              
                echo ' <input value="'.$row->discount.'" type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo ' <input value="'.$row->percent.'" type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input  value="'.$row->persentage.'" tabindex="'.$ti++.'"  type="text" name="persentage[]" id="txt_persentage" class="txt_cls" onblur="CalcAmount(this);return false;" /></td>';
                echo ' <td><input value="'.$row->freight.'" tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo ' <td><input  tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/>';
                 echo ' <input type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/>';
                 echo ' <input type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }



        function sales_return_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_return_get_item();
           $ti=6;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>
        <select name="itemcode[]" id="item_id" onchange="GetRate(this);return false;" class="col-xs-10 col-sm-12" tabindex="'.$ti++.'">
          <option value="0">Select Item Name</option>';

                foreach(item_list() as $row1)
                {
                    if($row1->id==$row->itemcode)
                    {
                       echo '<option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                    else
                    {
                       echo '<option value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                 }
          echo '</select>
<input type="hidden" id="order_id" name="orderid_gen[]"/>
                  </td>';
                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                
                echo ' <td><input value="'.$row->rate.'" readonly="readonly" tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->discount.'" tabindex="'.$ti++.'" type="text" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input value="'.$row->percent.'" tabindex="'.$ti++.'" type="text" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->freight.'" tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/></td>';
                 echo ' <td><input value="'.$row->discount.'" tabindex="'.$ti++.'" type="text" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input value="'.$row->percent.'" tabindex="'.$ti++.'" type="text" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }

        function sales_return_get_item_chalan(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_return_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td><input value="'.$row->iname.'" tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" value="'.$row->itemcode.'" name="itemcode[]"/><input type="hidden" id="order_id" value="'.$row->orderid_gen.'" name="orderid_gen[]"/></td>';
                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                
                echo ' <td><input value="'.$row->rate.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input value="'.$row->percent.'" type="hidden"  name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->discount.'" type="hidden"  name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->freight.'" type="hidden"  name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  type="hidden"  name="rate[]" id="txt_rate" class="txt_cls"/></td>';
                 echo ' <td><input value="'.$row->percent.'" type="hidden"  name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input value="'.$row->discount.'" type="hidden"  name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input type="hidden"  name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo '</tr>';

           }

        }
        function receipt_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t1.*,l.name as partyname from tbl_trans1 t1 , m_ledger l  where t1.ledger_id=l.id and t1.vtype="receipt" and t1.builtyno='.$id . ' and t1.company_id='.get_cookie("ae_company_id") . ' order by t1.id');

          
          $result=$query->result();
           $ti=3;
           $modelist=mode_list();
           $partylist=ledger_list();

           if(count($result)>0){
               foreach($result as $row){
                echo '  <tr>';
                echo '       <td>';
                // echo '      <select name="ledger_id[]" id="ledger_id" class="col-xs-12 col-sm-12" tabindex="'.$ti++.'" onblur="GetRpt(this.value);">';
                // foreach($partylist as $row1){
                //   if($row->ledger_id==$row1->id)
                //   {
                //     echo '       <option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                //   }
                //   else
                //   {
                //     echo '       <option value="'.$row1->id.'">'.$row1->name.'</option>';
                //   }
                // } 
                // echo '      </select>';

                echo '     <input tabindex="'.$ti++.'" type="text" id="lname" class="partyinfo item" onkeyup="GetParty(this);" value="'.$row->partyname.'" list="0"/> <input type="hidden" name="ledger_id[]" id="ledger_id"  class="ledger_id" value="'.$row->ledger_id.'">';

                echo '        </td>';
                if(date('d-m-Y',strtotime($row->cdate))=="01-01-1970" || date('d-m-Y',strtotime($row->cdate))=="30-11--0001")
                {
                  echo '       <td><input tabindex="'.$ti++.'" type="text" value="00-00-0000" name="vdate[]" id="vdate" class="txt_cls vdate" list="0" /></td>';
                }
                else
                {
                  echo '       <td><input tabindex="'.$ti++.'" type="text" value="'.date('d-m-Y',strtotime($row->cdate)).'" name="vdate[]" id="vdate" class="txt_cls vdate" list="0" /></td>';
                }
                echo '       <td><input tabindex="'.$ti++.'" type="text" value="'.$row->tol_freight.'" name="tol_freight[]" id="tol_freight" class="tol_freight txt_cls" onblur="TolFreight();return false;"/></td>';
                echo '       <td><input tabindex="'.$ti++.'" type="text" value="'.$row->lessadv.'" name="less_adv[]" id="less_adv" class="less_adv txt_cls" onblur="TolFreight();return false;"/></td>';
                echo '       <td>';
                echo '      <select name="mode_id[]" id="mode_id" class="col-xs-12 col-sm-12" tabindex="'.$ti++.'">';
                foreach($modelist as $row1){
                  if($row->ref_ledger_id==$row1->id)
                  {
                    echo '       <option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                  }
                  else
                  {
                    echo '       <option value="'.$row1->id.'">'.$row1->name.'</option>';
                  }
                }
                echo '      </select>';
                echo '        </td>';
                echo '  <td><input tabindex="'.$ti++.'" type="text" value="'.$row->remark.'" name="remark[]" id="remark" class="txt_cls"/></td>';
                if(date('d-m-Y',strtotime($row->cleardate))=="01-01-1970" || date('d-m-Y',strtotime($row->cleardate))=="30-11--0001")
                {
                  echo '       <td><input tabindex="'.$ti++.'" type="text" value="00-00-0000" name="cleardate[]" id="cleardate" class="txt_cls cleardate" list="0" /></td>';
                }
                else
                {
                  echo '       <td><input tabindex="'.$ti++.'" type="text" value="'.date('d-m-Y',strtotime($row->cleardate)).'" name="cleardate[]" id="cleardate" class="txt_cls cleardate" list="0" /></td>';
                }
                echo '       <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button tabindex="9" type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '  </tr>';
               }
           }  
        }


        // function receipt_get_item_old(){
        //   $id = $this->input->get("id");
        //   $query=$this->db->query('select * from tbl_trans1 where vtype="receipt" and builtyno='.$id . ' and company_id='.get_cookie("ae_company_id") . ' order by id');
        //   $result=$query->result();
        //    $ti=3;
        //    $modelist=mode_list();
        //    $partylist=ledger_list();

        //    if(count($result)>0){
        //        foreach($result as $row){
        //         echo '  <tr>';
        //         echo '       <td>';
        //         echo '      <select name="ledger_id[]" id="ledger_id" class="col-xs-12 col-sm-12" tabindex="'.$ti++.'" onblur="GetRpt(this.value);">';
        //         foreach($partylist as $row1){
        //           if($row->ledger_id==$row1->id)
        //           {
        //             echo '       <option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
        //           }
        //           else
        //           {
        //             echo '       <option value="'.$row1->id.'">'.$row1->name.'</option>';
        //           }
        //         } 
        //         echo '      </select>';
        //         echo '        </td>';
        //         if(date('d-m-Y',strtotime($row->cdate))=="01-01-1970" || date('d-m-Y',strtotime($row->cdate))=="30-11--0001")
        //         {
        //           echo '       <td><input tabindex="'.$ti++.'" type="text" value="00-00-0000" name="vdate[]" id="vdate" class="txt_cls vdate" list="0" /></td>';
        //         }
        //         else
        //         {
        //           echo '       <td><input tabindex="'.$ti++.'" type="text" value="'.date('d-m-Y',strtotime($row->cdate)).'" name="vdate[]" id="vdate" class="txt_cls vdate" list="0" /></td>';
        //         }
        //         echo '       <td><input tabindex="'.$ti++.'" type="text" value="'.$row->tol_freight.'" name="tol_freight[]" id="tol_freight" class="tol_freight txt_cls" onblur="TolFreight();return false;"/></td>';
        //         echo '       <td><input tabindex="'.$ti++.'" type="text" value="'.$row->lessadv.'" name="less_adv[]" id="less_adv" class="less_adv txt_cls" onblur="TolFreight();return false;"/></td>';
        //         echo '       <td>';
        //         echo '      <select name="mode_id[]" id="mode_id" class="col-xs-12 col-sm-12" tabindex="'.$ti++.'">';
        //         foreach($modelist as $row1){
        //           if($row->ref_ledger_id==$row1->id)
        //           {
        //             echo '       <option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
        //           }
        //           else
        //           {
        //             echo '       <option value="'.$row1->id.'">'.$row1->name.'</option>';
        //           }
        //         }
        //         echo '      </select>';
        //         echo '        </td>';
        //         echo '  <td><input tabindex="'.$ti++.'" type="text" value="'.$row->remark.'" name="remark[]" id="remark" class="txt_cls"/></td>';
        //         if(date('d-m-Y',strtotime($row->cleardate))=="01-01-1970" || date('d-m-Y',strtotime($row->cleardate))=="30-11--0001")
        //         {
        //           echo '       <td><input tabindex="'.$ti++.'" type="text" value="00-00-0000" name="cleardate[]" id="cleardate" class="txt_cls cleardate" list="0" /></td>';
        //         }
        //         else
        //         {
        //           echo '       <td><input tabindex="'.$ti++.'" type="text" value="'.date('d-m-Y',strtotime($row->cleardate)).'" name="cleardate[]" id="cleardate" class="txt_cls cleardate" list="0" /></td>';
        //         }
        //         echo '       <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button tabindex="9" type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
        //         echo '  </tr>';
        //        }
        //    }  
        // }

     function chalan_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td><input value="'.$row->iname.'" readonly="readonly" tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" value="'.$row->itemcode.'" name="itemcode[]"/><input type="hidden" id="order_id" value="'.$row->orderid_gen.'" name="orderid_gen[]"/></td>';
                echo ' <td><input style="width:50px;" value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button tabindex="" type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo ' <td><input value="'.$row->rate.'" readonly="readonly" tabindex="'.$ti++.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->discount.'" tabindex="'.$ti++.'" type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input value="'.$row->percent.'" tabindex="'.$ti++.'" type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->freight.'" tabindex="'.$ti++.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><input value="'.$row->freight.'" tabindex="'.$ti++.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><input  tabindex="'.$ti++.'" type="hidden" name="item_remark[]" id="txt_item_remark"/></td>';
                echo ' <td><input  tabindex="'.$ti++.'" type="hidden" name="unit[]" id="txt_unit"/></td>';

              
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button tabindex="" type="button" id="btn_add" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo ' <td><input  tabindex="'.$ti++.'" type="hidden" name="rate[]" id="txt_rate" class="txt_cls"/></td>';
                echo ' <td><input value="'.$row->discount.'" tabindex="'.$ti++.'" type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                 echo ' <td><input value="'.$row->percent.'" tabindex="'.$ti++.'" type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="hidden" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';                
                echo ' <td><input  tabindex="'.$ti++.'" type="hidden" name="item_remark[]" id="txt_item_remark"/></td>';
                echo ' <td><input  tabindex="'.$ti++.'" type="hidden" name="unit[]" id="txt_unit"/></td>';
                echo '</tr>';

           }

        }




    
      function order_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->order_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
//                echo ' <td><input value="'.$row->iname.'" tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" readonly="readonly" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" value="'.$row->itemcode.'" name="itemcode[]"/><input type="hidden" id="order_id" value="'.$row->orderid_gen.'" name="orderid_gen[]"/></td>';

                echo ' <td>
        <select name="itemcode[]" id="item_id" onchange="GetRate(this);return false;" class="col-xs-10 col-sm-12" tabindex="'.$ti++.'">
          <option value="0">Select Item Name</option>';

                foreach(item_list() as $row1)
                {
                    if($row1->id==$row->itemcode)
                    {
                       echo '<option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                    else
                    {
                       echo '<option value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                 }
          echo '</select>
<input type="hidden" id="order_id" name="orderid_gen[]"/>
                  </td>';

                echo ' <td><input value="'.$row->remark.'" tabindex="'.$ti++.'" type="text" name="item_remark[]" id="txt_remark" class="txt_cls" /></td>';
                
                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                
                echo ' <td><input value="'.$row->rate.'" tabindex="'.$ti++.'" type="text" name="rate[]"  id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/> <input value="'.$row->discount.'" tabindex="'.$ti++.'" type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/> <input value="'.$row->percent.'" tabindex="'.$ti++.'" type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->freight.'" tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" readonly="readonly" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/> <input tabindex="'.$ti++.'" type="hidden" name="discountrs[]" id="txt_discountrs" class="txt_cls" onblur="CalcAmount(this);return false;"/> <input tabindex="'.$ti++.'" type="hidden" name="discountper[]" id="txt_discountper" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" readonly="readonly" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }



    function ledger_mobno_get(){
      $this->load->model('transaction_model');
      $this->transaction_model->ledger_mobno_get();
    }
    //End By Ram(11-04-2015)


    function ledger_report(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $report_type=$this->input->get('report_type');
      $clear_date=$this->input->get('clear_date');
      $l_id=$this->input->get('l_id');

      if($clear_date=="Yes")
      {
        $query=$this->db->query("select max(cleardate) as cdate from tbl_trans1 where ledger_id=".$l_id . " and hide='no'");
        $result=$query->result();
        if(count($result)>0)
        {
            foreach($result as $row)
            {
              if($row->cdate!='0000-00-00' && $row->cdate!='1970-01-01')
              {
                $from = $row->cdate;
              }
            }
        }
      }

      $opb=0;
      $ledgername="";
      $opbalancermk="";
      $query=$this->db->query("select l.name ledgername,l.opbalance,l.opbalancermk from m_ledger l where l.id=".$l_id);
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
            $opb=$row->opbalance;
            $ledgername=$row->ledgername;
            $opbalancermk=$row->opbalancermk;
          }
      }

      //$query=$this->db->query("select v2.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans2 v2 inner join tbl_trans1 v on v2.billno=v.id inner join m_ledger l on v.ledger_id=l.id and v.id=v2.billno and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' order by v.cdate');

          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
                  </center>';

      echo '<table id="TblList" class="" style="width:1180px;">';
      echo '    <thead>';
      echo '        <tr>';
      echo '            <th colspan="14" class="tb_col">Ledger : '.$ledgername.'<br>From : '.date('d-m-Y',strtotime($this->input->get('from'))).' To : '.date('d-m-Y',strtotime($to)).' </th>';
      echo '        </tr>';
      echo '        <tr>';
      echo '            <th class="tb_col" style="width:50px;">Date</th>';
      echo '            <th class="tb_col" style="width:50px;">No.</th>';
      echo '            <th class="tb_col" style="width:80px;">Type</th>';
      echo '            <th class="tb_col" style="width:230px;">Item</th>';
      echo '            <th class="tb_col" style="width:80px;">Qty</th>';
      echo '            <th class="tb_col" style="width:50px;">Rate</th>';
      echo '            <th class="tb_col" style="width:50px;">Disc.</th>';
      echo '            <th class="tb_col" style="width:80px;">Amount</th>';
      echo '            <th class="tb_col" style="width:50px;">Freight</th>';
      echo '            <th class="tb_col" style="width:100px;">Bill Amt.</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Debit</th>';
      echo '            <th  style="width:90px;" class="tb_col right">RG</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Credit</th>';
      echo '            <th class="tb_col" style="width:50px;">&nbsp;</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;
      $fr=0;
      $tqty=0;
      $trgqty=0;
      $tfreight=0;
      $tlr_freight=0;
      $bill_amt=0;
      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate <="'.$to.'") and v.ledger_id='.$l_id.' and hide="yes" order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.lessadv) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.vtype='receipt' and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate <="'.$to.'") and v.ledger_id='.$l_id.' and hide="yes" order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }
      $query=$this->db->query("select sum(v.lessadv) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.vtype='receipt' and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
          $opb = bcadd($opb,($row1->amount)*-1);
      }


              if($opb>0){
              $bill_amt=$bill_amt+$opb;
              }else{
              $bill_amt=$bill_amt-$opb;
              }

            if($opb<>0){
              echo '<tr class="">';
              echo '    <td class="tb_col">' . date('d-m-Y',strtotime($this->input->get('from'))) . '</td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col">OpBal</td>';
              echo '    <td class="tb_col">'.$opbalancermk.' </td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col"> </td>';
               echo '    <td class="tb_col">' . number_format($bill_amt,2) . '</td>';
              if($opb>0){
               echo '    <td class="tb_col dr right">' . number_format($opb,2) . '</td>';
               echo '    <td class="tb_col cr right">&nbsp;</td>'; // addtional
               echo '    <td class="tb_col cr right">&nbsp;</td>'; // addtional
               // echo '    <td class="cr right">&nbsp;</td>'; // addtional
               $dr=bcadd($dr,$opb,2);
              }else{
               echo '    <td class="tb_col dr right">&nbsp;</td>';
               echo '    <td class="tb_col cr right">&nbsp</td>'; // addtional
               echo '    <td class="tb_col cr right">' . number_format(bcmul($opb,-1,2),2) . '</td>';
               // echo '    <td class="cr right">&nbsp</td>'; // addtional
               $cr=bcadd($cr,bcmul($opb,-1,2),2);
              }
                          $bill_amt=$dr-$cr;
                        echo '    <td class="tb_col">&nbsp;</td>';
              echo '</tr>';
            }

      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.tol_freight,v.vamount as amount,v.lr_freight,l.name ledgername,v.remark,v.lessadv,v.lr_no,v.transport,v.company_id from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' and v.hide="no" order by v.cdate,v.id');
      $result=$query->result();


      if(count($result)>0)
      {

          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                $dt = $row->cdate;
                $showdt=date('d-m-Y',strtotime($row->cdate));
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }                
                else
                {
                  echo '<tr class="" style="background-color:#F2F2F2;">';
                }
                echo '    <td class="tb_col">' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="RG Sale";
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if($row->vtype=="purchase return")
                {
                  $parti="Purchase Return";
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $parti="Payment";
                }
                if(strtoupper($row->vtype)=="CRNOTE")
                {
                  $parti="CrNote";
                }
                if(strtoupper($row->vtype)=="DRNOTE")
                {
                  $parti="DrNote";
                }
                echo '    <td class="tb_col">' . $row->builtyno."";
                echo '</td>';

                echo '    <td class="tb_col">' . $parti;
                echo '</td>';

                echo '    <td class="tb_col">';
                  echo "<span style='font-weight:bold;'>" . $row->remark . "</span>";
                 if($row->lr_no!='')
                {
                  echo "<span style='font-weight:bold;margin-left:20px;'>LR: " . $row->lr_no . " TR:" . $row->transport. "</span>";
                }  
                echo '</td>';

                echo '    <td class="tb_col">&nbsp;</td>';
                echo '    <td class="tb_col">&nbsp;</td>';
                echo '    <td class="tb_col">&nbsp;</td>';
                echo '    <td class="tb_col">&nbsp;</td>';
                
                $lr_freight_amount=$row->lr_freight;
                if($lr_freight_amount=="")
                {
                  $lr_freight_amount=0;
                }

                if($row->vtype=="sales" || $row->vtype=="purchase")
                {
                  $tlr_freight=$tlr_freight+$lr_freight_amount;
                  $bill_amt=$bill_amt+$lr_freight_amount;
                }
                if($row->vtype=="sales return")
                {
                  $bill_amt=$bill_amt+$lr_freight_amount;
                }
                if($row->vtype=="purchase return")
                {
                  $bill_amt=$bill_amt+$lr_freight_amount;
                }
                $amount = $row->amount*-1;
                if(strtoupper($row->vtype)=="RECEIPT" || strtoupper($row->vtype)=="CRNOTE")
                {
                  $amount = ($row->amount+$row->lessadv)*-1;
                }


                if(strtoupper($row->vtype)=="RECEIPT" || strtoupper($row->vtype)=="CRNOTE")
                {
                  $bill_amt=$bill_amt+$amount;
                  $bill_amt=$bill_amt-$row->lessadv;
                }
                if(strtoupper($row->vtype)=="PAYMENT" || strtoupper($row->vtype)=="DRNOTE")
                {
                  $bill_amt=$bill_amt+$amount;
                }

                echo '    <td class="tb_col">' . $row->lr_freight.'</td>';
                echo '    <td class="tb_col">'.number_format($bill_amt,2).'</td>';

                if($amount>0){
                 echo '    <td class="tb_col dr right">' . number_format($amount,2);
                 echo '</td>';
                 echo '    <td class="tb_col cr right"></td>';
                 echo '    <td class="tb_col cr right">';
                  if(strtoupper($row->vtype)=="RECEIPT" && $row->lessadv!=0)
                  {
                   echo '   <br><span style="font-size:9px;">CD : </span>' . number_format($row->lessadv,2) . '';
                   $cr=bcadd($cr,$row->lessadv,2);
                  }
                 echo '</td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                  if($row->vtype=="sales return")
                  {
                   echo '    <td class="tb_col dr right"></td>';
                   echo '    <td class="tb_col cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   echo '    <td class="tb_col cr right"></td>';
                   $rg=bcadd($rg,bcmul($amount,-1,2),2);
                  }
                  else
                  {
                   echo '    <td class="tb_col dr right"></td>';
                   echo '    <td class="tb_col cr right"></td>';
                   echo '    <td class="tb_col cr right">' . number_format(bcmul($amount,-1,2),2) . '';
                    if(strtoupper($row->vtype)=="RECEIPT" && $row->lessadv!=0)
                    {
                     echo '   <br><span style="font-size:9px;">CD : </span>' . number_format($row->lessadv,2) . '';
                     $cr=bcadd($cr,$row->lessadv,2);
                    }
                   echo '</td>';

                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                  }
                }
                echo '<td class="tb_col">';
                if(strtoupper($row->vtype)=="SALES")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->id .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                  
                }
                if(strtoupper($row->vtype)=="PURCHASE")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->id .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                  
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->builtyno .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                   
                }
                if(strtoupper($row->vtype)=="SALES RETURN")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("RGSale","'. $row->id .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                   
                }
                echo "<input  type='hidden' id='d_id' name='d_id[]'><input type='checkbox' class='checkbox1' id='checkid'> <input type='hidden' id='id' value='".$row->id."'>";
                echo '</td>';
                echo '</tr>';


                if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight=0;
                   $discount=0;
                   if($report_type=="Color Wise")
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 0,1000");
                    }
                    else
                    {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i,m_master g where t2.itemcode=i.id and i.group_id=g.id and  t2.billno=".$row->id." order by t2.id limit 0,1000");
                    }
                    $result1=$query1->result();
                    if(count($result1)>0)
                    {
                      foreach($result1 as $row1)
                      {
                         $party_name=$row1->itemname;
                         $qty=$row1->qtymt;
                         $rate=$row1->rate;
                         $freight=$row1->freight;
                         $discount="";
                         if($row->vtype=="sales" || $row->vtype=="purchase")
                         {
                             $tqty=$tqty+$qty;
                             $tfreight=$tfreight+$freight;
                         }
                         if($row->vtype=="sales return" || $row->vtype=="purchase return")
                         {
                             $trgqty=$trgqty+$qty;
//                             $tfreight=$tfreight-$freight;
                        }
                         if($row1->percent<>0)
                         {
                           $discount=$discount.$row1->percent."% ";
                         }
                         if($row1->discount<>0)
                         {
                            if($discount=="")
                            {
                               $discount=$discount.$row1->discount." ";
                            }
                            else {
                               $discount=$discount." + " .$row1->discount." ";
                            }
                         }

                        if($rate==0)
                        {
                          echo '<tr class="" style="background-color:#ffcccc;">';
                        }                
                        else
                        {
                          echo '<tr class="" style="">';
                        }
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">' . $party_name.'</td>';
                        echo '    <td class="tb_col">' . number_format($qty,0).'</td>';
                        echo '    <td class="tb_col">' . number_format($rate,2).'</td>';
                        echo '    <td class="tb_col">' . $discount.'</td>';
                        echo '    <td class="tb_col">' . $freight.'</td>';

                        if($row->vtype=="sales" || $row->vtype=="purchase")
                        {
                          $bill_amt=$bill_amt+$freight;
                        }
                        if($row->vtype=="sales return" || $row->vtype=="purchase return")
                        {
                          $bill_amt=$bill_amt-$freight;
                        }

                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">' . number_format($bill_amt,2).'</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '</tr>';

                      }
                    
                    }
                }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td  class="tb_col" colspan=3>&nbsp;</td>';
            echo '<td  class="tb_col" style="font-weight:bold;color:#000000;">Total</td>';
                        echo '<td class="tb_col">'.$tqty.' / '.$trgqty.'</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col">'.number_format($tfreight,2).'</td>';
                        echo '<td class="tb_col">'.number_format($tlr_freight,2).'</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
            echo '<td class="tb_col right">'.$dr.'</td>';
            echo '<td class="tb_col right">'.$rg.'</td>';
            echo '<td class="tb_col right">'.$cr.'</td>';
            echo '<td  class="tb_col">&nbsp;</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td  class="tb_col" colspan=3>&nbsp;</td>';
            echo '<td  class="tb_col" style="font-weight:bold;color:#000000;">Balance</td>';
            $bal=bcsub($dr,$cr,2);
            $bal=bcsub($bal,$rg,2);
                        echo '<td class="tb_col">'.number_format(bcsub($tqty-$trgqty,0),0,'.','').'</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col right"></td>';
                        echo '<td class="tb_col right"></td>';
                        echo '<td class="tb_col right"></td>';
                        echo '<td class="tb_col right"></td>';
            if($bal>0){
            echo '<td class="tb_col right"></td>';
            echo '<td class="tb_col">&nbsp;</td>';
            echo '<td class="tb_col right">'.$bal.' Dr</td>';
            echo '<td class="tb_col">&nbsp;</td>';
            }else{
            echo '<td class="tb_col right">'.bcmul($bal,-1,2).' Cr</td>';
            echo '<td class="tb_col right"></td>';
            echo '<td class="tb_col">&nbsp;</td>';
            echo '<td class="tb_col">&nbsp;</td>';
            }
            echo '</tr>';
          echo '</tfoot>';
          echo '</table> <script type="text/javascript" class="init">
     
                        $(".checkbox1").click(function()
                        {   
                            cRow=$(this).parent().parent();
                            id=$(cRow).find("#id").val(); 
                            if($(this).is(":checked"))
                            {
                              $(cRow).find("#d_id").val(id);
                            }
                            else
                            {
                              $(cRow).find("#d_id").val("");
                            }

                           
                        });

                        $(".checkbox1").click(function(){
                            var a = $(".checkbox1");
                            var b = a.filter(":checked").length;
                            console.log(b);
                            if(b == 0)
                            {
                                $(".transferbtn").hide();
                                $(".tcount").html("");
                            }
                            else
                            {
                                $(".transferbtn").show();
                                $(".tcount").html("("+b+")");
                                //$(".transferbtn").html("Send SMS ("+b+")");
                            }
                        }); 

                         
                    
                </script>';
      }
          echo '<br>';
    }







    function ledger_report_normal(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $clear_date=$this->input->get('clear_date');
      $l_id=$this->input->get('l_id');

      if($clear_date=="Yes")
      {
        $query=$this->db->query("select max(cleardate) as cdate from tbl_trans1 where ledger_id=".$l_id . " and hide='no'");
        $result=$query->result();
        if(count($result)>0)
        {
            foreach($result as $row)
            {
              if($row->cdate!='0000-00-00' && $row->cdate!='1970-01-01')
              {
                $from = $row->cdate;
              }
            }
        }
      }

      $opb=0;
      $ledgername="";
      $query=$this->db->query("select l.name ledgername,l.opbalance from m_ledger l where l.id=".$l_id);
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
            $opb=$row->opbalance;
            $ledgername=$row->ledgername;
          }
      }

      //$query=$this->db->query("select v2.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans2 v2 inner join tbl_trans1 v on v2.billno=v.id inner join m_ledger l on v.ledger_id=l.id and v.id=v2.billno and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' order by v.cdate');
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
                  </center>';
                echo '<br>';

      echo '<table id="TblList" class="" style="width:1180px;">';
      echo '    <thead>';
      echo '        <tr>';
      echo '            <th colspan="14" class="tb_col">Ledger : '.$ledgername.'<br>From : '.date('d-m-Y',strtotime($from)).' To : '.date('d-m-Y',strtotime($to)).' </th>';
      echo '        </tr>';
      echo '        <tr>';
      echo '            <th class="tb_col" style="width:50px;">Date</th>';
      echo '            <th class="tb_col" style="width:50px;">No.</th>';
      echo '            <th class="tb_col" style="width:80px;">Type</th>';
      echo '            <th class="tb_col" style="width:80px;">Remark</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Debit</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Credit</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Balance</th>';
      echo '            <th  style="width:90px;" class="tb_col right"></th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;
      $fr=0;
      $bill_amt=0;
      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate <="'.$to.'") and v.ledger_id='.$l_id.' and hide="yes" order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.lessadv) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.vtype='receipt' and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate <="'.$to.'") and v.ledger_id='.$l_id.' and hide="yes" ');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.lessadv) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.vtype='receipt' and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.'');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
          $opb = bcadd($opb,($row1->amount)*-1);
      }


            if($opb<>0){
              echo '<tr class="">';
              echo '    <td class="tb_col">' . date('d-m-Y',strtotime($from)) . '</td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col">OpBal</td>';
              echo '    <td class="tb_col"> </td>';
              if($opb>0){
               echo '    <td class="tb_col dr right">' . number_format($opb,2) . '</td>';
               echo '    <td class="tb_col cr right">&nbsp;</td>'; // addtional
               // echo '    <td class="cr right">&nbsp;</td>'; // addtional
               $dr=bcadd($dr,$opb,2);
              }else{
               echo '    <td class="tb_col cr right">&nbsp</td>'; // addtional
               echo '    <td class="tb_col cr right">' . number_format(bcmul($opb,-1,2),2) . '</td>';
               // echo '    <td class="cr right">&nbsp</td>'; // addtional
               $cr=bcadd($cr,bcmul($opb,-1,2),2);
              }
              $bill_amt=$dr-$cr;
               echo '    <td class="tb_col cr right">' . number_format($bill_amt,2) . '</td>';
              echo '</tr>';
            }

      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.tol_freight,v.vamount as amount,v.lr_freight,l.name ledgername,v.remark,v.lessadv from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' and v.hide="no" order by v.cdate');
      $result=$query->result();


      if(count($result)>0)
      {

          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                $dt = $row->cdate;
                $showdt=date('d-m-Y',strtotime($row->cdate));
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }                
                else
                {
                  echo '<tr class="" style="background-color:#F2F2F2;">';
                }
                echo '    <td class="tb_col">' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="RG Sale";
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $parti="Payment";
                }
                echo '    <td class="tb_col">' . $row->builtyno."";
                echo '</td>';

                echo '    <td class="tb_col">' . $parti;
                echo '</td>';

                echo '    <td class="tb_col">';
                  echo "<span style='font-weight:bold;'>" . $row->remark . "</span>";
                echo '</td>';


                $amount = $row->amount*-1;
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $amount = ($row->amount+$row->lessadv)*-1;
                }

                if($amount>0){
                 echo '    <td class="tb_col dr right">' . number_format($amount,2) . '</td>';
                 echo '    <td class="tb_col cr right"></td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                   echo '    <td class="tb_col dr right"></td>';
                   echo '    <td class="tb_col cr right">' . number_format(bcmul($amount,-1,2),2) . '';
                    if(strtoupper($row->vtype)=="RECEIPT" && $row->lessadv!=0)
                    {
                     echo '   <br><span style="font-size:9px;">CD : </span>' . number_format($row->lessadv,2) . '';
                     $cr=bcadd($cr,$row->lessadv,2);
                    }
                   echo '</td>';
                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                }
              $bill_amt=$bill_amt+$amount;
              if(strtoupper($row->vtype)=="RECEIPT")
              {
                $bill_amt=$bill_amt-$row->lessadv;
              }
               echo '    <td class="tb_col cr right">' . number_format($bill_amt,2) . '</td>';

               echo "<td>   &nbsp; &nbsp; &nbsp; &nbsp;<input  type='hidden' id='d_id' name='d_id[]'><input type='checkbox' class='checkbox1' id='checkid'> <input type='hidden' id='id' value='".$row->id."'></td>";

                echo '</tr>';



                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td  class="tb_col" colspan=2>&nbsp;</td>';
            echo '<td  class="tb_col" style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="tb_col right"> </td>';
            echo '<td class="tb_col right">'.$dr.'</td>';
            echo '<td class="tb_col right">'.$cr.'</td>';
            echo '<td  class="tb_col">&nbsp;</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td  class="tb_col" colspan=3>&nbsp;</td>';
            echo '<td  class="tb_col" style="font-weight:bold;color:#000000;">Balance</td>';
            $bal=bcsub($dr,$cr,2);
            $bal=bcsub($bal,$rg,2);
            echo '<td class="tb_col right"></td>';
            if($bal>0){
            echo '<td class="tb_col right">'.$bal.' Dr</td>';
            echo '<td class="tb_col">&nbsp;</td>';
            }else{
            echo '<td class="tb_col right">'.bcmul($bal,-1,2).' Cr</td>';
            echo '<td class="tb_col right"></td>';
            }
            echo '</tr>';
          echo '</tfoot>';
          echo '</table> <script type="text/javascript" class="init">
     
                        $(".checkbox1").click(function()
                        {   
                            cRow=$(this).parent().parent();
                            id=$(cRow).find("#id").val(); 
                            if($(this).is(":checked"))
                            {
                              $(cRow).find("#d_id").val(id);
                            }
                            else
                            {
                              $(cRow).find("#d_id").val("");
                            }

                           
                        });

                        $(".checkbox1").click(function(){
                            var a = $(".checkbox1");
                            var b = a.filter(":checked").length;
                            console.log(b);
                            if(b == 0)
                            {
                                $(".transferbtn").hide();
                                $(".tcount").html("");
                            }
                            else
                            {
                                $(".transferbtn").show();
                                $(".tcount").html("("+b+")");
                                //$(".transferbtn").html("Send SMS ("+b+")");
                            }
                        }); 

                         
                    
                </script>';
      }
          echo '<br>';
    }

    function maintenance(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $report_type=$this->input->get('report_type');
      $l_id=$this->input->get('l_id');


      $opb=0;
      $ledgername="";
      $query=$this->db->query("select l.name ledgername,l.opbalance from m_ledger l where l.id=".$l_id);
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
            $opb=$row->opbalance;
            $ledgername=$row->ledgername;
          }
      }

      //$query=$this->db->query("select v2.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans2 v2 inner join tbl_trans1 v on v2.billno=v.id inner join m_ledger l on v.ledger_id=l.id and v.id=v2.billno and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' order by v.cdate');
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
                  </center>';
          echo '<br>';


      echo '<table id="TblList" class="table table-bordered table-hover">';
      echo '    <thead>';
      echo '        <tr>';
      echo '            <th colspan="11">Ledger : '.$ledgername.'<br>From : '.date('d-m-Y',strtotime($from)).' To : '.date('d-m-Y',strtotime($to)).' </th>';
      echo '        </tr>';
      echo '        <tr>';
      echo '            <th style="width:10%;">Date</th>';
      echo '            <th>Particular Name</th>';
      echo '            <th>Item</th>';
      echo '            <th>Qty</th>';
      echo '            <th>Rate</th>';
      echo '            <th>Disc.</th>';
      echo '            <th>Amount</th>';
      echo '            <th style="width:10%;" class="right">Debit</th>';
      echo '            <th style="width:10%;" class="right">RG</th>';
      echo '            <th style="width:10%;" class="right">Credit</th>';
      echo '            <th>&nbsp;</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate<="'.$to.'") and v.hide="yes" and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }
          
            if($opb<>0){
              echo '<tr class="">';
              echo '    <td>' . date('d-m-Y',strtotime($from)) . '</td>';
              echo '    <td>Opening Balance</td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              if($opb>0){
               echo '    <td class="dr right">' . number_format($opb,2) . '</td>';
               echo '    <td class="cr right">&nbsp;</td>'; // addtional
               echo '    <td class="cr right">&nbsp;</td>'; // addtional
               // echo '    <td class="cr right">&nbsp;</td>'; // addtional
               $dr=bcadd($dr,$opb,2);
              }else{
               echo '    <td class="dr right">&nbsp;</td>';
               echo '    <td class="cr right">&nbsp</td>'; // addtional
               echo '    <td class="cr right">' . number_format(bcmul($opb,-1,2),2) . '</td>';
               // echo '    <td class="cr right">&nbsp</td>'; // addtional
               $cr=bcadd($cr,bcmul($opb,-1,2),2);
              }
              echo '</tr>';
            }

      $query=$this->db->query("select v.hide,v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.hide="no" and v.ledger_id='.$l_id.' order by v.cdate');
      $result=$query->result();


      if(count($result)>0)
      {

          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }                
                else
                {
                  echo '<tr class="">';
                }
                echo '    <td>' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $parti="Payment";
                }
                echo '    <td>' . $parti . "<br>";
                if($row->hide=="yes")
                {
                  echo "**";                  
                }

                echo $row->builtyno; 
                 if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }  
                echo '</td>';

                if($row->vtype=="sales" || $row->vtype=="purchase" || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty="";
                   $rate="";
                   $freight="";
                   $discount="";
                   if($report_type=="Color Wise")
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 0,1");
                   }
                   else
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,g.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i,m_master g where t2.itemcode=i.id and i.group_id=g.id and t2.billno=".$row->id." order by t2.id limit 0,1");
                   }
                    $result1=$query1->result();
                    foreach($result1 as $row1)
                    {
                       $party_name=$row1->itemname;
                       $qty=$row1->qtymt;
                       $rate=$row1->rate;
                       $freight=$row1->freight;
                       $discount="";
                       if($row1->percent<>0)
                       {
                         $discount=$discount.$row1->percent."% ";
                       }
                       if($row1->discount<>0)
                       {
                          if($discount=="")
                          {
                             $discount=$discount.$row1->discount." ";
                          }
                          else {
                             $discount=$discount." + " .$row1->discount." ";
                          }
                       }
                    }
                  
                  echo '    <td>' . $party_name.'</td>';
                  echo '    <td>' . number_format($qty,0).'</td>';
                  echo '    <td>' . number_format($rate,2).'</td>';
                  echo '    <td>' . $discount.'</td>';
                  echo '    <td>' . $freight.'</td>';
                }
                else{
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                }
                
                $amount = $row->amount*-1;

                if($amount>0){
                 echo '    <td class="dr right">' . number_format($amount,2) . '</td>';
                 echo '    <td class="cr right"></td>';
                 echo '    <td class="cr right"></td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                  if($row->vtype=="sales return")
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   echo '    <td class="cr right"></td>';
                   $rg=bcadd($rg,bcmul($amount,-1,2),2);
                  }
                  else
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                  }
                }
                echo '<td>';
                echo '<input style="width:22px;height:22px;" name="checkbox[]" class="chk" type="checkbox" value="'.$row->id.'">';
                echo '</td>';
                echo '</tr>';


                if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight="";
                   $discount="";
                   if($report_type=="Color Wise")
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 1,1000");
                    }
                    else
                    {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,g.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i,m_master g where t2.itemcode=i.id and i.group_id=g.id and  t2.billno=".$row->id." order by t2.id limit 1,1000");
                    }
                    $result1=$query1->result();
                    if(count($result1)>0)
                    {
                      foreach($result1 as $row1)
                      {
                         $party_name=$row1->itemname;
                         $qty=$row1->qtymt;
                         $rate=$row1->rate;
                         $freight=$row1->freight;
                         $discount="";
                         if($row1->percent<>0)
                         {
                           $discount=$discount.$row1->percent."% ";
                         }
                         if($row1->discount<>0)
                         {
                            if($discount=="")
                            {
                               $discount=$discount.$row1->discount." ";
                            }
                            else {
                               $discount=$discount." + " .$row1->discount." ";
                            }
                         }

                        echo '<tr>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>' . $party_name.'</td>';
                        echo '    <td>' . number_format($qty,0).'</td>';
                        echo '    <td>' . number_format($rate,2).'</td>';
                        echo '    <td>' . $discount.'</td>';
                        echo '    <td>' . $freight.'</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '</tr>';

                      }
                    
                    }
                }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=6>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="right">'.$dr.'</td>';
            echo '<td class="right">'.$rg.'</td>';
            echo '<td class="right">'.$cr.'</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan=6>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Balance</td>';
            $bal=bcsub($dr,$cr,2);
            $bal=bcsub($bal,$rg,2);
            if($bal>0){
            echo '<td class="right"></td>';
            echo '<td>&nbsp;</td>';
            echo '<td class="right">'.$bal.' Dr</td>';
            echo '<td>&nbsp;</td>';
            }else{
            echo '<td class="right">'.bcmul($bal,-1,2).' Cr</td>';
            echo '<td class="right"></td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            }
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }

    function history(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $report_type=$this->input->get('report_type');
      $l_id=$this->input->get('l_id');


      $opb=0;
      $ledgername="";
      $query=$this->db->query("select l.name ledgername,l.opbalance from m_ledger l where l.id=".$l_id);
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
            $opb=$row->opbalance;
            $ledgername=$row->ledgername;
          }
      }

      //$query=$this->db->query("select v2.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans2 v2 inner join tbl_trans1 v on v2.billno=v.id inner join m_ledger l on v.ledger_id=l.id and v.id=v2.billno and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' order by v.cdate');
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
                  </center>';
          echo '<br>';


      echo '<table id="TblList" class="table table-bordered table-hover">';
      echo '    <thead>';
      echo '        <tr>';
      echo '            <th colspan="11">Ledger : '.$ledgername.'<br>From : '.date('d-m-Y',strtotime($from)).' To : '.date('d-m-Y',strtotime($to)).' </th>';
      echo '        </tr>';
      echo '        <tr>';
      echo '            <th style="width:10%;">Date</th>';
      echo '            <th>Particular Name</th>';
      echo '            <th>Item</th>';
      echo '            <th>Qty</th>';
      echo '            <th>Rate</th>';
      echo '            <th>Disc.</th>';
      echo '            <th>Amount</th>';
      echo '            <th style="width:10%;" class="right">Debit</th>';
      echo '            <th style="width:10%;" class="right">RG</th>';
      echo '            <th style="width:10%;" class="right">Credit</th>';
      echo '            <th>&nbsp;</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }
          
            if($opb<>0){
              echo '<tr class="">';
              echo '    <td>' . date('d-m-Y',strtotime($from)) . '</td>';
              echo '    <td>Opening Balance</td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              if($opb>0){
               echo '    <td class="dr right">' . number_format($opb,2) . '</td>';
               echo '    <td class="cr right">&nbsp;</td>'; // addtional
               echo '    <td class="cr right">&nbsp;</td>'; // addtional
               // echo '    <td class="cr right">&nbsp;</td>'; // addtional
               $dr=bcadd($dr,$opb,2);
              }else{
               echo '    <td class="dr right">&nbsp;</td>';
               echo '    <td class="cr right">&nbsp</td>'; // addtional
               echo '    <td class="cr right">' . number_format(bcmul($opb,-1,2),2) . '</td>';
               // echo '    <td class="cr right">&nbsp</td>'; // addtional
               $cr=bcadd($cr,bcmul($opb,-1,2),2);
              }
              echo '</tr>';
            }

      $query=$this->db->query("select v.hide,v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'")  and v.ledger_id='.$l_id.' order by v.cdate');
      $result=$query->result();
      if(count($result)>0)
      {

          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }                
                else
                {
                  echo '<tr class="">';
                }
                echo '    <td>' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $parti="Payment";
                }
                echo '    <td>' . $parti . "<br>";
                if($row->hide=="yes")
                {
                  echo "**";                  
                }

                echo $row->builtyno; 
                 if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }  
                echo '</td>';

                if($row->vtype=="sales" || $row->vtype=="purchase" || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty="";
                   $rate="";
                   $freight="";
                   $discount="";
                   if($report_type=="Color Wise")
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 0,1");
                   }
                   else
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,g.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i,m_master g where t2.itemcode=i.id and i.group_id=g.id and t2.billno=".$row->id." order by t2.id limit 0,1");
                   }
                    $result1=$query1->result();
                    foreach($result1 as $row1)
                    {
                       $party_name=$row1->itemname;
                       $qty=$row1->qtymt;
                       $rate=$row1->rate;
                       $freight=$row1->freight;
                       $discount="";
                       if($row1->percent<>0)
                       {
                         $discount=$discount.$row1->percent."% ";
                       }
                       if($row1->discount<>0)
                       {
                          if($discount=="")
                          {
                             $discount=$discount.$row1->discount." ";
                          }
                          else {
                             $discount=$discount." + " .$row1->discount." ";
                          }
                       }
                    }
                  
                  echo '    <td>' . $party_name.'</td>';
                  echo '    <td>' . number_format($qty,0).'</td>';
                  echo '    <td>' . number_format($rate,2).'</td>';
                  echo '    <td>' . $discount.'</td>';
                  echo '    <td>' . $freight.'</td>';
                }
                else{
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                }
                
                $amount = $row->amount*-1;

                if($amount>0){
                 echo '    <td class="dr right">' . number_format($amount,2) . '</td>';
                 echo '    <td class="cr right"></td>';
                 echo '    <td class="cr right"></td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                  if($row->vtype=="sales return")
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   echo '    <td class="cr right"></td>';
                   $rg=bcadd($rg,bcmul($amount,-1,2),2);
                  }
                  else
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                  }
                }
                echo '<td>';
                echo '<input style="width:22px;height:22px;" name="checkbox[]" class="chk" type="checkbox" value="'.$row->id.'">';
                echo '</td>';
                echo '</tr>';


                if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight="";
                   $discount="";
                   if($report_type=="Color Wise")
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 1,1000");
                    }
                    else
                    {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,g.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i,m_master g where t2.itemcode=i.id and i.group_id=g.id and  t2.billno=".$row->id." order by t2.id limit 1,1000");
                    }
                    $result1=$query1->result();
                    if(count($result1)>0)
                    {
                      foreach($result1 as $row1)
                      {
                         $party_name=$row1->itemname;
                         $qty=$row1->qtymt;
                         $rate=$row1->rate;
                         $freight=$row1->freight;
                         $discount="";
                         if($row1->percent<>0)
                         {
                           $discount=$discount.$row1->percent."% ";
                         }
                         if($row1->discount<>0)
                         {
                            if($discount=="")
                            {
                               $discount=$discount.$row1->discount." ";
                            }
                            else {
                               $discount=$discount." + " .$row1->discount." ";
                            }
                         }

                        echo '<tr>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>' . $party_name.'</td>';
                        echo '    <td>' . number_format($qty,0).'</td>';
                        echo '    <td>' . number_format($rate,2).'</td>';
                        echo '    <td>' . $discount.'</td>';
                        echo '    <td>' . $freight.'</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '</tr>';

                      }
                    
                    }
                }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=6>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="right">'.$dr.'</td>';
            echo '<td class="right">'.$rg.'</td>';
            echo '<td class="right">'.$cr.'</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan=6>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Balance</td>';
            $bal=bcsub($dr,$cr,2);
            $bal=bcsub($bal,$rg,2);
            if($bal>0){
            echo '<td class="right"></td>';
            echo '<td>&nbsp;</td>';
            echo '<td class="right">'.$bal.' Dr</td>';
            echo '<td>&nbsp;</td>';
            }else{
            echo '<td class="right">'.bcmul($bal,-1,2).' Cr</td>';
            echo '<td class="right"></td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            }
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    function party_delete(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $report_type=$this->input->get('report_type');
      $l_id=$this->input->get('l_id');


      $opb=0;
      $ledgername="";
      $query=$this->db->query("select l.name ledgername,l.opbalance from m_ledger l where l.id=".$l_id);
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
            $opb=$row->opbalance;
            $ledgername=$row->ledgername;
          }
      }

      //$query=$this->db->query("select v2.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans2 v2 inner join tbl_trans1 v on v2.billno=v.id inner join m_ledger l on v.ledger_id=l.id and v.id=v2.billno and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' order by v.cdate');


      echo '<table id="TblList" class="table table-bordered table-hover">';
      echo '    <thead>';
      echo '        <tr>';
      echo '            <th colspan="11">Ledger : '.$ledgername.'<br>From : '.date('d-m-Y',strtotime($from)).' To : '.date('d-m-Y',strtotime($to)).' </th>';
      echo '        </tr>';
      echo '        <tr>';
      echo '            <th style="width:10%;">Date</th>';
      echo '            <th>Particular Name</th>';
      echo '            <th>Item</th>';
      echo '            <th>Qty</th>';
      echo '            <th>Rate</th>';
      echo '            <th>Disc.</th>';
      echo '            <th>Amount</th>';
      echo '            <th style="width:10%;" class="right">Debit</th>';
      echo '            <th style="width:10%;" class="right">RG</th>';
      echo '            <th style="width:10%;" class="right">Credit</th>';
      echo '            <th>&nbsp;</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate<="'.$to.'") and v.hide="yes" and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }
          
            if($opb<>0){
              echo '<tr class="">';
              echo '    <td>' . date('d-m-Y',strtotime($from)) . '</td>';
              echo '    <td>Opening Balance</td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              echo '    <td> </td>';
              if($opb>0){
               echo '    <td class="dr right">' . number_format($opb,2) . '</td>';
               echo '    <td class="cr right">&nbsp;</td>'; // addtional
               echo '    <td class="cr right">&nbsp;</td>'; // addtional
               // echo '    <td class="cr right">&nbsp;</td>'; // addtional
               $dr=bcadd($dr,$opb,2);
              }else{
               echo '    <td class="dr right">&nbsp;</td>';
               echo '    <td class="cr right">&nbsp</td>'; // addtional
               echo '    <td class="cr right">' . number_format(bcmul($opb,-1,2),2) . '</td>';
               // echo '    <td class="cr right">&nbsp</td>'; // addtional
               $cr=bcadd($cr,bcmul($opb,-1,2),2);
              }
              echo '</tr>';
            }

      $query=$this->db->query("select v.hide,v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.hide="no" and v.ledger_id='.$l_id.' order by v.cdate');
      $result=$query->result();


      if(count($result)>0)
      {

          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }                
                else
                {
                  echo '<tr class="">';
                }
                echo '    <td>' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $parti="Payment";
                }
                echo '    <td>' . $parti . "<br>";
                if($row->hide=="yes")
                {
                  echo "**";                  
                }

                echo $row->builtyno; 
                 if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }  
                echo '</td>';

                if($row->vtype=="sales" || $row->vtype=="purchase" || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty="";
                   $rate="";
                   $freight="";
                   $discount="";
                   if($report_type=="Color Wise")
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 0,1");
                   }
                   else
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,g.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i,m_master g where t2.itemcode=i.id and i.group_id=g.id and t2.billno=".$row->id." order by t2.id limit 0,1");
                   }
                    $result1=$query1->result();
                    foreach($result1 as $row1)
                    {
                       $party_name=$row1->itemname;
                       $qty=$row1->qtymt;
                       $rate=$row1->rate;
                       $freight=$row1->freight;
                       $discount="";
                       if($row1->percent<>0)
                       {
                         $discount=$discount.$row1->percent."% ";
                       }
                       if($row1->discount<>0)
                       {
                          if($discount=="")
                          {
                             $discount=$discount.$row1->discount." ";
                          }
                          else {
                             $discount=$discount." + " .$row1->discount." ";
                          }
                       }
                    }
                  
                  echo '    <td>' . $party_name.'</td>';
                  echo '    <td>' . number_format($qty,0).'</td>';
                  echo '    <td>' . number_format($rate,2).'</td>';
                  echo '    <td>' . $discount.'</td>';
                  echo '    <td>' . $freight.'</td>';
                }
                else{
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                }
                
                $amount = $row->amount*-1;

                if($amount>0){
                 echo '    <td class="dr right">' . number_format($amount,2) . '</td>';
                 echo '    <td class="cr right"></td>';
                 echo '    <td class="cr right"></td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                  if($row->vtype=="sales return")
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   echo '    <td class="cr right"></td>';
                   $rg=bcadd($rg,bcmul($amount,-1,2),2);
                  }
                  else
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                  }
                }
                echo '<td>';
                echo '</td>';
                echo '</tr>';


                if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight="";
                   $discount="";
                   if($report_type=="Color Wise")
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 1,1000");
                    }
                    else
                    {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,g.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i,m_master g where t2.itemcode=i.id and i.group_id=g.id and  t2.billno=".$row->id." order by t2.id limit 1,1000");
                    }
                    $result1=$query1->result();
                    if(count($result1)>0)
                    {
                      foreach($result1 as $row1)
                      {
                         $party_name=$row1->itemname;
                         $qty=$row1->qtymt;
                         $rate=$row1->rate;
                         $freight=$row1->freight;
                         $discount="";
                         if($row1->percent<>0)
                         {
                           $discount=$discount.$row1->percent."% ";
                         }
                         if($row1->discount<>0)
                         {
                            if($discount=="")
                            {
                               $discount=$discount.$row1->discount." ";
                            }
                            else {
                               $discount=$discount." + " .$row1->discount." ";
                            }
                         }

                        echo '<tr>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>' . $party_name.'</td>';
                        echo '    <td>' . number_format($qty,0).'</td>';
                        echo '    <td>' . number_format($rate,2).'</td>';
                        echo '    <td>' . $discount.'</td>';
                        echo '    <td>' . $freight.'</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '</tr>';

                      }
                    
                    }
                }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=6>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="right">'.$dr.'</td>';
            echo '<td class="right">'.$rg.'</td>';
            echo '<td class="right">'.$cr.'</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan=6>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Balance</td>';
            $bal=bcsub($dr,$cr,2);
            $bal=bcsub($bal,$rg,2);
            if($bal>0){
            echo '<td class="right"></td>';
            echo '<td>&nbsp;</td>';
            echo '<td class="right">'.$bal.' Dr</td>';
            echo '<td>&nbsp;</td>';
            }else{
            echo '<td class="right">'.bcmul($bal,-1,2).' Cr</td>';
            echo '<td class="right"></td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            }
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
          echo '<center><button type="button" id="btn_delete" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-delete bigger-120"></i>Delete</button>
                  </center>';
          echo '<br>';
    }


    function ledger_report_receipt(){
      $p_list=0;
      $user_id=get_cookie('ae_user_id');
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Receipt Entry Show Ledger"');
      if(count($query->result())>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_list=$row->p_list;
            }
      }
      if($p_list==0)
      {
        return "";
      }

      $l_id=$this->input->get('l_id');

      $from='2016-04-01';
      $to=date('Y-m-d');
      $query=$this->db->query("select max(cleardate) as cdate from tbl_trans1 where ledger_id=".$l_id);
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
              if($row->cdate!='0000-00-00' && $row->cdate!='1970-01-01')
              {
                $from = $row->cdate;
              }
          }
      }

      $opb=0;
      $ledgername="";
      $query=$this->db->query("select l.name ledgername,l.opbalance from m_ledger l where l.id=".$l_id);
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
            $opb=$row->opbalance;
            $ledgername=$row->ledgername;
          }
      }

      //$query=$this->db->query("select v2.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans2 v2 inner join tbl_trans1 v on v2.billno=v.id inner join m_ledger l on v.ledger_id=l.id and v.id=v2.billno and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' order by v.cdate');


      echo '<table id="TblList" border=1 cellspacing=0 style="font-size:11px;table-layout:fixed;word-wrap:break-word;">';
      echo '    <thead>';
      echo '        <tr>';
      echo '            <th colspan="10">Ledger : '.$ledgername.'<br>From : '.date('d-m-Y',strtotime($from)).' </th>';
      echo '        </tr>';
      echo '        <tr>';
      echo '            <th class="tb_col" style="width:100px;">Date</th>';
      echo '            <th class="tb_col" style="width:50px;">No.</th>';
      echo '            <th class="tb_col" style="width:80px;">Type</th>';
      echo '            <th class="tb_col" style="width:50px;">Freight</th>';
      echo '            <th class="tb_col" style="width:100px;">Bill Amt.</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Debit</th>';
      echo '            <th  style="width:90px;" class="tb_col right">RG</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Credit</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;
      $tqty=0;
      $trgqty=0;
      $tfreight=0;
      $tlr_freight=0;
      $bill_amt=0;

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate <="'.$to.'") and v.ledger_id='.$l_id.' and hide="yes" order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.lessadv) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.vtype='receipt' and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate <="'.$to.'") and v.ledger_id='.$l_id.' and hide="yes" order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }
      $query=$this->db->query("select sum(v.lessadv) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.vtype='receipt' and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
          $opb = bcadd($opb,($row1->amount)*-1);
      }

              if($opb>0){
              $bill_amt=$bill_amt+$opb;
              }else{
              $bill_amt=$bill_amt-$opb;
              }
          
            if($opb<>0){
              echo '<tr class="">';
              echo '    <td>' . date('d-m-Y',strtotime($from)) . '</td>';
              echo '    <td> </td>';
              echo '    <td>Opening Balance</td>';
              echo '    <td> </td>';
               echo '    <td class="tb_col">' . number_format($bill_amt,2) . '</td>';
              if($opb>0){
               echo '    <td class="tb_col dr right">' . number_format($opb,2) . '</td>';
               echo '    <td class="tb_col cr right">&nbsp;</td>'; // addtional
               echo '    <td class="tb_col cr right">&nbsp;</td>'; // addtional
               // echo '    <td class="cr right">&nbsp;</td>'; // addtional
               $dr=bcadd($dr,$opb,2);
              }else{
               echo '    <td class="tb_col dr right">&nbsp;</td>';
               echo '    <td class="tb_col cr right">&nbsp</td>'; // addtional
               echo '    <td class="tb_col cr right">' . number_format(bcmul($opb,-1,2),2) . '</td>';
               // echo '    <td class="cr right">&nbsp</td>'; // addtional
               $cr=bcadd($cr,bcmul($opb,-1,2),2);
              }
              echo '</tr>';
            }

      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.tol_freight,v.vamount as amount,v.lr_freight,l.name ledgername,v.remark,v.lessadv,v.lr_no,v.transport from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' and v.hide="no" order by v.cdate,v.id');
      $result=$query->result();


      if(count($result)>0)
      {

          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                $dt = $row->cdate;
                $showdt=date('d-m-Y',strtotime($row->cdate));
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }                
                else
                {
                  echo '<tr class="" style="background-color:#F2F2F2;">';
                }
                echo '    <td>' . $showdt . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $parti="Payment";
                }
                echo '    <td>' . $parti; 
                echo '</td>';


                $lr_freight_amount=$row->lr_freight;
                if($lr_freight_amount=="")
                {
                  $lr_freight_amount=0;
                }

//                if($row->vtype=="sales" || $row->vtype=="purchase")
//                {
//                  $tlr_freight=$tlr_freight+$lr_freight_amount;
//                  $bill_amt=$bill_amt+$lr_freight_amount;
//                }
//                if($row->vtype=="purchase return")
//                {
//                  $bill_amt=$bill_amt+$lr_freight_amount;
//                }

                $amount = $row->amount*-1;
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $amount = ($row->amount+$row->lessadv)*-1;
                }

                if(strtoupper($row->vtype)=="SALES")
                {
                  $bill_amt=$bill_amt+$amount;
                }

                if(strtoupper($row->vtype)=="SALES RETURN")
                {
                  $bill_amt=$bill_amt+$amount;
                }

                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $bill_amt=$bill_amt+$amount;
                  $bill_amt=$bill_amt-$row->lessadv;
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $bill_amt=$bill_amt+$amount;
                }

                echo '    <td class="tb_col">' . $row->lr_freight.'</td>';
                echo '    <td class="tb_col">'.number_format($bill_amt,2).'</td>';

                if($amount>0){
                 echo '    <td class="tb_col dr right">' . number_format($amount,2) . '</td>';
                 echo '    <td class="tb_col cr right"></td>';
                 echo '    <td class="tb_col cr right"></td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                  if($row->vtype=="sales return")
                  {
                   echo '    <td class="tb_col dr right"></td>';
                   echo '    <td class="tb_col cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   echo '    <td class="tb_col cr right"></td>';
                   $rg=bcadd($rg,bcmul($amount,-1,2),2);
                  }
                  else
                  {
                   echo '    <td class="tb_col dr right"></td>';
                   echo '    <td class="tb_col cr right"></td>';
                   echo '    <td class="tb_col cr right">' . number_format(bcmul($amount,-1,2),2) . '';
                    if(strtoupper($row->vtype)=="RECEIPT" && $row->lessadv!=0)
                    {
                     echo '   <br><span style="font-size:9px;">CD : </span>' . number_format($row->lessadv,2) . '';
                     $cr=bcadd($cr,$row->lessadv,2);
                    }
                   echo '</td>';

                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                  }
                }
                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=4>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="right">'.$dr.'</td>';
            echo '<td class="right">'.$rg.'</td>';
            echo '<td class="right">'.$cr.'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan=4>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Balance</td>';
            $bal=bcsub($dr,$cr,2);
            $bal=bcsub($bal,$rg,2);
            if($bal>0){
            echo '<td class="right"></td>';
            echo '<td>&nbsp;</td>';
            echo '<td class="right">'.$bal.' Dr</td>';
            }else{
            echo '<td class="right">'.bcmul($bal,-1,2).' Cr</td>';
            echo '<td class="right"></td>';
            echo '<td>&nbsp;</td>';
            }
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }

    function ledger_report_print($from,$to,$l_id,$lname,$report_type,$clear_date){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'l_id'=>$l_id,
      'lname'=>$lname,
      'report_type'=>$report_type,
      'clear_date'=>$clear_date
      );
//      $this->load->helper(array('dompdfA4', 'file'));
//      $html = $this->load->view('ledger_print', $data, true);
//      pdf_create($html, 'Ledger');
//        $this->load->view('ledger_print', $data);
        //require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('ledger_print', $data, true);
        echo $html;
        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);

    }

    function ledger_report_normal_print($from,$to,$l_id,$lname,$report_type,$clear_date){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'l_id'=>$l_id,
      'lname'=>$lname,
      'clear_date'=>$clear_date
      );
//      $this->load->helper(array('dompdfA4', 'file'));
//      $html = $this->load->view('ledger_print', $data, true);
//      pdf_create($html, 'Ledger');
//        $this->load->view('ledger_normal_print', $data);
       // require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('ledger_normal_print', $data, true);
        echo $html;
        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);

    }


    function lm001($from,$to,$l_id,$report_type,$clear_date){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'l_id'=>$l_id,
      'report_type'=>$report_type,
      'clear_date'=>$clear_date
      );
//      $this->load->helper(array('dompdfA4', 'file'));
//      $html = $this->load->view('ledger_print', $data, true);
//      pdf_create($html, 'Ledger');
        $this->load->view('lm002', $data);

    }

    function lm003($from,$to,$l_id,$report_type,$clear_date){
      ///require_once(FCPATH . 'application/libraries/phpToPDF.php');
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'l_id'=>$l_id,
      'report_type'=>$report_type,
      'clear_date'=>$clear_date
      );
    ini_set('memory_limit', '256M');
      //$this->load->helper(array('dompdfA4', 'file'));
      $html = $this->load->view('lm004', $data, true);

//      echo $html;
//header("Content-Type: application/vnd.ms-word");
//header("Content-Type: application/pdf");
//header("Expires: 0");
//header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
//header("Content-disposition: attachment; filename=\"mydocument_name.pdf\"");
//      echo $html;

//      return;
echo $html;
$pdf_options = array(
      "source_type" => 'html',
      "source" => $html,
      "action" => 'view',
      "save_directory" => 'PDF',
      "file_name" => 'my_filename.pdf');

    //Code to generate PDF file from options above
    //phptopdf($pdf_options);

/*      $pdfFilePath = FCPATH."PDF/1.pdf";
  $this->load->library('m_pdf');
  $pdf = $this->m_pdf->load();
  $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure ;)
  $pdf->WriteHTML($html); // write the HTML into the PDF
  $pdf->Output($pdfFilePath, 'F'); // save to file because we can
*/
//  redirect("/PDF/1.pdf");

//      pdf_create($html, 'Ledger');
//        $this->load->view('lm004', $data);

    }

    function lm003_1(){
      require_once(FCPATH . 'application/libraries/phpToPDF.php');

      $from=$this->input->get("from");
      $to=$this->input->get("to");
      $l_id=$this->input->get("l_id");
      $report_type=$this->input->get("report_type");
      $clear_date=$this->input->get("clear_date");

      $data=array(
      'from'=>$from,
      'to'=>$to,
      'l_id'=>$l_id,
      'report_type'=>$report_type,
      'clear_date'=>$clear_date
      );
    ini_set('memory_limit', '256M');
//      $this->load->helper(array('dompdfledger', 'file'));
      $html = $this->load->view('lm004', $data, true);
//      pdf_create($html, $l_id);
$pdf_options = array(
      "source_type" => 'html',
      "source" => $html,
      "action" => 'save',
      "save_directory" => 'PDF',
      "file_name" => 'my_filename.pdf');
  echo $html;
    //Code to generate PDF file from options above
    //phptopdf($pdf_options);

//      echo $html;

//      $this->load->library('pdf');
//      $this->pdf->load_view('lm004', $data);
//      $this->pdf->render();
//      file_put_contents('PDF/'.$l_id.".pdf", $this->pdf->output());
//      $this->pdf->stream();

//      echo $html;
//      $html="<table><tr><td>sdfsdf</td><td>werwer</td></tr></table>";
//      $pdfFilePath = FCPATH."PDF/".$l_id.".pdf";
//      $this->load->library('pdf');
//      $pdf = $this->pdf->load();
//      $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure ;)
//      $pdf->WriteHTML($html); // write the HTML into the PDF
 //     $pdf->Output($pdfFilePath, 'F'); // save to file because we can

//  redirect("/PDF/1.pdf");

//      pdf_create($html, 'Ledger');
//        $this->load->view('lm004', $data);

    }

    function daily_freight_report_print($from){
    $data=array(
      'from'=>$from
      
      );

//        $this->load->view('daily_freight_report_print', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('daily_freight_report_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;
    }

    ///////////////////
    function ledger_deleteselected(){
      $checkbox=$this->input->post('checkbox');

      $ids = explode(",", $checkbox);
      foreach($ids as $id) {
        $this->db->where('id',$id);
        $this->db->delete('tbl_trans1');

        $this->db->where('billno',$id);
        $this->db->delete('tbl_trans2');
      }

      echo "1";
    }


    function deletetransaction()
    {
        $d_id=$this->input->post('d_id');       
        $zipped=array_map(null, $d_id);
        foreach ($zipped as $tupple) 
        {
          $this->db->where('id',$tupple);
          $this->db->delete('tbl_trans1');

          $this->db->where('billno',$tupple);
          $this->db->delete('tbl_trans2');
        }
        echo "1";
    }

    
/////////////////////////////
    ///////////////////
    function prt_del(){
      $l_id=$this->input->post('l_id');
      $opb=0;
      $ledgername="";
      $query=$this->db->query("select l.name ledgername,l.opbalance from m_ledger l where l.id=".$l_id);
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
            $opb=$row->opbalance;
            $ledgername=$row->ledgername;
          }
      }

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and v.ledger_id='.$l_id.'');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $this->db->query("delete from tbl_trans2 where billno in (select id from tbl_trans1 where ledger_id=".$l_id." and company_id=".get_cookie("ae_company_id").")");

      $this->db->query("delete from tbl_trans1 where ledger_id=".$l_id." and company_id=".get_cookie("ae_company_id"));

      $updata=array(
        'opbalance'=>$opb
        );
      $this->db->where('id',$l_id);
      $this->db->update('m_ledger',$updata);

      echo "1";
    }

    ///////////////////

    ///////////////////
    function all_del(){
      $this->db->query("delete from tbl_trans2 where billno in (select id from tbl_trans1 where company_id=".get_cookie("ae_company_id").")");

      $this->db->query("delete from tbl_trans1 where company_id=".get_cookie("ae_company_id"));

      $updata=array(
        'opbalance'=>0
        );
      $this->db->where('company_id',get_cookie("ae_company_id"));
      $this->db->update('m_ledger',$updata);

      echo "1";
    }




    function ledger_hideselected(){
      $checkbox=$this->input->post('checkbox');

      $ids = explode(",", $checkbox);
      foreach($ids as $id) {
        $updata=array(
          'hide'=>'yes'
          );
        $this->db->where('id',$id);
        $this->db->update('tbl_trans1',$updata);
      }

      echo "1";
    }
/////////////////////////////
    ///////////////////
    function receipt_delete(){
      $builtyno=$this->input->post('ID');
      $query=$this->db->query('delete from tbl_trans1 where vtype="receipt" and builtyno='.$builtyno . ' and company_id='.get_cookie("ae_company_id"));

      echo "1";
    }
/////////////////////////////

    function daily_report(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $query=$this->db->query("select v.id,v.builtyno,v.edate as cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark,v.lr_freight,v.lr_no,v.transport from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.edate between "'.$from.'" and "'.$to.'") and v.hide="no" order by v.edate,v.vtype,v.id');
      $result=$query->result();

      if(count($result)>0)
      {

          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
          </center>';
          echo '<br>';

          echo '<table id="TblList" class="table table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
        echo '            <th style="width:10%;">Date</th>';
        echo '            <th>Particular Name</th>';
        echo '            <th>Item</th>';
        echo '            <th>Qty</th>';
        echo '            <th>Rate</th>';
        echo '            <th>Disc.</th>';
        echo '            <th>Amount</th>';
        echo '            <th>Freight</th>';
        echo '            <th style="width:10%;" class="right">Debit</th>';
        echo '            <th style="width:10%;" class="right">RG</th>';
        echo '            <th style="width:10%;" class="right">Credit</th>';
        echo '            <th>&nbsp;</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $rg=0;
          $fr=0;
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                $dt = $row->cdate;
                $showdt=date('d-m-Y',strtotime($row->cdate));
                if($row->amount==0){
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }
                else
                {
                  echo '<tr class="">';
                }
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $parti="Payment";
                }
                echo '    <td>' . $showdt . '<br>'. $parti . '</td>';
                echo '    <td>' . '' . $row->ledgername . '<br>' . $row->builtyno;
                 if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }  
                 if($row->lr_no!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>LR: " . $row->lr_no . " TR:" . $row->transport. "</span>";
                }  
                echo '</td>';

                if($row->vtype=="sales" || $row->vtype=="purchase" || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight=0;
                   $discount=0;
                    $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 0,1");
                    $result1=$query1->result();
                    foreach($result1 as $row1)
                    {
                       $party_name=$row1->itemname;
                       $qty=$row1->qtymt;
                       $rate=$row1->rate;
                       $freight=$row1->freight;
                       $discount="";
                       if($row1->percent<>0)
                       {
                         $discount=$discount.$row1->percent."% ";
                       }
                       if($row1->discount<>0)
                       {
                          if($discount=="")
                          {
                             $discount=$discount.$row1->discount." ";
                          }
                          else {
                             $discount=$discount." + " .$row1->discount." ";
                          }
                       }
                    }
                  
                  echo '    <td>' . $party_name.'</td>';
                  echo '    <td>' . number_format($qty,0).'</td>';
                  echo '    <td>' . number_format($rate,2).'</td>';
                  echo '    <td>' . $discount.'</td>';
                  echo '    <td>' . $freight.'</td>';
                }
                else{
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                }
                
                $amount = $row->amount*-1;

                 echo '    <td class="right">' . number_format($row->lr_freight,2) . '</td>';
                 $fr=bcadd($fr,$row->lr_freight);
                if($amount>0){
                 echo '    <td class="dr right">' . number_format($amount,2) . '</td>';
                 echo '    <td class="cr right"></td>';
                 echo '    <td class="cr right"></td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                  if($row->vtype=="sales return")
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   echo '    <td class="cr right"></td>';
                   $rg=bcadd($rg,bcmul($amount,-1,2),2);
                  }
                  else
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                  }
                }
                echo '<td>';
                if(strtoupper($row->vtype)=="SALES")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->id .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->builtyno .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                }
                if(strtoupper($row->vtype)=="SALES RETURN")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("RGSale","'. $row->id .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                }
                echo '</td>';
                echo '</tr>';


                if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight=0;
                   $discount=0;
                    $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 1,1000");
                    $result1=$query1->result();
                    if(count($result1)>0)
                    {
                      foreach($result1 as $row1)
                      {
                         $party_name=$row1->itemname;
                         $qty=$row1->qtymt;
                         $rate=$row1->rate;
                         $freight=$row1->freight;
                         $discount="";
                         if($row1->percent<>0)
                         {
                           $discount=$discount.$row1->percent."% ";
                         }
                         if($row1->discount<>0)
                         {
                            if($discount=="")
                            {
                               $discount=$discount.$row1->discount." ";
                            }
                            else {
                               $discount=$discount." + " .$row1->discount." ";
                            }
                         }

                        if($row1->rate==0){
                          echo '<tr class="" style="background-color:#ffcccc;">';
                        }
                        else
                        {
                          echo '<tr class="">';
                        }
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>' . $party_name.'</td>';
                        echo '    <td>' . number_format($qty,0).'</td>';
                        echo '    <td>' . number_format($rate,2).'</td>';
                        echo '    <td>' . $discount.'</td>';
                        echo '    <td>' . $freight.'</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '</tr>';

                      }
                    
                    }
                }

                $showdt='';

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=6>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="right">'.$fr.'</td>';
            echo '<td class="right">'.$dr.'</td>';
            echo '<td class="right">'.$rg.'</td>';
            echo '<td class="right">'.$cr.'</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }

/////////////////////////////
/////////////////////////////
function daily_report_checking(){
  $from=date('Y-m-d',strtotime($this->input->get('from')));
  $to=date('Y-m-d',strtotime($this->input->get('to')));
  $query=$this->db->query("select v.id,v.builtyno,v.edate as cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark,v.lr_freight,v.lr_no,v.transport from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.edate between "'.$from.'" and "'.$to.'") and v.hide="no" order by v.edate,v.vtype,v.id');
  $result=$query->result();

  if(count($result)>0)
  {

      echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
    <button class="btn btn-primary" onClick ="exportExcel();">
      <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
    </button>
      </center>';
      echo '<br>';

      echo '<table id="TblList" class="table table-bordered table-hover">';
      echo '    <thead>';
      echo '        <tr>';
    echo '            <th style="width:10%;">Date</th>';
    echo '            <th>Particular Name</th>';
    echo '            <th>Item</th>';
    echo '            <th>Qty</th>';
    echo '            <th>Freight</th>';
    echo '            <th>&nbsp;</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;
      $fr=0;
      $dt='';
      $showdt='';
      foreach($result as $row)
      {
            $dt = $row->cdate;
            $showdt=date('d-m-Y',strtotime($row->cdate));
            if($row->amount==0){
              echo '<tr class="" style="background-color:#ffcccc;">';
            }
            else
            {
              echo '<tr class="">';
            }
            $parti="";
            if($row->vtype=="sales")
            {
              $parti="Sales";
            }
            if($row->vtype=="sales return")
            {
              $parti="Sales Return";
            }
            if(strtoupper($row->vtype)=="RECEIPT")
            {
              $parti="Receipt";
            }
            if($row->vtype=="purchase")
            {
              $parti="Purchase";
            }
            if(strtoupper($row->vtype)=="PAYMENT")
            {
              $parti="Payment";
            }
            echo '    <td>' . $showdt . '<br>'. $parti . '</td>';
            echo '    <td>' . '' . $row->ledgername . '<br>' . $row->builtyno;
             if($row->remark!='')
            {
              echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
            }  
             if($row->lr_no!='')
            {
              echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>LR: " . $row->lr_no . " TR:" . $row->transport. "</span>";
            }  
            echo '</td>';

            if($row->vtype=="sales" || $row->vtype=="purchase" || $row->vtype=="sales return")
            {
               $party_name="";
               $qty=0;
               $rate=0;
               $freight=0;
               $discount=0;
                $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 0,1");
                $result1=$query1->result();
                foreach($result1 as $row1)
                {
                   $party_name=$row1->itemname;
                   $qty=$row1->qtymt;
                   $rate=$row1->rate;
                   $freight=$row1->freight;
                   $discount="";
                   if($row1->percent<>0)
                   {
                     $discount=$discount.$row1->percent."% ";
                   }
                   if($row1->discount<>0)
                   {
                      if($discount=="")
                      {
                         $discount=$discount.$row1->discount." ";
                      }
                      else {
                         $discount=$discount." + " .$row1->discount." ";
                      }
                   }
                }
              
              echo '    <td>' . $party_name.'</td>';
              echo '    <td>' . number_format($qty,0).'</td>';
            }
            else{
              echo '    <td>&nbsp;</td>';
              echo '    <td>&nbsp;</td>';
            }
            
            $amount = $row->amount*-1;

             echo '    <td class="right">' . number_format($row->lr_freight,2) . '</td>';
             $fr=bcadd($fr,$row->lr_freight);
            echo '<td>';
            if(strtoupper($row->vtype)=="SALES")
            {
              echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->id .'");return false;>';
              echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
              echo '        </button>';
            }
            if(strtoupper($row->vtype)=="RECEIPT")
            {
              echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->builtyno .'");return false;>';
              echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
              echo '        </button>';
            }
            if(strtoupper($row->vtype)=="SALES RETURN")
            {
              echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("RGSale","'. $row->id .'");return false;>';
              echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
              echo '        </button>';
            }
            echo '</td>';
            echo '</tr>';


            if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
            {
               $party_name="";
               $qty=0;
               $rate=0;
               $freight=0;
               $discount=0;
                $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 1,1000");
                $result1=$query1->result();
                if(count($result1)>0)
                {
                  foreach($result1 as $row1)
                  {
                     $party_name=$row1->itemname;
                     $qty=$row1->qtymt;
                     $rate=$row1->rate;
                     $freight=$row1->freight;
                     $discount="";
                     if($row1->percent<>0)
                     {
                       $discount=$discount.$row1->percent."% ";
                     }
                     if($row1->discount<>0)
                     {
                        if($discount=="")
                        {
                           $discount=$discount.$row1->discount." ";
                        }
                        else {
                           $discount=$discount." + " .$row1->discount." ";
                        }
                     }

                    if($row1->rate==0){
                      echo '<tr class="" style="background-color:#ffcccc;">';
                    }
                    else
                    {
                      echo '<tr class="">';
                    }
                    echo '    <td>&nbsp;</td>';
                    echo '    <td>&nbsp;</td>';
                    echo '    <td>' . $party_name.'</td>';
                    echo '    <td>' . number_format($qty,0).'</td>';
                    echo '    <td>&nbsp;</td>';
                    echo '</tr>';

                  }
                
                }
            }

            $showdt='';

      }
      echo '</tbody>';
        echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
        echo '<tr>';
        echo '<td colspan=6>&nbsp;</td>';
        echo '<td style="font-weight:bold;color:#000000;">Total</td>';
        echo '<td class="right">'.$fr.'</td>';
        echo '<td>&nbsp;</td>';
        echo '</tr>';
      echo '</tfoot>';
      echo '</table>';
  }
}

/////////////////////////////

    
    function rg_report(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.hide="no" and v.vtype="sales return" order by v.cdate');
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>

          </center>';
          echo '<br>';

          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>Particulars</th>';
          echo '            <th>Type</th>';
          echo '            <th style="width:10%;" class="right">Debit</th>';
          echo '            <th style="width:10%;" class="right">Credit</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                if($row->amount==0){
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }
                else
                {
                  echo '<tr class="">';
                }
                echo '    <td>' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
                }
                if($row->vtype=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if($row->vtype=="payment")
                {
                  $parti="Payment";
                }
                echo '    <td>' . $row->ledgername;
                if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }
                if($row->vtype=="sales")
                {
                  $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id."");
                  $result1=$query1->result();
                  foreach($result1 as $row1)
                  {
                      echo "<br><div style='margin-left:30px;width:200px;display:inline;float:left;'>".$row1->itemname."</div>";
                      echo "<div style='margin-left:30px;width:100px;display:inline;float:left;'>".number_format($row1->qtymt,0)." @ ".number_format($row1->rate,2)."</div>";
                  }
                }
                if($row->vtype=="sales return")
                {
                  $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id."");
                  $result1=$query1->result();
                  foreach($result1 as $row1)
                  {
                      echo "<br><div style='margin-left:30px;width:200px;display:inline;float:left;'>".$row1->itemname."</div>";
                      echo "<div style='margin-left:30px;width:100px;display:inline;float:left;'>".number_format($row1->qtymt,0)." @ ".number_format($row1->rate,2)."</div>";
                  }
                }
                if($row->vtype=="purchase")
                {
                  $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id."");
                  $result1=$query1->result();
                  foreach($result1 as $row1)
                  {
                      echo "<br><div style='margin-left:30px;width:200px;display:inline;float:left;'>".$row1->itemname."</div>";
                      echo "<div style='margin-left:30px;width:100px;display:inline;float:left;'>".number_format($row1->qtymt,0)." @ ".number_format($row1->rate,2)."</div>";
                  }
                }
                echo '</td>';
                echo '    <td>' . $parti . '</td>'; 
                if($row->amount>0){
                 echo '    <td class="dr right">' . number_format($row->amount,2) . '</td>';
                 echo '    <td class="cr right"></td>';
                 $dr=bcadd($dr,$row->amount,2);
                }else{
                 echo '    <td class="dr right"></td>';
                 echo '    <td class="cr right">' . number_format(bcmul($row->amount,-1,2),2) . '</td>';
                 $cr=bcadd($cr,bcmul($row->amount,-1,2),2);
                }
                echo '    <td>';
                echo '<input style="width:22px;height:22px;" name="checkbox[]" class="chk" type="checkbox" value="'.$row->id.'">';
                echo '    </td>';

                echo '</tr>';

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=2>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="right">'.$dr.'</td>';
            echo '<td class="right">'.$cr.'</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }

    function daily_report_print($from,$to){
      $data=array(
      'from'=>$from,
      'to'=>$to
      );

        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('daily_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function daily_report_check_print($from,$to){
      $data=array(
      'from'=>$from,
      'to'=>$to
      );

        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('daily_check_print', $data, true);
        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function day_book_print($from){
      $data=array(
      'from'=>$from
      );

//        $this->load->view('day_book_print', $data);


        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('day_book_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function party_dis_print($state){
      $data=array(
      'state'=>$state
      );

        $this->load->view('party_dis_print', $data);

    }


    function quatation_rpt_print($from,$to,$vtype){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'vtype'=>$vtype,

      );

        $this->load->view('quatation_rpt_print', $data);

    }


    function invoice_rpt_print($from,$to,$vtype){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'vtype'=>$vtype,
      );
        $this->load->view('invoice_rpt_print', $data);
    }

    function purchase_rpt_print($from,$to,$vtype){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'vtype'=>$vtype,
      );
        $this->load->view('purchase_rpt_print', $data);
    }

    function requisition_rpt_print($from,$to,$vtype){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'vtype'=>$vtype,
      );
        $this->load->view('requisition_rpt_print', $data);
    }

    function voucher_rpt_print($from,$to,$vtype){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'vtype'=>$vtype,
      );
        $this->load->view('voucher_rpt_print', $data);
    }

    function jobcard_rpt_print($from,$to,$vtype){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'vtype'=>$vtype,
      );
        $this->load->view('jobcard_rpt_print', $data);
    }


    function ageing_print($to,$district){
      $data=array(
      'to'=>$to,
      'district'=>$district
      );

//        $this->load->view('ageing_print', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('ageing_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function ageing_state_print($to,$state){
      $data=array(
      'to'=>$to,
      'state'=>$state
      );

//        $this->load->view('ageing_state_print', $data);
        //require_once(FCPATH . 'application/libraries/phptopdf.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('ageing_state_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function line_summary_print($to,$line_id){
      $data=array(
      'to'=>$to,
      'line_id'=>$line_id
      );

//        $this->load->view('line_summary_print', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('line_summary_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }


    function salesman_wise_print($to,$line_id){
      $data=array(
      'to'=>$to,
      'line_id'=>$line_id
      );

//        $this->load->view('line_summary_print', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('salesman_wise_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function sale_group_wise_print($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

//        $this->load->view('sale_group_wise_print', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('sale_group_wise_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function pending_order_print($search_by){
      $data=array(
      'search_by'=>$search_by
      );
      $this->load->view('pending_order_print', $data);
    }

    function sale_group_wise_print_1($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

//        $this->load->view('sale_group_wise_print_1', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('sale_group_wise_print_1', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);

        echo $html;

    }

    function sale_group_wise_print_2($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

//        $this->load->view('sale_group_wise_print_2', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('sale_group_wise_print_2', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function sale_brand_wise_print($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

//        $this->load->view('sale_brand_wise_print', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('sale_brand_wise_print', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function sale_brand_wise_print_1($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

//        $this->load->view('sale_brand_wise_print_1', $data);
        require_once(FCPATH . 'application/libraries/phpToPDF.php');
        ini_set('memory_limit', '256M');
        $html = $this->load->view('sale_brand_wise_print_1', $data, true);

        $pdf_options = array(
          "source_type" => 'html',
          "source" => $html,
          "action" => 'view',
          "save_directory" => 'PDF',
          "file_name" => 'my_filename.pdf');

      //Code to generate PDF file from options above
      //phptopdf($pdf_options);
        echo $html;

    }

    function sale_brand_wise_print_2($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

        $this->load->view('sale_brand_wise_print_2', $data);
    }

     function purchase_group_wise_print($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

        $this->load->view('purchase_group_wise_print', $data);

    }

    function sale_category_wise_print($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

        $this->load->view('sale_category_wise_print', $data);

    }

    function purchase_category_wise_print($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

        $this->load->view('purchase_category_wise_print', $data);

    }

    function sale_master_wise_print($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

        $this->load->view('sale_master_wise_print', $data);

    }

    function purchase_master_wise_print($from,$to,$ledger_id){
      $data=array(
      'from'=>$from,
      'to'=>$to,
      'ledger_id'=>$ledger_id
      );

        $this->load->view('purchase_master_wise_print', $data);

    }

    function rg_report_print($from,$to){
      $data=array(
      'from'=>$from,
      'to'=>$to
      );
      
      $this->load->view('rg_report_print', $data);

    }

/////////////////////////////
    function day_book(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").'  and (v.cdate="'.$from.'")  order by v.cdate');
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>

          </center>';
          echo '<br>';

          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>Particulars</th>';
          echo '            <th>Type</th>';
          echo '            <th style="width:10%;">RefNo</th>';
          echo '            <th style="width:10%;" class="right">Debit</th>';
          echo '            <th style="width:10%;" class="right">Credit</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                if($row->amount==0){
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }
                else
                {
                  echo '<tr class="">';
                }
                echo '    <td>' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
                }
                if($row->vtype=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if($row->vtype=="payment")
                {
                  $parti="Payment";
                }
                echo '    <td>' . $row->ledgername;
                if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }
                echo '</td>';
                echo '    <td>' . $parti . '</td>'; 
                echo '    <td>' . $row->builtyno . '</td>'; 
                if($row->amount>0){
                 echo '    <td class="dr right">' . number_format($row->amount,2) . '</td>';
                 echo '    <td class="cr right"></td>';
                 $dr=bcadd($dr,$row->amount,2);
                }else{
                 echo '    <td class="dr right"></td>';
                 echo '    <td class="cr right">' . number_format(bcmul($row->amount,-1,2),2) . '</td>';
                 $cr=bcadd($cr,bcmul($row->amount,-1,2),2);
                }
                echo '    <td>';
                echo '<input style="width:22px;height:22px;" name="checkbox[]" class="chk" type="checkbox" value="'.$row->id.'">';
                echo '    </td>';

                echo '</tr>';

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=2>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="right">'.$dr.'</td>';
            echo '<td class="right">'.$cr.'</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }


    function quotation_rpt(){
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $query=$this->db->query('select t1.id,t1.cdate,t1.price,t1.kindattn,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(t2.item_name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2 where t1.ledger_id=l.id and t1.id=t2.billno  and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');

      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center>
            <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>
          </center>';
          echo '<br>';
          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Kind Attn</th>';
          echo '            <th>Price</th>';
          echo '            <th>Items</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          $total = 0;
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '    <td>' . $row->lname.'</td>';
                echo '    <td>' . $row->kindattn.'</td>';
                echo '    <td class="dr right">' . number_format($row->price,2) . '</td>';
                echo '    <td>' . $row->items.'</td>';
                echo '</tr>';
                $total+=$row->price;

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=2>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td>'.number_format($total,2).'</td>';
            echo '<td colspan=1>&nbsp;</td>';
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }

    function purchase_rpt(){
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $query=$this->db->query('select t1.id,t1.cdate,t1.purchase_no,t1.jobcard,t1.pon,t1.ref_details,t1.sub_details,t1.tol_freight,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l, m_item i,tbl_trans2 t2 where t1.ledger_id=l.id and t1.id=t2.billno and i.id=t2.itemcode  and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,l.name order by t1.cdate,t1.id');

      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center>
            <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>
          </center>';
          echo '<br>';
          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Purchase&nbsp;No</th>';
          echo '            <th>P.O.No.</th>';
          echo '            <th>Jobcard</th>';
          echo '            <th>Ref&nbsp;Details</th>';
          echo '            <th>Sub&nbsp;Details</th>';
          echo '            <th>Total&nbsp;Amt</th>';
          echo '            <th>Items</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          $total = 0;
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '    <td>' . $row->lname.'</td>';
                echo '    <td>' . $row->purchase_no.'</td>';
                echo '    <td>' . $row->pon.'</td>';
                echo '    <td>' . $row->jobcard.'</td>';
                echo '    <td>' . $row->ref_details.'</td>';
                echo '    <td>' . $row->sub_details.'</td>';
                echo '    <td class="dr right">' . number_format($row->tol_freight,2) . '</td>';
                echo '    <td>' . $row->items.'</td>';
                echo '</tr>';
                $total+=$row->tol_freight;
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=6>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="dr right">'.number_format($total,2).'</td>';
            echo '<td colspan=1>&nbsp;</td>';
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }


    function jobcard_rpt(){
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $query=$this->db->query('select t1.id,t1.cdate,ledger_mobno,l.name lname,t1.approve_by,t1.jobcard,t1.designation,t1.pon,t1.jobwork,t1.jobcard,GROUP_CONCAT(CONCAT(t2.item_name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2 where t1.ledger_id=l.id and t1.id=t2.billno and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');

      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center>
            <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>
          </center>';
          echo '<br>';
          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Job&nbsp;Card&nbsp;No.</th>';
          echo '            <th>P.O.N.</th>';
          echo '            <th>Job&nbsp;Work</th>';
          echo '            <th>Items</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          $total = 0;
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '    <td>' . $row->lname.'</td>';
                echo '    <td>' . $row->jobcard.'</td>';
                echo '    <td>' . $row->pon.'</td>';
                echo '    <td>' . $row->jobwork.'</td>';
                echo '    <td>' . $row->items.'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
          //   echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
          //   echo '<tr>';
          //   echo '<td colspan=6>&nbsp;</td>';
          //   echo '<td style="font-weight:bold;color:#000000;">Total</td>';
          //   echo '<td class="dr right">'.number_format($total,2).'</td>';
          //   echo '<td colspan=1>&nbsp;</td>';
          //   echo '</tr>';
          // echo '</tfoot>';
          echo '</table>';
      }
    }

    function requisition_rpt(){
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $query=$this->db->query('select t1.id,t1.cdate,ledger_mobno,l.name lname,t1.approve_by,t1.requisition,t1.designation,t1.jobcard,t1.pon,t1.jobwork,GROUP_CONCAT(CONCAT(t2.item_name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2 where t1.ledger_id=l.id and t1.id=t2.billno and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');

      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center>
            <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>
          </center>';
          echo '<br>';
          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Requisition</th>';
          echo '            <th>Job&nbsp;Card&nbsp;No.</th>';
          echo '            <th>P.O.N.</th>';
          echo '            <th>Job&nbsp;Work</th>';
          echo '            <th>Items</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          $total = 0;
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '    <td>' . $row->lname.'</td>';
                echo '    <td>' . $row->requisition.'</td>';
                echo '    <td>' . $row->jobcard.'</td>';
                echo '    <td>' . $row->pon.'</td>';
                echo '    <td>' . $row->jobwork.'</td>';
                echo '    <td>' . $row->items.'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
          //   echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
          //   echo '<tr>';
          //   echo '<td colspan=6>&nbsp;</td>';
          //   echo '<td style="font-weight:bold;color:#000000;">Total</td>';
          //   echo '<td class="dr right">'.number_format($total,2).'</td>';
          //   echo '<td colspan=1>&nbsp;</td>';
          //   echo '</tr>';
          // echo '</tfoot>';
          echo '</table>';
      }
    }


    function voucher_rpt(){
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

        $query=$this->db->query('select t1.*,t1.upi,t1.bank,t1.cash,t1.card from tbl_trans1 t1 where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") group by t1.id,t1.cdate,t1.builtyno,t1.item_type order by t1.cdate,t1.id');
        // echo $this->db->last_query();die;
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center>
            <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>
          </center>';
          echo '<br>';
          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th>Date</th>';
          echo '            <th>Payable&nbsp;To</th>';
          echo '            <th>Ref.&nbsp;No</th>';
          echo '            <th>Type&nbsp;Of&nbsp;Payment</th>';
          echo '            <th>Payable&nbsp;Amount</th>';
          echo '            <th>Cash</th>';
          echo '            <th>Card</th>';
          echo '            <th>Bank</th>';
          echo '            <th>UPI</th>';
          echo '            <th>Left&nbsp;Amount</th>';
          echo '            <th>Remark</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          $total_cash = 0;
          $total_card = 0;
          $total_bank = 0;
          $total_upi = 0;
          $total = 0;
          $total_payable_amount=0;
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                echo '<tr class="">';
                echo '    <td>' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->refno . '</td>';   
                echo '    <td>' . $row->typeofpayment . '</td>';              
                echo '    <td class="dr right">' . $row->payable_amount . '</td>';              
                echo '    <td class="dr right">' . $row->cash . '</td>';              
                echo '    <td class="dr right">' . $row->card . '</td>';              
                echo '    <td class="dr right">' . $row->bank . '</td>';              
                echo '    <td class="dr right">' . $row->upi . '</td>';              
                echo '    <td class="dr right">' . $row->total_amt . '</td>';              
                echo '    <td>' . $row->remark . '</td>'; 
                echo '</tr>';
                $total_cash +=$row->cash;
                $total_card +=$row->card;
                $total_bank +=$row->bank;
                $total_upi +=$row->upi;
                $total +=$row->total_amt;
                $total_payable_amount +=$row->payable_amount;

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=3>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="dr right">'.number_format($total_payable_amount,2).'</td>';
            echo '<td class="dr right">'.number_format($total_cash,2).'</td>';
            echo '<td class="dr right">'.number_format($total_card,2).'</td>';
            echo '<td class="dr right">'.number_format($total_bank,2).'</td>';
            echo '<td class="dr right">'.number_format($total_upi,2).'</td>';
            echo '<td class="dr right">'.number_format($total,2).'</td>';
            echo '<td colspan=1>&nbsp;</td>';
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }

    function invoice_rpt(){
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $query=$this->db->query('select t1.id,t1.cdate,t1.invoice_no,t1.quatation,t1.wo_no,t1.reg_address,t1.con_address,t1.dispatch_detail,t1.grand_total,t1.total_gst,l.name lname,GROUP_CONCAT(CONCAT(t2.item_name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_invoice1 t1, m_ledger l,tbl_invoice2 t2 where t1.ledger_id=l.id and t1.id=t2.billno  and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,l.name order by t1.cdate,t1.id');

      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center>
            <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>
          </center>';
          echo '<br>';
          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Invoice&nbsp;No</th>';
          echo '            <th>W.O.No.</th>';
          echo '            <th>Quatation</th>';
          echo '            <th>Registered&nbsp;Add</th>';
          echo '            <th>Consignee&nbsp;Add</th>';
          echo '            <th>Dispatch&nbsp;Add</th>';
          echo '            <th>Total&nbsp;GST</th>';
          echo '            <th>Grand&nbsp;Total</th>';
          echo '            <th>Items</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          $total = 0;
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '    <td>' . $row->lname.'</td>';
                echo '    <td>' . $row->invoice_no.'</td>';
                echo '    <td>' . $row->wo_no.'</td>';
                echo '    <td>' . $row->quatation.'</td>';
                echo '    <td>' . $row->reg_address.'</td>';
                echo '    <td>' . $row->con_address.'</td>';
                echo '    <td>' . $row->dispatch_detail.'</td>';
                echo '    <td class="dr right">' . number_format($row->total_gst,2) . '</td>';
                echo '    <td class="dr right">' . number_format($row->grand_total,2) . '</td>';
                echo '    <td>' . $row->items.'</td>';
                echo '</tr>';
                $total+=$row->grand_total;
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=7>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td>'.number_format($total,2).'</td>';
            echo '<td colspan=3>&nbsp;</td>';
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }

    function daily_frieght_report(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.ledger_mobno as vehicle,l.name ledgername, v.transport,v.lr_freight,v.remark,v.lr_no from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and v.hide="no" and (v.cdate between "'.$from.'" and "'.$to.'") and v.billstatus="pending" order by v.cdate');
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<table class="table table-striped table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>Party Name</th>';
          echo '            <th>Vehicle No</th>';
          echo '            <th>LR No</th>';
          echo '            <th style="width:10%;">Transporter</th>';
          echo '            <th style="width:10%;" class="right">Freight</th>';
          
          
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $total_freight='0';
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
              $total_freight=$total_freight+$row->lr_freight;
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                
                echo '    <td>' . $row->ledgername;
                if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }
                
                echo '</td>';
                echo '    <td>' . $row->vehicle . '</td>'; 
                echo '    <td>' . $row->lr_no . '</td>'; 
                echo '    <td>' . $row->transport . '</td>'; 
                echo '    <td style="text-align:right">' . $row->lr_freight . '</td>'; 
                echo '</tr>';

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan="5" style="font-weight:bold;color:#000000; text-align:right;">Total</td>';
            echo '<td class="right">'.number_format($total_freight,2).'</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////

    function receipt_report(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $mode_id=$this->input->get('mode_id');
      $srch="";
      if($mode_id!=0)
      {
        $srch = " and v.ref_ledger_id=".$mode_id;
      }
      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.edate,v.vtype,l.name ledgername,v.remark,v.tol_freight,v.cleardate,v.salesman,r.name as rname,v.lessadv from tbl_trans1 v,m_ledger l,m_ledger r where v.ref_ledger_id=r.id and v.ledger_id=l.id and v.company_id=" . get_cookie("ae_company_id") . " and (v.cdate between '".$from."' and '".$to."') and v.vtype='Receipt' " . $srch ."  order by v.cdate");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>

          </center>';
          echo '<br>';

          echo '<table class="table table-striped table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Rec.Date</th>';
          echo '            <th>Salesman</th>';
          echo '            <th>Party Name</th>';
          echo '            <th>Entry Date</th>';
          echo '            <th>Amount</th>';
          echo '            <th>CD</th>';
          echo '            <th>Mode</th>';
          echo '            <th>Remark</th>';
          echo '            <th>Clear Date</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $total_freight='0';
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
              $total_freight=$total_freight+$row->tol_freight;
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '    <td>' . $row->salesman;
                echo '</td>';
                
                echo '    <td>' . $row->ledgername;
                echo '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->edate)) . '</td>'; 
                echo '    <td class="right">' . $row->tol_freight . '</td>'; 
                echo '    <td>' . $row->lessadv . '</td>'; 
                echo '    <td>' . $row->rname . '</td>'; 
                echo '    <td>' . $row->remark . '</td>';
                if($row->cleardate=="0000-00-00")
                {
                  echo '    <td> </td>'; 
                } 
                else
                {
                  echo '    <td>' . date('d-m-Y',strtotime($row->cleardate)) . '</td>'; 
                }
                echo '</tr>';

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan="4" style="font-weight:bold;color:#000000; text-align:right;">Total</td>';
            echo '<td class="right">'.number_format($total_freight,2).'</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////

    ///////////////////

    function drnote_report(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $srch="";
      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.edate,v.vtype,l.name ledgername,v.remark,v.tol_freight,v.cleardate,v.salesman,v.lessadv from tbl_trans1 v,m_ledger l where  v.ledger_id=l.id and v.company_id=" . get_cookie("ae_company_id") . " and (v.cdate between '".$from."' and '".$to."') and v.vtype='DrNote' " . $srch ."  order by v.cdate");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>

          </center>';
          echo '<br>';

          echo '<table class="table table-striped table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Entry Date</th>';
          echo '            <th>Party Name</th>';
          echo '            <th>Date</th>';
          echo '            <th>Amount</th>';
          echo '            <th>Remark</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $total_freight='0';
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
              $total_freight=$total_freight+$row->tol_freight;
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '</td>';
                
                echo '    <td>' . $row->ledgername;
                echo '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->edate)) . '</td>'; 
                echo '    <td class="right">' . $row->tol_freight . '</td>'; 
                echo '    <td>' . $row->remark . '</td>';
                echo '</tr>';

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan="3" style="font-weight:bold;color:#000000; text-align:right;">Total</td>';
            echo '<td class="right">'.number_format($total_freight,2).'</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////

    ///////////////////

    function crnote_report(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $srch="";
      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.edate,v.vtype,l.name ledgername,v.remark,v.tol_freight,v.cleardate,v.salesman,v.lessadv from tbl_trans1 v,m_ledger l where  v.ledger_id=l.id and v.company_id=" . get_cookie("ae_company_id") . " and (v.cdate between '".$from."' and '".$to."') and v.vtype='CrNote' " . $srch ."  order by v.cdate");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>

          </center>';
          echo '<br>';

          echo '<table class="table table-striped table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Entry Date</th>';
          echo '            <th>Party Name</th>';
          echo '            <th>Date</th>';
          echo '            <th>Amount</th>';
          echo '            <th>Remark</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $total_freight='0';
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
              $total_freight=$total_freight+$row->tol_freight;
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '</td>';
                
                echo '    <td>' . $row->ledgername;
                echo '</td>';
                echo '    <td>' . date('d-m-Y',strtotime($row->edate)) . '</td>'; 
                echo '    <td class="right">' . $row->tol_freight . '</td>'; 
                echo '    <td>' . $row->remark . '</td>';
                echo '</tr>';

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan="3" style="font-weight:bold;color:#000000; text-align:right;">Total</td>';
            echo '<td class="right">'.number_format($total_freight,2).'</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////

    function sales_category_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $master_category_id=$this->input->get('master_category_id');
      $srch="";
      if($master_category_id!=0)
      {
        $srch = " and m.parent_id=".$master_category_id;
      }
      if($ledger_id==0)
      {
        $query=$this->db->query("select m.id,m.name,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where t1.hide='no' and t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m.id) as saleamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m.id) as saleretamt 
                  from m_master m where m.type='ITEM CATEGORY' and m.company_id=" . get_cookie("ae_company_id")." ".$srch."  group by m.id,m.name order by m.name");
      }
      else
      {
        $query=$this->db->query("select m.id,m.name,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where t1.hide='no' and t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleretamt 
                  from m_master m where m.type='ITEM CATEGORY' and m.company_id=" . get_cookie("ae_company_id")." ".$srch." group by m.id,m.name order by m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
        if($master_category_id!=0)
        {
            echo '
      <button class="btn btn-primary" onClick ="GetRpt();">
            Back
          </button>';
            echo '<br>';
        }
          echo '<br>';
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
           <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Category</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          foreach($result as $row)
          {
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = $row->saleqty;
              $sale_amount = $row->saleamt;
              $sale_ret_qty = $row->saleretqty;
              $sale_ret_amount = $row->saleretamt;

              $net_qty = $sale_qty-$sale_ret_qty;
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);

              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }

    }
    ///////////////////    
    ///////////////////
    function sales_group_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $line_id=$this->input->get('line_id');
      $type=$this->input->get('type');
      if($line_id==0)
      {
        if($ledger_id==0)
        {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamt, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamt, 
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretamt ,
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamtret, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamtret 
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP' and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");

        }
        else
        {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamt, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamt, 
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamtret, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamtret 
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");
        }
      }
      else
      {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as saleqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as saleamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as lessamt, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as cdamt, 
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as saleretqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as saleretamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as lessamtret, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as cdamtret 
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Group</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.Rate</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          $t_lessamt=0;
          $t_cdamt=0;
          $t_lessamtret=0;
          $t_cdamtret=0;

          $g_sale_qty=0;
          $g_sale_amount=0;
          $g_sale_ret_qty=0;
          $g_sale_ret_amount=0;
          $g_net_qty=0;
          $g_net_amount=0;
          $g_lessamt=0;
          $g_cdamt=0;
          $g_lessamtret=0;
          $g_cdamtret=0;

          $mastercategory="";

          foreach($result as $row)
          {
              $avg_rate=0;
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = number_format($row->saleqty,0,'.','');
              $sale_amount = number_format($row->saleamt,2,'.','');
              $sale_ret_qty = number_format($row->saleretqty,0,'.','');
              $sale_ret_amount = number_format($row->saleretamt,2,'.','');
              $lessamt=number_format($row->lessamt,2,'.','');
              $cdamt=number_format($row->cdamt,2,'.','');
              $lessamtret=number_format($row->lessamtret,2,'.','');
              $cdamtret=number_format($row->cdamtret,2,'.','');

              $net_qty = number_format($sale_qty-$sale_ret_qty,0,'.','');
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);


              if($mastercategory<>$row->mastercategory && $net_qty!=0)
              {
                if($mastercategory<>"")
                {
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_net_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . number_format($g_net_amount,2) . '</td>';
                  echo '</tr>';
                  $g_sale_qty=0;
                  $g_sale_amount=0;
                  $g_sale_ret_qty=0;
                  $g_sale_ret_amount=0;
                  $g_net_qty=0;
                  $g_net_amount=0;
                  $g_lessamt=0;
                  $g_cdamt=0;
                  $g_lessamtret=0;
                  $g_cdamtret=0;

                }
                $mastercategory=$row->mastercategory;
                echo '<tr class="" style="font-weight:bold;background-color:#ffcccc;">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $mastercategory . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '</tr>';
              }



              if($sale_qty!=0)
              {
                $avg_rate=number_format(($row->saleamt+$row->lessamt+$row->cdamt)/$sale_qty,2);
              }
              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              $t_lessamt=$t_lessamt+$lessamt;
              $t_lessamtret=$t_lessamtret+$lessamtret;
              $t_cdamt=$t_cdamt+$cdamt;
              $t_cdamtret=$t_cdamtret+$cdamtret;



              $g_sale_qty=$g_sale_qty+$sale_qty;
              $g_sale_amount=$g_sale_amount+$sale_amount;
              $g_sale_ret_qty=$g_sale_ret_qty+$sale_ret_qty;
              $g_sale_ret_amount=$g_sale_ret_amount+$sale_ret_amount;
              $g_net_qty=$g_net_qty+$net_qty;
              $g_net_amount=$g_net_amount+($sale_amount-$sale_ret_amount);

              $g_lessamt=$g_lessamt+$lessamt;
              $g_lessamtret=$g_lessamtret+$lessamtret;
              $g_cdamt=$g_cdamt+$cdamt;
              $g_cdamtret=$g_cdamtret+$cdamtret;

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avg_rate . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_net_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . number_format($g_net_amount,2) . '</td>';
                  echo '</tr>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    

    ///////////////////
    function sales_group_wise_1(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $line_id=$this->input->get('line_id');
      $type=$this->input->get('type');
      if($line_id==0)
      {
        if($ledger_id==0)
        {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamt, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamt 
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP' and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");

        }
        else
        {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamt, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamt
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");
        }
      }
      else
      {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as saleqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as saleamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as lessamt, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as cdamt
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Group</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.Rate</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Gross Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.CD %</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_lessamt=0;
          $t_cdamt=0;
          $t_salecd=0;

          $g_sale_qty=0;
          $g_sale_amount=0;
          $g_lessamt=0;
          $g_cdamt=0;
          $g_salecd=0;

          $mastercategory="";


          foreach($result as $row)
          {
              $avg_rate=0;
              $sale_qty=0;
              $sale_amount=0;
              $sale_qty = number_format($row->saleqty,0,'.','');
              $sale_amount = number_format($row->saleamt,2,'.','');
              $lessamt=number_format($row->lessamt,2,'.','');
              $cdamt=number_format($row->cdamt,2,'.','');
              $salecd=$sale_amount+$cdamt+$lessamt;

              if($salecd!=0)
              {
                $avgcd = ($cdamt/$salecd*100);
                $avgcd = number_format($avgcd,2,".","");
              }
              else
              {
                $avgcd = 0;
              }


              if($mastercategory<>$row->mastercategory && $sale_qty!=0)
              {
                if($mastercategory<>"")
                {
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_salecd . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                  echo '</tr>';
                  $g_sale_qty=0;
                  $g_sale_amount=0;
                  $g_lessamt=0;
                  $g_cdamt=0;
                  $g_salecd=0;

                }
                $mastercategory=$row->mastercategory;
                echo '<tr class="" style="font-weight:bold;background-color:#ffcccc;">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $mastercategory . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '</tr>';
              }



              if($sale_qty!=0)
              {
                $avg_rate=number_format(($row->saleamt+$row->lessamt+$row->cdamt)/$sale_qty,2);
              }
              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;

              $t_lessamt=$t_lessamt+$lessamt;
              $t_cdamt=$t_cdamt+$cdamt;

              $t_salecd=$t_salecd+$salecd;


              $g_sale_qty=$g_sale_qty+$sale_qty;
              $g_sale_amount=$g_sale_amount+$sale_amount;

              $g_lessamt=$g_lessamt+$lessamt;
              $g_cdamt=$g_cdamt+$cdamt;

              $g_salecd=$g_salecd+$salecd;

              if($sale_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avg_rate . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $salecd . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avgcd . ' %</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_salecd . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                  echo '</tr>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_salecd . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function sales_group_wise_2(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $line_id=$this->input->get('line_id');
      $type=$this->input->get('type');
      if($line_id==0)
      {
        if($ledger_id==0)
        {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretamt ,
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamtret, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamtret 
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP' and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");

        }
        else
        {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamtret, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamtret 
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");
        }
      }
      else
      {
          $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                    (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l where t1.ledger_id=l.id and  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as saleretqty, 
                    (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l  where t1.ledger_id=l.id and t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as saleretamt, 
                    (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l  where t1.ledger_id=l.id and  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as lessamtret, 
                    (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_ledger l  where t1.ledger_id=l.id and  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and l.line_id=".$line_id." and i.group_id=m.id) as cdamtret 
                    from m_master m,m_item i,m_master c,m_master mc where i.group_id=m.id and i.category_id=c.id and c.parent_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." and c.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name order by mc.name,m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Group</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.Rate</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Gross Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.CD %</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_lessamtret=0;
          $t_cdamtret=0;
          $t_salecd=0;

          $g_sale_ret_qty=0;
          $g_sale_ret_amount=0;
          $g_lessamtret=0;
          $g_cdamtret=0;
          $g_salecd=0;

          $mastercategory="";

          foreach($result as $row)
          {
              $avg_rate=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $sale_ret_qty = number_format($row->saleretqty,0,'.','');
              $sale_ret_amount = number_format($row->saleretamt,2,'.','');
              $lessamtret=number_format($row->lessamtret,2,'.','');
              $cdamtret=number_format($row->cdamtret,2,'.','');
              $salecd=$sale_ret_amount+$cdamtret+$lessamtret;

              if($salecd!=0)
              {
                $avgcd = ($cdamtret/$salecd*100);
                $avgcd = number_format($avgcd,2,".","");
              }
              else
              {
                $avgcd = 0;
              }

              if($mastercategory<>$row->mastercategory && $sale_ret_qty!=0)
              {
                if($mastercategory<>"")
                {
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_salecd . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                  echo '</tr>';
                  $g_sale_ret_qty=0;
                  $g_sale_ret_amount=0;
                  $g_lessamtret=0;
                  $g_cdamtret=0;
                  $g_salecd=0;

                }
                $mastercategory=$row->mastercategory;
                echo '<tr class="" style="font-weight:bold;background-color:#ffcccc;">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $mastercategory . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '</tr>';
              }



              if($sale_ret_qty!=0)
              {
                $avg_rate=number_format(($row->saleretamt+$row->lessamtret+$row->cdamtret)/$sale_ret_qty,2);
              }
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;

              $t_lessamtret=$t_lessamtret+$lessamtret;
              $t_cdamtret=$t_cdamtret+$cdamtret;

              $t_salecd=$t_salecd+$salecd;


              $g_sale_ret_qty=$g_sale_ret_qty+$sale_ret_qty;
              $g_sale_ret_amount=$g_sale_ret_amount+$sale_ret_amount;

              $g_lessamtret=$g_lessamtret+$lessamtret;
              $g_cdamtret=$g_cdamtret+$cdamtret;

              $g_salecd=$g_salecd+$salecd;

              if($sale_ret_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avg_rate . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $salecd . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avgcd . ' %</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_salecd . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                  echo '</tr>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_salecd . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    

    ///////////////////
    function sales_brand_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $state_id=$this->input->get('state_id');
      $type=$this->input->get('type');
      if($ledger_id==0)
      {
        $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,mcc.name as masterc,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamt, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretamt ,
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamtret, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamtret 
                  from m_master m,m_item i,m_master mc,m_master mcc,m_master gr where i.group_id=m.id and i.category_id=gr.id and gr.parent_id=mcc.id and i.itemcompany_id=mc.id and m.type='ITEM GROUP' and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")."   group by m.id,m.name,mc.name,mcc.name order by mc.name,mcc.name,m.name");

      }
      else
      {
        $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,mcc.name as masterc,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamt, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamtret, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamtret 
                  from m_master m,m_item i,m_master mc,m_master mcc,m_master gr  where i.group_id=m.id and i.category_id=gr.id and gr.parent_id=mcc.id  and i.itemcompany_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." group by m.id,m.name,mc.name,mcc.name order by mc.name,mcc.name,m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Brand/Category</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Group</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.Rate</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          $t_lessamt=0;
          $t_cdamt=0;
          $t_lessamtret=0;
          $t_cdamtret=0;

          $g_sale_qty=0;
          $g_sale_amount=0;
          $g_sale_ret_qty=0;
          $g_sale_ret_amount=0;
          $g_net_qty=0;
          $g_net_amount=0;
          $g_lessamt=0;
          $g_cdamt=0;
          $g_lessamtret=0;
          $g_cdamtret=0;

          $mastercategory="";

          foreach($result as $row)
          {
              $avg_rate=0;
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = number_format($row->saleqty,0,'.','');
              $sale_amount = number_format($row->saleamt,2,'.','');
              $sale_ret_qty = number_format($row->saleretqty,0,'.','');
              $sale_ret_amount = number_format($row->saleretamt,2,'.','');
              $lessamt=number_format($row->lessamt,2,'.','');
              $cdamt=number_format($row->cdamt,2,'.','');
              $lessamtret=number_format($row->lessamtret,2,'.','');
              $cdamtret=number_format($row->cdamtret,2,'.','');

              $net_qty = number_format($sale_qty-$sale_ret_qty,0,'.','');
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);


              if($mastercategory<>$row->mastercategory && $net_qty!=0)
              {
                if($mastercategory<>"")
                {
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_net_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . number_format($g_net_amount,2) . '</td>';
                  echo '</tr>';
                  $g_sale_qty=0;
                  $g_sale_amount=0;
                  $g_sale_ret_qty=0;
                  $g_sale_ret_amount=0;
                  $g_net_qty=0;
                  $g_net_amount=0;
                  $g_lessamt=0;
                  $g_cdamt=0;
                  $g_lessamtret=0;
                  $g_cdamtret=0;

                }
                $mastercategory=$row->mastercategory;
                echo '<tr class="" style="font-weight:bold;background-color:#ffcccc;">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $mastercategory . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '</tr>';
              }



              if($sale_qty!=0)
              {
                $avg_rate=number_format(($row->saleamt+$row->lessamt+$row->cdamt)/$sale_qty,2);
              }
              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              $t_lessamt=$t_lessamt+$lessamt;
              $t_lessamtret=$t_lessamtret+$lessamtret;
              $t_cdamt=$t_cdamt+$cdamt;
              $t_cdamtret=$t_cdamtret+$cdamtret;



              $g_sale_qty=$g_sale_qty+$sale_qty;
              $g_sale_amount=$g_sale_amount+$sale_amount;
              $g_sale_ret_qty=$g_sale_ret_qty+$sale_ret_qty;
              $g_sale_ret_amount=$g_sale_ret_amount+$sale_ret_amount;
              $g_net_qty=$g_net_qty+$net_qty;
              $g_net_amount=$g_net_amount+($sale_amount-$sale_ret_amount);

              $g_lessamt=$g_lessamt+$lessamt;
              $g_lessamtret=$g_lessamtret+$lessamtret;
              $g_cdamt=$g_cdamt+$cdamt;
              $g_cdamtret=$g_cdamtret+$cdamtret;

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->masterc . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avg_rate . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_net_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . number_format($g_net_amount,2) . '</td>';
                  echo '</tr>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function sales_brand_wise_1(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $type=$this->input->get('type');
      if($ledger_id==0)
      {

        $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,mcc.name as masterc,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamt, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamt 
                  from m_master m,m_item i,m_master mc,m_master mcc,m_master gr where i.group_id=m.id and i.category_id=gr.id and gr.parent_id=mcc.id and i.itemcompany_id=mc.id and m.type='ITEM GROUP' and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")."   group by m.id,m.name,mc.name,mcc.name order by mc.name,mcc.name,m.name");
      }
      else
      {
        $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,mcc.name as masterc,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamt, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamt
                  from m_master m,m_item i,m_master mc,m_master mcc,m_master gr where i.group_id=m.id and i.category_id=gr.id and gr.parent_id=mcc.id and i.itemcompany_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." group by m.id,m.name,mc.name,mcc.name order by mc.name,mcc.name,m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Brand/Category</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Group</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.Rate</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Gross Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.CD %</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_lessamt=0;
          $t_cdamt=0;
          $t_salecd=0;

          $g_sale_qty=0;
          $g_sale_amount=0;
          $g_lessamt=0;
          $g_cdamt=0;
          $g_salecd=0;

          $mastercategory="";


          foreach($result as $row)
          {
              $avg_rate=0;
              $sale_qty=0;
              $sale_amount=0;
              $sale_qty = number_format($row->saleqty,0,'.','');
              $sale_amount = number_format($row->saleamt,2,'.','');
              $lessamt=number_format($row->lessamt,2,'.','');
              $cdamt=number_format($row->cdamt,2,'.','');
              $salecd=$sale_amount+$cdamt+$lessamt;

              if($salecd!=0)
              {
                $avgcd = ($cdamt/$salecd*100);
                $avgcd = number_format($avgcd,2,".","");
              }
              else
              {
                $avgcd = 0;
              }


              if($mastercategory<>$row->mastercategory && $sale_qty!=0)
              {
                if($mastercategory<>"")
                {
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_salecd . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                  echo '</tr>';
                  $g_sale_qty=0;
                  $g_sale_amount=0;
                  $g_lessamt=0;
                  $g_cdamt=0;
                  $g_salecd=0;

                }
                $mastercategory=$row->mastercategory;
                echo '<tr class="" style="font-weight:bold;background-color:#ffcccc;">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $mastercategory . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '</tr>';
              }



              if($sale_qty!=0)
              {
                $avg_rate=number_format(($row->saleamt+$row->lessamt+$row->cdamt)/$sale_qty,2);
              }
              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;

              $t_lessamt=$t_lessamt+$lessamt;
              $t_cdamt=$t_cdamt+$cdamt;

              $t_salecd=$t_salecd+$salecd;


              $g_sale_qty=$g_sale_qty+$sale_qty;
              $g_sale_amount=$g_sale_amount+$sale_amount;

              $g_lessamt=$g_lessamt+$lessamt;
              $g_cdamt=$g_cdamt+$cdamt;

              $g_salecd=$g_salecd+$salecd;

              if($sale_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->masterc . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avg_rate . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $salecd . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avgcd . ' %</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamt . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_salecd . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                  echo '</tr>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_salecd . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function sales_brand_wise_2(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $type=$this->input->get('type');


      if($ledger_id==0)
      {
        $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,mcc.name as masterc,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretamt ,
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamtret, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamtret 
                  from m_master m,m_item i,m_master mc,m_master mcc,m_master gr where i.group_id=m.id and i.category_id=gr.id and gr.parent_id=mcc.id and  i.itemcompany_id=mc.id and m.type='ITEM GROUP' and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name,mc.name,mcc.name order by mc.name,mcc.name,m.name");

      }
      else
      {
        $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,mcc.name as masterc,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamtret, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamtret 
                  from m_master m,m_item i,m_master mc,m_master mcc,m_master gr where i.group_id=m.id and i.category_id=gr.id and gr.parent_id=mcc.id and i.itemcompany_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")." group by m.id,m.name,mc.name,mcc.name order by mc.name,mcc.name,m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Brand/Category</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Group</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.Rate</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Gross Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.CD %</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_lessamtret=0;
          $t_cdamtret=0;
          $t_salecd=0;

          $g_sale_ret_qty=0;
          $g_sale_ret_amount=0;
          $g_lessamtret=0;
          $g_cdamtret=0;
          $g_salecd=0;

          $mastercategory="";

          foreach($result as $row)
          {
              $avg_rate=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $sale_ret_qty = number_format($row->saleretqty,0,'.','');
              $sale_ret_amount = number_format($row->saleretamt,2,'.','');
              $lessamtret=number_format($row->lessamtret,2,'.','');
              $cdamtret=number_format($row->cdamtret,2,'.','');
              $salecd=$sale_ret_amount+$cdamtret+$lessamtret;

              if($salecd!=0)
              {
                $avgcd = ($cdamtret/$salecd*100);
                $avgcd = number_format($avgcd,2,".","");
              }
              else
              {
                $avgcd = 0;
              }

              if($mastercategory<>$row->mastercategory && $sale_ret_qty!=0)
              {
                if($mastercategory<>"")
                {
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_salecd . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                  echo '</tr>';
                  $g_sale_ret_qty=0;
                  $g_sale_ret_amount=0;
                  $g_lessamtret=0;
                  $g_cdamtret=0;
                  $g_salecd=0;

                }
                $mastercategory=$row->mastercategory;
                echo '<tr class="" style="font-weight:bold;background-color:#ffcccc;">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $mastercategory . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '</tr>';
              }



              if($sale_ret_qty!=0)
              {
                $avg_rate=number_format(($row->saleretamt+$row->lessamtret+$row->cdamtret)/$sale_ret_qty,2);
              }
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;

              $t_lessamtret=$t_lessamtret+$lessamtret;
              $t_cdamtret=$t_cdamtret+$cdamtret;

              $t_salecd=$t_salecd+$salecd;


              $g_sale_ret_qty=$g_sale_ret_qty+$sale_ret_qty;
              $g_sale_ret_amount=$g_sale_ret_amount+$sale_ret_amount;

              $g_lessamtret=$g_lessamtret+$lessamtret;
              $g_cdamtret=$g_cdamtret+$cdamtret;

              $g_salecd=$g_salecd+$salecd;

              if($sale_ret_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->masterc . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avg_rate . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $salecd . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avgcd . ' %</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_salecd . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                  echo '</tr>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_salecd . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    

    ///////////////////
    function value_wise_sales(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');

      $masterids = array();
      $masternames = array();
      $query=$this->db->query('select m.id,m.name from m_master m,m_master c,m_item i,tbl_trans2 t2,tbl_trans1 t1 where t1.id=t2.billno and t2.itemcode=i.id and i.category_id=c.id and c.parent_id=m.id and m.type="MASTER CATEGORY"  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") group by m.name,m.id order by m.name'); 
      if($query->num_rows()>0){
       foreach($query->result() as $row){
          $masterids[]=$row->id;
          $masternames[]=$row->name;
       }
      }

      if($ledger_id==0)
      {
        $query=$this->db->query("select l.id,l.name
                  from m_ledger l where l.company_id=".get_cookie("ae_company_id")."  group by l.id,l.name order by l.name");

      }
      else
      {
        $query=$this->db->query("select l.id,l.name
                  from m_ledger l where l.id=".$ledger_id." and l.company_id=".get_cookie("ae_company_id")."  group by l.id,l.name order by l.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Name of Customer</th>';
          foreach($masternames as $mastername)
          {
            echo '            <th style="border:1px solid black;padding:5px;">'.$mastername.'</th>';
          }
          echo '            <th style="border:1px solid black;padding:5px;">Grand Total</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          $grand_total=0;
          foreach($result as $row)
          {
                $grand_total=0;

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                foreach($masterids as $masterid)
                {
                 $freight=0;
                 $query1=$this->db->query('select sum(t2.freight) as freight from tbl_trans2 t2, tbl_trans1 t1, m_item i,m_master c where t1.id=t2.billno and t2.itemcode=i.id and i.category_id=c.id and c.parent_id='.$masterid.'  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") and t1.ledger_id='.$row->id .' and t1.vtype="sales"'); 
                 if($query1->num_rows()>0){
                   foreach($query1->result() as $row1){
                    $freight=$row1->freight;
                    $grand_total=$grand_total+$freight;
                   }
                  }

                 $query1=$this->db->query('select sum(t2.freight) as freight from tbl_trans2 t2, tbl_trans1 t1, m_item i,m_master c where t1.id=t2.billno and t2.itemcode=i.id and i.category_id=c.id and c.parent_id='.$masterid.'  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") and t1.ledger_id='.$row->id .' and t1.vtype="sales return"'); 
                 if($query1->num_rows()>0){
                   foreach($query1->result() as $row1){
                    $freight=$freight-$row1->freight;
                    $grand_total=$grand_total-$row1->freight;
                   }
                  }
                 echo ' <td style="border:1px solid black;padding:5px;">'  . $freight.'</td>';
                }
                echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($grand_total,2,'.','').'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function qty_item_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $cat_id=$this->input->get('cat_id');

      $masterids = array();
      $masternames = array();
      $query=$this->db->query('select i.id,i.name from m_master m,m_master c,m_item i,tbl_trans2 t2,tbl_trans1 t1 where t1.id=t2.billno and t2.itemcode=i.id and i.category_id=c.id and c.parent_id=m.id and m.id='.$cat_id.' and  m.type="MASTER CATEGORY"  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") group by i.name,i.id order by i.name'); 
      if($query->num_rows()>0){
       foreach($query->result() as $row){
          $masterids[]=$row->id;
          $masternames[]=$row->name;
       }
      }

      if($ledger_id==0)
      {
        $query=$this->db->query("select l.id,l.name
                  from m_ledger l where l.company_id=".get_cookie("ae_company_id")."  group by l.id,l.name order by l.name");

      }
      else
      {
        $query=$this->db->query("select l.id,l.name
                  from m_ledger l where l.id=".$ledger_id." and l.company_id=".get_cookie("ae_company_id")."  group by l.id,l.name order by l.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Name of Customer</th>';
          foreach($masternames as $mastername)
          {
            echo '            <th style="border:1px solid black;padding:5px;">'.$mastername.'</th>';
          }
          echo '            <th style="border:1px solid black;padding:5px;">Grand Total</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          $grand_total=0;
          foreach($result as $row)
          {
                $grand_total=0;

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                foreach($masterids as $masterid)
                {
                 $freight=0;
                 $query1=$this->db->query('select sum(t2.freight) as freight from tbl_trans2 t2, tbl_trans1 t1, m_item i where t1.id=t2.billno and t2.itemcode=i.id and i.id='.$masterid.'  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") and t1.ledger_id='.$row->id .' and t1.vtype="sales"'); 
                 if($query1->num_rows()>0){
                   foreach($query1->result() as $row1){
                    $freight=$row1->freight;
                    $grand_total=$grand_total+$freight;
                   }
                  }

                 $query1=$this->db->query('select sum(t2.freight) as freight from tbl_trans2 t2, tbl_trans1 t1, m_item i where t1.id=t2.billno and t2.itemcode=i.id and i.id='.$masterid.'  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") and t1.ledger_id='.$row->id .' and t1.vtype="sales return"'); 
                 if($query1->num_rows()>0){
                   foreach($query1->result() as $row1){
                    $freight=$freight-$row1->freight;
                    $grand_total=$grand_total-$row1->freight;
                   }
                  }
                 echo ' <td style="border:1px solid black;padding:5px;">'  . $freight.'</td>';
                }
                echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($grand_total,2,'.','').'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function group_wise_sale_summary(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $cat_id=$this->input->get('cat_id');

      $masterids = array();
      $masternames = array();
      $query=$this->db->query('select c.id,c.name from m_master c,m_item i,tbl_trans2 t2,tbl_trans1 t1 where t1.id=t2.billno and t2.itemcode=i.id and c.parent_id='.$cat_id.' and i.category_id=c.id and c.type="ITEM CATEGORY"  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") group by c.name,c.id order by c.name'); 
      if($query->num_rows()>0){
       foreach($query->result() as $row){
          $masterids[]=$row->id;
          $masternames[]=$row->name;
       }
      }

      if($ledger_id==0)
      {
        $query=$this->db->query("select l.id,l.name
                  from m_ledger l where l.company_id=".get_cookie("ae_company_id")."  group by l.id,l.name order by l.name");

      }
      else
      {
        $query=$this->db->query("select l.id,l.name
                  from m_ledger l where l.id=".$ledger_id." and l.company_id=".get_cookie("ae_company_id")."  group by l.id,l.name order by l.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Name of Customer</th>';
          foreach($masternames as $mastername)
          {
            echo '            <th style="border:1px solid black;padding:5px;">'.$mastername.'</th>';
          }
          echo '            <th style="border:1px solid black;padding:5px;">Grand Total</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          $grand_total=0;
          foreach($result as $row)
          {
                $grand_total=0;

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                foreach($masterids as $masterid)
                {
                 $freight=0;
                 $query1=$this->db->query('select sum(t2.freight) as freight from tbl_trans2 t2, tbl_trans1 t1, m_item i,m_master c where t1.id=t2.billno and t2.itemcode=i.id and i.category_id=c.id and c.id='.$masterid.'  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") and t1.ledger_id='.$row->id .' and t1.vtype="sales"'); 
                 if($query1->num_rows()>0){
                   foreach($query1->result() as $row1){
                    $freight=$row1->freight;
                    $grand_total=$grand_total+$freight;
                   }
                  }

                 $query1=$this->db->query('select sum(t2.freight) as freight from tbl_trans2 t2, tbl_trans1 t1, m_item i,m_master c where t1.id=t2.billno and t2.itemcode=i.id and i.category_id=c.id and c.id='.$masterid.'  and t1.company_id='. get_cookie('ae_company_id') .' and (t1.cdate between "'.$from.'" and "'.$to.'") and t1.ledger_id='.$row->id .' and t1.vtype="sales return"'); 
                 if($query1->num_rows()>0){
                   foreach($query1->result() as $row1){
                    $freight=$freight-$row1->freight;
                    $grand_total=$grand_total-$row1->freight;
                   }
                  }
                 echo ' <td style="border:1px solid black;padding:5px;">'  . $freight.'</td>';
                }
                echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($grand_total,2,'.','').'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function sales_item_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $item_id=$this->input->get('item_id');
      $ledger_id=$this->input->get('ledger_id');


      if($ledger_id==0)
      {
        $query=$this->db->query("select m.id,m.name,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and i.id=".$item_id." and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and  i.id=".$item_id." and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=m.id) as saleamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and  i.id=".$item_id." and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=m.id) as lessamt, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and  i.id=".$item_id." and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=m.id) as cdamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and  i.id=".$item_id." and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and  i.id=".$item_id." and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=m.id) as saleretamt 
                  from m_ledger m where m.company_id=" . get_cookie("ae_company_id")."  group by m.id,m.name  order by m.name");

      }
      else
      {
        $query=$this->db->query("select m.id,m.name,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.id=".$item_id." and t1.ledger_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.id=".$item_id." and t1.ledger_id=m.id) as saleamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.id=".$item_id." and t1.ledger_id=m.id) as lessamt, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.id=".$item_id." and t1.ledger_id=m.id) as cdamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.id=".$item_id." and t1.ledger_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.id=".$item_id." and t1.ledger_id=m.id) as saleretamt 
                  from m_ledger m where m.id=".$ledger_id." and m.company_id=" . get_cookie("ae_company_id")." group by m.id,m.name order by m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Ledger Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          $t_lessamt=0;
          $t_cdamt=0;
          foreach($result as $row)
          {
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = $row->saleqty;
              $sale_amount = $row->saleamt;
              $sale_ret_qty = $row->saleretqty;
              $sale_ret_amount = $row->saleretamt;
              $lessamt=number_format($row->lessamt,2);
              $cdamt=number_format($row->cdamt,2);

              $net_qty = $sale_qty-$sale_ret_qty;
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);

              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              $t_lessamt=$t_lessamt+$lessamt;
              $t_cdamt=$t_cdamt+$cdamt;

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamt . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////   
    ///////////////////
    function sales_item_ledger(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $group_id=$this->input->get('group_id');
      $ledger_id=$this->input->get('ledger_id');

      echo '<center><button class="btn btn-primary" onClick ="exportExcel();">
      <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
    </button>
              </center>';

      echo '<table id="TblList" class="" style="width:1180px;">';
      echo '    <thead>';
      echo '        <tr>';
//      echo '            <th colspan="14" class="tb_col">Ledger : '.$ledgername.'<br>From : '.date('d-m-Y',strtotime($from)).' To : '.date('d-m-Y',strtotime($to)).' </th>';
      echo '        </tr>';
      echo '        <tr>';
      echo '            <th class="tb_col" style="width:50px;">Date</th>';
      echo '            <th class="tb_col" style="width:50px;">No.</th>';
      echo '            <th class="tb_col" style="width:80px;">Type</th>';
      echo '            <th class="tb_col" style="width:230px;">Item</th>';
      echo '            <th class="tb_col" style="width:80px;">Qty</th>';
      echo '            <th class="tb_col" style="width:50px;">Rate</th>';
      echo '            <th class="tb_col" style="width:50px;">Disc.</th>';
      echo '            <th class="tb_col" style="width:80px;">Amount</th>';
      echo '            <th class="tb_col" style="width:50px;">Freight</th>';
      echo '            <th class="tb_col" style="width:50px;">&nbsp;</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;
      $fr=0;
      $tqty=0;
      $trgqty=0;
      $tfreight=0;
      $tlr_freight=0;
      $bill_amt=0;

      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.tol_freight,v.vamount as amount,v.lr_freight,l.name ledgername,v.remark,v.lessadv,v.lr_no,v.transport from tbl_trans1 v, m_ledger l,tbl_trans2 t2,m_item i where  v.ledger_id=l.id and v.id=t2.billno and t2.itemcode=i.id and i.group_id=".$group_id." and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$ledger_id.' and v.hide="no" group by v.id,v.builtyno,v.cdate,v.vtype,v.tol_freight,v.vamount,v.lr_freight,l.name,v.remark,v.lessadv,v.lr_no,v.transport order by v.cdate,v.id');
      $result=$query->result();


      if(count($result)>0)
      {

          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                $dt = $row->cdate;
                $showdt=date('d-m-Y',strtotime($row->cdate));
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }                
                else
                {
                  echo '<tr class="" style="background-color:#F2F2F2;">';
                }
                echo '    <td class="tb_col">' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="RG Sale";
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $parti="Payment";
                }
                echo '    <td class="tb_col">' . $row->builtyno."";
                echo '</td>';

                echo '    <td class="tb_col">' . $parti;
                echo '</td>';

                echo '    <td class="tb_col">';
                  echo "<span style='font-weight:bold;'>" . $row->remark . "</span>";
                 if($row->lr_no!='')
                {
                  echo "<span style='font-weight:bold;margin-left:20px;'>LR: " . $row->lr_no . " TR:" . $row->transport. "</span>";
                }  
                echo '</td>';

                echo '    <td class="tb_col"></td>';
                echo '    <td class="tb_col">&nbsp;</td>';
                echo '    <td class="tb_col">&nbsp;</td>';
                echo '    <td class="tb_col">&nbsp;</td>';
                echo '    <td class="tb_col">&nbsp;</td>';
                
                $lr_freight_amount=$row->lr_freight;
                if($lr_freight_amount=="")
                {
                  $lr_freight_amount=0;
                }

                if($row->vtype=="sales" || $row->vtype=="purchase")
                {
                  $tlr_freight=$tlr_freight+$lr_freight_amount;
                  $bill_amt=$bill_amt+$lr_freight_amount;
                }
                if($row->vtype=="sales return" || $row->vtype=="purchase return")
                {
                  $bill_amt=$bill_amt+$lr_freight_amount;
                }
                $amount = $row->amount*-1;
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $amount = ($row->amount+$row->lessadv)*-1;
                }


                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $bill_amt=$bill_amt+$amount;
                  $bill_amt=$bill_amt-$row->lessadv;
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $bill_amt=$bill_amt-$amount;
                }

                echo '    <td class="tb_col">' . $row->lr_freight.'</td>';

                echo '<td class="tb_col">';
                if(strtoupper($row->vtype)=="SALES")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->id .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                }
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("'.$row->vtype.'","'. $row->builtyno .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                }
                if(strtoupper($row->vtype)=="SALES RETURN")
                {
                  echo '        <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick=GetRecord("RGSale","'. $row->id .'");return false;>';
                  echo '          <i class="ace-icon fa fa-pencil bigger-120"></i>';
                  echo '        </button>';
                }
                echo '</td>';
                echo '</tr>';


                if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight=0;
                   $discount=0;
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and i.group_id=".$group_id." and t2.billno=".$row->id." order by t2.id limit 0,1000");
                    $result1=$query1->result();
                    if($query1->num_rows()>0)
                    {
                      foreach($result1 as $row1)
                      {
                         $party_name=$row1->itemname;
                         $qty=$row1->qtymt;
                         $rate=$row1->rate;
                         $freight=$row1->freight;
                         $discount="";
                         if($row->vtype=="sales" || $row->vtype=="purchase")
                         {
                             $tqty=$tqty+$qty;
                             $tfreight=$tfreight+$freight;
                         }
                         if($row->vtype=="sales return" || $row->vtype=="purchase return")
                         {
                             $trgqty=$trgqty+$qty;
//                             $tfreight=$tfreight-$freight;
                        }
                         if($row1->percent<>0)
                         {
                           $discount=$discount.$row1->percent."% ";
                         }
                         if($row1->discount<>0)
                         {
                            if($discount=="")
                            {
                               $discount=$discount.$row1->discount." ";
                            }
                            else {
                               $discount=$discount." + " .$row1->discount." ";
                            }
                         }

                        if($rate==0)
                        {
                          echo '<tr class="" style="background-color:#ffcccc;">';
                        }                
                        else
                        {
                          echo '<tr class="" style="">';
                        }
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">' . $party_name.'</td>';
                        echo '    <td class="tb_col">' . number_format($qty,0).'</td>';
                        echo '    <td class="tb_col">' . number_format($rate,2).'</td>';
                        echo '    <td class="tb_col">' . $discount.'</td>';
                        echo '    <td class="tb_col">' . $freight.'</td>';

                        if($row->vtype=="sales" || $row->vtype=="purchase")
                        {
                          $bill_amt=$bill_amt+$freight;
                        }
                        if($row->vtype=="sales return" || $row->vtype=="purchase return")
                        {
                          $bill_amt=$bill_amt-$freight;
                        }

                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '</tr>';

                      }
                    
                    }
                }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td  class="tb_col" colspan=3>&nbsp;</td>';
            echo '<td  class="tb_col" style="font-weight:bold;color:#000000;">Total</td>';
                        echo '<td class="tb_col">'.$tqty.' / '.$trgqty.'</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col">'.number_format($tfreight,2).'</td>';
                        echo '<td class="tb_col">'.number_format($tlr_freight,2).'</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
            echo '<td  class="tb_col">&nbsp;</td>';
            echo '</tr>';

          echo '</tfoot>';
          echo '</table>';
      }
          echo '<br>';
    }

    ///////////////////  

         ///////////////////
    function sales_mastercategory_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      if($ledger_id==0)
      {
        $query=$this->db->query("select m.id,m.name,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m1.id and m1.parent_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m1.id and m1.parent_id=m.id) as saleamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m1.id and m1.parent_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where   t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to')  and i.category_id=m1.id and m1.parent_id=m.id) as saleretamt 
                  from m_master m where m.type='MASTER CATEGORY' and m.company_id=" . get_cookie("ae_company_id")." group by m.id,m.name order by m.name");
      }
      else
      {
        $query=$this->db->query("select m.id,m.name,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m1.id and m1.parent_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m1.id and m1.parent_id=m.id) as saleamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m1.id and m1.parent_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where   t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m1.id and m1.parent_id=m.id) as saleretamt 
                  from m_master m where m.type='MASTER CATEGORY' and m.company_id=" . get_cookie("ae_company_id")." group by m.id,m.name order by m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center><button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Category</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          foreach($result as $row)
          {
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = $row->saleqty;
              $sale_amount = $row->saleamt;
              $sale_ret_qty = $row->saleretqty;
              $sale_ret_amount = $row->saleretamt;

              $net_qty = $sale_qty-$sale_ret_qty;
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);

              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;" onclick="GetRptCategory('.$row->id.');">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    

    ///////////////////
    function purchase_category_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $query=$this->db->query("select m.id,m.name,
                (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='purchase' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleqty, 
                (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='purchase' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleamt, 
                (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='purchase return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleretqty, 
                (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='purchase return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleretamt 
                from m_master m where m.type='ITEM CATEGORY' group by m.id,m.name order by m.name");
      $result=$query->result();

      if(count($result)>0)
      {
        echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
          <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
          </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Category</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Purchase Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Purchase Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          foreach($result as $row)
          {
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = $row->saleqty;
              $sale_amount = $row->saleamt;
              $sale_ret_qty = $row->saleretqty;
              $sale_ret_amount = $row->saleretamt;

              $net_qty = $sale_qty-$sale_ret_qty;
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);

              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function purchase_group_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $query=$this->db->query("select m.id,m.name,
                (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='purchase' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleqty, 
                (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='purchase' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleamt, 
                (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='purchase return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretqty, 
                (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='purchase return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretamt 
                from m_master m where m.type='ITEM GROUP' group by m.id,m.name order by m.name");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
          <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
          </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Group</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Purchase Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Purchase Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          foreach($result as $row)
          {
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = $row->saleqty;
              $sale_amount = $row->saleamt;
              $sale_ret_qty = $row->saleretqty;
              $sale_ret_amount = $row->saleretamt;

              $net_qty = $sale_qty-$sale_ret_qty;
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);

              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function purchase_mastercategory_wise(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $ledger_id=$this->input->get('ledger_id');
      $query=$this->db->query("select m.id,m.name,
                (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and  t1.vtype='purchase' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m1.id and m1.parent_id=m.id) as saleqty, 
                (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and  t1.vtype='purchase' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m1.id and m1.parent_id=m.id) as saleamt, 
                (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and  t1.vtype='purchase return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m1.id and m1.parent_id=m.id) as saleretqty, 
                (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i,m_master m1 where  t1.hide='no' and   t1.vtype='purchase return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m1.id and m1.parent_id=m.id) as saleretamt 
                from m_master m where m.type='MASTER CATEGORY' group by m.id,m.name order by m.name");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
            <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
            <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Category</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Purchase Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Purchase Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          foreach($result as $row)
          {
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = $row->saleqty;
              $sale_amount = $row->saleamt;
              $sale_ret_qty = $row->saleretqty;
              $sale_ret_amount = $row->saleretamt;

              $net_qty = $sale_qty-$sale_ret_qty;
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);

              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    

    function daily_hideselected(){
      $checkbox=$this->input->post('checkbox');
      $from=$this->input->post('from');
      $from = date('Y-m-d',strtotime($from));

      $ids = explode(",", $checkbox);
      foreach($ids as $id) {
        $updata=array(
          'billstatus'=>'clear'
          );
        $this->db->where('id',$id);
        $this->db->update('tbl_trans1',$updata);
      }

      $billno=1;
      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate="'.$from.'") and v.vtype="sales" and v.billstatus="pending" order by v.id');
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
            echo $row->id;
            $updata=array(
              'builtyno'=>$billno
              );
            $this->db->where('id',$row->id);
            $this->db->update('tbl_trans1',$updata);
            $billno++;
          }
      }


      echo "1";
    }
/////////////////////////////

    ///////////////////
    function voucher_delete($id){
      $this->db->where('id',$id);
      $this->db->delete('tbl_trans1');

      $this->db->where('billno',$id);
      $this->db->delete('tbl_trans2');

      echo "1";
    }

    function order_delete($id){
      
      $tableName3='tbl_order_bal';
      $zipped_b = $this->db->query("select a.itemcode,a.qtymt,b.ledger_id from tbl_order2 a inner join tbl_order1 b  on a.billno=b.id where a.billno=".$id);
      foreach($zipped_b->result() as $tuple_b) 
      {             
                  $where=array(
                                "ledger_id"=>$tuple_b->ledger_id,
                                "item_id"=>$tuple_b->itemcode,
                                "company_id"=>get_cookie('ae_company_id')
                              );
                  $this->db->where($where);
                  $q=$this->db->get($tableName3);
                  if($q->num_rows()>0)
                  {
                      $oldata=$q->result();
                      $old_bal=$oldata[0]->bal;
                      $old_id=$oldata[0]->id;
                      $oldbal=$old_bal-$tuple_b->qtymt;
                      if($oldbal<0)
                      {
                        $oldbal=0;
                      }
                      $where1=array(
                                "id"=>$old_id
                              );
                      $data_b=array(
                          "bal"=>$oldbal
                      );
                      $this->db->where($where1);
                      $this->db->update($tableName3,$data_b);                  
                  }
      }

      $this->db->where('id',$id);
      $this->db->delete('tbl_order1');

      $this->db->where('billno',$id);
      $this->db->delete('tbl_order2');

      echo "1";
    }

    function chalan_delete($id){
      
      $tableName3='tbl_order_bal';
      $zipped_b = $this->db->query("select a.itemcode,a.qtymt,b.ledger_id from tbl_trans2 a inner join tbl_trans1 b on a.billno=b.id where a.billno=".$id);
      foreach($zipped_b->result() as $tuple_b) 
      {             
                  $where=array(
                                "ledger_id"=>$tuple_b->ledger_id,
                                "item_id"=>$tuple_b->itemcode,
                                "company_id"=>get_cookie('ae_company_id')
                              );
                  $this->db->where($where);
                  $q=$this->db->get($tableName3);
                  if($q->num_rows()>0)
                  {
                      $oldata=$q->result();
                      $old_bal=$oldata[0]->bal;
                      $old_id=$oldata[0]->id;
                      $oldbal=$old_bal+$tuple_b->qtymt;

                      $where1=array(
                                "id"=>$old_id
                              );
                      if($oldbal>0)
                      {
                        $data_b=array(
                            "bal"=>$oldbal
                        );
                      }
                      else
                      {
                        $data_b=array(
                            "bal"=>'0'
                        );
                      }
                      $this->db->where($where1);
                      $this->db->update($tableName3,$data_b);                  
                  }
            }

      $this->db->where('id',$id);
      $this->db->delete('tbl_trans1');

      $this->db->where('billno',$id);
      $this->db->delete('tbl_trans2');

      echo "1";
    }
/////////////////////////////
    ///////////////////
    function ageing(){
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $d30=date('Y-m-d', strtotime($to.' -30 days'));
      $d60=date('Y-m-d', strtotime($to.' -60 days'));
      $d90=date('Y-m-d', strtotime($to.' -90 days'));
      $d120=date('Y-m-d', strtotime($to.' -120 days'));

      $district=$this->input->get('district');
      $query=$this->db->query("select m.id,m.name,m.opbalance,
                (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d30."' and v.cdate<='".$to."') and v.ledger_id=m.id) as d30,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d60."' and v.cdate<='".$d30."') and v.ledger_id=m.id) as d60,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d90."' and v.cdate<='".$d60."') and v.ledger_id=m.id) as d90,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d120."' and v.cdate<='".$d90."') and v.ledger_id=m.id) as d120,
                (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$d120."') and v.ledger_id=m.id) as dabove,
                (select sum(v.vamount+(v.lessadv*2)) as amount from tbl_trans1 v  where (v.vamount+(v.lessadv*2))>0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <'".$to."') and v.ledger_id=m.id) as receipt,
                (select sum(v.vamount+(v.lessadv*2)) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <'".$to."') and v.ledger_id=m.id) as vamount
                from m_ledger m where m.district='$district' and m.company_id=" . get_cookie("ae_company_id") ."  group by m.id,m.name order by m.name");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
              <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
                <button class="btn btn-primary" onClick ="exportExcel();">
                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
                </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;">0-30</th>';
          echo '            <th style="border:1px solid black;padding:5px;">31-60</th>';
          echo '            <th style="border:1px solid black;padding:5px;">61-90</th>';
          echo '            <th style="border:1px solid black;padding:5px;">91-120</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Above 120</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Closing Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $clbalance_total=0;
          foreach($result as $row)
          {
              $d30=$row->d30*-1;
              $d60=$row->d60*-1;
              $d90=$row->d90*-1;
              $d120=$row->d120*-1;
              $dabove=$row->dabove*-1;
              $receipt=$row->receipt;

              if($d30>0)
              {
                if($d30>$receipt)
                {
                  $d30=$d30-$receipt;
                }
                else
                {
                  $d30=0;
                  $receipt=$receipt-$d30;
                }
              }
              if($d60>0)
              {
                if($d60>$receipt)
                {
                  $d60=$d60-$receipt;
                }
                else
                {
                  $d60=0;
                  $receipt=$receipt-$d60;
                }
              }
              if($d90>0)
              {
                if($d90>$receipt)
                {
                  $d90=$d90-$receipt;
                }
                else
                {
                  $d90=0;
                  $receipt=$receipt-$d90;
                }
              }
              if($d120>0)
              {
                if($d120>$receipt)
                {
                  $d120=$d120-$receipt;
                }
                else
                {
                  $d120=0;
                  $receipt=$receipt-$d120;
                }
              }
              if($dabove>0)
              {
                if($dabove>$receipt)
                {
                  $dabove=$dabove-$receipt;
                }
                else
                {
                  $dabove=0;
                  $receipt=$receipt-$dabove;
                }
              }


              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->vamount)*-1,2);

              $clbalance_total=bcadd($clbalance_total,$clbalance,2);

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d30.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d60.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d90.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d120.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$dabove.'  </td>';

                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance.' </td>';
                echo '</tr>';

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL :</td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';

                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance_total.' </td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    

    ///////////////////
    function ageing_state(){
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $d30=date('Y-m-d', strtotime($to.' -30 days'));
      $d60=date('Y-m-d', strtotime($to.' -60 days'));
      $d90=date('Y-m-d', strtotime($to.' -90 days'));
      $d120=date('Y-m-d', strtotime($to.' -120 days'));

      $state=$this->input->get('state');
      $group_id=$this->input->get('group_id');
      if($group_id==0)
      {
      $query=$this->db->query("select m.id,m.name,m.opbalance,
                (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d30."' and v.cdate<='".$to."') and v.ledger_id=m.id) as d30,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d60."' and v.cdate<='".$d30."') and v.ledger_id=m.id) as d60,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d90."' and v.cdate<='".$d60."') and v.ledger_id=m.id) as d90,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d120."' and v.cdate<='".$d90."') and v.ledger_id=m.id) as d120,
                (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$d120."') and v.ledger_id=m.id) as dabove,
                (select sum(v.vamount+((v.lessadv)*2)) as amount from tbl_trans1 v  where v.vamount>0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <'".$to."') and v.ledger_id=m.id) as receipt,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as vamount,
                (select sum(v.lessadv) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as lessadv
                from m_ledger m where m.state='$state' and m.company_id=" . get_cookie("ae_company_id") ."  group by m.id,m.name order by m.name");
      }
      else
      {
        $query=$this->db->query("select m.id,m.name,m.opbalance,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d30."' and v.cdate<='".$to."') and v.ledger_id=m.id) as d30,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d60."' and v.cdate<='".$d30."') and v.ledger_id=m.id) as d60,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d90."' and v.cdate<='".$d60."') and v.ledger_id=m.id) as d90,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d120."' and v.cdate<='".$d90."') and v.ledger_id=m.id) as d120,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$d120."') and v.ledger_id=m.id) as dabove,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount>0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <'".$to."') and v.ledger_id=m.id) as receipt,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as vamount,
                  (select sum(v.lessadv) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as lessadv
                  from m_ledger m where m.state='$state' and m.company_id=" . get_cookie("ae_company_id") ." and m.group_id=".$group_id." group by m.id,m.name order by m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
             <button class="btn btn-primary" onClick ="exportExcel();">
            <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
          </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;">0-30</th>';
          echo '            <th style="border:1px solid black;padding:5px;">31-60</th>';
          echo '            <th style="border:1px solid black;padding:5px;">61-90</th>';
          echo '            <th style="border:1px solid black;padding:5px;">91-120</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Above 120</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Closing Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $clbalance_total=0;
          foreach($result as $row)
          {
              $d30=$row->d30*-1;
              $d60=$row->d60*-1;
              $d90=$row->d90*-1;
              $d120=$row->d120*-1;
              $dabove=$row->dabove*-1;
              $receipt=$row->receipt;

              if($d30>0)
              {
                if($d30>$receipt)
                {
                  $d30=$d30-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$d30;
                  $d30=0;
                }
              }
              if($d60>0)
              {
                if($d60>$receipt)
                {
                  $d60=$d60-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$d60;
                  $d60=0;
                }
              }
              if($d90>0)
              {
                if($d90>$receipt)
                {
                  $d90=$d90-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$d90;
                  $d90=0;
                }
              }
              if($d120>0)
              {
                if($d120>$receipt)
                {
                  $d120=$d120-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$d120;
                  $d120=0;
                }
              }
              if($dabove>0)
              {
                if($dabove>$receipt)
                {
                  $dabove=$dabove-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$dabove;
                  $dabove=0;
                }
              }


              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->vamount)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);

              $clbalance_total=bcadd($clbalance_total,$clbalance,2);

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name .'</td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d30.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d60.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d90.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d120.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$dabove.'  </td>';

                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance.' </td>';
                echo '</tr>';

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL :</td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';

                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance_total.' </td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function ageing_line(){
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $d30=date('Y-m-d', strtotime($to.' -30 days'));
      $d60=date('Y-m-d', strtotime($to.' -60 days'));
      $d90=date('Y-m-d', strtotime($to.' -90 days'));
      $d120=date('Y-m-d', strtotime($to.' -120 days'));

      $line=$this->input->get('line');
      $group_id=$this->input->get('group_id');
      if($group_id==0)
      {
      $query=$this->db->query("select m.id,m.name,m.opbalance,
                (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d30."' and v.cdate<='".$to."') and v.ledger_id=m.id) as d30,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d60."' and v.cdate<='".$d30."') and v.ledger_id=m.id) as d60,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d90."' and v.cdate<='".$d60."') and v.ledger_id=m.id) as d90,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d120."' and v.cdate<='".$d90."') and v.ledger_id=m.id) as d120,
                (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$d120."') and v.ledger_id=m.id) as dabove,
                (select sum(v.vamount+((v.lessadv)*2)) as amount from tbl_trans1 v  where v.vamount>0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <'".$to."') and v.ledger_id=m.id) as receipt,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as vamount,
                (select sum(v.lessadv) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as lessadv
                from m_ledger m where m.line_id=".$line." and m.company_id=" . get_cookie("ae_company_id") ."  group by m.id,m.name order by m.name");
      }
      else
      {
        $query=$this->db->query("select m.id,m.name,m.opbalance,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d30."' and v.cdate<='".$to."') and v.ledger_id=m.id) as d30,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d60."' and v.cdate<='".$d30."') and v.ledger_id=m.id) as d60,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d90."' and v.cdate<='".$d60."') and v.ledger_id=m.id) as d90,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d120."' and v.cdate<='".$d90."') and v.ledger_id=m.id) as d120,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$d120."') and v.ledger_id=m.id) as dabove,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount>0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <'".$to."') and v.ledger_id=m.id) as receipt,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as vamount,
                  (select sum(v.lessadv) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as lessadv
                  from m_ledger m where m.line_id=".$line." and m.company_id=" . get_cookie("ae_company_id") ." and m.group_id=".$group_id." group by m.id,m.name order by m.name");
      }
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
             <button class="btn btn-primary" onClick ="exportExcel();">
            <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
          </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;">0-30</th>';
          echo '            <th style="border:1px solid black;padding:5px;">31-60</th>';
          echo '            <th style="border:1px solid black;padding:5px;">61-90</th>';
          echo '            <th style="border:1px solid black;padding:5px;">91-120</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Above 120</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Closing Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $clbalance_total=0;
          foreach($result as $row)
          {
              $d30=$row->d30*-1;
              $d60=$row->d60*-1;
              $d90=$row->d90*-1;
              $d120=$row->d120*-1;
              $dabove=$row->dabove*-1;
              $receipt=$row->receipt;

              if($d30>0)
              {
                if($d30>$receipt)
                {
                  $d30=$d30-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$d30;
                  $d30=0;
                }
              }
              if($d60>0)
              {
                if($d60>$receipt)
                {
                  $d60=$d60-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$d60;
                  $d60=0;
                }
              }
              if($d90>0)
              {
                if($d90>$receipt)
                {
                  $d90=$d90-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$d90;
                  $d90=0;
                }
              }
              if($d120>0)
              {
                if($d120>$receipt)
                {
                  $d120=$d120-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$d120;
                  $d120=0;
                }
              }
              if($dabove>0)
              {
                if($dabove>$receipt)
                {
                  $dabove=$dabove-$receipt;
                  $receipt=0;
                }
                else
                {
                  $receipt=$receipt-$dabove;
                  $dabove=0;
                }
              }


              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->vamount)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);

              $clbalance_total=bcadd($clbalance_total,$clbalance,2);

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name .'</td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d30.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d60.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d90.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d120.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$dabove.'  </td>';

                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance.' </td>';
                echo '</tr>';

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL :</td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';

                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance_total.' </td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    
    ///////////////////
    function line_summary(){
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $line_id=$this->input->get('line_id');
        $query=$this->db->query("select m.id,m.name,m.opbalance,m.mobilenosms,m.climit,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$to."') and v.ledger_id=m.id) as balance,
                  (select sum(v.lessadv) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$to."') and v.ledger_id=m.id) as lessadv
                  from m_ledger m where  m.line_id=".$line_id." and m.company_id=" . get_cookie("ae_company_id") ."  group by m.id,m.name,m.mobilenosms order by m.name");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
             <button class="btn btn-primary" onClick ="exportExcel();">
            <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
          </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;"> </th>';
          echo '            <th style="border:1px solid black;padding:5px;">Mobile No.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Received</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $clbalance_total=0;
          foreach($result as $row)
          {
              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->balance)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);

              $clbalance_total=bcadd($clbalance_total,$clbalance,2);

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name .'</td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$row->climit.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$row->mobilenosms.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '</tr>';

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL :</td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance_total.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    

    ///////////////////
    function salesman_wise_summary(){
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $line_id=$this->input->get('line_id');
        $query=$this->db->query("select m.id,m.name,m.opbalance,m.mobilenosms,m.climit,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$to."') and v.ledger_id=m.id) as balance,
                  (select sum(v.lessadv) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$to."') and v.ledger_id=m.id) as lessadv
                  from m_ledger m where  m.salesman='".$line_id."' and m.company_id=" . get_cookie("ae_company_id") ."  group by m.id,m.name,m.mobilenosms order by m.name");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
             <button class="btn btn-primary" onClick ="exportExcel();">
            <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
          </button>

          </center>';
          echo '<br>';

          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;"> </th>';
          echo '            <th style="border:1px solid black;padding:5px;">Mobile No.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Received</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $clbalance_total=0;
          foreach($result as $row)
          {
              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->balance)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);

              $clbalance_total=bcadd($clbalance_total,$clbalance,2);

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name .'</td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$row->climit.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$row->mobilenosms.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '</tr>';

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL :</td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance_total.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }
    }
    ///////////////////    


    ///////////////////
    function line_summary_array(){
      $to=date('Y-m-d',strtotime($this->input->get('to')));
      $line_id=$this->input->get('line_id');

    $ledger_ids=explode(",",$line_id);
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint1();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>

          </center>';
          echo '<br>';

    echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
    echo '    <thead>';
    echo '        <tr>';
    echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';
    echo '            <th style="border:1px solid black;padding:5px;"> </th>';
    echo '            <th style="border:1px solid black;padding:5px;">Mobile No.</th>';
    echo '            <th style="border:1px solid black;padding:5px;">Amount</th>';
    echo '            <th style="border:1px solid black;padding:5px;">Printing</th>';
    echo '        </tr>';
    echo '    </thead>';
    echo '    <tbody>';
    $clbalance_total=0;
    foreach($ledger_ids as $ledger_id)
    {
        $query=$this->db->query("select m.id,m.name,m.opbalance,m.mobilenosms,m.climit,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$to."') and v.ledger_id=m.id) as balance,
                  (select sum(v.lessadv) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$to."') and v.ledger_id=m.id) as lessadv
                  from m_ledger m where  m.line_id=".$ledger_id." group by m.id,m.name,m.mobilenosms order by m.name");
        $result=$query->result();

        if(count($result)>0)
        {
          foreach($result as $row)
          {
              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->balance)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);

              $clbalance_total=bcadd($clbalance_total,$clbalance,2);
              if($clbalance!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name .' <input type="hidden" id="ledger_id" value="'.$row->id.'"></td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$row->climit.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$row->mobilenosms.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right" id="last_col">  </td>';
                echo '</tr>';
              }

          }
      }
    }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL :</td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance_total.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
            
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';

    }
    ///////////////////    

/////////////////////////////
    function stock_report_detail(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));

      $query=$this->db->query("select i.id,i.name,i.vat,i.opn_bal,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase' and t2.itemcode=i.id and (t1.cdate<'".$from."')) as opur,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales' and t2.itemcode=i.id and (t1.cdate<'".$from."')) as osal,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate<'".$from."')) as osalr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate<'".$from."')) as opurr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."')) as pur,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."')) as sal,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."')) as salr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase return' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."')) as purr
       from m_item i where i.company_id=".get_cookie('ae_company_id')."  order by i.name");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
        echo '            <th>Item</th>';
        echo '            <th>Op.Balance</th>';
        echo '            <th>Purchase</th>';
        echo '            <th>Sales</th>';
        echo '            <th>Purchase Return</th>';
        echo '            <th>Sales Return<br>Fresh</th>';
        echo '            <th>Cl.Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $opb=0;
          $pur=0;
          $prod1=0;
          $sal=0;
          $prod2=0;
          $prod3=0;
          $purr=0;
          $salr=0;
          $clb=0;
          $type="";
          foreach($result as $row)
          {
              // if($type<>$row->type)
              // {
              //   $type=$row->type;
              //     echo '<tr class="" style="background-color:#ffcccc;">';
              //     echo '    <td colspan="7">'.$type.'</td>';
              //     echo '</tr>';
              // }

                $opb=$row->opn_bal;
                $opb=$opb+$row->opur;
                $opb=$opb-$row->osal;
                $opb=$opb+$row->osalr;
                $opb=$opb-$row->opurr;

                $pur=$row->pur;
                $sal=$row->sal;
                $salr=$row->salr;
                $purr=$row->purr;
                if($opb==0)
                {
                  $opb=0;
                }
                $clb = $opb+$pur+$prod1+$salr-$purr;
                $clb = $clb - $sal;
                $clb = $clb - $prod2;

                if($opb!=0 || $pur!=0 || $prod1!=0 || $sal!=0 || $prod2!=0 || $salr!=0 || $purr!=0)
                {
                  echo '<tr class="">';
                  echo '    <td>' . '' . $row->name . '</td>';
                  echo '    <td>' . '' . $opb . '</td>';
                  echo '    <td>' . '' . $pur . '</td>';
                  echo '    <td>' . '' . $sal . '</td>';
                  echo '    <td>' . '' . $purr . '</td>';
                  echo '    <td>' . '' . $salr . '</td>';
                  echo '    <td>' . '' . $clb . '</td>';
                  echo '</tr>';
                }
          }
          echo '</tbody>';
          echo '</table>';
      }
          echo '<center>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
          </center>';
          echo '<br>';
    }
/////////////////////////////
    function stock_item_reorder_detail()
    {
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));

      $query=$this->db->query("select i.id,i.reorder,i.name,mc.name as type,i.vat,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase' and t2.itemcode=i.id and (t1.cdate<'".$from."')) as opur,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales' and t2.itemcode=i.id and (t1.cdate<'".$from."')) as osal,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate<'".$from."') and t1.item_type='Fresh') as osalr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate<'".$from."') and t1.item_type='Fresh') as opurr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."')) as pur,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."')) as sal,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."') and t1.item_type='Fresh') as salr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase return' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."') and t1.item_type='Fresh') as purr
       from m_item i,m_master c,m_master mc where i.company_id=".get_cookie('ae_company_id')." and i.category_id=c.id and c.parent_id=mc.id  order by mc.name,i.name");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
        echo '            <th>Item</th>';
        echo '            <th>Re-Order</th>'; 
        echo '            <th>Cl.Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $opb=0;
          $pur=0;
          $prod1=0;
          $sal=0;
          $prod2=0;
          $prod3=0;
          $purr=0;
          $salr=0;
          $clb=0;
          $type="";
          foreach($result as $row)
          {
              if($type<>$row->type)
              {
                $type=$row->type;
                  echo '<tr class="" style="background-color:#ffcccc;">';
                  echo '    <td colspan="7">'.$type.'</td>';
                  echo '</tr>';
              }

                $opb=$row->vat;
                $opb=$opb+$row->opur;
                $opb=$opb-$row->osal;
                $opb=$opb+$row->osalr;
                $opb=$opb-$row->opurr;

                $pur=$row->pur;
                $sal=$row->sal;
                $salr=$row->salr;
                $purr=$row->purr;
                if($opb==0)
                {
                  $opb=0;
                }
                $clb = $opb+$pur+$prod1+$salr-$purr;
                $clb = $clb - $sal;
                $clb = $clb - $prod2;

                if($row->reorder>$clb)
                {
                  echo '<tr class="">';
                    echo '    <td>' . '' . $row->name . '</td>';
                    echo '    <td>' . '' . $row->reorder. '</td>'; 
                    echo '    <td>' . '' . $clb . '</td>';
                  echo '</tr>';
                }
          }
          echo '</tbody>';
          echo '</table>';
      }
          echo '<center>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
          </center>';
          echo '<br>';
    }

/////////////////////////////
    function stock_report_damage(){
      $from=date('Y-m-d',strtotime($this->input->get('from')));
      $to=date('Y-m-d',strtotime($this->input->get('to')));

      $query=$this->db->query("select i.id,i.name,mc.name as type,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate<'".$from."') and t1.item_type='Damage') as osalr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate<'".$from."') and t1.item_type='Damage') as opurr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."') and t1.item_type='Damage') as salr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase return' and t2.itemcode=i.id and (t1.cdate between '".$from."' and '".$to."') and t1.item_type='Damage') as purr
       from m_item i,m_master c,m_master mc where i.company_id=".get_cookie('ae_company_id')." and i.category_id=c.id and c.parent_id=mc.id  order by mc.name,i.name");
      $result=$query->result();

      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
        echo '            <th>Item</th>';
        echo '            <th>Op.Balance</th>';
        echo '            <th>Damage In</th>';
        echo '            <th>Damage Out</th>';
        echo '            <th>Cl.Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $opb=0;
          $pur=0;
          $prod1=0;
          $sal=0;
          $prod2=0;
          $prod3=0;
          $purr=0;
          $salr=0;
          $clb=0;
          $type="";
          foreach($result as $row)
          {
              if($type<>$row->type)
              {
                $type=$row->type;
                  echo '<tr class="" style="background-color:#ffcccc;">';
                  echo '    <td colspan="7">'.$type.'</td>';
                  echo '</tr>';
              }

                $opb=$row->osalr;
                $opb=$opb+$row->opurr;

                $salr=$row->salr;
                $purr=$row->purr;
                if($opb==0)
                {
                  $opb=0;
                }
                $clb = $opb;
                $clb = $clb + $salr;
                $clb = $clb - $purr;

                if($opb!=0 ||  $salr!=0 || $purr!=0)
                {
                  echo '<tr class="">';
                  echo '    <td>' . '' . $row->name . '</td>';
                  echo '    <td>' . '' . $opb . '</td>';
                  echo '    <td>' . '' . $salr . '</td>';
                  echo '    <td>' . '' . $purr . '</td>';
                  echo '    <td>' . '' . $clb . '</td>';
                  echo '</tr>';
                }
          }
          echo '</tbody>';
          echo '</table>';
      }
          echo '<center>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
          </center>';
          echo '<br>';
    }
/////////////////////////////


       function purchase_return_save(){
      $this->load->model('transaction_model');
      $this->transaction_model->purchase_return_save();
    }
     function purchase_return_save_modify(){
      $this->load->model('transaction_model');
      $this->transaction_model->purchase_return_save_modify();
    }
     function purchase_return_get()
        {
          $this->load->model('transaction_model');
          $this->transaction_model->purchase_return_get();
        }

        function purchase_return_get_item(){
           $this->load->model('transaction_model');
           $result=$this->transaction_model->sales_get_item();
           $ti=9;
           if(count($result)>0){
               foreach($result as $row){
                echo '<tr>';
                echo ' <td>
        <select name="itemcode[]" id="item_id" onchange="GetRate(this);return false;" class="col-xs-10 col-sm-12" tabindex="'.$ti++.'">
          <option value="0">Select Item Name</option>';

                foreach(item_list() as $row1)
                {
                    if($row1->id==$row->itemcode)
                    {
                       echo '<option selected="selected" value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                    else
                    {
                       echo '<option value="'.$row1->id.'">'.$row1->name.'</option>';
                    }
                 }
          echo '</select>
<input type="hidden" id="order_id" name="orderid_gen[]"/>
                  </td>';

                echo ' <td><input value="'.$row->qtymt.'" tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                
                echo ' <td><input value="'.$row->rate.'" tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls" onblur="CalcAmount(this);return false;"/></td>';
                echo ' <td><input value="'.$row->freight.'" tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';
               }
           }  
           else
           {
                echo '<tr>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" id="txt_item" class="txt_item item" onkeyup="getItemAutoCompt(this);" list="0"/><input type="hidden" id="item_id" class="item_id" name="itemcode[]"/><input type="hidden" id="order_id" name="orderid_gen[]"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtymt[]" id="txt_qtymt" class="qtymt txt_cls" onblur="GetQtyBag(this);return false;"/></td>';
                // echo ' <td><input tabindex="'.$ti++.'" type="text" name="qtybag[]" id="txt_qtybag" class="qtybag txt_cls" readonly="true"/></td>           ';
                echo ' <td><input  tabindex="'.$ti++.'" type="text" name="rate[]" id="txt_rate" class="txt_cls"/></td>';
                echo ' <td><input tabindex="'.$ti++.'" type="text" name="freight[]" id="txt_freight" class="freight txt_cls" onblur="TolFreight();" /></td>';
                echo ' <td><button tabindex="'.$ti++.'" type="button" id="btn_add" class="btn btn-xs btn-info" onclick="ItemAddNew(this);return false;"><i class="ace-icon fa fa-plus bigger-120"></i></button><button type="button" id="btn_del" class="btn btn-xs btn-danger" onclick="deleteRow(this);return false;"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></td>';
                echo '</tr>';

           }

        }


      /////////////////////////
    ///////////////////
    function split_company_create(){
      $newname=$this->input->post("newname");
      $cdate=$this->input->post("cdate");

      $data=array(
            'company_name'=>$newname,
            );

      $this->db->insert("m_company",$data);
          $company_id=$this->db->insert_id();

        $pos_name = $newname;

        $data1=array(
              'name'=>$pos_name,
              'type'=>'POS',
              'company_id'=>$company_id,
              );
      $this->db->insert("m_master",$data1);

      echo $company_id;       
    }


    ///////////////////
    function split_master_create(){
      $newcompany=$this->input->post("newcompany");

      $query=$this->db->query("insert into m_master (name,company_id,type,freight,parent_id,actual_freight,prefix,vat,old_id) select name,".$newcompany.",type,freight,parent_id,actual_freight,prefix,vat,id from m_master where company_id=".get_cookie("ae_company_id"));

      echo "1";       
    }
    ///////////////////
    function split_item_create(){
      $newcompany=$this->input->post("newcompany");

      $query=$this->db->query("insert into m_item (name,group_id,category_id,itemcompany_id,desptype,vat,company_id,mrp,old_id) select name,group_id,category_id,itemcompany_id,desptype,vat,".$newcompany. ",mrp,id from m_item where company_id=".get_cookie("ae_company_id"));

      $query=$this->db->query("update m_item set group_id=(select id from m_master where old_id=m_item.group_id and company_id=".$newcompany.") where company_id=".$newcompany);

     $query=$this->db->query("update m_item set category_id=(select id from m_master where old_id=m_item.category_id and company_id=".$newcompany.") where company_id=".$newcompany);

      $query=$this->db->query("update m_item set itemcompany_id=(select id from m_master where old_id=m_item.itemcompany_id and company_id=".$newcompany.") where company_id=".$newcompany);

      echo "1";       
    }
    ///////////////////
    function split_ledger_create(){
      $newcompany=$this->input->post("newcompany");

      $query=$this->db->query("insert into m_ledger (name,alias,print_name,group_id,opbalance,optype,address,district,state,pincode,cperson,phoneno,mobileno,faxno,emailid,panno,cstno,tinno,exciseno,sertaxno,mobilenosms,billname,contactperson,crlimit,grade,garage,dob,pageno,postamt,sapcode,remark,company_id,line_id,climit,old_id) select name,alias,print_name,group_id,0,optype,address,district,state,pincode,cperson,phoneno,mobileno,faxno,emailid,panno,cstno,tinno,exciseno,sertaxno,mobilenosms,billname,contactperson,crlimit,grade,garage,dob,pageno,postamt,sapcode,remark,". $newcompany .",line_id,climit,id from m_ledger where company_id=".get_cookie("ae_company_id"));

      echo "1";       
    }

    ///////////////////
    function split_pricelist_create(){
      $newcompany=$this->input->post("newcompany");

      $query=$this->db->query("insert into m_rate (item_id,rate,pdate) select i.id,r.rate,r.pdate from m_item i, m_rate r where i.old_id=r.item_id and i.company_id=".$newcompany);

      echo "1";       
    }

    ///////////////////
    function split_opbalance_create(){
      $newcompany=$this->input->post("newcompany");
      $cdate=date('Y-m-d',strtotime($this->input->post('cdate')));

        $query=$this->db->query("select m.id,m.name,m.opbalance,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$cdate."') and v.ledger_id=m.id) as balance,
                  (select sum(v.lessadv) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$cdate."') and v.ledger_id=m.id) as lessadv
                  from m_ledger m where  m.company_id=".get_cookie("ae_company_id")." group by m.id,m.name,m.mobilenosms order by m.name");
      $result=$query->result();

      if(count($result)>0)
      {
          $clbalance_total=0;
          foreach($result as $row)
          {
              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->balance)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);

              $query=$this->db->query("update  m_ledger set opbalance=".$clbalance." where old_id=".$row->id);


          }
      }

      echo "1";       
    }


    ///////////////////
/////////////////////////////
    function split_stock_create(){
      $newcompany=$this->input->post("newcompany");
      $query=$this->db->query("select i.id,i.name,mc.name as type,i.vat,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase' and t2.itemcode=i.id) as pur,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales' and t2.itemcode=i.id) as sal,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='sales return' and t2.itemcode=i.id and t1.item_type='Fresh') as salr,
      (select sum(t2.qtymt) from tbl_trans2 t2,tbl_trans1 t1 where t1.company_id=".get_cookie('ae_company_id')." and t1.id=t2.billno and t1.vtype='purchase return' and t2.itemcode=i.id and t1.item_type='Fresh') as purr
       from m_item i,m_master c,m_master mc where i.company_id=".get_cookie('ae_company_id')." and i.category_id=c.id and c.parent_id=mc.id  order by mc.name,i.name");
      $result=$query->result();

      if(count($result)>0)
      {
          $opb=0;
          $pur=0;
          $prod1=0;
          $sal=0;
          $prod2=0;
          $prod3=0;
          $purr=0;
          $salr=0;
          $clb=0;
          $type="";
          foreach($result as $row)
          {
                $opb=$row->vat;
                $pur=$row->pur;
                $sal=$row->sal;
                $salr=$row->salr;
                $purr=$row->purr;
                $clb = $opb+$pur+$prod1+$salr-$purr;
                $clb = $clb - $sal;
                $clb = $clb - $prod2;

                if($opb!=0 || $pur!=0 || $prod1!=0 || $sal!=0 || $prod2!=0 || $salr!=0 || $purr!=0)
                {
                  $query=$this->db->query("update m_item set vat=".$clb." where old_id=".$row->id." and company_id=".$newcompany);
                }
          }
      }
          echo "1";
    }
/////////////////////////////    
    function send_sms_summary()
    {
      $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,l.mobilenosms,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")  order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="sales"  and t1.stop_builty=0  group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name,l.mobilenosms order by t1.cdate,t1.id');
      $result=$query->result();
      if(count($result)>0)
      {
          echo '<table id="TblList" class="table table-striped table-bordered table-hover">';
          echo '    <thead>';
          echo '        <tr>';
          // echo '            <th>Category</th>';
          echo '            <th>Date</th>';
          echo '            <th>No</th>';
          // echo '            <th>POS</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Mobile No. (SMS)</th>';
          echo '            <th>Items</th>';
          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          foreach($result as $row)
          {
                echo '<tr class="">';
                // echo '    <td>' . $row->catname . '</td>';
                echo '    <td><input type="hidden" id="tid" value="'.$row->id.'">' . date('d-m-Y',strtotime($row->cdate)) . '</td>';
                echo '    <td>' . $row->builtyno . '</td>';
                echo '    <td>' . $row->lname . '</td>';
                echo '    <td>' . $row->mobilenosms . '</td>';
                echo '    <td>' . $row->items . '</td>';
                // echo '    <td>' . $row->dname . '</td>'; 
                echo '<td id="last_col">&nbsp;</td>';               
                echo '</tr>';
        }
      }
    }
    ///////////////////    
    function send_sms()
    {
      $tid=$this->input->get("tid");

      $msg="";
      $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,l.mobilenosms,t1.remark,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")  order by t2.id SEPARATOR " ") as items,t1.lr_no,t1.transport from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="sales" and t1.stop_builty=0 and t1.id='.$tid.'  group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name,l.mobilenosms,t1.lr_no,t1.transport order by t1.cdate,t1.id,t1.remark');
      $result=$query->result();
      if(count($result)>0)
      {
          foreach($result as $row)
          {
              $msg=""; //$row->lname;
//              $msg=$msg." ";
              $msg=$msg."Ch.No.".$row->builtyno;
              $msg=$msg." ";
              $msg=$msg."".date('d-m-Y',strtotime($row->cdate));
              $msg=$msg." ";
              $msg=$msg."".$row->remark;
              $msg=$msg." ";
              $msg=$msg."".$row->items;
              if($row->lr_no!="")
              {
                $msg=$msg." LR:".$row->lr_no;
              }
              if($row->transport!="")
              {
                $msg=$msg." TR:".$row->transport;
              }
              sendsms($msg,$row->mobilenosms);
              $this->db->query('update tbl_trans1 set stop_builty=1 where id='.$tid);
          }
      }
    }

    //////////////pending order report
    ///////////////////
    function pending_order_report()
    {
      $search_by=$this->input->get('search_by');

      if($search_by=='Party')
      {      
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';
          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">S.no.</th>';      
          echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';  
          echo '            <th style="border:1px solid black;padding:5px;">Item Name</th>';
          // echo '            <th style="border:1px solid black;padding:5px;">Order Qty</th>';
          // echo '            <th style="border:1px solid black;padding:5px;">Dispatch</th>';   
          echo '            <th style="border:1px solid black;padding:5px;">Balance Qty</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          $totat_order_qty=0;
          $order_qty=0;
          $bal_qty=0;
          $itemname='';

          $query=$this->db->query('update tbl_order_bal b set b.bal=0 where b.bal<0'); 

          $query=$this->db->query('delete from  tbl_order_bal where bal=0'); 

          $query=$this->db->query('select b.bal,i.name as itemname, i.id as itemcode, m.name as party_name,m.id as ledger_id from tbl_order_bal b, m_item i, m_ledger m where  b.item_id=i.id  and b.company_id='. get_cookie('ae_company_id') .' and  b.ledger_id=m.id order by m.name'); 
          $j=1;
          foreach($query->result() as $row)
          {                

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">'.$j++.'</td>';
                echo '    <td style="border:1px solid black;padding:5px;">'.$row->party_name.'</td>';      
                echo '    <td style="border:1px solid black;padding:5px;">'.$row->itemname.'</td>';
                echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($row->bal,2,'.','').'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
      }
      if($search_by=='Item')
      {      
          echo '<br>';
          echo '<center>
          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
            <button class="btn btn-primary" onClick ="exportExcel();">
              <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
            </button>

          </center>';
          echo '<br>';
          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">S.no.</th>';      
          echo '            <th style="border:1px solid black;padding:5px;">Item Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Balance Qty</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          $totat_order_qty=0;
          $order_qty=0;
          $bal_qty=0;
          $itemname='';
          $query=$this->db->query('select sum(b.bal) bal,i.name as itemname from tbl_order_bal b, m_item i where b.item_id=i.id  and b.company_id='. get_cookie('ae_company_id').' group by b.item_id order by i.name ');
          $j=1;
          foreach($query->result() as $row)
          {           
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">'.$j++.'</td>';
                echo '    <td style="border:1px solid black;padding:5px;">'.$row->itemname.'</td>';   
                echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($row->bal,2,'.','').'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
      }
  }


  // function pending_order_report()
  //   {
  //     $search_by=$this->input->get('search_by');

  //     if($search_by=='Party')
  //     {      
  //         echo '<br>';
  //         echo '<center>
  //         <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
  //           <button class="btn btn-primary" onClick ="exportExcel();">
  //             <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
  //           </button>

  //         </center>';
  //         echo '<br>';
  //         echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
  //         echo '    <thead>';
  //         echo '        <tr>';
  //         echo '            <th style="border:1px solid black;padding:5px;">S.no.</th>';      
  //         echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';  
  //         echo '            <th style="border:1px solid black;padding:5px;">Item Name</th>';
  //         echo '            <th style="border:1px solid black;padding:5px;">Order Qty</th>';
  //         echo '            <th style="border:1px solid black;padding:5px;">Dispatch</th>';   
  //         echo '            <th style="border:1px solid black;padding:5px;">Balance Qty</th>';
  //         echo '        </tr>';
  //         echo '    </thead>';
  //         echo '    <tbody>';

  //         $totat_order_qty=0;
  //         $order_qty=0;
  //         $bal_qty=0;
  //         $itemname='';
  //         $query=$this->db->query('select sum(t2.qtymt) as order_qty,i.name as itemname, i.id as itemcode, m.name as party_name,m.id as ledger_id from tbl_order2 t2, tbl_order1 t1, m_item i, m_ledger m where t1.id=t2.billno and t2.itemcode=i.id  and t1.company_id='. get_cookie('ae_company_id') .' and  t1.ledger_id=m.id and t1.vtype="order" group by t1.ledger_id,t2.itemcode order by m.name'); 
  //         $j=1;
  //         foreach($query->result() as $row)
  //         {                

  //               echo '<tr class="">';
  //               echo '    <td style="border:1px solid black;padding:5px;">'.$j++.'</td>';
  //               echo '    <td style="border:1px solid black;padding:5px;">'.$row->party_name.'</td>';
                
                

  //               echo '    <td style="border:1px solid black;padding:5px;">'.$row->itemname.'</td>';
  //               $totat_dis_qty=0;
  //               $dis_qty=0;
  //               $query2=$this->db->query('select sum(t2.qtymt) as dis_qty,i.name as itemname from tbl_trans2 t2, tbl_trans1 t1, m_item i where t1.id=t2.billno and t2.itemcode=i.id  and t1.company_id='. get_cookie('ae_company_id') .' and  t1.ledger_id='.$row->ledger_id .' and t2.itemcode='.$row->itemcode.' and t1.vtype="sales" group by t2.itemcode');
  //               //echo $this->db->last_query();die;
  //               if(count($result)>0)
  //               {
  //                 foreach($query2->result() as $row2)
  //                 {
  //                   $dis_qty=$row2->dis_qty;
  //                   $totat_dis_qty+=$dis_qty;
  //                 }
  //               }

  //               $bal_qty=$row->order_qty-$dis_qty;
  //               echo ' <td style="border:1px solid black;padding:5px;">'  . $row->order_qty.'</td>';
  //               echo ' <td style="border:1px solid black;padding:5px;">'  . $dis_qty.'</td>';
  //               echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($bal_qty,2,'.','').'</td>';
  //               echo '</tr>';
  //         }
  //         echo '</tbody>';
  //         echo '</table>';
  //     }
  //     if($search_by=='Item')
  //     {      
  //         echo '<br>';
  //         echo '<center>
  //         <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
  //           <button class="btn btn-primary" onClick ="exportExcel();">
  //             <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
  //           </button>

  //         </center>';
  //         echo '<br>';
  //         echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
  //         echo '    <thead>';
  //         echo '        <tr>';
  //         echo '            <th style="border:1px solid black;padding:5px;">S.no.</th>';      
  //         echo '            <th style="border:1px solid black;padding:5px;">Item Name</th>';
  //         echo '            <th style="border:1px solid black;padding:5px;">Order Qty</th>';
  //         echo '            <th style="border:1px solid black;padding:5px;">Dispatch</th>';   
  //         echo '            <th style="border:1px solid black;padding:5px;">Balance Qty</th>';
  //         echo '        </tr>';
  //         echo '    </thead>';
  //         echo '    <tbody>';

  //         $totat_order_qty=0;
  //         $order_qty=0;
  //         $bal_qty=0;
  //         $itemname='';
  //         $query=$this->db->query('select sum(t2.qtymt) as order_qty,i.name as itemname,i.id as itemcode from tbl_order2 t2, tbl_order1 t1, m_item i where t1.id=t2.billno and t2.itemcode=i.id  and t1.company_id='. get_cookie('ae_company_id').' and t1.vtype="order" group by t2.itemcode order by i.name ');
  //         $j=1;
  //         foreach($query->result() as $row)
  //         {           

  //               echo '<tr class="">';
  //               echo '    <td style="border:1px solid black;padding:5px;">'.$j++.'</td>';
  //               echo '    <td style="border:1px solid black;padding:5px;">'.$row->itemname.'</td>'; 

  //               $dis_qty=0;
  //               $query2=$this->db->query('select sum(t2.qtymt) as dis_qty,i.name as itemname from tbl_trans2 t2, tbl_trans1 t1, m_item i where t1.id=t2.billno and t2.itemcode=i.id  and t1.company_id='. get_cookie('ae_company_id') .' and  t2.itemcode='.$row->itemcode .' and t1.vtype="sales" group by t2.itemcode'); 
  //               if(count($result)>0)
  //               {
  //                 foreach($query2->result() as $row2)
  //                 {
  //                   $dis_qty=$row2->dis_qty;                   
  //                 }
  //               }

  //               $bal_qty=$row->order_qty-$dis_qty;
  //               echo ' <td style="border:1px solid black;padding:5px;">'  . $row->order_qty.'</td>';
  //               echo ' <td style="border:1px solid black;padding:5px;">'  . $dis_qty.'</td>';
  //               echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($bal_qty,2,'.','').'</td>';
  //               echo '</tr>';
  //         }
  //         echo '</tbody>';
  //         echo '</table>';
  //     }
  // }
  


  }
