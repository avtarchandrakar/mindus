<?
if (!defined('BASEPATH')) exit('No direct script access allowed');

class quotation_model extends CI_Model {

	public function sales_save($tableName,$data,$id,$full_path,$file_name)
        {
          date_default_timezone_set('Asia/Kolkata');
          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
          $tableName3='tbl_order_bal';
          $status = $this->input->post("status");
          $fields = $this->db->field_data($tableName1);
          foreach ($fields as $field)
          {
            if($field->primary_key==1)
              continue;
            $value=$this->input->post($field->name);
            if(!empty($value))
            {
                $data[$field->name]=$value;
            }
          }
          $cat_id=$this->input->post('cat_id');
          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          $rate=$this->input->post("rate");
          $discountrs=$this->input->post("discountrs");
          $discountper=$this->input->post("discountper");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
          $item_remark=$this->input->post("item_remark");
          $unit=$this->input->post("unit");
          $moc=$this->input->post("moc");
          $item_name=$this->input->post("item_name");
          $ledger_id=$this->input->post("ledger_id");
          $data['file_name']=$file_name;
          $data['file_path']=$full_path;
          if($status=="add")
            {
            try{

            $maxsno=0;
            $query=$this->db->query("select max(qua_no) as maxsno from tbl_trans1");
            $result=$query->result();
            if($query->num_rows()>0)
            {
              foreach($result as $row)
              {
                $maxsno = intval($row->maxsno)+1;
              }
            }
            $data['qua_no']=$maxsno;
            $maxsno1='';
            if(strlen($maxsno)==1){
              $maxsno1="00".$maxsno;
            }elseif (strlen($maxsno)==2) {
              $maxsno1="0".$maxsno;
            }else{
              $maxsno1=$maxsno;
            }
            $data['quatation_no']='MI/CO/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;

              $climit=0;
              $query=$this->db->query("select climit from m_ledger where id=".$ledger_id."");
              $result=$query->result();
              if($query->num_rows()>0)
              {
                foreach($result as $row)
                {
                  $climit = $row->climit;
                }
              }
              
              $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_trans1 where cdate='".date('Y-m-d',strtotime($data['cdate']))."' and vtype='".$data["vtype"]."' and company_id=".get_cookie("ae_company_id"));
              $result=$query->result();
              if($query->num_rows()>0)
              {
                foreach($result as $row)
                {
                  $builtyno = $row->builtyno;
                }
              }
              $builtyno++;
              $data['builtyno'] = ($builtyno);
              $data['created_by'] = get_cookie('ae_username');
              $data['created_datetime'] = date('Y-m-d h:i:s');

            $this->db->trans_begin();
            $this->db->insert($tableName1,$data); // insert trans1
            $id=$this->db->insert_id();

            $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$moc,$item_name);
            foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "discount"=>$tuple[3],
                "percent"=>$tuple[6],
                "freight"=>$tuple[4],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[5],
                "remark"=>$tuple[7],
                "unit"=>$tuple[8],
                "moc"=>$tuple[9],
                "item_name"=>$tuple[10],
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
          }
          $this->db->trans_commit();
          echo $id;       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "0";       
            }
        }
        if($status=="edit")
          {
          try{
          $this->db->trans_begin();  
          $id=$this->input->post('sno');

          $data['modified_by'] = get_cookie('ae_username');
          $data['modi_datetime'] = date('Y-m-d h:i:s');

          $this->db->where('id',$id);
          $this->db->update($tableName1,$data); // update trans 1

          $this->db->where('billno',$id);
          $this->db->delete($tableName2); // delete trans 2
          $zipped = array_map(null, $itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$moc,$item_name);
          foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "discount"=>$tuple[3],
                "percent"=>$tuple[6],
                "freight"=>$tuple[4],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[5],
                 "remark"=>$tuple[7],
                 "unit"=>$tuple[8],
                 "moc"=>$tuple[9],
                 "item_name"=>$tuple[10],
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
          }


          $this->db->trans_commit();
          echo $id;       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "0";       
            }
        }
      }
}

?>
