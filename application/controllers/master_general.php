<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class master_general extends CI_Controller {
	
	    function __construct() {
	        parent::__construct();
	        $this->load->helper('common_helper');
			ini_set('post_max_size', '200M');  
	    }
	
	    function area() {
	        $this->load->view('area');
	    }

	    function SelectCompany(){
	    	$company_id= $this->input->get('company_id');
	    	$company_name= $this->input->get('company_name');
	    	$pos_id= $this->input->get('pos_id');
	    	$pos_name= $this->input->get('pos_name');
	    	$fnyear_id= $this->input->get('fnyear_id');
	    	$fnyear_name= $this->input->get('fnyear_name');

    		// set cookie
			$cookie = array(
			'name'   => 'company_id',
			'value'  => $company_id,
			'expire' => time()+86500,
			'path'   => '/',
			'prefix' => 'ae_',
			);
			 
			set_cookie($cookie);
			
			$cookie1 = array(
			'name'   => 'company_name',
			'value'  => $company_name,
			'expire' => time()+86500,
			'path'   => '/',
			'prefix' => 'ae_',
			);
			 
			set_cookie($cookie1);

			$cookie2 = array(
			'name'   => 'pos_id',
			'value'  => $pos_id,
			'expire' => time()+86500,
			'path'   => '/',
			'prefix' => 'ae_',
			);
			 
			set_cookie($cookie2);
			
			$cookie3 = array(
			'name'   => 'pos_name',
			'value'  => $pos_name,
			'expire' => time()+86500,
			'path'   => '/',
			'prefix' => 'ae_',
			);
			 
			set_cookie($cookie3);


			$cookie4 = array(
			'name'   => 'fnyear_id',
			'value'  => $fnyear_id,
			'expire' => time()+86500,
			'path'   => '/',
			'prefix' => 'ae_',
			);
			 
			set_cookie($cookie4);
			
			$cookie5 = array(
			'name'   => 'fnyear_name',
			'value'  => $fnyear_name,
			'expire' => time()+86500,
			'path'   => '/',
			'prefix' => 'ae_',
			);
			 
			set_cookie($cookie5);

			$dfrom='';
			$dto='';

			$query=$this->db->query("select * from m_finyear where id=" . $fnyear_id . "");
			foreach($query->result() as $row)
			{
				$dfrom=$row->dfrom;
				$dto=$row->dto;

				$cookie6 = array(
				'name'   => 'dfrom',
				'value'  => $dfrom,
				'expire' => time()+86500,
				'path'   => '/',
				'prefix' => 'ae_',
				);
				 
				set_cookie($cookie6);
				
				$cookie7 = array(
				'name'   => 'dto',
				'value'  => $dto,
				'expire' => time()+86500,
				'path'   => '/',
				'prefix' => 'ae_',
				);
				 
				set_cookie($cookie7);
			}

	    }

	    function SelectOtherCompany(){
			$cookie = array(
			    'name'   => 'company_id',
			    'value'  => '',
			    'expire' => '0',
			    'prefix' => 'ae_'
			    );
			 
			delete_cookie($cookie);

			$cookie1 = array(
			    'name'   => 'company_name',
			    'value'  => '',
			    'expire' => '0',
			    'prefix' => 'ae_'
			    );
			 
			delete_cookie($cookie1);

			$cookie2 = array(
			    'name'   => 'pos_id',
			    'value'  => '',
			    'expire' => '0',
			    'prefix' => 'ae_'
			    );
			 
			delete_cookie($cookie2);

			$cookie3 = array(
			    'name'   => 'pos_name',
			    'value'  => '',
			    'expire' => '0',
			    'prefix' => 'ae_'
			    );
			 
			delete_cookie($cookie3);
	    }

	    function loadform()
	    {
	    	$formname= $this->input->get('formname');
	    	if($formname=="Dashboard")
	    	{
	    		return $this->load->view('dashboardview');
	    	}
	    	if($formname=="Company")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('company',$data);
	    	}
	    	if($formname=="Item Brand")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('item_company',$data);
	    	}
	    	if($formname=="State Master")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('state',$data);
	    	}
	    	if($formname=="Item Category")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('item_category',$data);
	    	}
	    	if($formname=="Item Master Category")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('item_master_category',$data);
	    	}
	    	if($formname=="Party Wise Rate")
	    	{
	    		return $this->load->view('party_rate');
	    	}
	    	if($formname=="Party Wise Discount")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('party_discount_1',$data);
	    	}
	    	if($formname=="Period Wise SD")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('period_sd',$data);
	    	}
	    	if($formname=="Price List")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Price List State Wise"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('price_list_single',$data);
	    	}
	    	if($formname=="Customer Master")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ledger',$data);
	    	}

	    	if($formname=="Employee Registration")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('employee_registration',$data);
	    	}

	    	if($formname=="Employee Attendance")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('employee_attendance',$data);
	    	}

	    	if($formname=="Supplier Master")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('supplayer',$data);
	    	}


	    	if($formname=="Ledger Opening")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ledger_opening',$data);
	    	}

	    	if($formname=="Ledger Mobile No.")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ledger_mobile',$data);
	    	}

	    	if($formname=="Pending LR Entry")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    		$data=array(
	    			'title'=>'Pending LR Entry',
	    			'vtype'=>'sales',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('lr_entry',$data);
	    	}


	    	if($formname=="Pending LR Return")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Pending LR Entry"');
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
	    		$data=array(
	    			'title'=>'Pending LR Return',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('lr_entry_return',$data);
	    	}

	    	if($formname=="Send Challan SMS")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    		$data=array(
	    			'title'=>'Send Challan SMS',
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('send_challan_sms',$data);
	    	}

	    	if($formname=="Ledger Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ledger_report',$data);
	    	}

	    	if($formname=="Ledger Report-Multiple")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ledger_report_multiple',$data);
	    	}

	    	if($formname=="Ledger Report-Line Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ledger_report_line_new',$data);
	    	}

	    	if($formname=="Line Summary")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('line_summary',$data);
	    	}

	    	if($formname=="Salesman Wise Summary")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('salesman_wise_report',$data);
	    	}

	    	if($formname=="Ledger Report-Normal")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ledger_report_normal',$data);
	    	}

	    	if($formname=="Maintenance")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('maintenance',$data);
	    	}
	    	if($formname=="History")
	    	{
	    		return $this->load->view('history');
	    	}
	    	if($formname=="Party Delete")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('delete_party',$data);
	    	}
	    	if($formname=="All Delete")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('delete_all',$data);
	    	}
	    	if($formname=="Daily Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('daily_report',$data);
	    	}
	    	if($formname=="Daily Report Checking")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('daily_report_checking',$data);
	    	}
	    	if($formname=="Stock Report Detail")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('stock_report_detail',$data);
	    	}

	    	if($formname=="Stock Re-Order Detail")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('item_reorder_report',$data);
	    	}

	    	if($formname=="Stock Report Damage")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('stock_report_damage',$data);
	    	}

	    	if($formname=="RG Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);

	    		return $this->load->view('rg_report',$data);

	    	}

	    	if($formname=="Day Book")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('day_book',$data);
	    	}

	    	if($formname=="Quotation Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('quotation_report',$data);
	    	}

	    	if($formname=="Invoice Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('invoice_report',$data);
	    	}

	    	if($formname=="Purchase Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('purchase_report',$data);
	    	}

	    	if($formname=="Jobcard Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('jobcard_report',$data);
	    	}

	    	if($formname=="Requisition Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('requisition_report',$data);
	    	}


	    	if($formname=="Voucher Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('voucher_report',$data);
	    	}

	    	if($formname=="Daily Freight Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('daily_freight_report',$data);
	    	}


	    	if($formname=="Receipt Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'modelist'=>mode_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('receipt_report',$data);
	    	}	    	

	    	if($formname=="DrNote Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'modelist'=>mode_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('drnote_report',$data);
	    	}	    	

	    	if($formname=="CrNote Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'modelist'=>mode_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('crnote_report',$data);
	    	}	    	

	    	if($formname=="Sales-Category Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		
	    		return $this->load->view('sales_category_wise',$data);
	    	}
	    	if($formname=="Sales-Item Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
		    		'itemlist'=>item_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		
	    		return $this->load->view('sales_item_wise',$data);
	    	}
	    	if($formname=="Sales-Item Ledger")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
		    		'itemlist'=>item_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		
	    		return $this->load->view('sales_item_ledger',$data);
	    	}
	    	if($formname=="Sales-Master Category Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('sales_mastercategory_wise',$data);
	    	}
	    	if($formname=="Sales-Group Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('sales_group_wise',$data);
	    	}

	    	if($formname=="Sales-Brand Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
		    		'statelist'=>state_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('sales_brand_wise',$data);
	    	}

	    	if($formname=="Value Wise Sales of Customer")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('value_wise_sales',$data);
	    	}

	    	if($formname=="Qty Item Wise Sales Summary")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('qty_item_wise',$data);
	    	}

	    	if($formname=="Group Wise Sales Summary")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('group_wise_sale_summary',$data);
	    	}

	    	if($formname=="Pending Order Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('pending_order_report',$data);
	    	}


	    	if($formname=="Purchase-Category Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('purchase_category_wise',$data);
	    	}
	    	if($formname=="Purchase-Master Category Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('purchase_mastercategory_wise',$data);
	    	}
	    	if($formname=="Purchase-Group Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('purchase_group_wise',$data);
	    	}

	    	if($formname=="Discount Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('party_discount_r',$data);
	    	}

	    	if($formname=="SMS Setting")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$sms_value="";
	    		$query=$this->db->query('select sms_value from m_sms');
	    		if($query->num_rows()>0)    
		        {          
		          	foreach($query->result() as $row)
		          	{
		          		$sms_value=$row->sms_value;
		            }
		    	}

	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
	    			'sms_value'=>$sms_value,
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('sms_setting',$data);
	    	}

	    	if($formname=="Scanner Option")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'partylist'=>ledger_list(),
	    			'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('scanner',$data);
	    	}

	    	if($formname=="Rate Difference")
	    	{
	    		return $this->load->view('rate_difference');
	    	}
	    	if($formname=="Amount Difference")
	    	{
	    		return $this->load->view('amount_difference');
	    	}

	    	if($formname=="Ageing Report")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ageing',$data);
	    	}

	    	if($formname=="Ageing Report-State Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Ageing Report"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ageing_state',$data);
	    	}

	    	if($formname=="Ageing Report-Line Wise")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Ageing Report"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ageing_line',$data);
	    	}
	    	if($formname=="Ledger Group")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('ledgergroup',$data);
	    	}
	    	if($formname=="Destination")
	    	{
	    		return $this->load->view('destination');
	    	}
	    	if($formname=="Source")
	    	{
	    		return $this->load->view('source');
	    	}
	    	if($formname=="District")
	    	{
	    		return $this->load->view('district_master');
	    	}
	    	if($formname=="Area/Line Master")
	    	{
	    		return $this->load->view('line_group');
	    	}
	    	if($formname=="Item")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('item',$data);
	    	}

	    	if($formname=="Content Master")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('custome_master',$data);
	    	}


	    	if($formname=="Item Group")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('itemgroup',$data);
	    	}
	    	if($formname=="POS Location")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('poslocation',$data);
	    	}

	    	if($formname=="Salesman")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('salesman',$data);
	    	}

	    	if($formname=="Godown")
	    	{
	    		return $this->load->view('godown');
	    	}
	    	
	    	if($formname=="Chalan")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate,p_reprint from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
	    		if($query->num_rows()>0)    
		        {          
		          	foreach($query->result() as $row)
		          	{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;
		          		$p_reprint=$row->p_reprint;
		            }
		    	}
	    		$data=array(
	    			'title'=>'Manage Chalan',
	    			'vtype'=>'sales',
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
		    		'p_bdate'=>$p_bdate,
		    		'p_reprint'=>$p_reprint
	    			);
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('chalan',$data);
	    	}


	    	if($formname=="Order")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate,p_reprint from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
	    		if($query->num_rows()>0)    
		        {          
		          	foreach($query->result() as $row)
		          	{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;
		          		$p_reprint=$row->p_reprint;
		            }
		    	}
	    		$data=array(
	    			'title'=>'Manage Order',
	    			'vtype'=>'order',
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
		    		'p_bdate'=>$p_bdate,
		    		'p_reprint'=>$p_reprint
	    			);
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('order',$data);
	    	}
	    	
	    	if($formname=="Invoice")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    		return $this->load->view('invoice1',$data);
	    	}

	    	if($formname=="Sales")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    			'title'=>'Sales Modify',
		    			'vtype'=>'sale',
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
		    			'title'=>'Sales',
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
	    		return $this->load->view('sales',$data);
	    	}

	    	if($formname=="Quotation")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
	    		// echo $this->db->last_query();die;
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
		    			'title'=>'Quotation Modify',
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
		    			'godownlist'=>godown_list(),
		    			'back_date'=>$back_date,
		    			'p_entry'=>$p_entry,
		    			'p_modify'=>$p_modify,
		    			'p_delete'=>$p_delete,
		    			'p_list'=>$p_list,
		    			'p_bdate'=>$p_bdate
		    			);
	    		}
	    		return $this->load->view('quatation',$data);
	    	}

	    	if($formname=="Customer Purchase Order")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
	    		// echo $this->db->last_query();die;
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
		    			'back_date'=>$back_date,
		    			'p_entry'=>$p_entry,
		    			'p_modify'=>$p_modify,
		    			'p_delete'=>$p_delete,
		    			'p_list'=>$p_list,
		    			'p_bdate'=>$p_bdate
		    			);
	    		}
	    		return $this->load->view('approval',$data);
	    	}


	    	if($formname=="Jobcard")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
	    		// echo $this->db->last_query();die;
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
		    			'godownlist'=>godown_list(),
		    			'back_date'=>$back_date,
		    			'p_entry'=>$p_entry,
		    			'p_modify'=>$p_modify,
		    			'p_delete'=>$p_delete,
		    			'p_list'=>$p_list,
		    			'p_bdate'=>$p_bdate
		    			);
	    		}
	    		return $this->load->view('jobcard',$data);
	    	}

	    	if($formname=="Requisition Slip")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
	    		// echo $this->db->last_query();die;
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
		    			'godownlist'=>godown_list(),
		    			'back_date'=>$back_date,
		    			'p_entry'=>$p_entry,
		    			'p_modify'=>$p_modify,
		    			'p_delete'=>$p_delete,
		    			'p_list'=>$p_list,
		    			'p_bdate'=>$p_bdate
		    			);
	    		}
	    		return $this->load->view('requisition',$data);
	    	}

	    	if($formname=="Chalan Return")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate,p_reprint from tbl_user_permission where permission_id='.$user_id.' and form_id="Chalan"');
	    		if($query->num_rows()>0)    
		        {          
		          	foreach($query->result() as $row)
		          	{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;
		          		$p_reprint=$row->p_reprint;
		            }
		    	}
	    		$data=array(
	    			'title'=>'Manage Chalan Return',
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
		    		'p_bdate'=>$p_bdate,
		    		'p_reprint'=>$p_reprint
	    			);
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('chalan_return',$data);
	    	}

	    	if($formname=="Chalan Purchase")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate,p_reprint from tbl_user_permission where permission_id='.$user_id.' and form_id="Chalan"');
	    		if($query->num_rows()>0)    
		        {          
		          	foreach($query->result() as $row)
		          	{
		          		$p_entry=$row->p_entry;
		          		$p_modify=$row->p_modify;
		          		$p_delete=$row->p_delete;
		          		$p_list=$row->p_list;
		          		$p_bdate=$row->p_bdate;
		          		$p_reprint=$row->p_reprint;
		            }
		    	}
	    		$data=array(
	    			'title'=>'Manage Chalan Purchase',
	    			'vtype'=>'purchase',
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
		    		'p_bdate'=>$p_bdate,
		    		'p_reprint'=>$p_reprint
	    			);
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('chalan_purchase',$data);
	    	}
	    	if($formname=="Sales Return")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    			'title'=>'Sales Return Modify',
		    			'vtype'=>'sales return',
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
		    			'title'=>'Sales Return',
		    			'vtype'=>'sales return',
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
	    		return $this->load->view('sales_return',$data);


	    	}

	    	if($formname=="Receipt")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    		return $this->load->view('receipt',$data);
	    	}



	    	if($formname=="Payment")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    			'title'=>'Manage Payment',
	    			'vtype'=>'payment',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('payment',$data);
	    	}

	    	if($formname=="Cr Note")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    			'title'=>'Manage Cr Note',
	    			'vtype'=>'crnote',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('crnote',$data);
	    	}

	    	if($formname=="Dr Note")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    			'title'=>'Manage Dr Note',
	    			'vtype'=>'drnote',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('drnote',$data);
	    	}

	    	if($formname=="Voucher")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    			'title'=>'Manage Voucher',
	    			'vtype'=>'voucher',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('voucher',$data);
	    	}

	    	if($formname=="Purchase")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    			'title'=>'Manage Purchase',
	    			'vtype'=>'purchase',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('purchase',$data);
	    	}

	    	if($formname=="Work Order")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    			'title'=>'Work Order',
	    			'vtype'=>'work_order',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('work_order',$data);
	    	}

	    	if($formname=="Purchase Return")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
	    			'title'=>'Manage Purchase Return',
	    			'vtype'=>'purchase return',
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
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('purchase_return',$data);
	    	}
	    	if($formname=="Dispatch")
	    	{
	    		$data=array(
	    			'title'=>'Manage Dispatch',
	    			'vtype'=>'dispatch',
	    			'poslist'=>pos_list(),
	    			'sourcelist'=>source_list(),
	    			'partylist'=>ledger_list(),
	    			'subdealerlist'=>sub_dealer_list(),
	    			'transporterlist'=>transporter_list(),
	    			'consigneelist'=>consignee_list(),
	    			'destinationlist'=>destination_list(),
	    			'categorylist'=>category_list(),
	    			'itemlist'=>item_list(),
	    			'godownlist'=>godown_list()
	    			);
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('dispatch',$data);
	    	}
	    	if($formname=="Transfer")
	    	{
	    		$data=array(
	    			'title'=>'Manage Transfer',
	    			'vtype'=>'transfer',
	    			'poslist'=>pos_list(),
	    			'sourcelist'=>source_list(),
	    			'partylist'=>ledger_list(),
	    			'subdealerlist'=>sub_dealer_list(),
	    			'transporterlist'=>transporter_list(),
	    			'consigneelist'=>consignee_list(),
	    			'destinationlist'=>destination_list(),
	    			'categorylist'=>category_list(),
	    			'itemlist'=>item_list(),
	    			'godownlist'=>godown_list()
	    			);
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('dispatch',$data);
	    	}
	    	if($formname=="Invoice")
	    	{
	    		$data=array(
	    			'title'=>'Manage Invoice',
	    			'vtype'=>'dispatch',
	    			'poslist'=>pos_list(),
	    			'sourcelist'=>source_list(),
	    			'partylist'=>ledger_list(),
	    			'subdealerlist'=>sub_dealer_list(),
	    			'transporterlist'=>transporter_list(),
	    			'consigneelist'=>consignee_list(),
	    			'destinationlist'=>destination_list(),
	    			'categorylist'=>category_list(),
	    			'itemlist'=>item_list(),
	    			'godownlist'=>godown_list()
	    			);
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('invoice',$data);
	    	}
	    	if($formname=="Pending Bill Rate")
	    	{
	    		$data=array(
	    			'title'=>'Manage Pending Bill Rate',
	    			'vtype'=>'dispatch',
	    			'poslist'=>pos_list(),
	    			'sourcelist'=>source_list(),
	    			'partylist'=>ledger_list(),
	    			'subdealerlist'=>sub_dealer_list(),
	    			'transporterlist'=>transporter_list(),
	    			'consigneelist'=>consignee_list(),
	    			'destinationlist'=>destination_list(),
	    			'categorylist'=>category_list(),
	    			'itemlist'=>item_list(),
	    			'godownlist'=>godown_list()
	    			);
	    		$action=$this->input->get('action');
	    		if($action=='pending')
	    		$data['orderno']=$this->input->get('id');
	    		else
                $data['orderno']=0;
	    		return $this->load->view('pending_bill_rate',$data);
	    	}
	    	if($formname=="Generate Bill")
	    	{
	    		return $this->load->view('generate_bill');
	    	}
	    	if($formname=="Payment Freight List")
	    	{
	    		return $this->load->view('payment_freight_list');
	    	}
	    	if($formname=="Arrival")
	    	{
	    		$data=array(
	    			'title'=>'Manage Arrival',
	    			'vtype'=>'arrival',
	    			'poslist'=>pos_list(),
	    			'partylist'=>ledger_list(),
	    			'sourcelist'=>source_list(),
	    			'transporterlist'=>transporter_list(),
	    			'itemlist'=>item_list(),
	    			'godownlist'=>godown_list()
	    			);
	    		return $this->load->view('arrival',$data);
	    	}
	    	if($formname=="Order")
	    	{
	    		$action=$this->input->get('action');
	    		if($action=='edit'){
		    		$data=array(
		    			'title'=>'Order Modify',
		    			'status'=>'edit',
		    			'id'=>$this->input->get('id'),
		    			'vtype'=>'dispatch',
		    			'poslist'=>pos_list(),
		    			'sourcelist'=>source_list(),
		    			'partylist'=>ledger_list(),
		    			'subdealerlist'=>sub_dealer_list(),
		    			'transporterlist'=>transporter_list(),
		    			'consigneelist'=>consignee_list(),
		    			'destinationlist'=>destination_list(),
		    			'categorylist'=>category_list(),
		    			'itemlist'=>item_list(),
		    			'godownlist'=>godown_list()
		    			);
	    	   }else{
		    		$data=array(
		    			'title'=>'Order',
		    			'vtype'=>'dispatch',
		    			'status'=>'add',
		    			'id'=>'',
		    			'poslist'=>pos_list(),
		    			'sourcelist'=>source_list(),
		    			'partylist'=>ledger_list(),
		    			'subdealerlist'=>sub_dealer_list(),
		    			'transporterlist'=>transporter_list(),
		    			'consigneelist'=>consignee_list(),
		    			'destinationlist'=>destination_list(),
		    			'categorylist'=>category_list(),
		    			'itemlist'=>item_list(),
		    			'godownlist'=>godown_list()
		    			);
	    	   }
	    		return $this->load->view('order',$data);
	    	}
	    	if($formname=="Pending Order")
	    	{
	    		$data=array(
	    			'title'=>'Manage Pending Order',
	    			'vtype'=>'ORDER',
	    			'poslist'=>pos_list(),
	    			'partylist'=>ledger_list(),
	    			'subdealerlist'=>sub_dealer_list(),
	    			'consigneelist'=>consignee_list(),
	    			'destinationlist'=>destination_list(),
	    			'itemlist'=>item_list()
	    			);
	    		return $this->load->view('pending_order',$data);
	    	}
	    	if($formname=="Payment Freight")
	    	{
	    		$action=$this->input->get('action');
	    		if($action=='edit'){
	    		$data=array(
	    			'title'=>'Edit Payment Freight',
	    			'status'=>'edit',
	    			'id'=>$this->input->get('id'),
	    			'vtype'=>'freight',
	    			'poslist'=>pos_list(),
	    			'cash_in_hand_list'=>cash_in_hand_list(),
	    			'indirect_expenses_list'=>indirect_expenses_list()
	    			);
	    	   }else{
	    	   $data=array(
	    			'title'=>'Add Payment Freight',
	    			'status'=>'add',
	    			'id'=>'',
	    			'vtype'=>'freight',
	    			'poslist'=>pos_list(),
	    			'cash_in_hand_list'=>cash_in_hand_list(),
	    			'indirect_expenses_list'=>indirect_expenses_list()
	    			);
	    	   }
	    		return $this->load->view('payment_freight',$data);
	    	}
	    	if($formname=="Dispatch List")
	    	{
	    		$data=array(
	    			'title'=>'Dispatch List',
	    			'vtype'=>'dispatch',
	    			'poslist'=>pos_list(),
	    			'partylist'=>ledger_list(),
	    			'subdealerlist'=>sub_dealer_list(),
	    			'transporterlist'=>transporter_list(),
	    			'consigneelist'=>consignee_list(),
	    			'destinationlist'=>destination_list(),
	    			'itemlist'=>item_list(),
	    			'godownlist'=>source_list(),
	    			'categorylist'=>category_list()
	    			);
	    		return $this->load->view('dispatch_list',$data);
	    	}
	    	if($formname=="Arrival List")
	    	{
	    		$data=array(
	    			'title'=>'Arrival List',
	    			'vtype'=>'ARRIVAL',
	    			'sourcelist'=>source_list(),
	    			'partylist'=>ledger_list(),
	    			'transporterlist'=>transporter_list(),
	    			'itemlist'=>item_list(),
	    			'godownlist'=>godown_list()
	    			);
	    		return $this->load->view('arrival_list',$data);
	    	}
	    	if($formname=="Order List")
	    	{
	    		$data=array(
	    			'title'=>'Order List',
	    			'vtype'=>'ORDER',
	    			'partylist'=>ledger_list(),
	    			'itemlist'=>item_list()
	    			);
	    		return $this->load->view('view_order',$data);
	    	}
	    	if($formname=="Order List Live")
	    	{
	    		$data=array(
	    			'title'=>'Order List',
	    			'vtype'=>'ORDER',
	    			'partylist'=>ledger_list(),
	    			'itemlist'=>item_list()
	    			);
	    		return $this->load->view('view_order_auto',$data);
	    	}
	    	if($formname=="Order Modify")
	    	{
	    		$data=array(
	    			'title'=>'Order Modify',
	    			'vtype'=>'ORDER',
	    			'partylist'=>ledger_list(),
	    			'itemlist'=>item_list()
	    			);
	    		return $this->load->view('order_modify',$data);
	    	}
	    	if($formname=="Order Adjustment")
	    	{
	    		$data=array(
	    			'title'=>'Order Adjustment',
	    			'vtype'=>'ORDER',
	    			'partylist'=>ledger_list(),
	    			'itemlist'=>item_list()
	    			);
	    		return $this->load->view('order_adjust',$data);
	    	}
	    	if($formname=="Database Backup")
	    	{
	    		return $this->load->view('database_backup');
	    	}
	    	if($formname=="Company Split")
	    	{
	    		return $this->load->view('company_split');
	    	}

	    	//Start By Ram(21-05-2015)
	    	if($formname=="User Add")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="User Management"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('user_mgmt',$data);
	    	}
	    	if($formname=="User List")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="User Management"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);
	    		return $this->load->view('user_mgmt_list',$data);
	    	}
	    	//End By Ram(21-05-2015)
	    	if($formname=="Database Backup")
	    	{
	    		return $this->load->view('database_backup');
	    	}
	    	//Start By Ram(27-04-2015)
	    	if($formname=="Generate Bill List")
	    	{
	    		$data=array(
	    			'categorylist'=>category_list()
	    			);
	    		return $this->load->view('generate_bill_list',$data);
	    	}
	    	//End By Ram(27-04-2015)
	    	//Start By Ram(01-05-2015)
	    	if($formname=="Summary Report Party wise")
	    	{
	    		return $this->load->view('summary_report_party_wise');
	    	}
	    	if($formname=="Summary Report Godown wise")
	    	{	    		
	    		return $this->load->view('summary_report_godown_wise');
	    	}
	    	//End By Ram(01-05-2015)
	    	//Start By Ram(10-06-2015)
	    	if($formname=="User Permission")
	    	{	    
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);		
	    		return $this->load->view('user_permission',$data);
	    	}
	    	if($formname=="User Permission Form")
	    	{
	    		$user_id=get_cookie('ae_user_id');
	    		$query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="'.$formname.'"');
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
		    	$data=array(
		    		'p_entry'=>$p_entry,
		    		'p_modify'=>$p_modify,
		    		'p_delete'=>$p_delete,
		    		'p_list'=>$p_list,
		    		'p_bdate'=>$p_bdate
	    			);	    		
	    		return $this->load->view('permission_form',$data);
	    	}
	    	//End By Ram(10-06-2015)
	     }
	    function area_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->area_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->area_name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info" title="Edit" onclick="GetRecord(' . $row->area_id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger" title="Delete" onclick="DeleteRecord(' . $row->area_id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function area_save()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->area_save();
	    }
	    function area_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->area_get();
	    }


//LEDGER STARTS
	    function ledger_save()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->ledger_save();
	    }

	    function supplayer_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->supplayer_list();
	    	// print_r($result);
	    	if(count($result)>0)
	    	{
		        echo '<table id="TblList" class="table table-striped table-bordered table-hover" style="font-size:11px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>Group</th>';
		        echo '            <th>District</th>';
		        echo '            <th>State</th>';
		        echo '            <th>Line Group</th>';
		        echo '            <th>Op.Balance</th>';
		        echo '            <th>Mobile No.</th>';
		        echo '            <th>Credit Limit</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->group_name . '</td>';
	                echo '    <td>' . $row->district . '</td>';
	                echo '    <td>' . $row->statename . '</td>';
	                echo '    <td>' . $row->linegroup . '</td>';
	                echo '    <td>' . $row->opbalance . '</td>';
	                echo '    <td>' . $row->mobileno . '</td>';
	                echo '    <td>' . $row->climit . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
          echo '<center>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
                  </center>';
          echo '<br>';

	    	}
	    }


	    function ledger_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->ledger_list();
	    	// print_r($result);
	    	if(count($result)>0)
	    	{
		        echo '<table id="TblList" class="table table-striped table-bordered table-hover" style="font-size:11px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>Group</th>';
		        echo '            <th>District</th>';
		        echo '            <th>State</th>';
		        echo '            <th>Line Group</th>';
		        echo '            <th>Op.Balance</th>';
		        echo '            <th>Mobile No.</th>';
		        echo '            <th>Credit Limit</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->group_name . '</td>';
	                echo '    <td>' . $row->district . '</td>';
	                echo '    <td>' . $row->statename . '</td>';
	                echo '    <td>' . $row->linegroup . '</td>';
	                echo '    <td>' . $row->opbalance . '</td>';
	                echo '    <td>' . $row->mobileno . '</td>';
	                echo '    <td>' . $row->climit . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
          echo '<center>
        <button class="btn btn-primary" onClick ="exportExcel();">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
                  </center>';
          echo '<br>';

	    	}
	    }
	    function ledger_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->ledger_get();
	    }

	    function states_get()
	    {
	    	$html = '';
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->states_get();
	    	if(count($result)>0)
	    	{
	    		foreach($result as $row)
		        {
		        	$html = $html."<option value='".$row->name."'>".$row->name."</option>";
		        }
		    }
		    echo $html;
	    }

	    function employee_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->employee_get();
	    }
//LEDGER ENDS





//DESTINATION STARTS
	    function destination_save()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->destination_save();
	    }
	    function destination_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->destination_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>Freight(PMT)</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->freight . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_del" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function destination_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->destination_get();
	    }

//DESTINATION ENDS




//SOURCE STARTS
	    function source_save()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->source_save();
	    }
	    function source_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->source_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>Freight</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->freight . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_del" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function source_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->source_get();
	    }

//SOURCE ENDS






//ITEM GROUP STARTS
	    function itemgroup_save()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->itemgroup_save();
	    }
	    function itemgroup_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->itemgroup_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>Packing</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->vat . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function itemgroup_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->itemgroup_get();
	    }

//ITEM GROUP ENDS
	    //ITEM category STARTS
	   
	    function itemcategory_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->itemcategory_get();
	    }

	    function itemcategory_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->itemcategory_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>Master Category</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->mastercategory . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    

//ITEM category ENDS


	    //ITEM category STARTS
	   
	    function mastercategory_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->mastercategory_get();
	    }

	    function mastercategory_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->mastercategory_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>CD Applicable</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->prefix . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    

//ITEM category ENDS





//ITEM STARTS
	    function item_save()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->item_save();
	    }

	    function custome_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->custome_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Ref</th>';
		        echo '            <th>Sub</th>';
		        echo '            <th>Header</th>';
		        echo '            <th>Taxes</th>';
		        echo '            <th>Scope of Work</th>';
		        echo '            <th>Design Criteria</th>';
		        echo '            <th>Delivery Period</th>';
		        echo '            <th>Payment Terms</th>';
		        echo '            <th>Validity of offer</th>';
		        echo '            <th>Note</th>';
		        echo '            <th>Performance Warranty</th>';
		        echo '            <th>Equipment Acceptance</th>';
		        echo '            <th>Supervision of Erection &amp; Commissioning</th>';
		        echo '            <th>Training</th>';
		        echo '            <th>General Safety</th>';
		        echo '            <th>Spare Parts</th>';
		        echo '            <th>Transportation of chassis &amp; equipment</th>';
		        echo '            <th>GST Tax</th>';
		        echo '            <th>Mobile Crane</th>';
		        echo '            <th>Scope Of Unloading</th>';
		        echo '            <th>Overdue Intrest & Wherehousing Charge</th>';
		        echo '            <th>Cancellation</th>';
		        echo '            <th>Jurisdication</th>';
		        echo '            <th>Documents Provided During Delivery</th>';
		        echo '            <th>Load Test</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->ref . '</td>';
	                echo '    <td>' . $row->sub . '</td>';
	                echo '    <td>' . $row->header . '</td>';
	                echo '    <td>' . $row->taxes . '</td>';
	                echo '    <td>' . $row->scope_of_work . '</td>';
	                echo '    <td>' . $row->design_criteria . '</td>';
	                echo '    <td>' . $row->delivery_period . '</td>';
	                echo '    <td>' . $row->payment_terms . '</td>';
	                echo '    <td>' . $row->validity_of_offer . '</td>';
	                echo '    <td>' . $row->note . '</td>';
	                echo '    <td>' . $row->performance_warranty . '</td>';
	                echo '    <td>' . $row->equipment_acceptance . '</td>';
	                echo '    <td>' . $row->supervision_commissioning . '</td>';
	                echo '    <td>' . $row->training . '</td>';
	                echo '    <td>' . $row->general_safety . '</td>';
	                echo '    <td>' . $row->spare_parts . '</td>';
	                echo '    <td>' . $row->chassis_equipment . '</td>';
	                echo '    <td>' . $row->gst_tax . '</td>';
	                echo '    <td>' . $row->mobile_crane . '</td>';
	                echo '    <td>' . $row->scope_of_unloading . '</td>';
	                echo '    <td>' . $row->intrest_charge . '</td>';
	                echo '    <td>' . $row->cancellation . '</td>';
	                echo '    <td>' . $row->jurisdication . '</td>';
	                echo '    <td>' . $row->documents_provided . '</td>';
	                echo '    <td>' . $row->load_test . '</td>';

	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }

	    function item_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->item_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>Specifiation</th>';
		        echo '            <th>Group</th>';
		        echo '            <th>HSN No</th>';
		        echo '            <th>Alert QTY</th>';
		        echo '            <th>Unit</th>';
		        echo '            <th>Unit Type</th>';
		        echo '            <th>Unit Rate</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->specification . '</td>';
	                echo '    <td>' . $row->group_name . '</td>';
	                echo '    <td>' . $row->hsn_no . '</td>';
	                echo '    <td>' . $row->reorder . '</td>';
	                echo '    <td>' . $row->unit . '</td>';
	                echo '    <td>' . $row->unittype . '</td>';
	                echo '    <td>' . $row->unitrate . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function item_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->item_get();
	    }

	    function custome_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->custome_get();
	    }

//ITEM ENDS
	    //START POS LOCATION
	    function pos_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->pos_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }

	    function salesmanlist()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->salesmanlist();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }

	    function pos_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->pos_get();
	    }
	    //END POS LOCATION
	    //START Item Company
	    function item_company_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->item_company_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function item_company_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->item_company_get();
	    }
	    //END Item Company
	    //START GODOWN
	    function godown_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->godown_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_del" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function godown_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->godown_get();
	    }
	    //END GODOWN
	    //DISTRICT MASTER
	    function district_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->district_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function district_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->district_get();
	    }


	    //DISTRICT MASTER
	    function line_group_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->line_group_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function line_group_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->line_group_get();
	    }




	    ////Start State
	      function state_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->state_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function state_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->state_get();
	    }
	    ///End State
	    //END DISTRICT MASTER
	    //LEDGER GROUP
	    function ledgergroup_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->ledgergroup_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>GroupName</th>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->parent . '</td>';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function ledgergroup_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->ledgergroup_get();
	    }
	    function ledgergroup_save()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->ledgergroup_save();
	    }

	    function CheckFinYear(){
	    	$cdate= $this->input->get('cdate');
	    	$dfrom=get_cookie('ae_dfrom');
	    	$dto=get_cookie('ae_dto');
	    	if(strtotime($cdate)>=strtotime($dfrom) && strtotime($cdate)<=strtotime($dto))
	    	{
	    		echo "1";
	    	}
	    	else
	    	{
	    		echo "0";
	    	}
		}	    
		//User Management
		function user_save()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->user_save();
	    }
		function user_password()
	    {
	    	$userid = $this->input->post("userid");
	    	$password = $this->input->post("password");

	    	$data=array(
	    				'password'=>md5($password)
	    				);
	    		$this->db->where("id",$userid);
				$this->db->update("m_user",$data);

				echo "1";    		
	    }
	    function user_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->user_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:150px;">Name</th>';
		        // echo '            <th>User Type</th>';
		        // echo '            <th>User Permission</th>';
		        echo '            <th style="width:150px;">IP Address</th>';
		        echo '            <th style="width:150px;">Back Date</th>';
		        echo '            <th   style="width:120px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
		        	if($row->permission==1){
		        		$permission='Admin';
		        	}else if($row->permission==2){
                        $permission='Manager';
		        	}else{
		        		$permission='Operator';
		        	}
	                echo '<tr class="">';
	                echo '    <td class="username_1">' . $row->username . '</td>';
	                // echo '    <td>' . $row->type . '</td>';
	                // echo '    <td>' . $permission . '</td>';
	                echo '    <td>' . $row->ip_address . '</td>';
	                echo '    <td>' . $row->back_date . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;" style="margin-right:20px;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Change Password" onclick="GetPassword(' . $row->id .',this);return false;" style="margin-right:20px;">';
					echo '			    Change Password';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function user_get()
	    {
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->user_get();
	    }
		//End User Management
	    function item_list_party()
	    {
	    	$party_id=$this->input->get('party_id');

			$query=$this->db->query("select id,name,(select rate from m_party_rate where party_id=".$party_id." and item_id=m_item.id limit 0,1) as rate from m_item  order by name");
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:200px;">Name</th>';
		        echo '            <th style="width:100px;">Rate</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                echo '		<input type="text" name="rate[]" value="'.$row->rate.'"><input type="hidden" name="item_id[]" value="'.$row->id.'">';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }

//////
	      function item_list_discount()
	    {
	    	$party_id=$this->input->get('party_id');
	 
			$query=$this->db->query("select id,name,(select rate from m_party_discount where party_id=".$party_id." and item_id=m_master.id limit 0,1) as rate,(select percent from m_party_discount where party_id=".$party_id." and item_id=m_master.id limit 0,1) as percent from m_master where type='MASTER CATEGORY' order by name");
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:200px;">Name</th>';
		        echo '            <th style="width:100px;">% (Percentage)</th>';
		        echo '            <th style="width:100px;">Discount</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';
		        foreach($result as $row)
		        {
		        	echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                echo '		<input type="text" name="percent[]" value="'.$row->percent.'">';
	                echo '    </td>';
	                echo '    <td>';
	                echo '		<input type="text" name="rate[]" value="'.$row->rate.'" ><input type="hidden" name="item_id[]" value="'.$row->id.'">';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }
	    ///////////

		function period_sd_list()
	    {
	    	$state_id=$this->input->get('state_id');

			$query=$this->db->query("select id,name,(select rate from m_state_rate where state_id=".$state_id." and item_id=m_item.id limit 0,1) as rate from m_item  order by name");
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:200px;">Name</th>';
		        echo '            <th style="width:100px;">Rate</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                echo '		<input type="text" name="rate[]" value="'.$row->rate.'"><input type="hidden" name="item_id[]" value="'.$row->id.'">';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }

	    //////////////////////
	    function item_party_save()
	    {
			$party_id=$this->input->post('party_id');
			$item_id=$this->input->post("item_id",TRUE);
			$rate=$this->input->post("rate",TRUE);

            try
            {
				$this->db->trans_begin();
				$this->db->where('party_id',$party_id);
				$this->db->delete("m_party_rate");

				$zipped = array_map(null,$item_id,$rate);
				foreach($zipped as $tuple) {
	            if($tuple[0]!='' && ($tuple[1]!=0))
    	        {
	                $data2=array(
	                "party_id"=>$party_id,
	                "item_id"=>$tuple[0],
	                "rate"=>$tuple[1]
	                );
					$this->db->insert("m_party_rate",$data2);
	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }




	   


	    function item_party_Periodsd()
	    {
			$state_id=$this->input->post('state_id');
			$item_id=$this->input->post("item_id",TRUE);
			$rate=$this->input->post("rate",TRUE);

            try
            {
				$this->db->trans_begin();
				$this->db->where('state_id',$party_id);
				$this->db->delete("m_period_sd");

				$zipped = array_map(null,$item_id,$rate);
				foreach($zipped as $tuple) {
	            if($tuple[0]!='' && ($tuple[1]!=0))
    	        {
	                $data2=array(
	                "state_id"=>$state_id,
	                "item_id"=>$tuple[0],
	                "rate"=>$tuple[1]
	                );
					$this->db->insert("m_period_sd",$data2);
	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }
	    ///////////

	    public function party_rate_getdiscount()
		{
	        $party_id = $this->input->get("party_id");
	        $item_id = $this->input->get("item_id");

	        if($party_id!=0 && $item_id!=0)
	        {
		        $query=$this->db->query("select * from m_party_discount where party_id=".$party_id." and item_id=".$item_id);
		        $result=$query->result();
		        if(count($result)>0)
		        {
		          foreach($result as $row)
		          {
		            $data = array(
		                "rate"=>$row->rate
		              );
		          }
		        }
		        else
		        {
		            $data = array(
		                "rate"=>""
		              );
		        }
	        }
	        else
	        {
		            $data = array(
		                "rate"=>""
		              );
	        }
	        echo json_encode($data);
	    }	

	    ////////////
 		public function party_discount_get()
		{ 
	        $party_id = $this->input->get("party_id");
	        $item_id = $this->input->get("item_id");

	        if($party_id!=0 && $item_id!=0)
	        {
	        	$category_id=0;
		        $query=$this->db->query("select c.parent_id from m_item i,m_master c where i.category_id=c.id and i.id=" .$item_id);
			 	$result=$query->result();
					if(count($result)>0)
				{
					foreach($result as $row)
			          {
			            $category_id=$row->parent_id;
			          }
				}
	        
		        $query2=$this->db->query("select * from m_party_discount where party_id=".$party_id." and item_id=".$category_id);
		        $result2=$query2->result();
		        if(count($result2)>0)
		        {
		          foreach($result2 as $row2)
		          {
		            $data = array(
		                "discountrs"=>$row2->rate,
		                "discountper" =>$row2->percent
		              );
		          }
		        }
		        else
		        {
		            $data = array(
		                "discount"=>""
		              );
		        }
	        }
	        else
	        {
		            $data = array(
		                "discount"=>""
		              );
	        }
	        echo json_encode($data);
	    }

		public function getorderbalqty()
		{
	        $party_id = $this->input->get("party_id");
	        $item_id = $this->input->get("item_id");

	        if($party_id!=0 && $item_id!=0)
	        {    	        
	        	$query2=$this->db->query("select * from tbl_order_bal where ledger_id=".$party_id." and item_id=".$item_id);
		        $result2=$query2->result();
		        if(count($result2)>0)
		        {
		          foreach($result2 as $row2)
		          {
		            $data = array(
		                "bal_qty"=>$row2->bal
		              );
		          }
		        }
		    }
		    else
		    {
		        $data = array(
		           	"bal_qty"=>""
		        );
		    }	        
	        echo json_encode($data);
	    }






	    ///////////
		public function party_rate_get()
		{
	        $party_id = $this->input->get("party_id");
	        $item_id = $this->input->get("item_id");
			if($party_id!=0 && $item_id!=0)
	        {
				$query=$this->db->query("select * from m_ledger where id=" .$party_id);
				 $result=$query->result();
						if(count($result)>0)
					{
						foreach($result as $row)
				          {
				            $state=$row->state;
				             
				          }
					}
				$query1=$this->db->query("select * from m_master where name='".$state."' and company_id=".get_cookie('ae_company_id'));
				 $result1=$query1->result();
						if(count($result1)>0)
						        {foreach($result1 as $row1)
			          {
			            $state_id=$row1->id;
			             
			          }
			        }

			     $query3=$this->db->query("select * from m_item where id='".$item_id."'");
				 $result3=$query3->result();
						if(count($result3)>0)
						        {foreach($result3 as $row3)
			          {
			            $group_id=$row3->group_id;

			             
			          }
			        }
			
		        $query2=$this->db->query("select * from m_state_rate where state_id=".$state_id." and item_id=".$group_id);
		        $result2=$query2->result();
		        if(count($result2)>0)
		        {
		          foreach($result2 as $row2)
		          {
		            $data = array(
		                "rate"=>$row2->rate
		              );  
		          }
		        }
		        else
		        {
		            $data = array(
		                "rate"=>""
		              );
		        }
	        }
	        else
	        {
		            $data = array(
		                "rate"=>""
		              );
	        }
	        echo json_encode($data);
	    }


//////////////
		public function party_rate_get_single()
		{
	        $item_id = $this->input->get("item_id");
	        $cdate = $this->input->get("cdate");
	        $ledger_id = $this->input->get("ledger_id");
	        $cdate = date('Y-m-d',strtotime($cdate));
			
	        $rate = '';
	        $unit='';
	        $specification='';
	        $queryu=$this->db->query(" select unit,specification from m_item where id='".$item_id."'");
	        if ($queryu->num_rows()>0) 
	        {
	        	foreach ($queryu->result() as $rowu)
	        	{
	        		$unit=$rowu->unit;
	        		$specification=$rowu->specification;
	        	}
	        }



	        $data = array(
	                "rate"=>$rate,
	                "unit" => $unit,
	                "specification" => $specification
	              );

	        echo json_encode($data);
	    }



 function item_list_state()
	    {
	    	$state_id=$this->input->get('state_id');

			$query=$this->db->query("select m.id,m.name,'' as rate, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP'  group by m.id,m.name,imc.name order by imc.name,m.name");
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
	    		echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo' <tr>';
		        echo '<th>Date : <input type ="text" id = "date" name="date" class="cdate"></th>';
		        
				echo '</table>';

		        echo '<table class="table table-striped table-bordered table-hover" style="width:600px;">';
		       

		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Master Category</th>';
		        echo '            <th style="width:200px;">Name</th>';
		        echo '            <th style="width:100px;">Rate</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->MasterCategory . '</td>';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                echo '		<input type="text" name="rate[]" value="'.$row->rate.'"><input type="hidden" name="item_id[]" value="'.$row->id.'">';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }


 function price_list_state_wise()
	    {
	    	$cat_id=$this->input->get('cat_id');
	    	$state_id=$this->input->get('state_id');

	       	$state_array = array();
	       	$state_array_id = array();
	       	$state_rate=array();
		    $query=$this->db->query('select m.id,m.name from m_master m where m.company_id='.get_cookie('ae_company_id').' and m.type="STATE"  group by m.name,m.id order by m.name'); 
			if($query->num_rows()>0){
			 foreach($query->result() as $row){
			  $state_array[] = $row->name;
			  $state_array_id[] = $row->id;
			  $state_rate[] = 0;
			 }
			}

			if($cat_id==0)
			{
				$query=$this->db->query("select m.id,m.name, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP'  group by m.id,m.name,imc.name order by imc.name,m.name");
			}
			else
			{
				$query=$this->db->query("select m.id,m.name, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where imc.id=".$cat_id." and i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP'  group by m.id,m.name,imc.name order by imc.name,m.name");
			}
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
	    		echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo' <tr>';
		        echo '<th>Date : <input type ="text" id = "date" name="date" class="cdate"></th>';
		        
				echo '</table>';

		        echo '<table class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
		       

		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Master Category</th>';
		        echo '            <th style="width:200px;">Name</th>';
		        foreach($state_array as $item)
		        {
		          echo '<th style="width:50px;text-align:center;">'.$item.'</td>';
		        }
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->MasterCategory . '</td>';
	                echo '    <td>' . $row->name . '</td>';
	                $i=0;
			        foreach($state_rate as $item)
			        {
						if($state_array_id[$i]!=$state_id)
						{
			                echo '    <td>';
			                echo '		';
			                echo '    </td>';

						}
						else
						{
			                echo '    <td>';
			                echo '		<input style="width:50px;" type="text" name="rate[]" value="'.$item.'"><input type="hidden" name="item_id[]" value="'.$row->id.'"><input type="hidden" name="state_id[]" value="'.$state_array_id[$i].'">';
			                echo '    </td>';
						}

		                $i++;
			        }
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }

 function date_list_state()
	    {
			$query=$this->db->query("select pdate from m_state_rate group by pdate order by pdate");
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		       

		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:200px;">Date</th>';
		        echo '            <th style="width:100px;">&nbsp;</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . date('d-m-Y',strtotime($row->pdate)) . '</td>';
	                echo '    <td>';
					echo '		<button class="btn btn-info" type="button" onclick=GetListDate("'.date('d-m-Y',strtotime($row->pdate)).'"); >';
					echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
					echo '			Modify';
					echo '		</button>';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
	    	}
	    }

 function item_list_state_date()
	    {
	    	$pdate=$this->input->get('pdate');
	    	$state_id=$this->input->get('state_id');

			$query=$this->db->query("select m.id,m.name,(select rate from m_state_rate where state_id=".$state_id." and item_id=m.id and pdate='".date('Y-m-d',strtotime($pdate))."' limit 0,1) as rate, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP' group by m.id,m.name,imc.name order by imc.name,m.name");
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
	    		echo '<table id="" class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo' <tr>';
		        echo '<th>Date : <input type ="text" id = "date" name="date" value="'.$pdate.'" class="cdate"></th>';
		        
				echo '</table>';

		        echo '<table id="TblList" class="table table-striped table-bordered table-hover" style="width:600px;">';
		       

		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Master Category</th>';
		        echo '            <th style="width:200px;">Name</th>';
		        echo '            <th style="width:100px;">Rate</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->MasterCategory . '</td>';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                echo '		<input type="text" name="rate[]" value="'.$row->rate.'"><input type="hidden" name="item_id[]" value="'.$row->id.'">';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';

          echo '<center>
        <button class="btn btn-primary" onClick ="exportExcel();return false;">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
                  </center>';

	    	}
	    }


	    function item_list_Periodsd()
	    {
	    	$state_id=$this->input->get('state_id');
	    	$from=$this->input->get('from');
	    	$to=$this->input->get('to');

			$query=$this->db->query("select id,name,(select rate from m_period_sd where state_id=".$state_id." and item_id=m_master.id limit 0,1) as rate from m_master where type='Item Group'  order by name");
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:200px;">Group</th>';
		        echo '            <th style="width:100px;">SD</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                echo '		<input type="text" name="rate[]" value="'.$row->rate.'"><input type="hidden" name="item_id[]" value="'.$row->id.'">';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }

	     function item_party_savediscount()
	    {
			$party_id=$this->input->post('party_id');
			$item_id=$this->input->post("item_id",TRUE);
			$rate=$this->input->post("rate",TRUE);
			$percent=$this->input->post("percent",TRUE);

            try
            {
				$this->db->trans_begin();
				$this->db->where('party_id',$party_id);
				$this->db->delete("m_party_discount");

				$zipped = array_map(null,$item_id,$rate,$percent);
				foreach($zipped as $tuple) {
			        $query=$this->db->query("delete from m_party_discount where party_id=".$party_id." and item_id=".$tuple[0]."");

	            if($tuple[0]!='' && ($tuple[1]!=0))
    	        {
	                $data2=array(
	                "party_id"=>$party_id,
	                "item_id"=>$tuple[0],
	                "rate"=>$tuple[1],
	                "percent"=>$tuple[2]
	                );
					$this->db->insert("m_party_discount",$data2);
	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }
	    //////////////////////
	    function item_state_save()
	    {
			$state_id=$this->input->post('state_id');
			$item_id=$this->input->post("item_id",TRUE);
			$rate=$this->input->post("rate",TRUE);
			$pdate=$this->input->post("date");

            try
            {
				$this->db->trans_begin();

		        $query=$this->db->query("delete from m_state_rate where state_id=".$state_id." and pdate='".date('Y-m-d',strtotime($pdate))."'");

				$zipped = array_map(null,$item_id,$rate);
				foreach($zipped as $tuple) {
	            if($tuple[0]!='' && ($tuple[1]!=0))
    	        {
	                $data2=array(
	                "state_id"=>$state_id,
	                "item_id"=>$tuple[0],
	                "rate"=>$tuple[1],
	                "pdate"=>date('Y-m-d',strtotime($pdate))
	                );
					$this->db->insert("m_state_rate",$data2);
	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }


	    function item_state_Peroidsd()
	    {
			$state_id=$this->input->post('state_id');
			$from=$this->input->post('from');
			$to=$this->input->post('to');
			$item_id=$this->input->post("item_id",TRUE);
			$rate=$this->input->post("rate",TRUE);

            try
            {
				$this->db->trans_begin();
				$this->db->where('state_id',$party_id);
				$this->db->delete("m_period_sd");

				$zipped = array_map(null,$item_id,$rate);
				foreach($zipped as $tuple) {
	            if($tuple[0]!='' && ($tuple[1]!=0))
    	        {
	                $data2=array(
	                "state_id"=>$state_id,
	                "from"=>$from,
	                "to"=>$to,
	                "item_id"=>$tuple[0],
	                "rate"=>$tuple[1]
	                );
					$this->db->insert("m_period_sd",$data2);
	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }
	    //////////////////////
		public function state_rate_get()
		{
	        $state_id = $this->input->get("state_id");
	        $item_id = $this->input->get("item_id");

	        if($party_id!=0 && $item_id!=0)
	        {
		        $query=$this->db->query("select * from m_state_rate where state_id=".$state_id." and item_id=".$item_id);
		        $result=$query->result();
		        if(count($result)>0)
		        {
		          foreach($result as $row)
		          {
		            $data = array(
		                "rate"=>$row->rate
		              );
		          }
		        }
		        else
		        {
		            $data = array(
		                "rate"=>""
		              );
		        }
	        }
	        else
	        {
		            $data = array(
		                "rate"=>""
		              );
	        }
	        echo json_encode($data);
	    }

//COMPANY STARTS
	    function company_save()
	    {
	        // print_r($_FILES);die();

	    	$this->load->model('master_general_model');
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

            if(!empty($_FILES['logo']["name"]))
            {
                $temp_file_name = $_FILES['logo']['name'];   
                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name;

                if (!$this->upload->do_upload('logo')) 
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

                    // $this->master_general_model->company_save($full_path,$file_name);
                }
            }
            else if(isset($_POST['logofilepath']))
            { 
			        $full_path=$_POST['logofilepath'];
    				$file_name=$_POST['logofilename'];
			        // $this->master_general_model->company_save($full_path,$file_name);
		    }
		    else
		    {
		      $full_path=base_url().'uploads/'.'unknown.jpg';
			  $file_name='unknown.jpg';
		        // $this->master_general_model->company_save($full_path,$file_name);
		    }

		    // print_r($this->upload->do_upload('logo'));die();

		    if(!empty($_FILES['header1']["name"]))
            {
            	$path="./uploads";
                $temp_file_name = $_FILES['header1']['name'];   
                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name1=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name1'] = $file_name1;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name1;
		    	print_r($this->upload->do_upload('header1'));die();
		    	$full_path1=base_url().'uploads/'.$file_name1;
                if (!$this->upload->do_upload('header1')) 
                {
                    $error = array('error' => $this->upload->display_errors());
                    foreach ($error as $d){
                        echo $d;
                    }
                }
                else
                {

                    $data = $this->upload->data();
		    // print_r($_FILES['header']["name"]);die();

                    $full_path1=base_url().'uploads/'.$data['file_name'];

                    // $this->master_general_model->company_save($full_path,$file_name);
                }
                // print_r($full_path1);die();
            }
            else if(isset($_POST['headerfilepath']))
            { 
			        $full_path1=$_POST['headerfilepath'];
    				$file_name1=$_POST['headerfilename'];
			        // $this->master_general_model->company_save($full_path,$file_name);
		    }
		    else
		    {
		      $full_path1=base_url().'uploads/'.'unknown.jpg';
			  $file_name1='unknown.jpg';
		        // $this->master_general_model->company_save($full_path,$file_name);
		    }

		    // print_r($full_path1)."<br>";
           	// // print_r($file_name1)."<br>";
           	// // print_r($full_path2)."<br>";
           	// //print_r($file_name2)."<br>";
           	// die();

		    if(!empty($_FILES['footer']["name"]))
            {
                $temp_file_name = $_FILES['footer']['name'];   
                $r=date('d-m-Y-H-i-s');
                $file_ext = substr(strrchr($temp_file_name,'.'),1);
                $file_name2=preg_replace('/[\s_-]/', '', strchr($temp_file_name,'.',true).$r.strchr($temp_file_name,'.'));
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $file_name2;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path=$path."/".$file_name2;
                $full_path2=base_url().'uploads/'.$file_name2;
                if (!$this->upload->do_upload('footer')) 
                {
                    $error = array('error' => $this->upload->display_errors());
                    foreach ($error as $d){
                        echo $d;
                    }
                }
                else
                {
                    $data = $this->upload->data();
                    $full_path2=base_url().'uploads/'.$data['file_name'];

                    // $this->master_general_model->company_save($full_path,$file_name);
                }
            }
            else if(isset($_POST['footerfilepath']))
            { 
			        $full_path2=$_POST['footerfilepath'];
    				$file_name2=$_POST['footerfilename'];
			        // $this->master_general_model->company_save($full_path,$file_name);
		    }
		    else
		    {
		      $full_path2=base_url().'uploads/'.'unknown.jpg';
			  $file_name2='unknown.jpg';

		        // $this->master_general_model->company_save($full_path,$file_name);
		    }

		    

	    	$this->master_general_model->company_save($full_path,$file_name,$full_path1,$file_name1,$full_path2,$file_name2);
	    }
	    function company_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->company_list();
	    	if(count($result)>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->company_name . '</td>';
	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->company_id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->company_id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
	    	}
	    }
	    function company_get()
	    {
	    	// $id = $this->input->get("id");
	    	// echo $id;die();
	    	$this->load->model('master_general_model');
	    	$this->master_general_model->company_get();
	    }

	    //////////////////////
	    function price_list_save()
	    {
						
			$state_id=$this->input->post("state_id",TRUE);
			$item_id=$this->input->post("item_id",TRUE);
			$rate=$this->input->post("rate",TRUE);
			$pdate=$this->input->post("date");
			print_r($state_id);
			print_r($rate);
			print_r($item_id);
            try
            {
				$this->db->trans_begin();


				$zipped = array_map(null,$item_id,$rate,$state_id);
				foreach($zipped as $tuple) {
	            if($tuple[0]!='' && ($tuple[1]!=0))
    	        {
	                $data2=array(
	                "state_id"=>$tuple[2],
	                "item_id"=>$tuple[0],
	                "rate"=>$tuple[1],
	                "pdate"=>date('Y-m-d',strtotime($pdate))
	                );

		        $query=$this->db->query("delete from m_state_rate where state_id=".$tuple[2]." and item_id=".$tuple[0]." and pdate='".date('Y-m-d',strtotime($pdate))."'");

					$this->db->insert("m_state_rate",$data2);
					echo "rate: ".$tuple[1]."<br>";
	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }

	    ////////////////////////
 function price_list_state_date_wise()
	    {
	    	$pdate=$this->input->get('pdate');
	    	$cat_id=$this->input->get('cat_id');
	    	$state_id=$this->input->get('state_id');
	       	$state_array = array();
	       	$state_array_id = array();
	       	$state_rate=array();
		    $query=$this->db->query('select m.id,m.name from m_master m where m.company_id='.get_cookie('ae_company_id').' and m.type="STATE"  group by m.name,m.id order by m.name'); 
			if($query->num_rows()>0){
			 foreach($query->result() as $row){
			  $state_array[] = $row->name;
			  $state_array_id[] = $row->id;
			  $state_rate[] = 0;
			 }
			}

			if($cat_id==0)
			{
				$query=$this->db->query("select m.id,m.name, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP'  group by m.id,m.name,imc.name order by imc.name,m.name");
			}
			else
			{
				$query=$this->db->query("select m.id,m.name, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where imc.id=".$cat_id." and i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP'  group by m.id,m.name,imc.name order by imc.name,m.name");
			}
	    	$result=$query->result();
	    	if(count($result)>0)
	    	{
	    		echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo' <tr>';
		        echo '<th>Date : <input type ="text" id = "date" name="date" value="'.$pdate.'" class="cdate"></th>';
		        
				echo '</table>';

		        echo '<table id="price1" class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
		       

		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Master Category</th>';
		        echo '            <th style="width:200px;">Name</th>';
		        foreach($state_array as $item)
		        {
		          echo '<th style="width:50px;">'.$item.'</td>';
		        }
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->MasterCategory . '</td>';
	                echo '    <td>' . $row->name . '</td>';
	                $i=0;
			        foreach($state_rate as $item)
			        {
			        	$rate=0;
						$query_rate=$this->db->query("select rate from m_state_rate where state_id=".$state_array_id[$i]." and item_id=".$row->id . " and pdate='".date('Y-m-d',strtotime($pdate)) . "'");
				    	$result_rate=$query_rate->result();
				    	if(count($result_rate)()>0)
				    	{
					        foreach($result_rate as $row_rate)
					        {
					        	$rate=$row_rate->rate;
					        }

						}
						if($state_array_id[$i]!=$state_id)
						{
			                echo '    <td>';
			                echo '		'.$rate;
			                echo '    </td>';

						}
						else
						{
			                echo '    <td style="background-color:#ffcccc;">';
			                echo '		<input style="width:50px;" type="text" name="rate[]" value="'.$rate.'"><input type="hidden" name="item_id[]" value="'.$row->id.'"><input type="hidden" name="state_id[]" value="'.$state_array_id[$i].'">';
			                echo '    </td>';
						}
		                $i++;
			        }
	                echo '</tr>';
		        }

                echo '<tr class="">';
                echo '    <td>&nbsp;</td>';
                echo '    <td>&nbsp;</td>';
                $i=0;
		        foreach($state_rate as $item)
		        {
					if($state_array_id[$i]!=$state_id)
					{
		                echo '    <td>';
						echo '		<button class="btn btn-info" type="button" onclick="CopyCol('.($i+2).');">';
						echo '			C';
						echo '		</button>';
		                echo '    </td>';

					}
					else
					{
		                echo '    <td>';
						echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
						echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
						echo '			Submit';
						echo '		</button>';
		                echo '    </td>';
					}
	                $i++;
		        }
                echo '</tr>';

		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '	</div>';
				echo '</div>';
	    	}
	    }

/////////////////
	    function discount_list_party()
	    {
	    	$state_id=$this->input->get('state_id');
	    	$cat_id=$this->input->get('cat_id');
	       	$state_array = array();
	       	$state_array_id = array();
	       	$state_rate=array();
		    $query=$this->db->query('select m.id,m.name from m_master m where m.id='.$cat_id.' and m.prefix="YES" and m.company_id='.get_cookie('ae_company_id').' and m.type="Master Category"  group by m.name,m.id order by m.name'); 
			if($query->num_rows>0){
			 foreach($query->result() as $row){
			  $state_array[] = $row->name;
			  $state_array_id[] = $row->id;
			  $state_rate[] = 0;
			 }
			}

			$state_id_no=0;
		    $query=$this->db->query('select m.id,m.name from m_master m where m.name="'.$state_id.'" and m.company_id='.get_cookie('ae_company_id').' and m.type="State"  group by m.name,m.id order by m.name'); 
			if($query->num_rows()()>0){
			 foreach($query->result() as $row){
			  $state_id_no = $row->id;
			 }
			}

			echo '<input type="hidden" name="state_id_no" value="'.$state_id_no.'">';

			$query=$this->db->query("select m.id,m.name from m_ledger m where  m.company_id=".get_cookie('ae_company_id')." and m.state='$state_id'   group by m.id,m.name order by m.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:200px;">Name</th>';
		        foreach($state_array as $item)
		        {
		          echo '<th style="width:50px;text-align:center;">'.$item.'</td>';
		        }
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                $i=0;
			        foreach($state_rate as $item)
			        {
			        	$rate=0;
						$query_rate=$this->db->query("select percent from m_party_discount where item_id=".$state_array_id[$i]." and party_id=".$row->id . "");
				    	$result_rate=$query_rate->result();
				    	if($query_rate->num_rows()>0)
				    	{
					        foreach($result_rate as $row_rate)
					        {
					        	$rate=$row_rate->percent;
					        }

						}
		                echo '    <td>';
		                echo '		<input style="width:50px;" type="text" name="rate[]" value="'.$rate.'"><input type="hidden" name="item_id[]" value="'.$row->id.'">';
		                echo '    </td>';
		                $i++;
			        }
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }
	    //////////////////////

	    function discount_save_party()
	    {
			$state_id=$this->input->post("cat_id");
			$item_id=$this->input->post("item_id",TRUE);
			$rate=$this->input->post("rate",TRUE);

            try
            {
				$this->db->trans_begin();


				$zipped = array_map(null,$item_id,$rate);
				foreach($zipped as $tuple) {
			        $query=$this->db->query("delete from m_party_discount where party_id=".$tuple[0]." and item_id=".$state_id);
	            if($tuple[0]!='' && ($tuple[1]!=0))
    	        {
	                $data2=array(
	                "item_id"=>$state_id,
	                "party_id"=>$tuple[0],
	                "percent"=>$tuple[1]
	                );


					$this->db->insert("m_party_discount",$data2);
	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }

	    ////////////////////////

/////////////////
	    function discount_list_party_report()
	    {
	    	$state_id=$this->input->get('state_id');
	       	$state_array = array();
	       	$state_array_id = array();
	       	$state_rate=array();
		    $query=$this->db->query('select m.id,m.name from m_master m where m.prefix="YES" and m.company_id='.get_cookie('ae_company_id').' and m.type="Master Category"  group by m.name,m.id order by m.name'); 
			if($query->num_rows()>0){
			 foreach($query->result() as $row){
			  $state_array[] = $row->name;
			  $state_array_id[] = $row->id;
			  $state_rate[] = 0;
			 }
			}

			$query=$this->db->query("select m.id,m.name from m_ledger m where  m.company_id=".get_cookie('ae_company_id')." and m.state='$state_id'   group by m.id,m.name order by m.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
		        echo '<table id="TblList" class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:200px;">Name</th>';
		        foreach($state_array as $item)
		        {
		          echo '<th style="width:50px;text-align:center;">'.$item.'</td>';
		        }
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                $i=0;
			        foreach($state_rate as $item)
			        {
			        	$rate=0;
						$query_rate=$this->db->query("select percent from m_party_discount where item_id=".$state_array_id[$i]." and party_id=".$row->id . "");
				    	$result_rate=$query_rate->result();
				    	if($query_rate->num_rows()>0)
				    	{
					        foreach($result_rate as $row_rate)
					        {
					        	$rate=$row_rate->percent;
					        }

						}
		                echo '    <td>';
		                echo $rate;
		                echo '    </td>';
		                $i++;
			        }
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-6">';
		          echo '<center>
		          <button type="button" id="btn_print" class="btn btn-success" onclick="ShowPrint();return false;"><i class="ace-icon fa fa-print bigger-120"></i>Print</button>
		        		<button class="btn btn-primary" onClick ="exportExcel();return false;">
		          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
		        		</button>
		                  </center>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }
	    //////////////////////
//COMPANY ENDS
////////////////
 function price_list_single()
	    {
	    	$cat_id=$this->input->get('cat_id');

			if($cat_id==0)
			{
				$query=$this->db->query("select m.id,m.name, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP'  group by m.id,m.name,imc.name order by imc.name,m.name");
			}
			else
			{
				$query=$this->db->query("select m.id,m.name, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where imc.id=".$cat_id." and i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP'  group by m.id,m.name,imc.name order by imc.name,m.name");
			}
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo' <tr>';
		        echo '<th>Date : <input type ="text" id = "date" name="date" class="cdate"></th>';
		        
				echo '</table>';

		        echo '<table class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
		       

		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Master Category</th>';
		        echo '            <th style="width:200px;">Name</th>';
	            echo '<th style="width:50px;text-align:center;">Rate</td>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->MasterCategory . '</td>';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                echo '		<input style="width:50px;" type="text" name="rate[]" value=""><input type="hidden" name="item_id[]" value="'.$row->id.'">';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
	    	}
	    }

 function date_list_single()
	    {
			$query=$this->db->query("select pdate from m_rate group by pdate order by pdate");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:400px;">';
		       

		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:200px;">Date</th>';
		        echo '            <th style="width:100px;">&nbsp;</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . date('d-m-Y',strtotime($row->pdate)) . '</td>';
	                echo '    <td>';
					echo '		<button class="btn btn-info" type="button" onclick=GetListDate("'.date('d-m-Y',strtotime($row->pdate)).'"); >';
					echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
					echo '			Modify';
					echo '		</button>';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
	    	}
	    }

////////////////
function ledger_opening()
{
	$district=$this->input->get('district');

	$query=$this->db->query("select l.id,l.name,l.opbalance,l.optype from m_ledger l where l.district = '".$district."'  group by l.id,l.name,l.opbalance,l.optype order by l.name");
	$result=$query->result();
	if($query->num_rows()>0)
	{
        echo '<table class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
        echo '    <thead>';
        echo '        <tr>';
        echo '            <th style="width:300px;">Ledger</th>';
        echo '            <th style="width:200px;">Op.Balance</th>';
        echo '        </tr>';
        echo '    </thead>';
        echo '    <tbody>';

        foreach($result as $row)
        {
            echo '<tr class="">';
            echo '    <td>' . $row->name . '</td>';
            echo '    <td>';
            echo '		<input style="width:200px;" type="text" name="opbalance[]" value="'.$row->opbalance.'"><input type="hidden" name="ledger_id[]" value="'.$row->id.'">';
            echo '    </td>';
            echo '</tr>';
        }
        echo '</table>';
		echo '<div class="clearfix form-actions">';
		echo '	<div class="col-md-offset-3 col-md-9">';
		echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
		echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
		echo '			Submit';
		echo '		</button>';
		echo '	</div>';
		echo '</div>';
	}
}


function emp_list()
{
	$date =$this->input->get('date');
	$modi_date = date('Y-m-d',strtotime($date));
	$query1=$this->db->query("select * from tbl_attendance where company_id=". get_cookie('ae_company_id') ." and date='".$modi_date."'");
		if($query1->num_rows()>0)
		{
			$query=$this->db->query("select * from tbl_attendance where company_id=". get_cookie('ae_company_id') ." and date='".$modi_date."'");
			$result=$query->result();
			if($query->num_rows()>0)
			{
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-2 col-md-9">';
				echo '		<h2>Already Submited</h2>';			
				echo '	</div>';
				echo '</div>';
		        echo '<table class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Employee Name</th>';
		        echo '            <th style="width:200px;">Date</th>';
		        echo '            <th style="width:200px;">Working Hour</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
		            echo '<tr class="">';
		            echo '    <td>' . $row->emp_name . '<input type="hidden" name="emp_id[]" value="'.$row->emp_id.'"><input type="hidden" name="emp_name[]" value="'.$row->emp_name.'"><input type="hidden" name="tbl_id[]" value="'.$row->id.'"></td>';
		            echo '    <td>';
		            echo '		<input type="text" list="0" readonly="true" name="date[]" value="'.date('d-m-Y',strtotime($row->date)).'" data-rule-required="true" class="cdate date-picker form-control col-xs-10 col-sm-12" />';
		            echo '    </td>';
		            echo '    <td><select name="hour[]" data-rule-required="true" disabled>';
		            for ($i=1; $i <25 ; $i++) { 
		            echo '    <option value="'.$i.'" ';
		            if(number_format($i,2)==$row->hour){ 
		            echo 'selected="true"';
		        	}
		        	echo '>'.$i.' Hour</option>';
		            }
		            echo '    </select></td>';

		            echo '</tr>';
		        }
		        echo '</table>';
		    }

		}else{
			$query=$this->db->query("select * from m_employee where company_id=". get_cookie('ae_company_id') ." and status='1'  group by name order by name");
			$result=$query->result();
			if($query->num_rows()>0)
			{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Employee Name</th>';
		        echo '            <th style="width:200px;">Date</th>';
		        echo '            <th style="width:200px;">Working Hour</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
		            echo '<tr class="">';
		            echo '    <td>' . $row->name . '<input type="hidden" name="emp_id[]" value="'.$row->id.'"><input type="hidden" name="emp_name[]" value="'.$row->name.'"><input type="hidden" name="tbl_id[]" value="0"></td>';
		            echo '    <td>';
		            echo '		<input type="text" list="0" readonly="true" name="date[]" value="'.$date.'" data-rule-required="true" class="cdate date-picker form-control col-xs-10 col-sm-12" />';
		            echo '    </td>';
		            echo '    <td><select name="hour[]" data-rule-required="true">';
		            for ($i=1; $i <25 ; $i++) { 
		            echo '    <option value="'.$i.'">'.$i.' Hour</option>';
		            }
		            echo '    </select></td>';

		            echo '</tr>';
		        }
		        echo '</table>';
		        echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
				echo "<script>
					     $('#newsubmit').click(function () {
			                var data = $('#userform').serialize();
							$('#newsubmit').attr('disabled',true);

			                $('.loading').show();
			                $.ajax({
			                    url: '".base_url()."index.php/master_general/emp_attan_save',
			                    type: 'POST',
			                    data: data,
			                    cache: false,
			                    success: function (html) {
			                        $('.loading').hide();
			                        if (html=='1') {
			                        	$('#data-list-table').html('');
			                        	GetList();
					            		SuccessAlert1('Saved Successfully');
					            	}else{
					            		ErrorAlert('Ubnable to Save');
					            	}
			                        
			                    }
			                });
			                return false;
				        });
			</script>";
				
		}
	}
	
}



function emp_attan_save()
{
				
	$emp_id=$this->input->post("emp_id");
	$emp_name=$this->input->post("emp_name");
	$date=$this->input->post("date");
	$hour=$this->input->post("hour");
	$tbl_id=$this->input->post("tbl_id");

	// print_r($emp_id)."<br>";
	// print_r($emp_name)."<br>";
	// print_r($date)."<br>";
	// print_r($tbl_id)."<br>";die();


    try
    {
		$this->db->trans_begin();
		$zipped = array_map(null,$emp_id,$emp_name,$date,$hour,$tbl_id);
		foreach($zipped as $tuple) {
			$dates = date('Y-m-d',strtotime($tuple[2]));
			if ($tuple[4]=="0") {
	        	$query=$this->db->query("insert into tbl_attendance(emp_id,date,hour,emp_name,company_id) values('".$tuple[0]."','".$dates."','".$tuple[3]."','".$tuple[1]."','".get_cookie('ae_company_id')."')");
			}else{
				$query12=$this->db->query("delete from tbl_attendance where id='".$tuple[4]."'");
				$query=$this->db->query("insert into tbl_attendance(emp_id,date,hour,emp_name,company_id,updated_at) values('".$tuple[0]."','".$dates."','".$tuple[3]."','".$tuple[1]."','".get_cookie('ae_company_id')."','".$dates."')");
			}
			
        }

		$this->db->trans_commit();
		echo "1";       
    }
    catch(Exception $e)
    {
        $this->db->trans_rollback();
        echo "2";       
    }
}


////////////////////
	    //////////////////////
	    function ledger_opening_save()
	    {
						
			$ledger_id=$this->input->post("ledger_id",TRUE);
			$opbalance=$this->input->post("opbalance",TRUE);
            try
            {
				$this->db->trans_begin();


				$zipped = array_map(null,$ledger_id,$opbalance);
				foreach($zipped as $tuple) {
	            if($tuple[0]!='')
    	        {
    	        	$opb=0;
    	        	if($tuple[1]=="")
    	        	{
    	        		$opb=0;
    	        	}
    	        	else
    	        	{
    	        		$opb=$tuple[1];
    	        	}

			        $query=$this->db->query("update m_ledger set opbalance=".$opb." where id=".$tuple[0]);

	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }
////////////////////
////////////////
 function ledger_mobile()
	    {
	    	$district=$this->input->get('district');

			$query=$this->db->query("select l.id,l.name,l.mobilenosms,l.optype from m_ledger l where l.district = '".$district."' and l.company_id=". get_cookie('ae_company_id') ."  group by l.id,l.name,l.opbalance,l.optype order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
		        echo '<table class="table table-striped table-bordered table-hover" style="width:600px;font-size:12px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Ledger</th>';
		        echo '            <th style="width:200px;">Mobile No.</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';
		        $i=1;
		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                if($row->mobilenosms=="")
	                {
		                echo '		<input style="width:200px;" type="text" name="mobilenosms[]" value="0"><input type="hidden" name="ledger_id[]" value="'.$row->id.'">';
	                }
	                else
	                {
		                echo '		<input style="width:200px;" type="text" name="mobilenosms[]" value="'.$row->mobilenosms.'"><input type="hidden" name="ledger_id[]" value="'.$row->id.'">';
	                }
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';
				
	    	}
	    }
////////////////////
	    //////////////////////
	    function ledger_mobile_save()
	    {
						
			$ledger_id=$this->input->post("ledger_id",TRUE);
			$mobilenosms=$this->input->post("mobilenosms",TRUE);
            try
            {
				$this->db->trans_begin();


				$zipped = array_map(null,$ledger_id,$mobilenosms);
				foreach($zipped as $tuple) {
	            if($tuple[0]!='')
    	        {
	        		$opb=$tuple[1];

			        $query=$this->db->query("update m_ledger set mobilenosms=".$opb." where id=".$tuple[0]);

	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }	    
 function item_list_single_date()
	    {
	    	$pdate=$this->input->get('pdate');

	    	if($pdate=="undefined")
	    	{
	    		$pdate=date('d-m-Y');
	    	}

	    	$cat_id=$this->input->get('cat_id');

			if($cat_id==0)
			{
				$query=$this->db->query("select m.id,m.name,(select rate from m_rate where  item_id=m.id and pdate='".date('Y-m-d',strtotime($pdate))."' limit 0,1) as rate, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP' group by m.id,m.name,imc.name order by imc.name,m.name");
			}
			else
			{
				$query=$this->db->query("select m.id,m.name,(select rate from m_rate where  item_id=m.id and pdate='".date('Y-m-d',strtotime($pdate))."' limit 0,1) as rate, imc.name as MasterCategory from m_master m, m_item i,m_master ic,m_master imc where imc.id=".$cat_id." and i.group_id=m.id and i.category_id=ic.id and ic.parent_id=imc.id and m.type = 'ITEM GROUP' group by m.id,m.name,imc.name order by imc.name,m.name");
			}

	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		echo '<table id="" class="table table-striped table-bordered table-hover" style="width:400px;">';
		        echo' <tr>';
		        echo '<th>Date : <input type ="text" id = "date" name="date" value="'.$pdate.'" class="cdate"></th>';
		        
				echo '</table>';

		        echo '<table id="TblList" class="table table-striped table-bordered table-hover" style="width:600px;">';
		       

		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th style="width:300px;">Master Category</th>';
		        echo '            <th style="width:200px;">Name</th>';
		        echo '            <th style="width:100px;">Rate</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->MasterCategory . '</td>';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>';
	                echo '		<input type="text" name="rate[]" value="'.$row->rate.'"><input type="hidden" name="item_id[]" value="'.$row->id.'">';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
				echo '<div class="clearfix form-actions">';
				echo '	<div class="col-md-offset-3 col-md-9">';
				echo '		<button  tabindex="6" class="btn btn-info" type="button" id="newsubmit" >';
				echo '			<i class="ace-icon fa fa-check bigger-110"></i>';
				echo '			Submit';
				echo '		</button>';
				echo '	</div>';
				echo '</div>';

          echo '<center>
        <button class="btn btn-primary" onClick ="exportExcel();return false;">
          <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        </button>
                  </center>';

	    	}
	    }

	    //////////////////////
	    function price_list_single_save()
	    {
						
			$item_id=$this->input->post("item_id",TRUE);
			$rate=$this->input->post("rate",TRUE);
			$pdate=$this->input->post("date");
            try
            {
				$this->db->trans_begin();


				$zipped = array_map(null,$item_id,$rate);
				foreach($zipped as $tuple) {
	            if($tuple[0]!='' && ($tuple[1]!=0))
    	        {
	                $data2=array(
	                "item_id"=>$tuple[0],
	                "rate"=>$tuple[1],
	                "pdate"=>date('Y-m-d',strtotime($pdate))
	                );

		        $query=$this->db->query("delete from m_rate where item_id=".$tuple[0]." and pdate='".date('Y-m-d',strtotime($pdate))."'");

					$this->db->insert("m_rate",$data2);
					echo "rate: ".$tuple[1]."<br>";
	            }//End if
		        }

				$this->db->trans_commit();
				echo "1";       
            }
            catch(Exception $e)
            {
	            $this->db->trans_rollback();
	            echo "2";       
            }
	    }



		function sms_setting()
	    {
	    	$sms_value = $this->input->post("sms_value");

	    	$data=array(
	    				'sms_value'=>$sms_value
	    				);
	    		$this->db->where("id",1);
				$this->db->update("m_sms",$data);

				echo "1";    		
	    }

	    function employee_list()
	    {
	    	$this->load->model('master_general_model');
	    	$result=$this->master_general_model->employee_list();
	    	// print_r($result);
	    	if(count($result)>0)
	    	{
		        echo '<table id="TblList" class="table table-striped table-bordered table-hover" style="font-size:11px;">';
		        echo '    <thead>';
		        echo '        <tr>';
		        echo '            <th>Name</th>';
		        echo '            <th>District</th>';
		        echo '            <th>State</th>';
		        echo '            <th>Mobile No.</th>';
		        echo '            <th>Hour Charge</th>';
		        echo '            <th>Current Salary</th>';
		        echo '            <th>Previous Salary</th>';
		        echo '            <th   style="width:130px">Action</th>';
		        echo '        </tr>';
		        echo '    </thead>';
		        echo '    <tbody>';

		        foreach($result as $row)
		        {
	                echo '<tr class="">';
	                echo '    <td>' . $row->name . '</td>';
	                echo '    <td>' . $row->district . '</td>';
	                echo '    <td>' . $row->state . '</td>';
	                echo '    <td>' . $row->mobileno . '</td>';
	                echo '    <td>' . $row->hourcharge . '</td>';
	                echo '    <td>' . $row->csalary . '</td>';
	                echo '    <td>' . $row->psalary . '</td>';

	                echo '    <td>';
					echo '	    <div class="   btn-group">';
					echo '		    <button class="btn btn-xs btn-info btn_modify" title="Edit" onclick="GetRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-pencil bigger-120"></i>';
					echo '		    </button>';

					echo '		    <button class="btn btn-xs btn-danger btn_delete" title="Delete" onclick="DeleteRecord(' . $row->id .');return false;">';
					echo '			    <i class="ace-icon fa fa-trash-o bigger-120"></i>';
					echo '		    </button>';
					echo '	    </div>';
	                echo '    </td>';
	                echo '</tr>';
		        }
		        echo '</table>';
        //   echo '<center>
        // <button class="btn btn-primary" onClick ="exportExcel();">
        //   <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel
        // </button>
        //           </center>';
          echo '<br>';

	    	}
	    }

	}
