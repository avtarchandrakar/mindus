<?
if (!defined('BASEPATH')) exit('No direct script access allowed');
class user_model extends CI_Model {
    
    function user_permission_save(){
	    $tableName1='tbl_user_permission';
	    $status = $this->input->post("status");
	    $permission_id = $this->input->post("permission_id");
	    $cid=get_cookie('ae_company_id');
		$form_id=$this->input->post("form_id");
		$p_entry=$this->input->post("p_entry");
		$p_modify=$this->input->post("p_modify");
		$p_delete=$this->input->post("p_delete");
    $p_list=$this->input->post("p_list");
    $p_bdate=$this->input->post("p_bdate");
    $p_reprint=$this->input->post("p_reprint");
		//Add
		if($status=="add")
		{
    		try{
            $this->db->trans_begin();
            
            //Delete Existing Table
            // $where="(permission_id=$p)";
            $this->db->where('permission_id',$permission_id);
            $this->db->delete($tableName1);

			$zipped = array_map(null,$form_id,$p_entry,$p_modify,$p_delete,$p_list,$p_bdate,$p_reprint);
			foreach($zipped as $tuple) {
                $data=array(
                	'permission_id'=>$permission_id,
                	'form_id'=>$tuple[0],
                	'p_entry'=>$tuple[1],
                	'p_modify'=>$tuple[2],
                	'p_delete'=>$tuple[3],
                  'p_list'=>$tuple[4],
                  'p_bdate'=>$tuple[5],
                  'p_reprint'=>$tuple[6],
                	'company_id'=>$cid
                	);
                $this->db->insert($tableName1,$data);
			}
			$this->db->trans_commit();
			echo "1";    		
		    }catch(Exception $e){
		    $this->db->trans_rollback();
		    echo "2";    		
		    }
		 }
	}

    public function user_permission_list(){
    	$query=$this->db->query('select id form_id,name form_name from tbl_permission_form order by name');
    	return $query->result();
    }
    //Permission Form
    public function permission_form_list(){
    	$query=$this->db->query('select * from tbl_permission_form order by id');
    	return $query->result();
    }
    public function permission_form_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select * from tbl_permission_form where id=$id");
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
      public function permission_form_save()
	    {
	    	$name = $this->input->post("name");
	    	$cid = get_cookie('ae_company_id');
	    	$status = $this->input->post("status");

	    	$data=array(
	    				'name'=>$name,
	    				'company_id'=>$cid
	    				);

	    	if($status=="add")
	    	{
          $query=$this->db->query('select id,name from tbl_permission_form where company_id='.get_cookie('ae_company_id').' and name="'.$name.'"');
          if($query->num_rows()>0)
          {
            echo "2";
          }
          else
          {
				    $this->db->insert("tbl_permission_form",$data);
				    echo "1";   
          } 		
	    	}
	    	if($status=="edit")
	    	{
		    	$sno = $this->input->post("sno");
	    		$this->db->where("id",$sno);
				$this->db->update("tbl_permission_form",$data);
				echo "1";    		
	    	}
	    }
      public function permission_get(){
        $form_id=$this->input->get('form_id');
        $permission_id=get_cookie('ae_userpermission');
        $str='0,0,0';
        $query=$this->db->query('select p_entry,p_modify,p_delete from tbl_user_permission where permission_id='.$permission_id.' and form_id='.$form_id);
        if($query->num_rows()>0)    {          
          foreach($query->result() as $row){
            $str=$row->p_entry.','.$row->p_modify.','.$row->p_delete;
          }
          echo $str;
        }else{
          echo $str;
        }
      }

    public function user_inst_list(){
      $id=$this->input->get('id');
      $query=$this->db->query('select up.p_id as pid from m_user u inner join m_user_permission up on u.id=up.u_id where u.id='.$id);
      return $query->result();
    }

}