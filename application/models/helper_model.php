<?
if (!defined('BASEPATH')) exit('No direct script access allowed');
class helper_model extends CI_Model {
    
    public function insert($tableName,$data,$id)
	    {
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						if($field->name=="Password")
							$data[$field->name]=md5($value);
						else if($field->name=="cdate" || $field->name=="gpdate" || $field->name=="invoicedate" || $field->name=="cleardate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
	          $data['edate'] = date('Y-m-d',strtotime($data['cdate']));
	    	if($status=="add")
	    	{
	    		if($this->input->post('vtype')=="receipt" || $this->input->post('vtype')=="RECEIPT")
	    		{
			        $data['vamount'] = ($this->input->post('tol_freight'));
	    		}
	    		if($this->input->post('vtype')=="payment" || $this->input->post('vtype')=="PAYMENT")
	    		{
			        $data['vamount'] = ($this->input->post('tol_freight'))*-1;
	    		}
	    		if($this->input->post('vtype')=="crnote" || $this->input->post('vtype')=="CRNOTE")
	    		{
			        $data['vamount'] = ($this->input->post('tol_freight'));
	    		}
	    		if($this->input->post('vtype')=="drnote" || $this->input->post('vtype')=="DRNOTE")
	    		{
			        $data['vamount'] = ($this->input->post('tol_freight'))*-1;
	    		}
	    		if($tableName=="tbl_trans1")
	    		{
	              $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_trans1 where cdate='".date('Y-m-d',strtotime($data['edate']))."' and vtype='".$this->input->post('vtype')."' and company_id=".get_cookie("ae_company_id"));
	              $result=$query->result();
	              if(count($result)>0)
	              {
	                foreach($result as $row)
	                {
	                  $builtyno = $row->builtyno;
	                }
	              }
	              $builtyno++;
	              $data['builtyno'] = ($builtyno);
          		}
	    		$data['company_id']=get_cookie("ae_company_id");
	    		$data['pos_id']=get_cookie("ae_pos_id");
				$this->db->insert($tableName,$data);
				echo "1";    		
	    	}
	    	if($status=="edit")
	    	{
	    		if($this->input->post('vtype')=="receipt" || $this->input->post('vtype')=="RECEIPT")
	    		{
			        $data['vamount'] = ($this->input->post('tol_freight'));
	    		}
	    		if($this->input->post('vtype')=="payment" || $this->input->post('vtype')=="PAYMENT")
	    		{
			        $data['vamount'] = ($this->input->post('tol_freight'))*-1;
	    		}
	    		if($this->input->post('vtype')=="crnote" || $this->input->post('vtype')=="CRNOTE")
	    		{
			        $data['vamount'] = ($this->input->post('tol_freight'));
	    		}
	    		if($this->input->post('vtype')=="drnote" || $this->input->post('vtype')=="DRNOTE")
	    		{
			        $data['vamount'] = ($this->input->post('tol_freight'))*-1;
	    		}
		    	$sno = $this->input->post("sno");
	    		$this->db->where($id,$sno);
				$this->db->update($tableName,$data);
				echo "1";    		
	    	}
	    }

        function delete($tableName, $id){
	    	  $sno=$this->input->post('ID');
              $query = $this->db->where($id, $sno);
		      $query = $this->db->limit(1,0);
		      $query = $this->db->delete($tableName);
		      return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	    }

	    function get_max_id($tableName, $id){
             $query=$this->db->query("select $id FROM $tableName ORDER BY $id DESC LIMIT 1");
	         if($query->num_rows()>0){
	            foreach($query->result() as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",		    				
		    				"max_id"=>$row->$id+1
		    			);
	    		}
	         }
	         else
	         {
	              $data = array(
	    				"Message"=>"Failed"
		    			);
	         }
	         echo json_encode($data);
	    }
	    //Autocomplete
	    public function get_ledger($q){
	    $this->db->select('*');
	    $this->db->like('name', $q);
	    $query = $this->db->get('m_ledger');
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){
	      	$new_row['value']=htmlentities(stripslashes($row['name']));
	        $new_row['label']=htmlentities(stripslashes($row['name']));
	        $new_row['id']=htmlentities(stripslashes($row['id']));
	        $new_row['grade']=htmlentities(stripslashes($row['grade']));
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }else{
	     $row_set[]=''; 	
	     echo json_encode($row_set);
	    }
	  }
	  public function get_item($q){
        $this->db->where('company_id',get_cookie('ae_company_id'));
	    $this->db->select('*');
	    $this->db->like('name', $q);
	    $query = $this->db->get('m_item');
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){
	      	$new_row['value']=htmlentities(stripslashes($row['name']));
	        $new_row['label']=htmlentities(stripslashes($row['name']));
	        $new_row['id']=htmlentities(stripslashes($row['id']));
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }else{
	     $row_set[]=''; 	
	     echo json_encode($row_set);
	    }
	  }




	  public function get_item2($q){
	  	//$cat=$this->input->get('cat');
	  	//$this->db->where('group_id',$cat);
	  	//$this->db->where('group_id');
        $this->db->where('company_id',get_cookie('ae_company_id'));
	    $this->db->select('*');
	    $this->db->like('name', $q);
	    $query = $this->db->get('m_item');
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){
	      	$new_row['value']=htmlentities(stripslashes($row['name']));
	        $new_row['label']=htmlentities(stripslashes($row['name']));
	        $new_row['id']=htmlentities(stripslashes($row['id']));
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }else{
	     $row_set[]=''; 	
	     echo json_encode($row_set);
	    }
	  }

	  public function get_item3($q){
	  	//$cat=$this->input->get('cat');
	  	//$this->db->where('group_id',$cat);
	  	//$this->db->where('group_id');
        $query=$this->db->query("select i.id,i.name,i.group_id,(select rate from m_rate where rate<>0 and item_id=i.group_id order by pdate desc limit 0,1) as rate from m_item i where i.name like '%".$q."%' and i.company_id=".get_cookie('ae_company_id')." order by i.name");
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){
	      	$new_row['value']=htmlentities(stripslashes($row['name']));
	        $new_row['label']=htmlentities(stripslashes($row['name']));
	        $new_row['id']=htmlentities(stripslashes($row['id']));
	        $new_row['rate']=htmlentities(stripslashes($row['rate']));
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }else{
	     $row_set[]=''; 	
	     echo json_encode($row_set);
	    }
	  }




	  public function get_item3_date($q){
	  	$cdate=$this->input->get('cdate');
        $cdate = date('Y-m-d',strtotime($cdate));
	  	
	  	//$this->db->where('group_id',$cat);
	  	//$this->db->where('group_id');
        $query=$this->db->query("select i.id,i.name,i.group_id,(select rate from m_rate where rate<>0 and item_id=i.group_id and pdate<='".$cdate."' order by pdate desc limit 0,1) as rate from m_item i where i.name like '%".$q."%' and i.company_id=".get_cookie('ae_company_id')." order by i.name");
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){
	      	$name = str_replace( array( '\'', '"',
	',' , ';', '<', '>' ), ' ', $row['name']);
	      	$new_row['value']=htmlentities(stripslashes($name));
	        $new_row['label']=htmlentities(stripslashes($name));
	        $new_row['id']=htmlentities(stripslashes($row['id']));
	        $new_row['rate']=htmlentities(stripslashes($row['rate']));
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }else{
	     $row_set[]=''; 	
	     echo json_encode($row_set);
	    }
	  }


	  public function get_city($q){
	  	$this->db->distinct();
	    $this->db->select('state');
	    $this->db->like('state', $q);
	    $query = $this->db->get('m_ledger');
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){
	      	$new_row['value']=htmlentities(stripslashes($row['state']));
	        $new_row['label']=htmlentities(stripslashes($row['state']));
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }else{
	     $row_set[]=''; 	
	     echo json_encode($row_set);
	    }
	  }
	  //COMPANY LIST
	  public function company_list(){
	  	$query=$this->db->query('select id,name from m_master where company_id='.get_cookie("ae_company_id").' and type="Item Company"');
	  	return $query->result();
	  }
	  public function item_list(){
	  	$id=$this->input->get('id');
	  	$query=$this->db->query('select t2.name,t1.i_id,t1.i_discount from tbl_ledger_assign_item t1 inner join m_item t2 on t1.i_id=t2.id where t1.l_id='.$id.' and t1.company_id='.get_cookie("ae_company_id").' order by t2.name');
	  	return $query->result();
	  }
	  //END COMPANY LIST
	  // Master Insert

	  public function m_itemgroup($tableName,$data,$id)
	    {
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						if($field->name=="cdate" || $field->name=="gpdate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
			$name=$this->input->post('name');
			$uname=$this->input->post('uname');
			$type=$this->input->post('type');
			

	    	if($status=="add")
	    	{
	    		$query=$this->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and name="'.$name.'" and type="'.$type.'"');
	    		if($query->num_rows()>0){
	    			echo "2";
	    		}else{
	    		$data['type']= 'ITEM GROUP';
	    		$data['company_id']=get_cookie("ae_company_id");
				$this->db->insert($tableName,$data);
				echo "1";
				}    		
	    	}
	    	if($status=="edit")
	    	{
	    		$query=$this->db->query('select name from m_master where company_id='.get_cookie('ae_company_id').' and name<>"'.$uname.'" and type="'.$type.'"');
	    		if($query->num_rows()>0){
	    			$arr=array();
	    			foreach($query->result() as $data2){
                     $arr[]=$data2->name;
	    			}
	                if(in_array($name, $arr)){
	                  echo "2";
	                } else{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);

			    	  $query=$this->db->query('update m_ledger set state="'.$name.'" where company_id='.get_cookie('ae_company_id').' and state="'.$uname.'"');
				      echo "1";    		                
	                }
	    		}
	    		else
	    		{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);
				      echo "1";    		                
	    		}
	    	}
	    }

	  public function m_insert($tableName,$data,$id)
	    {
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						if($field->name=="cdate" || $field->name=="gpdate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
			$name=$this->input->post('name');
			$uname=$this->input->post('uname');
			$type=$this->input->post('type');
			

	    	if($status=="add")
	    	{
	    		$query=$this->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and name="'.$name.'" and type="'.$type.'"');
	    		if($query->num_rows()>0){
	    			echo "2";
	    		}else{
	    		$data['type']= $type;
	    		$data['company_id']=get_cookie("ae_company_id");
				$this->db->insert($tableName,$data);
				echo "1";
				}    		
	    	}
	    	if($status=="edit")
	    	{
	    		$query=$this->db->query('select name from m_master where company_id='.get_cookie('ae_company_id').' and name<>"'.$uname.'" and type="'.$type.'"');
	    		if($query->num_rows()>0){
	    			$arr=array();
	    			foreach($query->result() as $data2){
                     $arr[]=$data2->name;
	    			}
	                if(in_array($name, $arr)){
	                  echo "2";
	                } else{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);

			    	  $query=$this->db->query('update m_ledger set state="'.$name.'" where company_id='.get_cookie('ae_company_id').' and state="'.$uname.'"');
				      echo "1";    		                
	                }
	    		}
	    		else
	    		{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);
				      echo "1";    		                
	    		}
	    	}
	    }

	    public function m_insert_ledger($tableName,$data,$id)
	    {
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						if($field->name=="cdate" || $field->name=="gpdate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
			$name=$this->input->post('name');
			$uname=$this->input->post('uname');
			$type='customer';
			

	    	if($status=="add")
	    	{
	    		$query=$this->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and name="'.$name.'" and type="'.$type.'"');
	    		if($query->num_rows()>0){
	    			echo "2";
	    		}else{
	    		$data['type']= $type;
	    		$data['company_id']=get_cookie("ae_company_id");
				$this->db->insert($tableName,$data);
				echo "1";
				}    		
	    	}
	    	if($status=="edit")
	    	{
	    		$query=$this->db->query('select name from m_master where company_id='.get_cookie('ae_company_id').' and name<>"'.$uname.'" and type="'.$type.'"');
	    		if($query->num_rows()>0){
	    			$arr=array();
	    			foreach($query->result() as $data2){
                     $arr[]=$data2->name;
	    			}
	                if(in_array($name, $arr)){
	                  echo "2";
	                } else{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);

			    	  $query=$this->db->query('update m_ledger set state="'.$name.'" where company_id='.get_cookie('ae_company_id').' and state="'.$uname.'"');
				      echo "1";    		                
	                }
	    		}
	    		else
	    		{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);
				      echo "1";    		                
	    		}
	    	}
	    }

	    public function m_employee($tableName,$data,$id)
	    {
	    	$tableName = 'm_employee';
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						if($field->name=="cdate" || $field->name=="gpdate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
			$name=$this->input->post('name');
			$uname=$this->input->post('uname');
			$type=$this->input->post('type');
			

	    	if($status=="add")
	    	{
	    		$query=$this->db->query('select id,name from m_employee where company_id='.get_cookie('ae_company_id').' and name="'.$name.'" ');
	    		if($query->num_rows()>0){
	    			echo "2";
	    		}else{
	    		$data['type']= $type;
	    		$data['company_id']=get_cookie("ae_company_id");
				$this->db->insert($tableName,$data);
				echo "1";
				}    		
	    	}
	    	if($status=="edit")
	    	{
	    		$query=$this->db->query('select name from m_employee where company_id='.get_cookie('ae_company_id').' and name<>"'.$uname.'" ');
	    		if($query->num_rows()>0){
	    			$arr=array();
	    			foreach($query->result() as $data2){
                     $arr[]=$data2->name;
	    			}
	                if(in_array($name, $arr)){
	                  echo "2";
	                } else{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);

			    	  $query=$this->db->query('update m_employee set state="'.$name.'" where company_id='.get_cookie('ae_company_id').' and state="'.$uname.'"');
				      echo "1";    		                
	                }
	    		}
	    		else
	    		{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);
				      echo "1";    		                
	    		}
	    	}
	    }


	    public function m_insert1($tableName,$data,$id)
	    {
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						if($field->name=="cdate" || $field->name=="gpdate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
			$name=$this->input->post('name');
			$uname=$this->input->post('uname');
			$type=$this->input->post('type');
			

	    	if($status=="add")
	    	{
	    		$query=$this->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and name="'.$name.'" and type="'.$type.'"');
	    		if($query->num_rows()>0){
	    			echo "2";
	    		}else{
	    		$data['type']= 'supplayer';
	    		$data['company_id']=get_cookie("ae_company_id");
				$this->db->insert($tableName,$data);
				echo "1";
				}    		
	    	}
	    	if($status=="edit")
	    	{
	    		$query=$this->db->query('select name from m_master where company_id='.get_cookie('ae_company_id').' and name<>"'.$uname.'" and type="'.$type.'"');
	    		if($query->num_rows()>0){
	    			$arr=array();
	    			foreach($query->result() as $data2){
                     $arr[]=$data2->name;
	    			}
	                if(in_array($name, $arr)){
	                  echo "2";
	                } else{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);

			    	  $query=$this->db->query('update m_ledger set state="'.$name.'" where company_id='.get_cookie('ae_company_id').' and state="'.$uname.'"');
				      echo "1";    		                
	                }
	    		}
	    		else
	    		{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);
				      echo "1";    		                
	    		}
	    	}
	    }
	  // End Master Insert
	  // category Insert
	  public function m_insert_category($tableName,$data,$id)
	    {
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						if($field->name=="cdate" || $field->name=="gpdate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
			$name=$this->input->post('name');
		if($status=="add")
	    	{
	    		$query=$this->db->query('select id,name from m_category where company_id='.get_cookie('ae_company_id').' ');
	    		if($query->num_rows()>0){
	    			echo "2";
	    		}else{
	    		$data['company_id']=get_cookie("ae_company_id");
				$this->db->insert($tableName,$data);
				echo "1";
				}    		
	    	}
	    	if($status=="edit")
	    	{
	    		$query=$this->db->query('select name from m_category where company_id='.get_cookie('ae_company_id').' ');
	    		if($query->num_rows()>0){
	    			$arr=array();
	    			foreach($query->result() as $data2){
                     $arr[]=$data2->name;
	    			}
	                if(in_array($name, $arr)){
	                  echo "2";
	                } else{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);
				      echo "1";    		                
	                }
	    		}
	    		else
	    		{
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);
				      echo "1";    		                
	    		}
	    	}
	    }
	  // End Category Insert

	    // Master Insert Without Type
	  	public function m_insert_custome($tableName,$data,$id)
	    {
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						
						if($field->name=="cdate" || $field->name=="gpdate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
	    	if($status=="add")
	    	{
	    		
	    		$data['company_id']=get_cookie("ae_company_id");
				$this->db->insert($tableName,$data);
				echo "1";
				 		
	    	}
	    	if($status=="edit")
	    	{
              $sno = $this->input->post("sno");
			  $this->db->where($id,$sno);
		      $this->db->update($tableName,$data);
		      echo "1";   
	    	}
	    }
	  // End Master Insert m_insert_custome
	  
	    // Master Insert Without Type
	  	public function m_insert_wt($tableName,$data,$id)
	    {
	    	$status = $this->input->post("status");
	    	$fields = $this->db->field_data($tableName);
				foreach ($fields as $field)
				{
					if($field->primary_key==1)
						continue;
					$value=$this->input->post($field->name);
					if(!empty($value))
					{
						
						if($field->name=="cdate" || $field->name=="gpdate")
							$data[$field->name]=date('Y-m-d',strtotime($value));
						else
							$data[$field->name]=$value;
					}
				}
			$name=$this->input->post('name');
			$uname=$this->input->post('uname');
	    	if($status=="add")
	    	{
	    		// $query=$this->db->query("select id,name from ".$tableName." where company_id=".get_cookie('ae_company_id')." and name='".$name."' ");
	    		// if($query->num_rows()>0){
	    		// 	echo "2";
	    		// }else{
	    		$data['company_id']=get_cookie("ae_company_id");
				$this->db->insert($tableName,$data);
				echo "1";
				// }    		
	    	}
	    	if($status=="edit")
	    	{
	    		$query=$this->db->query("select name from ".$tableName." where company_id=".get_cookie('ae_company_id')." and name!='".$name."'");
	    		if($query->num_rows()>0)
	    		{
	    			// $arr=array();
	    			// foreach($query->result() as $data2)
	    			// {
                    //  $arr[]=$data2->name;
	    			// }
	                // if(in_array($name, $arr)){
	                // 	// print_r($arr);die();
	                //   echo "2";
	                // } 
	                // else
	                // {
	                  $sno = $this->input->post("sno");
	    			  $this->db->where($id,$sno);
				      $this->db->update($tableName,$data);
				      echo "1";    		                
	                // }
	    		}
	    	}
	    }
	  // End Master Insert Without Type
	  //Dynamic Dropdown
	  public function getPOSFromCompany()
    	{
    		try{
    			$query = $this->db->query("SELECT id,name FROM m_master WHERE type='POS' AND company_id=".$this->input->post('subid'));
    			return $query->result();
    		}catch(Exception $e){
    			return $e->getMessage();
    		}
    	}

    	public function getState()
    	{
    		try{
    			$ledger_id=$this->input->get('id');
    			$query = $this->db->query("SELECT id,state FROM m_ledger WHERE id=".$ledger_id."");
		        $result=$query->result();
		        if($query->num_rows()>0)
		        {
		          foreach($result as $row)
		          {
		            $data = array(
		                "Message"=>"Success",
		                "state"=>$row->state
		              );
		          }
		        }
		        else{
		          $data = array(
		              "Message"=>"Failed"
		              );
		        }
		        echo json_encode($data);

    		}catch(Exception $e){
    			return $e->getMessage();
    		}
    	}

    	public function getcust_details()
    	{
    		$html = '';
			$ledger_id=$this->input->get('id');
			$query = $this->db->query("SELECT l.id,l.mobileno,l.district,l.address,s.name AS state_name FROM m_ledger l LEFT JOIN states s ON s.id=l.state WHERE l.id=".$ledger_id." ");
	        $result=$query->result();
	        if($query->num_rows()>0)
	        {
	          foreach($result as $row)
	          {
	            $html = 'Mo .'.$row->mobileno.",".$row->address.",".$row->district.",".$row->state_name;
	          }
    			
	        }
	        echo $html;
		        
    	}

      public function get_partyinfo_cmpt($q){
	    $query=$this->db->query('select id,name from m_ledger where company_id='.get_cookie("ae_company_id").' and name like "%'.$q.'%"');
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){	        
	      	$new_row['label']=htmlentities(stripslashes($row['name']));;
	        $new_row['id']=htmlentities(stripslashes($row['id']));
	        $new_row['name']=htmlentities(stripslashes($row['name']));;
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }else{
	     $row_set[]=''; 	
	     echo json_encode($row_set);
	    }
	  }
    	
}
