<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class master_general_model extends CI_Model {
	    public function area_list()
	    {
	    	$query=$this->db->query("select * from master_area");
	    	return $query->result();
	    } 

	    public function area_save()
	    {
	    	$area_name = $this->input->post("area_name");
	    	$status = $this->input->post("status");

	    	$data=array(
	    				'area_name'=>$area_name
	    				);

	    	if($status=="add")
	    	{
				$this->db->insert("master_area",$data);
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("area_id",$sno);
				$this->db->update("master_area",$data);
				echo "1";    		
	    	}
	    }
	    public function area_get()
	    {
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select * from master_area where area_id=$id");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"area_id"=>$row->area_id,
		    				"area_name"=>$row->area_name
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }




//LEDGER STARTS

	    public function ledger_save()
	    {
	    	$name = $this->input->post("name");
	    	$alias = $this->input->post("alias");
	    	$print_name = $this->input->post("print_name");
	    	$group_id = $this->input->post("group_name");
	    	$opbalance = $this->input->post("opbalance");
	    	$optype = $this->input->post("optype");
	    	$address = $this->input->post("address");
	    	$district = $this->input->post("district");
	    	$state = $this->input->post("state");
	    	$pincode = $this->input->post("pincode");
	    	$cperson = $this->input->post("cperson");
	    	$phoneno = $this->input->post("phoneno");
	    	$mobileno = $this->input->post("mobileno");
	    	$faxno = $this->input->post("faxno");
	    	$emailid = $this->input->post("emailid");
	    	$panno = $this->input->post("panno");
	    	$cstno = $this->input->post("cstno");
	    	$tinno = $this->input->post("tinno");
	    	$exciseno = $this->input->post("exciseno");
	    	$sertaxno = $this->input->post("sertaxno");
	    	$mobilenosms = $this->input->post("mobilenosms");
	    	$company_id = get_cookie("ae_company_id");
	    	$status = $this->input->post("status");
	    	$sno = $this->input->post("sno");

	    	$data=array(
	    				'name'=>$name,
	    				'alias'=>$alias,
	    				'print_name'=>$print_name,
	    				'group_id'=>$group_id,
	    				'opbalance'=>$opbalance,
	    				'optype'=>$optype	,
	    				'address'=>$address,
	    				'district'=>$district,
	    				'state'=>$state,
	    				'pincode'=>$pincode,
	    				'cperson'=>$cperson,
	    				'phoneno'=>$phoneno,
	    				'mobileno'=>$mobileno,
	    				'faxno'=>$faxno,
	    				'emailid'=>$emailid,
	    				'panno'=>$panno,
	    				'cstno'=>$cstno,
	    				'tinno'=>$tinno,
	    				'exciseno'=>$exciseno,
	    				'sertaxno'=>$sertaxno,
	    				'mobilenosms'=>$mobilenosms,
	    				'company_id'=>$company_id
	    				);

	    	if($status=="add")
	    	{
				$this->db->insert("m_ledger",$data);
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("id",$sno);
				$this->db->update("m_ledger",$data);
				echo "1";    		
	    	}
	    }


	    public function ledger_list()
	    {
	    	$query=$this->db->query("select l.*, g.name as group_name,lg.name as linegroup,s.name as statename from m_ledger as l left join m_ledger_group as g on (l.group_id=g.id) left join m_master lg on l.line_id=lg.id left join states s on l.state=s.id where l.company_id=" . get_cookie("ae_company_id") ." and l.type='customer' order by l.name");
	    	// echo $this->db->last_query();die;
	    	return $query->result();
	    } 

	    public function employee_list()
	    {
	    	$query=$this->db->query("select l.* from m_employee as l where l.company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 

	    public function supplayer_list()
	    {
	    	$query=$this->db->query("select l.*, g.name as group_name,lg.name as linegroup,s.name as statename from m_ledger as l left join m_ledger_group as g on (l.group_id=g.id) left join m_master lg on l.line_id=lg.id left join states s on l.state=s.id where l.company_id=" . get_cookie("ae_company_id") ." and l.type='supplayer' order by l.name");
	    	return $query->result();
	    } 

	   

	    public function ledger_get()
	    {
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_ledger as l where l.id=$id and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"alias"=>$row->alias,
		    				"print_name"=>$row->print_name,
		    				"group_id"=>$row->group_id,
		    				"line_id"=>$row->line_id,
		    				"opbalance"=>$row->opbalance,
		    				"optype"=>$row->optype,
		    				"address"=>$row->address,
		    				"district"=>$row->district,
		    				"state"=>$row->state,
		    				"pincode"=>$row->pincode,
		    				"cperson"=>$row->cperson,
		    				"phoneno"=>$row->phoneno,
		    				"mobileno"=>$row->mobileno,
		    				"faxno"=>$row->faxno,
		    				"emailid"=>$row->emailid,
		    				"panno"=>$row->panno,
		    				"cstno"=>$row->cstno,
		    				"tinno"=>$row->tinno,
		    				"exciseno"=>$row->exciseno,
		    				"sertaxno"=>$row->sertaxno,
		    				"mobilenosms"=>$row->mobilenosms,
		    				"sapcode"=>$row->sapcode,
		    				"climit"=>$row->climit,
		    				"salesman"=>$row->salesman,
		    				"opbalancermk"=>$row->opbalancermk,
		    				"crlimit"=>$row->crlimit,
		    				"acno"=>$row->acno,
		    				"ifsccode"=>$row->ifsccode,
		    				"acholder"=>$row->acholder,
		    				"bankname"=>$row->bankname,
		    				"branchname"=>$row->branchname,
		    				"gstn_id"=>$row->gstn_id,
		    				"gstntype"=>$row->gstntype,
		    				"pan_no"=>$row->pan_no,
		    				"companyname"=>$row->companyname,
		    				"website"=>$row->website,
		    				"contactpersone"=>$row->contactpersone,
		    				"mobileno2"=>$row->mobileno2,
		    				"country_code"=>$row->country_code,
		    				"country_code2"=>$row->country_code2,
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

	     public function states_get()
	    {
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select * from cities where state_id=$id");
	    	return $query->result();
	    }
	    

	    public function employee_get()
	    {
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_employee as l where l.id=$id and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"alias"=>$row->alias,
		    				"print_name"=>$row->print_name,
		    				"group_id"=>$row->group_id,
		    				"line_id"=>$row->line_id,
		    				"opbalance"=>$row->opbalance,
		    				"optype"=>$row->optype,
		    				"address"=>$row->address,
		    				"district"=>$row->district,
		    				"state"=>$row->state,
		    				"pincode"=>$row->pincode,
		    				"cperson"=>$row->cperson,
		    				"phoneno"=>$row->phoneno,
		    				"mobileno"=>$row->mobileno,
		    				"faxno"=>$row->faxno,
		    				"emailid"=>$row->emailid,
		    				"panno"=>$row->panno,
		    				"cstno"=>$row->cstno,
		    				"tinno"=>$row->tinno,
		    				"exciseno"=>$row->exciseno,
		    				"sertaxno"=>$row->sertaxno,
		    				"mobilenosms"=>$row->mobilenosms,
		    				"sapcode"=>$row->sapcode,
		    				"climit"=>$row->climit,
		    				"salesman"=>$row->salesman,
		    				"opbalancermk"=>$row->opbalancermk,
		    				"crlimit"=>$row->crlimit,
		    				"acno"=>$row->acno,
		    				"ifsccode"=>$row->ifsccode,
		    				"acholder"=>$row->acholder,
		    				"bankname"=>$row->bankname,
		    				"branchname"=>$row->branchname,
		    				"gstn_id"=>$row->gstn_id,
		    				"gstntype"=>$row->gstntype,
		    				"pan_no"=>$row->pan_no,
		    				"companyname"=>$row->companyname,
		    				"website"=>$row->website,
		    				"contactpersone"=>$row->contactpersone,
		    				"mobileno2"=>$row->mobileno2,
		    				"psalary"=>$row->psalary,
		    				"csalary"=>$row->csalary,
		    				"hourcharge"=>$row->hourcharge,
		    				
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

//LEDGER ENDS








//DESTINATION STARTS

	    public function destination_save()
	    {
	    	$name = $this->input->post("name");
	    	$type = "Destination";
	    	$company_id = get_cookie("ae_company_id");
	    	$status = $this->input->post("status");
	    	$sno = $this->input->post("sno");

	    	$data=array(
	    				'name'=>$name,
	    				'type'=>$type,
	    				'company_id'=>$company_id
	    				);

	    	if($status=="add")
	    	{
				$this->db->insert("m_master",$data);
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("id",$sno);
				$this->db->update("m_master",$data);
				echo "1";    		
	    	}
	    }


	    public function destination_list()
	    {
	    	$type = "Destination";
	    	$query=$this->db->query("select l.* from m_master as l where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 

	    public function destination_get()
	    {
	    	$type = "Destination";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_master as l where l.id=$id and l.type='" . $type . "' and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"freight"=>$row->freight
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

//DESTINATION ENDS



//SOURCE STARTS

	    public function source_save()
	    {
	    	$name = $this->input->post("name");
	    	$freight = $this->input->post("freight");
	    	$type = "Source";
	    	$company_id = get_cookie("ae_company_id");
	    	$status = $this->input->post("status");
	    	$sno = $this->input->post("sno");

	    	$data=array(
	    				'name'=>$name,
	    				'freight'=>$freight,
	    				'type'=>$type,
	    				'company_id'=>$company_id
	    				);

	    	if($status=="add")
	    	{
				$this->db->insert("m_master",$data);
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("id",$sno);
				$this->db->update("m_master",$data);
				echo "1";    		
	    	}
	    }


	    public function source_list()
	    {
	    	$type = "Source";
	    	$query=$this->db->query("select l.* from m_master as l where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 

	    public function source_get()
	    {
	    	$type = "Source";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_master as l where l.id=$id and l.type='" . $type . "' and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"freight"=>$row->freight
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

//SOURCE ENDS



//ITEM GROUP STARTS

	    public function itemgroup_save()
	    {
	    	$name = $this->input->post("name");
	    	$prefix = $this->input->post("prefix");
	    	$type = "Item Group";
	    	$company_id = get_cookie("ae_company_id");
	    	$status = $this->input->post("status");
	    	$sno = $this->input->post("sno");

	    	$data=array(
	    				'name'=>$name,
	    				'prefix'=>$prefix,
	    				'type'=>$type,
	    				'company_id'=>$company_id
	    				);

	    	if($status=="add")
	    	{
				$this->db->insert("m_master",$data);
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("id",$sno);
				$this->db->update("m_master",$data);
				echo "1";    		
	    	}
	    }


	    public function itemgroup_list()
	    {
	    	$type = "Item Group";
	    	$query=$this->db->query("select l.* from m_master as l where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 
 		public function itemcategory_list()
	    {
	    	$type = "Item Category";
	    	$query=$this->db->query("select l.*,g.name as mastercategory from m_master as l left join m_master as g on l.parent_id=g.id where l.type='" . $type . "' and l.company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 
 		public function mastercategory_list()
	    {
	    	$type = "Master Category";
	    	$query=$this->db->query("select l.* from m_master as l where type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 
	    public function itemgroup_get()
	    {
	    	$type = "Item Group";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_master as l where l.id=$id and l.type='" . $type . "' and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"prefix"=>$row->prefix,
		    				"vat"=>$row->vat
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }


	    public function itemcategory_get()
	    {
	    	$type = "Item Category";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_master as l where l.id=$id and l.type='" . $type . "' and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"parent_id"=>$row->parent_id,
		    				"prefix"=>$row->prefix,
		    				"vat"=>$row->vat
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

	    public function mastercategory_get()
	    {
	    	$type = "Master Category";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_master as l where l.id=$id and l.type='" . $type . "' and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"prefix"=>$row->prefix,
		    				"vat"=>$row->vat
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

//ITEM GROUP ENDS








//ITEM STARTS

	    public function item_save()
	    {
	    	$name = $this->input->post("name");
	    	$group_id = $this->input->post("group_id");
	    	$itemcompany_id = $this->input->post("itemcompany_id");
	    	$desptype = $this->input->post("desptype");
	    	$mrp = $this->input->post("mrp");

	    	$company_id = get_cookie("ae_company_id");
	    	$status = $this->input->post("status");
	    	$sno = $this->input->post("sno");

	    	$data=array(
	    				'name'=>$name,
	    				'group_id'=>$group_id,
	    				'itemcompany_id'=>$itemcompany_id,
	    				'desptype'=>$desptype,
	    				'mrp'=>$mrp,
	    				'company_id'=>$company_id
	    				);

	    	if($status=="add")
	    	{
				$this->db->insert("m_item",$data);
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("id",$sno);
				$this->db->update("m_item",$data);
				echo "1";    		
	    	}
	    }


	    public function item_list()
	    {
	    	$query=$this->db->query("select i.unit,i.unittype,i.unitrate,i.specification,i.hsn_no,i.id,i.name,g.name group_name,i.category_id,i.desptype,i.mrp,i.reorder from m_item i inner join m_master g on i.group_id=g.id  and  i.company_id=" . get_cookie("ae_company_id") ." order by i.name");
	    	// echo $this->db->last_query();die;
	    	return $query->result();
	    } 


	    public function custome_list()
	    {
	    	$query=$this->db->query("select * from m_custome where company_id=" . get_cookie("ae_company_id") ." ");
	    	// echo $this->db->last_query();die;
	    	return $query->result();
	    } 



	    public function custome_get()
	    {
	    	$id = $this->input->get("id");
	    	$query=$this->db->query('select * from m_custome where company_id='.get_cookie('ae_company_id').' and id='.$id);
	    	$result=$query->result();
	    	// print_r($result);die();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"ref"=>$row->ref,
		    				"sub"=>$row->sub,
		    				"header"=>$row->header,
		    				"taxes"=>$row->taxes,
		    				"scope_of_work"=>$row->scope_of_work,
		    				"design_criteria"=>$row->design_criteria,
		    				"delivery_period"=>$row->delivery_period,
		    				"payment_terms"=>$row->payment_terms,
		    				"validity_of_offer"=>$row->validity_of_offer,
		    				"note"=>$row->note,
		    				"performance_warranty"=>$row->performance_warranty,
		    				"equipment_acceptance"=>$row->equipment_acceptance,
		    				"supervision_commissioning"=>$row->supervision_commissioning,
		    				"training"=>$row->training,
		    				"general_safety"=>$row->general_safety,
		    				"spare_parts"=>$row->spare_parts,
		    				"chassis_equipment"=>$row->chassis_equipment,
		    				"gst_tax"=>$row->gst_tax,
		    				"mobile_crane"=>$row->mobile_crane,
		    				"scope_of_unloading"=>$row->scope_of_unloading,
		    				"intrest_charge"=>$row->intrest_charge,
		    				"cancellation"=>$row->cancellation,
		    				"jurisdication"=>$row->jurisdication,
		    				"documents_provided"=>$row->documents_provided,
		    				"load_test"=>$row->load_test,

		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }



	    public function item_get()
	    {
	    	$id = $this->input->get("id");
	    	$query=$this->db->query('select * from m_item where company_id='.get_cookie('ae_company_id').' and id='.$id);
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"group_id"=>$row->group_id,
		    				"category_id"=>$row->category_id,
		    				"itemcompany_id"=>$row->itemcompany_id,
		    				"desptype"=>$row->desptype,
		    				"mrp"=>$row->mrp,
		    				"reorder"=>$row->reorder,
		    				"unit"=>$row->unit,
		    				"opn_bal"=>$row->opn_bal,
		    				"hsn_no"=>$row->hsn_no,
		    				"specification"=>$row->specification,
		    				"unittype"=>$row->unittype,
		    				"unitrate"=>$row->unitrate,
		    				"description"=>$row->description,

		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

//ITEM ENDS
	    //POS START
	    public function pos_list()
	    {
	    	$type = "POS";
	    	$query=$this->db->query("select l.* from m_master as l where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 

	    public function salesmanlist()
	    {
	    	$type = "salesman";
	    	$query=$this->db->query("select l.* from m_master as l where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 

	    public function pos_get()
	    {
	    	//$type = "POS";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_master as l where l.id=$id  and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }
	    //POS END
	    //Item Company START
	    public function item_company_list()
	    {
	    	$type = "Item Company";
	    	$query=$this->db->query("select l.* from m_master as l where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 

	    public function item_company_get()
	    {
	    	$type = "Item Company";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_master as l where l.id=$id and l.type='" . $type . "' and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }
	    //Item Company END
	    //GODOWN START
	    public function godown_list()
	    {
	    	$type = "Godown";
	    	$query=$this->db->query("select l.* from m_master as l where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by l.name");
	    	return $query->result();
	    } 

	    public function godown_get()
	    {
	    	$type = "Godown";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select l.* from m_master as l where l.id=$id and l.type='" . $type . "' and l.company_id=" . get_cookie("ae_company_id") . " order by l.name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }
	    //GODOWN END
	    //DISTRICT MASTER
	    public function district_list()
	    {
	    	$type = "District";
	    	$query=$this->db->query("select id,name from m_master where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by id");
	    	return $query->result();
	    }
	    public function district_get()
	    {
	    	$type = "District";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select id,name from m_master where company_id='".get_cookie('ae_company_id')."' and type='" . $type . "' and id=$id order by id");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }


	    //DISTRICT MASTER
	    public function line_group_list()
	    {
	    	$type = "LineGroup";
	    	$query=$this->db->query("select id,name from m_master where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by id");
	    	return $query->result();
	    }
	    public function line_group_get()
	    {
	    	$type = "LineGroup";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select id,name from m_master where company_id='".get_cookie('ae_company_id')."' and type='" . $type . "' and id=$id order by id");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

	    ////Start State Master
	    public function state_list()
	    {
	    	$type = "State";
	    	$query=$this->db->query("select id,name from m_master where  type='" . $type . "' and company_id=" . get_cookie("ae_company_id") ." order by id");
	    	return $query->result();
	    }
	    public function state_get()
	    {
	    	$type = "State";
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select id,name from m_master where company_id='".get_cookie('ae_company_id')."' and type='" . $type . "' and id=$id order by id");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }

	    ///End State master
	    //END DISTRICT MASTER
	    //LEDGER GROUP
	    public function ledgergroup_list()
	    {
	    	$query=$this->db->query("select l1.id,l1.name,l1.parent_id,l2.name parent from m_ledger_group l1 inner join m_ledger_group l2 on l1.parent_id=l2.id where l1.parent_id<>0");
	    	return $query->result();
	    } 

	    public function ledgergroup_get()
	    {
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select id,name,parent_id from m_ledger_group where id=".$id);
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"name"=>$row->name,
		    				"parent_id"=>$row->parent_id
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }
	    public function ledgergroup_save()
	    {
	    	$name = $this->input->post("name");
	    	$parent_id = $this->input->post("parent_id");
	    	$type = "R";
	    	$status = $this->input->post("status");
	    	$sno = $this->input->post("sno");

	    	$data=array(
	    				'name'=>$name,
	    				'type'=>$type,
	    				'parent_id'=>$parent_id
	    				);

	    	if($status=="add")
	    	{
				$this->db->insert("m_ledger_group",$data);
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("id",$sno);
				$this->db->update("m_ledger_group",$data);
				echo "1";    		
	    	}
	    }
	    //END LEDGER GROUP
	    //User Management
	    public function user_save()
	    {
	    	$username = $this->input->post("username");
	    	$password = $this->input->post("password");
	    	$type = $this->input->post("type");
	    	$mobile1 = $this->input->post("mobile1");
	    	$mobile2 = $this->input->post("mobile2");
	    	$mobile3 = $this->input->post("mobile3");
	    	$otp = $this->input->post("otp");
	    	$openpass = $this->input->post("openpass");
	    	$permission = $this->input->post("permission");
	    	$back_date = $this->input->post("back_date");
	    	$ip_address = $this->input->post("ip_address");
	    	$company_id = get_cookie("ae_company_id");
	    	$status = $this->input->post("status");
	    	$sno = $this->input->post("sno");

	    	$data=array(
	    				'username'=>$username,
	    				'password'=>md5($password),
	    				'type'=>$type,
	    				'mobile1'=>$mobile1,
	    				'mobile2'=>$mobile2,
	    				'mobile3'=>$mobile3,
	    				'otp'=>$otp,
	    				'openpass'=>$openpass,
	    				'permission'=>$permission,
	    				'back_date'=>$back_date,
	    				'ip_address'=>$ip_address
	    				);
            $tableName2='m_user_permission';
            $a1=$this->input->post("listbox");

	    	if($status=="add")
	    	{
				$this->db->insert("m_user",$data);
	            $id=$this->db->insert_id(); 
	            $zipped = array_map(null, $a1);
	            foreach($zipped as $tuple) {
	                $data2=array(
	                    "u_id"=>$id,
	                    "p_id"=>$tuple                    
	                    );
	                $this->db->insert($tableName2,$data2);
	            }
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$data=array(
	    				'username'=>$username,
	    				'type'=>$type,
	    				'mobile1'=>$mobile1,
	    				'mobile2'=>$mobile2,
	    				'mobile3'=>$mobile3,
	    				'otp'=>$otp,
	    				'openpass'=>$openpass,
	    				'permission'=>$permission,
	    				'back_date'=>$back_date,
	    				'ip_address'=>$ip_address
	    				);

		    	$sno = $this->input->post("sno");
	    		$this->db->where("id",$sno);
				$this->db->update("m_user",$data);

				$this->db->where('u_id',$sno);
				$this->db->delete($tableName2);
	            $zipped = array_map(null, $a1);
	            foreach($zipped as $tuple) {
	                $data2=array(
	                    "u_id"=>$sno,
	                    "p_id"=>$tuple
	                    );
	                $this->db->insert($tableName2,$data2);
	            }
				echo "1";    		
	    	}
	    }


	    public function user_list()
	    {
	    	$query=$this->db->query("select id,username,type,permission,ip_address,back_date from m_user order by type,username");
	    	return $query->result();
	    } 

	    public function user_get()
	    {
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select id,username,type,permission,ip_address,back_date,mobile1,mobile2,mobile3,otp,openpass from m_user where id=$id");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"username"=>$row->username,
		    				"type"=>$row->type,
		    				"mobile1"=>$row->mobile1,
		    				"mobile2"=>$row->mobile2,
		    				"mobile3"=>$row->mobile3,
		    				"otp"=>$row->otp,
		    				"permission"=>$row->permission,
		    				"back_date"=>$row->back_date,
		    				"ip_address"=>$row->ip_address,
		    				"openpass"=>$row->openpass
		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
    		echo json_encode($data);
	    }
	    //End User Management

//COMPANY STARTS

	    public function company_save($logofilepath,$logofilename,$footerfilepath,$footerfilename,$headerfilepath,$headerfilename)
	    {
	    	$company_name = $this->input->post("name");
	    	$company_address = $this->input->post("address");
	    	$status = $this->input->post("status");
	    	$sno = $this->input->post("sno");
	    	$cperson = $this->input->post("cperson");
	    	$state = $this->input->post("state");
	    	$district = $this->input->post("district");
	    	$mobileno = $this->input->post("mobileno");
	    	$landline = $this->input->post("landline");
	    	$mobileno2 = $this->input->post("mobileno2");
	    	$slogen = $this->input->post("slogen");
	    	$gstntype = $this->input->post("gstntype");
	    	$gstn = $this->input->post("gstn");
	    	$termcondition = $this->input->post("termcondition");
	    	$cin = $this->input->post("cin");
	    	$gmail = $this->input->post("gmail");
	    	$website = $this->input->post("website");
	    	$ac_holder = $this->input->post("ac_holder");
	    	$bankname = $this->input->post("bankname");
	    	$ac_no = $this->input->post("ac_no");
	    	$ifsccode = $this->input->post("ifsccode");

	    	$ac_holder2 = $this->input->post("ac_holder2");
	    	$bankname2 = $this->input->post("bankname2");
	    	$ac_no2 = $this->input->post("ac_no2");
	    	$ifsccode2 = $this->input->post("ifsccode2");
	    	$bank_address2 = $this->input->post("bank_address2");
	    	$bank_address = $this->input->post("bank_address");

	    	$data=array(
	    				'company_name'=>$company_name,
	    				'company_address'=>$company_address,
	    				'cperson'=>$cperson,
	    				'state'=>$state,
	    				'district'=>$district,
	    				'mobileno'=>$mobileno,
	    				'landline'=>$landline,
	    				'mobileno2'=>$mobileno2,
	    				'slogen'=>$slogen,
	    				'gstntype'=>$gstntype,
	    				'gstn'=>$gstn,
	    				'termcondition'=>$termcondition,
	    				'logofilepath'=>$logofilepath,
	    				'logofilename'=>$logofilename,
	    				'footerfilepath'=>$footerfilepath,
	    				'footerfilename'=>$footerfilename,
	    				'headerfilepath'=>$headerfilepath,
	    				'headerfilename'=>$headerfilename,
	    				'cin'=>$cin,
	    				'gmail'=>$gmail,
	    				'website'=>$website,
	    				'ac_holder'=>$ac_holder,
	    				'bankname'=>$bankname,
	    				'ac_no'=>$ac_no,
	    				'ifsccode'=>$ifsccode,

	    				'ac_holder2'=>$ac_holder2,
	    				'bankname2'=>$bankname2,
	    				'ac_no2'=>$ac_no2,
	    				'ifsccode2'=>$ifsccode2,
	    				'bank_address'=>$bank_address,
	    				'bank_address2'=>$bank_address2,
	    				
	    				);

	    	if($status=="add")
	    	{
				$this->db->insert("m_company",$data);
		        $company_id=$this->db->insert_id();

		    	$pos_name = $this->input->post("name");

		    	$data1=array(
		    				'name'=>$pos_name,
		    				'type'=>'POS',
		    				'company_id'=>$company_id,
		    				);
				$this->db->insert("m_master",$data1);

				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("company_id",$sno);
				$this->db->update("m_company",$data);
				echo "1";    		
	    	}
	    }


	    public function company_list()
	    {
	    	$query=$this->db->query("select l.* from m_company as l  order by l.company_name");
	    	return $query->result();
	    } 

	    public function company_get()
	    {
	    	$id = $this->input->get("id");
	    	// echo $id;die();
	    	$query=$this->db->query("select l.* from m_company as l where l.company_id=$id  order by l.company_name");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->company_id,
		    				"name"=>$row->company_name,
		    				"address"=>$row->company_address,
		    				"cperson"=>$row->cperson,
		    				"state"=>$row->state,
		    				"district"=>$row->district,
		    				"mobileno"=>$row->mobileno,
		    				"landline"=>$row->landline,
		    				"mobileno2"=>$row->mobileno2,
		    				"slogen"=>$row->slogen,
		    				"gstntype"=>$row->gstntype,
		    				"gstn"=>$row->gstn,
		    				"termcondition"=>$row->termcondition,
		    				"logofilepath"=>$row->logofilepath,
		    				"logofilename"=>$row->logofilename,
		    				"headerfilepath"=>$row->headerfilepath,
		    				"headerfilename"=>$row->headerfilename,
		    				"footerfilepath"=>$row->footerfilepath,
		    				"footerfilename"=>$row->footerfilename,
		    				"cin"=>$row->cin,
		    				"gmail"=>$row->gmail,
		    				"website"=>$row->website,
		    				"ac_holder"=>$row->ac_holder,
		    				"bankname"=>$row->bankname,
		    				"ac_no"=>$row->ac_no,
		    				"ifsccode"=>$row->ifsccode,
		    				"ac_holder2"=>$row->ac_holder2,
		    				"bankname2"=>$row->bankname2,
		    				"ac_no2"=>$row->ac_no2,
		    				"ifsccode2"=>$row->ifsccode2,
		    				"bank_address2"=>$row->bank_address2,
		    				"bank_address"=>$row->bank_address,

		    			);
	    		}
	    	}
	    	else{
	    		$data = array(
	    				"Message"=>"Failed"
		    			);
	    	}
	    	// echo "select l.* from m_company as l where l.company_id=$id  order by l.company_name";
    		echo json_encode($data);
	    }

//COMPANY ENDS




	}
