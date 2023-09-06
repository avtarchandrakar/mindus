<?
if (!defined('BASEPATH')) exit('No direct script access allowed');

class formController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('common_helper');
    }

    function index() {
        
    }

    function sales_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
            }

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->post('action');
          if($action=="edit")
          {
            $q=$this->input->get('id');
            $data=array(
              'title'=>'Quotation Modify',
              'vtype'=>'quatation',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->post('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'custome_list'=>customes_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          else
          {
            $data=array(
              'title'=>'Quotation',
              'vtype'=>'quatation',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'custome_list'=>customes_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          $this->load->view('sales_form',$data);
    }


    function requisition_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
            }

          // $query1=$ci->db->query("select * from m_custome where company_id=" . get_cookie("ae_company_id") ." limit 1");
         

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Requisition Slip',
              'vtype'=>'requisition',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'custome_list'=>customes_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          else
          {
            $data=array(
              'title'=>'Requisition Slip',
              'vtype'=>'requisition',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'custome_list'=>customes_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          $this->load->view('requisition_form',$data);
    }

    function jobform_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
            }

          // $query1=$ci->db->query("select * from m_custome where company_id=" . get_cookie("ae_company_id") ." limit 1");
         

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Jobcard Modify',
              'vtype'=>'jobcard',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'custome_list'=>customes_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          else
          {
            $data=array(
              'title'=>'Jobcard',
              'vtype'=>'jobcard',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'custome_list'=>customes_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          $this->load->view('jobform_form',$data);
    }

    function approval_edit(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->post('action');
            $q=$this->input->post('q');
            $data=array(
              'title'=>'Customer Purchase Order Modify',
              'vtype'=>'cpo',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->post('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          $this->load->view('approval_edit',$data);
    }

    function approval_form(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Customer Purchase Order Modify',
              'vtype'=>'cpo',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Customer Purchase Order',
              'vtype'=>'cpo',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          $this->load->view('approval_form',$data);
    }


    function mail_form(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Send Mail Modify',
              'vtype'=>'sendmail',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Send Mail',
              'vtype'=>'sendmail',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'gid'=>$this->input->get('gid'),
              'ledger_id'=>$this->input->get('ledger_id'),
              'subject'=>'Metalite Industries',
              'mailbody'=>'Metalite Industries
              Dear Sir,
              This has with reference to your quotation and our talk, please find herewith attached purchase order.
              
              Kindly send your acceptance.
              
              ................
              Warm Regards,
              Venketeshwar Agrawal
              Metalite Industries
              Contact: +91 70528 99999',


              );
          }
          $this->load->view('mail_form',$data);
    }


    function invoice_mail_form(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Send Mail Modify',
              'vtype'=>'sendmail',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Send Mail',
              'vtype'=>'sendmail',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'gid'=>$this->input->get('gid'),
              'ledger_id'=>$this->input->get('ledger_id'),
              'subject'=>'Metalite Industries',
              'mailbody'=>'Metalite Industries
              Dear Sir,
              This has with reference to your quotation and our talk, please find herewith attached purchase order.
              
              Kindly send your acceptance.
              
              ................
              Warm Regards,
              Venketeshwar Agrawal
              Metalite Industries
              Contact: +91 70528 99999',


              );
          }
          $this->load->view('invoice_mail_form',$data);
    }

    function mail_form_purchase(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Send Mail Modify',
              'vtype'=>'sendmail',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Send Mail',
              'vtype'=>'sendmail',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'gid'=>$this->input->get('gid'),
              'ledger_id'=>$this->input->get('ledger_id'),
              'subject'=>'Metalite Industries',
              'mailbody'=>'Metalite Industries
              Dear Sir,
              This has with reference to your quotation and our talk, please find herewith attached purchase order.
              
              Kindly send your acceptance.
              
              ................
              Warm Regards,
              Venketeshwar Agrawal
              Metalite Industries
              Contact: +91 70528 99999',


              );
          }
          $this->load->view('mail_form_purchase',$data);
    }


    function workorder_form(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Send Mail Modify',
              'vtype'=>'sendmail',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Send Mail',
              'vtype'=>'sendmail',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'gid'=>$this->input->get('gid'),
              'ledger_id'=>$this->input->get('ledger_id'),
              'subject'=>'Metalite Industries',
              'mailbody'=>'Metalite Industries
              Dear Sir,
              This has with reference to your quotation and our talk, please find herewith attached purchase order.
              
              Kindly send your acceptance.
              
              ................
              Warm Regards,
              Venketeshwar Agrawal
              Metalite Industries
              Contact: +91 70528 99999',


              );
          }
          $this->load->view('workorder_form',$data);
    }


    function invoice_whatsapp_form(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Send Mail Modify',
              'vtype'=>'sendmail',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Send Mail',
              'vtype'=>'sendmail',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'gid'=>$this->input->get('gid'),
              'ledger_id'=>$this->input->get('ledger_id'),
              'subject'=>'Metalite Industries',
              'mailbody'=>'Metalite Industries
              Dear Sir,
              This has with reference to your quotation and our talk, please find herewith attached purchase order.
              
              Kindly send your acceptance.
              
              ................
              Warm Regards,
              Venketeshwar Agrawal
              Metalite Industries
              Contact: +91 70528 99999',


              );
          }
          $this->load->view('invoice_whatsapp_form',$data);
    }

    function whatsapp_form(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Send WhatsApp Modify',
              'vtype'=>'WhatsApp',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Send WhatsApp',
              'vtype'=>'WhatsApp',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'gid'=>$this->input->get('gid'),
              'ledger_id'=>$this->input->get('ledger_id'),
              'subject'=>'Metalite Industries',
              'mailbody'=>'Metalite Industries
              Dear Sir,
              This has with reference to your quotation and our talk, please find herewith attached purchase order.
              
              Kindly send your acceptance.
              
              ................
              Warm Regards,
              Venketeshwar Agrawal
              Metalite Industries
              Contact: +91 70528 99999',


              );
          }
          $this->load->view('whatsapp_form',$data);
    }

    function whatsapp_form_wo(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Send WhatsApp Modify',
              'vtype'=>'WhatsApp',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Send WhatsApp',
              'vtype'=>'WhatsApp',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'gid'=>$this->input->get('gid'),
              'ledger_id'=>$this->input->get('ledger_id'),
              'subject'=>'Metalite Industries',
              'mailbody'=>'Metalite Industries
              Dear Sir,
              This has with reference to your quotation and our talk, please find herewith attached purchase order.
              
              Kindly send your acceptance.
              
              ................
              Warm Regards,
              Venketeshwar Agrawal
              Metalite Industries
              Contact: +91 70528 99999',


              );
          }
          $this->load->view('whatsapp_form_wo',$data);
    }

    function whatsapp_form_purchase(){
          $user_id=get_cookie('ae_user_id');
          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Send WhatsApp Modify',
              'vtype'=>'WhatsApp',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              );
          }
          else
          {
            $data=array(
              'title'=>'Send WhatsApp',
              'vtype'=>'WhatsApp',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'gid'=>$this->input->get('gid'),
              'ledger_id'=>$this->input->get('ledger_id'),
              'subject'=>'Metalite Industries',
              'mailbody'=>'Metalite Industries
              Dear Sir,
              This has with reference to your quotation and our talk, please find herewith attached purchase order.
              
              Kindly send your acceptance.
              
              ................
              Warm Regards,
              Venketeshwar Agrawal
              Metalite Industries
              Contact: +91 70528 99999',


              );
          }
          $this->load->view('whatsapp_form_purchase',$data);
    }

    function sales_return_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales Return"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
          }

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          $data=array(
            'title'=>'Sales Return',
            'vtype'=>'sales return',
            'poslist'=>pos_list(),
            'sourcelist'=>source_list(),
            'partylist'=>ledger_list(),
            'subdealerlist'=>sub_dealer_list(),
            'transporterlist'=>transporter_list(),
            'consigneelist'=>consignee_list(),
            'destinationlist'=>destination_list(),
            'categorylist'=>category_list(),
            'itemlist'=>item_list(),
            'godownlist'=>godown_list(),
            'p_entry'=>$p_entry,
            'p_modify'=>$p_modify,
            'p_delete'=>$p_delete,
            'p_list'=>$p_list,
            'p_bdate'=>$p_bdate
            );
          $this->load->view('sales_return_form',$data);
    }

    function invoice_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
          }

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Invoice Modify',
              'vtype'=>'invoice',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          else
          {
            $data=array(
              'title'=>'Invoice',
              'vtype'=>'invoice',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          $this->load->view('invoice_form',$data);
    }

    function voucher_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
          }

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Voucher Modify',
              'vtype'=>'voucher',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          else
          {
            $data=array(
              'title'=>'Voucher',
              'vtype'=>'voucher',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          $this->load->view('voucher_form',$data);
    }



    function purchase_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
          }

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Purchase Modify',
              'vtype'=>'purchase',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          else
          {
            $data=array(
              'title'=>'Purchase',
              'vtype'=>'purchase',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          $this->load->view('purchase_form',$data);
    }


    function work_order_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
          }

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Work Order Modify',
              'vtype'=>'work_order',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          else
          {
            $data=array(
              'title'=>'Work Order',
              'vtype'=>'work_order',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          $this->load->view('work_order_form',$data);
    }

    function q3format_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
          }

          $back_date=get_cookie('ae_back_date');
          $action=$this->input->get('action');
          if($action=="edit")
          {
            $q=$this->input->get('q');
            $data=array(
              'title'=>'Q3 format Modify',
              'vtype'=>'quatation',
              'poslist'=>pos_list(),
              'status'=>'edit',
              'id'=>$this->input->get('id'),
              'orderno'=>0,
              'sourcelist'=>source_list(),
              'partylist'=>ledger_list(),
              'q'=>$q,
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          else
          {
            $data=array(
              'title'=>'Q3 format',
              'vtype'=>'quatation',
              'orderno'=>0,
              'status'=>'add',
              'id'=>0,
              'poslist'=>pos_list(),
              'sourcelist'=>source_list(),
              'q'=>0,
              'partylist'=>ledger_list(),
              'subdealerlist'=>sub_dealer_list(),
              'transporterlist'=>transporter_list(),
              'consigneelist'=>consignee_list(),
              'destinationlist'=>destination_list(),
              'categorylist'=>category_list(),
              'itemlist'=>item_list(),
              'godownlist'=>godown_list(),
              'back_date'=>$back_date,
              'p_entry'=>$p_entry,
              'p_modify'=>$p_modify,
              'p_delete'=>$p_delete,
              'p_list'=>$p_list,
              'p_bdate'=>$p_bdate
              );
          }
          $this->load->view('q3format_form',$data);
    }

    
    function receipt_form(){
          $user_id=get_cookie('ae_user_id');
          $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Receipt"');
          //echo $this->db->last_query();die;
            if($query->num_rows()>0)    
            {          
                foreach($query->result() as $row)
                {
                  $p_entry=$row->p_entry;
                  $p_modify=$row->p_modify;
                  $p_delete=$row->p_delete;
                  $p_list=$row->p_list;
                  $p_bdate=$row->p_bdate;
                }
          }

          $back_date=get_cookie('ae_back_date');
          $data=array(
            'title'=>'Manage Receipt',
            'vtype'=>'receipt',
            'poslist'=>pos_list(),
            'sourcelist'=>source_list(),
            'partylist'=>ledger_list(),
            'modelist'=>mode_list(),
            'transporterlist'=>transporter_list(),
            'consigneelist'=>consignee_list(),
            'destinationlist'=>destination_list(),
            'categorylist'=>category_list(),
            'itemlist'=>item_list(),
            'godownlist'=>godown_list(),
            'p_entry'=>$p_entry,
            'p_modify'=>$p_modify,
            'p_delete'=>$p_delete,
            'p_list'=>$p_list,
            'p_bdate'=>$p_bdate
            );
          $action=$this->input->get('action');
          if($action=='pending')
          $data['orderno']=$this->input->get('id');
          else
                $data['orderno']=0;
          return $this->load->view('receipt_form',$data);

    }


    // function customes_list()
    // {
        // $ci=& get_instance();
        // $ci->load->database(); 

        // $query=$ci->db->query("select * from m_custome where company_id=" . get_cookie("ae_company_id") ." limit 1");
        // return $query->result();
    // }

  }
