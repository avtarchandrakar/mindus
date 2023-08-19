<?
if (!defined('BASEPATH')) exit('No direct script access allowed');

class helperController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        // echo 'This is Helper Controller !';
    }

    function insert($tableName, $id)
    {
    	$this->load->model('helper_model');
    	$this->helper_model->insert($tableName, null, $id);
    }

    function delete($tableName, $id)
	    {
	    	$this->load->model('helper_model');
	    	$status=$this->helper_model->delete($tableName, $id);
	    	if($status){
	    		echo "1";
	    	}
	    	else{
	    	    echo "2";	
	    	}
	    }
    function get_max_id($tablename, $id){
        $this->load->model('helper_model');
        $this->helper_model->get_max_id($tablename, $id);
    }
    //AutoComplete
    function get_ledger(){
        $this->load->model('helper_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->helper_model->get_ledger($q);
        }
    }
    function get_item(){
        $this->load->model('helper_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->helper_model->get_item($q);
        }
    }
    function get_item2(){
        $this->load->model('helper_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->helper_model->get_item2($q);
        }
    }
    function get_item3(){
        $this->load->model('helper_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->helper_model->get_item3($q);
        }
    }

    function get_item3_date(){
        $this->load->model('helper_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->helper_model->get_item3_date($q);
        }
    }

    function get_item4_date(){
        $this->load->model('helper_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->helper_model->get_item4_date($q);
        }
    }

    function get_city(){
        $this->load->model('helper_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->helper_model->get_city($q);
        }
    }
    //COMPANY LIST
       function company_list()
        {
            $id=$this->input->get('id');
            $lid=$this->input->get('id');
            $rst=array();
            $chktbl=$this->db->query('select c_id from tbl_ledger_assign_company where l_id='.$id.' and company_id='.get_cookie("ae_company_id"));
            if($chktbl->num_rows()>0){
                foreach($chktbl->result() as $data){
                    $rst[]=$data->c_id;
                }
            }
            $this->load->helper('common_helper');
            $this->load->model('helper_model');
            $result=$this->helper_model->company_list();
            if(count($result)>0)
            {
              foreach($result as $row){
                echo '<div class="form-group">';
                echo '<label class="col-sm-2 control-label no-padding-right" for="form-field-1">'.$row->name.'</label>';

                echo '<div class="col-sm-3">';
                echo '<input type="hidden" name="c_id[]" class="col-xs-10 col-sm-12" value="'.$row->id.'" />';
                if(in_array($row->id, $rst)){
                 echo '<input type="text" name="c_discount[]" placeholder="Discount Percentage" class="col-xs-10 col-sm-12" value="'.getCompanyDiscount($row->id,$lid).'" />';
                }else{
                 echo '<input type="text" name="c_discount[]" placeholder="Discount Percentage" class="col-xs-10 col-sm-12" />';
                }
                echo '</div>';
                echo '</div>';
              }
            }
        }
    //END COMPANY LIST
    //ITEM LIST
       function item_list()
        {
            $this->load->model('helper_model');
            $result=$this->helper_model->item_list();
            if(count($result)>0)
            {
              foreach($result as $row){
                echo '<tr><td>'. $row->name .'<input type="hidden" value="'.$row->i_id.'" name="itemid[]" class="col-xs-10 col-sm-12"/></td><td><input type="text" name="itemdis[]" placeholder="Amount" class="col-xs-10 col-sm-12" value="'.$row->i_discount.'"/></td></tr>';
              }
            }
        }

       
    //END ITEM LIST
    //Master Insert
    function m_insert($tableName, $id)
    {
        $this->load->model('helper_model');
        $this->helper_model->m_insert($tableName, null, $id);
    }


    function m_insert_ledger($tableName, $id)
    {
        $this->load->model('helper_model');
        $this->helper_model->m_insert_ledger($tableName, null, $id);
    }

    function m_employee($tableName, $id)
    {
        $this->load->model('helper_model');
        $this->helper_model->m_employee($tableName, null, $id);
    }

    function m_itemgroup($tableName, $id)
    {
        $this->load->model('helper_model');
        $this->helper_model->m_itemgroup($tableName, null, $id);
    }

    function m_insert1($tableName, $id)
    {
        $this->load->model('helper_model');
        $this->helper_model->m_insert1($tableName, null, $id);
    }


    function m_insert_category($tableName, $id)
    {
        $this->load->model('helper_model');
        $this->helper_model->m_insert_category($tableName, null, $id);
    }
    function m_insert_wt($tableName, $id) // Without Type
    {
        $this->load->model('helper_model');
        $this->helper_model->m_insert_wt($tableName, null, $id);
    }

    function m_insert_custome($tableName, $id) // Without Type
    {
        $this->load->model('helper_model');
        $this->helper_model->m_insert_custome($tableName, null, $id);
    }

    
    //End Master Insert
    //Dynamic dropdown
    function get_partyinfo_cmpt(){
        $this->load->model('helper_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->helper_model->get_partyinfo_cmpt($q);
        }
    }

    public function getPOSFromCompany(){
        $this->load->model('helper_model');
        $this->json->jsonReturn($this->helper_model->getPOSFromCompany());
    }
    public function getState(){
        $this->load->model('helper_model');
        $this->helper_model->getState();
    }

    public function getcust_details(){
        $this->load->model('helper_model');
        $this->helper_model->getcust_details();
    }
}
