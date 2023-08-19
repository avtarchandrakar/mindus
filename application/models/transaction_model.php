<?
if (!defined('BASEPATH')) exit('No direct script access allowed');

class transaction_model extends CI_Model {
    // Dispatch
    public function dispatch_list(){
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
      $srch = "";
      if($usertype=="CEMENT")
      {
        $srch = " and cat.name='CEMENT'";
      }
      if($usertype=="FERTILIZERS")
      {
        $srch = " and cat.name='FERTILIZERS'";
      }
    	$query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,p.name pname,l.name lname,d.name dname,cat.name catname from tbl_trans1 t1 inner join m_master p on t1.pos_id=p.id inner join m_ledger l on t1.ledger_id=l.id inner join m_master d on t1.destination_id=d.id inner join m_master cat on t1.cat_id=cat.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" ' . $srch . ' and t1.billstatus="pending" order by t1.cdate');
    	return $query->result();
    }


public function GetState()
      {
        try{
          $ledger_id=$this->input->get('ledger_id');
          $query = $this->db->query("SELECT state_id from m_ledger where ledger_id=".$ledger_id."");
          return $query->result();
        }catch(Exception $e){
          return $e->getMessage();
        }
      }

    public function sales_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $user_id=get_cookie('ae_user_id');
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,t1.file_path,t1.quatation_no,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      }
      else{
        $query=$this->db->query('select t1.file_path,t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")  order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.cdate="'.date('Y-m-d').'"  group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      }    
      //echo $this->db->last_query();die;
      return $query->result();
      
    }


    public function ledger_list($ledger_id)
    {
      $query=$this->db->query("select * from m_ledger where id='".$ledger_id."'");
       return $query->result();
    }

    public function sales_list1()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $user_id=get_cookie('ae_user_id');
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.quatation_selected,t1.if_approve,t1.cdate,t1.builtyno,t1.quatation_no,t1.file_path,t1.ledger_id,ledger_mobno,l.name lname from tbl_trans1 t1, m_ledger l where t1.ledger_id=l.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="quatation" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") order by id desc');
        // echo 'select t1.id,t1.if_approve,t1.cdate,t1.builtyno,t1.quatation_no,t1.ledger_id,ledger_mobno,l.name lname from tbl_trans1 t1, m_ledger l where t1.ledger_id=l.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="quatation" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") ';die();
      }
      else{
        $query=$this->db->query('select t1.id,t1.quatation_selected,t1.if_approve,t1.cdate,t1.builtyno,t1.file_path,t1.quatation_no,t1.ledger_id,ledger_mobno,l.name lname from tbl_trans1 t1, m_ledger l where t1.ledger_id=l.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="quatation" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") order by id desc');
      }    
      // echo $this->db->last_query();die;
      return $query->result();
      
    }


    public function approve_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $user_id=get_cookie('ae_user_id');
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        // $query=$this->db->query('select t1.id,t1.if_approve,t1.cdate,t1.builtyno,t1.quatation_no,ledger_mobno,l.name lname,t3.fullpath,t3.filename,t3.id as cpo_id from tbl_trans1 t1, m_ledger l, tbl_trans3 t3 where t1.ledger_id=l.id and t1.id=t3.q_number and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="quatation"  and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") ');
        $query=$this->db->query('select t1.*,t1.cdate,ledger_mobno,l.name lname,t3.if_approve,t3.quatation_no from tbl_trans3 t1, m_ledger l, tbl_trans1 t3 where t1.ledger_id=l.id and t1.q_number=t3.id and t1.company_id='.get_cookie('ae_company_id').'  and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") ');
      }
      else{
        $query=$this->db->query('select t1.*,t1.cdate,ledger_mobno,l.name lname,t3.if_approve,t3.quatation_no from tbl_trans3 t1, m_ledger l, tbl_trans1 t3 where t1.ledger_id=l.id and t1.q_number=t3.id and t1.company_id='.get_cookie('ae_company_id').'  and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") ');
        // $query=$this->db->query('select t1.id,t1.if_approve,t1.cdate,t1.builtyno,t1.quatation_no,ledger_mobno,l.name lname,t3.fullpath,t3.filename,t3.id as cpo_id from tbl_trans1 t1, m_ledger l, tbl_trans3 t3 where t1.ledger_id=l.id and t1.id=t3.q_number and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="quatation"  and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") ');
      }    
      //echo $this->db->last_query();die;
      return $query->result();
      
    }

    public function requisition_list()
    {
      // $from=$this->input->get('from');
      // $to=$this->input->get('to');
      // $vtype=$this->input->get('vtype');
      // $usertype=get_cookie('ae_usertype');
      // // echo $vtype;
      // $user_id=get_cookie('ae_user_id');
      // $p_bdate=0;
      // $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Requisition Slip"');
      //   if($query->num_rows()>0)    
      //   {          
      //       foreach($query->result() as $row)
      //       {
      //         $p_bdate=$row->p_bdate;
      //       }
      // }

      // if($p_bdate==1)
      // {
      //   $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,t1.file_path,t1.jobcard,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      // }
      // else{
      //   $query=$this->db->query('select t1.file_path,t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,t1.jobcard,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")  order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.cdate="'.date('Y-m-d').'"  group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');

      // }    
      //echo $this->db->last_query();die;
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $user_id=get_cookie('ae_user_id');
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,t1.ledger_id,t1.jobcard,t1.quatation_no,ledger_mobno,l.name lname from tbl_trans1 t1, m_ledger l  where t1.ledger_id=l.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") ');
      }
      else{
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,t1.ledger_id,t1.jobcard,t1.quatation_no,ledger_mobno,l.name lname from tbl_trans1 t1, m_ledger l  where t1.ledger_id=l.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") ');
      }    
      //echo $this->db->last_query();die;
      // return $query->result();
      return $query->result();
      
    }

    public function jobcard_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');
      // echo $vtype;
      $user_id=get_cookie('ae_user_id');
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Jobcard"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,t1.file_path,t1.jobcard,GROUP_CONCAT(CONCAT(t2.item_name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2 where t1.ledger_id=l.id and t1.id=t2.billno and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      }
      else{
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,t1.file_path,t1.jobcard,GROUP_CONCAT(CONCAT(t2.item_name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2 where t1.ledger_id=l.id and t1.id=t2.billno and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');

      }    
      // echo $this->db->last_query();die;
      return $query->result();
      
    }


    public function quatation_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $user_id=get_cookie('ae_user_id');
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,t1.file_path,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      }
      else{
        $query=$this->db->query('select t1.file_path,t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")  order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.cdate="'.date('Y-m-d').'"  group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      }    
      //echo $this->db->last_query();die;
      return $query->result();
      
    }



      public function order_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');

      $user_id=get_cookie('ae_user_id');
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_order1 t1, m_ledger l,tbl_order2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      }
      else{
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")  order by t2.id SEPARATOR "<br>") as items from tbl_order1 t1, m_ledger l,tbl_order2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.cdate="'.date('Y-m-d').'"  group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      }    
      //echo $this->db->last_query();die;
      return $query->result();
      
    }


      public function sales_return_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
      $user_id=get_cookie('ae_user_id');
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Sales Return"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,t1.item_type,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")   group by t1.id,t1.cdate,t1.builtyno,t1.item_type,ledger_mobno,l.name order by t1.cdate,t1.id');
      }
      else{
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,t1.item_type,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.cdate="'.date('Y-m-d').'" group by t1.id,t1.cdate,t1.item_type,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');
      }    
      //echo $this->db->last_query();die;
      return $query->result();
      
    }

    public function lr_pending_list()
    {
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
      $user_id=get_cookie('ae_user_id');

      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Pending LR Entry"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")) as items,t1.remark from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t1.truckno="YES" and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and lr_no="" group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name,t1.remark order by t1.cdate desc');
      }
      else{
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")) as items,t1.remark from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t1.truckno="YES" and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and lr_no="" and t1.cdate="'.date('Y-m-d').'" group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name,t1.remark order by t1.cdate desc');
      }    
      //echo $this->db->last_query();die;
      return $query->result();
      
    }

  function save_lr_entry()
  {
      $tableName1='tbl_trans1';
      $id=$this->input->post("id");
      $lr_no=$this->input->post("lr_no");
      $transport=$this->input->post("transport");
      $lr_freight=$this->input->post("lr_freight");
      
      try
    {
            $this->db->trans_begin();
      $zipped = array_map(null,$id,$lr_no,$transport,$lr_freight);
      foreach($zipped as $tuple) 
      {
          if($tuple[1]!="")
            {

              $where=array(
                      'id'=>$tuple[0],
                      );
              $data2=array(
                    "lr_no"=>$tuple[1],
                    "transport"=>$tuple[2],
                    "lr_freight"=>$tuple[3]
                  );
              $this->db->where($where);
              $this->db->update($tableName1,$data2);

              $query=$this->db->query('update tbl_trans1 set vamount=vamount-'.$tuple[3].' where id='.$tuple[0]);
                 
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





    public function lr_return_list()
    {
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
      $user_id=get_cookie('ae_user_id');

      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Pending LR Entry"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")) as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t1.truckno="YES" and  t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and lr_no="" group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name order by t1.cdate desc');
      }
      else{
        $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(i.name," - (",round(t2.qtymt,0),")")) as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t1.truckno="YES" and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and lr_no="" and t1.cdate="'.date('Y-m-d').'" group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name order by t1.cdate desc');
      }    
      //echo $this->db->last_query();die;
      return $query->result();
      
    }

  function save_lr_return_entry()
  {
      $tableName1='tbl_trans1';
      $id=$this->input->post("id");
      $lr_no=$this->input->post("lr_no");
      $transport=$this->input->post("transport");
      $lr_freight=$this->input->post("lr_freight");
      
      try
    {
            $this->db->trans_begin();
      $zipped = array_map(null,$id,$lr_no,$transport,$lr_freight);
      foreach($zipped as $tuple) 
      {
          if($tuple[1]!="")
            {

              $where=array(
                      'id'=>$tuple[0],
                      );
              $data2=array(
                    "lr_no"=>$tuple[1],
                    "transport"=>$tuple[2],
                    "lr_freight"=>$tuple[3]
                  );
              $this->db->where($where);
              $this->db->update($tableName1,$data2);

              $query=$this->db->query('update tbl_trans1 set vamount=vamount-'.$tuple[3].' where id='.$tuple[0]);
                 
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

    public function receipt_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
         
      $user_id=get_cookie('ae_user_id');

      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Receipt"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.builtyno,t1.cdate,t1.tol_amount,t1.salesman,l.name,t1.tol_freight,t1.lessadv,t1.edate from tbl_trans1 t1 left join m_ledger l on t1.ledger_id=l.id   where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.edate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  order by t1.edate,cast(builtyno as UNSIGNED),t1.id');
      }
      else
      {
        $query=$this->db->query('select t1.builtyno,t1.cdate,t1.tol_amount,t1.salesman,l.name,t1.tol_freight,t1.lessadv,t1.edate from tbl_trans1 t1 left join m_ledger l on t1.ledger_id=l.id   where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.edate="'.date('Y-m-d').'" order by t1.edate,cast(builtyno as UNSIGNED),t1.id');
      }
      //echo $this->db->last_query();die;
      return $query->result();
      
    }

    public function payment_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
     
      $user_id=get_cookie('ae_user_id');

      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Payment"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.tol_freight,t1.remark,l.name lname from tbl_trans1 t1 inner join m_ledger l on t1.ledger_id=l.id  where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") order by t1.cdate,t1.id');
      }
      else
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.tol_freight,t1.remark,l.name lname from tbl_trans1 t1 inner join m_ledger l on t1.ledger_id=l.id  where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.cdate="'.date('Y-m-d').'" order by t1.cdate,t1.id');
      }
      //echo $this->db->last_query();die;
      return $query->result();
      
    }

    public function crnote_list()
    {
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
     
      $user_id=get_cookie('ae_user_id');

      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Cr Note"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.tol_freight,t1.remark,l.name lname from tbl_trans1 t1 inner join m_ledger l on t1.ledger_id=l.id  where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" order by t1.cdate,t1.id');
      }
      else
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.tol_freight,t1.remark,l.name lname from tbl_trans1 t1 inner join m_ledger l on t1.ledger_id=l.id  where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.cdate="'.date('Y-m-d').'" order by t1.cdate,t1.id');
      }
      //echo $this->db->last_query();die;
      return $query->result();
      
    }

    public function drnote_list()
    {
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
      $user_id=get_cookie('ae_user_id');
     
      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Dr Note"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.tol_freight,t1.remark,l.name lname from tbl_trans1 t1 inner join m_ledger l on t1.ledger_id=l.id  where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" order by t1.cdate,t1.id');
      }
      else
      {
        $query=$this->db->query('select t1.id,t1.cdate,t1.tol_freight,t1.remark,l.name lname from tbl_trans1 t1 inner join m_ledger l on t1.ledger_id=l.id  where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.cdate="'.date('Y-m-d').'" order by t1.cdate,t1.id');
      }
      //echo $this->db->last_query();die;
      return $query->result();
      
    }


    public function invoices_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
     
      $user_id=get_cookie('ae_user_id');

        $query=$this->db->query('select t1.*,l.name lname,t1.ledger_id from tbl_invoice1 t1, m_ledger l,tbl_invoice2 t2 where t1.ledger_id=l.id and t1.id=t2.billno and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") group by t1.id,t1.cdate,l.name order by t1.created_datetime,t1.id');
        // echo $this->db->last_query();die;
      return $query->result();

      
    }


    public function voucher_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
     
      $user_id=get_cookie('ae_user_id');

      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Cr Note"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.* from tbl_trans1 t1 where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") group by t1.id,t1.cdate,t1.builtyno,t1.item_type order by t1.cdate,t1.id');
      }
      else
      {
        $query=$this->db->query('select t1.* from tbl_trans1 t1 where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") group by t1.id,t1.cdate,t1.builtyno,t1.item_type order by t1.cdate,t1.id');
      }
      // echo $this->db->last_query();die;
      return $query->result();
      
    }

    public function purchase_list()
    {
      $from=$this->input->get('from');
      $to=$this->input->get('to');
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
     
      $user_id=get_cookie('ae_user_id');

      $p_bdate=0;
      $query=$this->db->query('select p_entry,p_modify,p_delete,p_list,p_bdate from tbl_user_permission where permission_id='.$user_id.' and form_id="Cr Note"');
        if($query->num_rows()>0)    
        {          
            foreach($query->result() as $row)
            {
              $p_bdate=$row->p_bdate;
            }
      }

      if($p_bdate==1)
      {
        $query=$this->db->query('select t1.file_path,t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(i.name) as items,t1.item_type,t1.ledger_id from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name,t1.item_type order by t1.cdate,t1.id');
      }
      else
      {
        $query=$this->db->query('select t1.file_path,t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name lname,GROUP_CONCAT(i.name) as items,t1.item_type,t1.ledger_id from tbl_trans1 t1, m_ledger l,tbl_trans2 t2, m_item i where t1.ledger_id=l.id and t1.id=t2.billno and t2.itemcode=i.id and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'") group by t1.id,t1.cdate,t1.builtyno,ledger_mobno,l.name,t1.item_type order by t1.cdate,t1.id');
      }
      // echo $this->db->last_query();die;
      return $query->result();
      
    }
    
    public function dispatch_save()
        {
          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
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
          $data['cdate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          $qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
         /* $itemcode=array(12,3,4);
          $qtymt=array(2,13,41);
          $qtybag=array(21,3,14);
          $rate=array(21,31,41);
          $freight=array(12,31,14);*/
          if($status=="add")
            {
            try{
            $this->db->trans_begin();
          $this->db->insert($tableName1,$data); // insert trans1
          $id=$this->db->insert_id();
          $zipped = array_map(null,$itemcode,$qtymt,$qtybag,$rate,$freight,$orderid_gen);
          foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
                $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "qtybag"=>$tuple[2],
                "rate"=>$tuple[3],
                "freight"=>$tuple[4],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[5],
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[3]) || $tuple[3]==0.00 || $tuple[3]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
            }//End if
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
        }
        if($status=="edit")
          {
          try{
          $this->db->trans_begin();  
          $id=$this->input->post('sno');
          $this->db->where('id',$id);
          $this->db->update($tableName1,$data); // update trans 1
          $this->db->where('billno',$id);
          $this->db->delete($tableName2); // delete trans 2
          $zipped = array_map(null, $itemcode,$qtymt,$qtybag, $rate,$freight,$orderid_gen);
          foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "qtybag"=>$tuple[2],
                "rate"=>$tuple[3],
                "freight"=>$tuple[4],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[5],
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[3]) || $tuple[3]==0.00 || $tuple[3]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
        }
      }

    public function approve_save($tableName,$data,$id,$full_path,$file_name)
    {
          date_default_timezone_set('Asia/Kolkata');
          $tableName1='tbl_trans3';
          $tableName3='tbl_trans1';

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

          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['company_id'] = get_cookie("ae_company_id");
          $data['filename']=$file_name;
          $data['fullpath']=$full_path;

          $cdate = date('Y-m-d',strtotime($this->input->post('cdate')));
          $company_id = get_cookie("ae_company_id");
          if($status=="add"){
            $q_number=$this->input->post('q_number');
            $this->db->trans_begin();
            $updata['if_approve']='1';
            $query=$this->db->query("update tbl_trans1 set if_approve='1' where id='".$q_number."'");
            // $this->db->where('id',$q_number);
            // $this->db->update($tableName3,$updata);
            $this->db->insert($tableName1,$data); // insert trans1
            $id=$this->db->insert_id();
            $q_number=$this->input->post('q_number');
            echo $id;
          }elseif($status=="edit"){
            $sno = $this->input->post('sno');
            if ($sno>0){
              $this->db->trans_begin();
              $this->db->where('id',$sno);
              $this->db->update($tableName1,$data);
              echo $sno;
            }else{
              echo '0';
            }
            
          }
           
          
    }



      public function requisition_save($tableName,$data,$id,$full_path,$file_name)
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
          $data['vamount'] = ($this->input->post('tol_freight'))*-1;
          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          // $specification=$this->input->post("specification");
          $rate=$this->input->post("rate");
          $discountrs=$this->input->post("discountrs");
          $discountper=$this->input->post("discountper");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
          $item_remark=$this->input->post("item_remark");
          $unit=$this->input->post("unit");
          $moc=$this->input->post("moc");
          $drawing_no=$this->input->post("drawing_no");
          $item_name=$this->input->post("item_name");


            // print_r($drawing_no);



          $ledger_id=$this->input->post("ledger_id");


          $data['file_name']=$file_name;
          $data['file_path']=$full_path;

     
          if($status=="add")
            {
            try{

            $maxsno=0;
            $query=$this->db->query("select max(req_no) as maxsno from tbl_trans1");
            $result=$query->result();
            if($query->num_rows()>0)
            {
              foreach($result as $row)
              {
                $maxsno = intval($row->maxsno)+1;
              }
            }
            $data['req_no']=$maxsno;
            $maxsno1='';
            if(strlen($maxsno)==1){
              $maxsno1="00".$maxsno;
            }elseif (strlen($maxsno)==2) {
              $maxsno1="0".$maxsno;
            }else{
              $maxsno1=$maxsno;
            }
            $data['requisition']='MI/REQ/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;


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

            
            $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$moc,$drawing_no,$item_name);
            foreach($zipped as $tuple) {
            // if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            // {
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
                "drawing_no"=>$tuple[10],
                "item_name"=>$tuple[11],
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
            // }//End if
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

          // print_r($item_name)."<br>";
          // print_r($qtymt)."<br>";
          // print_r($itemcode)."<br>";
          // print_r($rate)."<br>";
          // print_r($discountrs)."<br>";
          // print_r($freight)."<br>";
          // print_r($orderid_gen)."<br>";
          // print_r($discountper)."<br>";
          // print_r($item_remark)."<br>";
          // print_r($unit)."<br>";
          // print_r($moc)."<br>";
          // print_r($drawing_no)."<br>";die();



          $zipped = array_map(null, $itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$moc,$drawing_no,$item_name);
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
                "drawing_no"=>$tuple[10],
                "item_name"=>$tuple[11],
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }

          $this->db->trans_commit();
          echo $id;       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "0";       
            }
        }
      }

      public function jobcard_save($tableName,$data,$id,$full_path,$file_name)
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
          $data['vamount'] = ($this->input->post('tol_freight'))*-1;
          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          // $specification=$this->input->post("specification");
          $rate=$this->input->post("rate");
          $discountrs=$this->input->post("discountrs");
          $discountper=$this->input->post("discountper");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
          $item_remark=$this->input->post("item_remark");
          $unit=$this->input->post("unit");
          $moc=$this->input->post("moc");
          $drawing_no=$this->input->post("drawing_no");
          $item_name=$this->input->post("item_name");


            // print_r($drawing_no);



          $ledger_id=$this->input->post("ledger_id");


          $data['file_name']=$file_name;
          $data['file_path']=$full_path;

     
          if($status=="add")
            {
            try{

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
            $data['job_sno']=$maxsno;
            $maxsno1='';
            if(strlen($maxsno)==1){
              $maxsno1="00".$maxsno;
            }elseif (strlen($maxsno)==2) {
              $maxsno1="0".$maxsno;
            }else{
              $maxsno1=$maxsno;
            }
            $data['jobcard']='MI/JC/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;


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


            $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$moc,$drawing_no,$item_name);
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
                "drawing_no"=>$tuple[10],
                "item_name"=>$tuple[11],
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
           
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

          $zipped = array_map(null, $itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$moc,$drawing_no,$item_name);
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
                "drawing_no"=>$tuple[10],
                "item_name"=>$tuple[11],
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }

          $this->db->trans_commit();
          echo $id;       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "0";       
            }
        }
      }

      // public function sales_save($tableName,$data,$id,$full_path,$file_name)
      //   {
      //     date_default_timezone_set('Asia/Kolkata');
      //     $tableName1='tbl_trans1';
      //     $tableName2='tbl_trans2';
      //     $tableName3='tbl_order_bal';
      //     $status = $this->input->post("status");
      //     $fields = $this->db->field_data($tableName1);
      //     foreach ($fields as $field)
      //     {
      //       if($field->primary_key==1)
      //         continue;
      //       $value=$this->input->post($field->name);
      //       if(!empty($value))
      //       {
      //           $data[$field->name]=$value;
      //       }
      //     }


      //     $cat_id=$this->input->post('cat_id');
      //     // $data['vamount'] = ($this->input->post('tol_freight'))*-1;
      //     $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
      //     $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
      //     $data['pos_id'] = get_cookie("ae_pos_id");
      //     $data['company_id'] = get_cookie("ae_company_id");
      //     $itemcode=$this->input->post("itemcode");
      //     $qtymt=$this->input->post("qtymt");
      //     // $specification=$this->input->post("specification");
      //     $rate=$this->input->post("rate");
      //     $discountrs=$this->input->post("discountrs");
      //     $discountper=$this->input->post("discountper");
      //     $freight=$this->input->post("freight");
      //     $orderid_gen=$this->input->post("orderid_gen");
      //     $item_remark=$this->input->post("item_remark");
      //     $unit=$this->input->post("unit");
      //     $moc=$this->input->post("moc");
      //     $item_name=$this->input->post("item_name");


      //     $ledger_id=$this->input->post("ledger_id");


      //     $data['file_name']=$file_name;
      //     $data['file_path']=$full_path;

     
      //     if($status=="add")
      //       {
      //       try{

      //       $maxsno=0;
      //       $query=$this->db->query("select max(qua_no) as maxsno from tbl_trans1");
      //       $result=$query->result();
      //       if($query->num_rows()>0)
      //       {
      //         foreach($result as $row)
      //         {
      //           $maxsno = intval($row->maxsno)+1;
      //         }
      //       }
      //       $data['qua_no']=$maxsno;
      //       $maxsno1='';
      //       if(strlen($maxsno)==1){
      //         $maxsno1="00".$maxsno;
      //       }elseif (strlen($maxsno)==2) {
      //         $maxsno1="0".$maxsno;
      //       }else{
      //         $maxsno1=$maxsno;
      //       }
      //       $data['quatation_no']='MI/CO/'.substr(get_cookie("ae_fnyear_name"),8,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;


      //         $climit=0;
      //         $query=$this->db->query("select climit from m_ledger where id=".$ledger_id."");
      //         $result=$query->result();
      //         if($query->num_rows()>0)
      //         {
      //           foreach($result as $row)
      //           {
      //             $climit = $row->climit;
      //           }
      //         }
              
      //         $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_trans1 where cdate='".date('Y-m-d',strtotime($data['cdate']))."' and vtype='".$data["vtype"]."' and company_id=".get_cookie("ae_company_id"));
      //         $result=$query->result();
      //         if($query->num_rows()>0)
      //         {
      //           foreach($result as $row)
      //           {
      //             $builtyno = $row->builtyno;
      //           }
      //         }
      //         $builtyno++;
      //         $data['builtyno'] = ($builtyno);
      //         $data['created_by'] = get_cookie('ae_username');
      //         $data['created_datetime'] = date('Y-m-d h:i:s');

      //       $this->db->trans_begin();
      //       $this->db->insert($tableName1,$data); // insert trans1
      //       $id=$this->db->insert_id();

      //       $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$moc,$item_name);
      //       foreach($zipped as $tuple) {
      //       // if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
      //       // {
      //         $data2=array(
      //           "billno"=>$id,
      //           "itemcode"=>$tuple[0],
      //           "qtymt"=>$tuple[1],
      //           "rate"=>$tuple[2],
      //           "discount"=>$tuple[3],
      //           "percent"=>$tuple[6],
      //           "freight"=>$tuple[4],
      //           "cat_id"=>$cat_id,
      //           "orderid_gen"=>$tuple[5],
      //           "remark"=>$tuple[7],
      //           "unit"=>$tuple[8],
      //           "moc"=>$tuple[9],
      //           "item_name"=>$tuple[10],
      //           "company_id"=>get_cookie('ae_company_id')
      //           );
      //         $this->db->insert($tableName2,$data2);
      //         //Update Status
      //         if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
      //           $updata=array(
      //             'tstatus'=>'pending'
      //             );
      //           $this->db->where('id',$id);
      //           $this->db->update($tableName1,$updata);
      //         }else{
      //           $updata=array(
      //             'tstatus'=>'pending'
      //             );
      //           $this->db->where('id',$id);
      //           $this->db->update($tableName1,$updata);
      //         }
      //         //End Update Status
      //       //}//End if
      //     }
      //     $this->db->trans_commit();
      //     echo $id;       
      //       }catch(Exception $e){
      //       $this->db->trans_rollback();
      //       echo "0";       
      //       }
      //   }
      //   if($status=="edit")
      //     {
      //     try{
      //     $this->db->trans_begin();  
      //     $id=$this->input->post('sno');

      //     $data['modified_by'] = get_cookie('ae_username');
      //     $data['modi_datetime'] = date('Y-m-d h:i:s');

      //     $this->db->where('id',$id);
      //     $this->db->update($tableName1,$data); // update trans 1

      //     $this->db->where('billno',$id);
      //     $this->db->delete($tableName2); // delete trans 2
      //     $zipped = array_map(null, $itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$moc,$item_name);
      //     foreach($zipped as $tuple) {
      //         $data2=array(
      //           "billno"=>$id,
      //           "itemcode"=>$tuple[0],
      //           "qtymt"=>$tuple[1],
      //           "rate"=>$tuple[2],
      //           "discount"=>$tuple[3],
      //           "percent"=>$tuple[6],
      //           "freight"=>$tuple[4],
      //           "cat_id"=>$cat_id,
      //           "orderid_gen"=>$tuple[5],
      //            "remark"=>$tuple[7],
      //            "unit"=>$tuple[8],
      //            "moc"=>$tuple[9],
      //            "item_name"=>$tuple[10],


      //           "company_id"=>get_cookie('ae_company_id')            
      //           );
      //         $this->db->insert($tableName2,$data2);
      //         //Update Status
      //         if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
      //           $updata=array(
      //             'tstatus'=>'pending'
      //             );
      //           $this->db->where('id',$id);
      //           $this->db->update($tableName1,$updata);
      //         }else{
      //           $updata=array(
      //             'tstatus'=>''
      //             );
      //           $this->db->where('id',$id);
      //           $this->db->update($tableName1,$updata);
      //         }
      //         //End Update Status
      //     }


      //     $this->db->trans_commit();
      //     echo $id;       
      //       }catch(Exception $e){
      //       $this->db->trans_rollback();
      //       echo "0";       
      //       }
      //   }
      // }


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
            $data['quatation_no']='MI/CO/'.substr(get_cookie("ae_fnyear_name"),8,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;

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


      public function voucher_save($tableName,$data,$id,$full_path,$file_name)
        {
          date_default_timezone_set('Asia/Kolkata');
          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
          
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

          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $data['file_name']=$file_name;
          $data['file_path']=$full_path;

     
          if($status=="add")
            {
            try{

            $maxsno=0;
            $query=$this->db->query("select max(vouc_no) as maxsno from tbl_trans1");
            $result=$query->result();
            if($query->num_rows()>0)
            {
              foreach($result as $row)
              {
                $maxsno = intval($row->maxsno)+1;
              }
            }
            $data['vouc_no']=$maxsno;
            $maxsno1='';
            if(strlen($maxsno)==1){
              $maxsno1="00".$maxsno;
            }elseif (strlen($maxsno)==2) {
              $maxsno1="0".$maxsno;
            }else{
              $maxsno1=$maxsno;
            }
            $data['voucher_no']='MI/VOC/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;
              
             
              $data['created_by'] = get_cookie('ae_username');
              $data['created_datetime'] = date('Y-m-d h:i:s');
            $this->db->trans_begin();
            $this->db->insert($tableName1,$data); // insert trans1
            $id=$this->db->insert_id();
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

          $this->db->trans_commit();
          echo $id;       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "0";       
            }
        }
      }



      public function purchases_save($tableName,$data,$id,$full_path,$file_name)
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
          $cat_id=$this->input->post('cat_id');

          $data['vamount'] = ($this->input->post('tol_freight'))*-1;
          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          // $specification=$this->input->post("specification");
          $rate=$this->input->post("rate");
          $discountrs=$this->input->post("discountrs");
          $discountper=$this->input->post("discountper");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
          $item_remark=$this->input->post("item_remark");
          $unit=$this->input->post("unit");
          $ledger_id=$this->input->post("ledger_id");


          $data['file_name']=$file_name;
          $data['file_path']=$full_path;

     
          if($status=="add")
            {
            try{

            $maxsno=0;
            $query=$this->db->query("select max(pur_no) as maxsno from tbl_trans1");
            $result=$query->result();
            if($query->num_rows()>0)
            {
              foreach($result as $row)
              {
                $maxsno = intval($row->maxsno)+1;
              }
            }
            $data['pur_no']=$maxsno;
            $maxsno1='';
            if(strlen($maxsno)==1){
              $maxsno1="00".$maxsno;
            }elseif (strlen($maxsno)==2) {
              $maxsno1="0".$maxsno;
            }else{
              $maxsno1=$maxsno;
            }
            $data['purchase_no']='PO/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;

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

            $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit);
            foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
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
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
            }//End if
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
          $zipped = array_map(null, $itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit);
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


      public function work_order_save($tableName,$data,$id,$full_path,$file_name)
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
          $cat_id=$this->input->post('cat_id');

          $data['vamount'] = ($this->input->post('tol_freight'))*-1;
          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          // $specification=$this->input->post("specification");
          $rate=$this->input->post("rate");
          $discountrs=$this->input->post("discountrs");
          $discountper=$this->input->post("discountper");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
          $item_remark=$this->input->post("item_remark");
          $unit=$this->input->post("unit");
          $ledger_id=$this->input->post("ledger_id");


          $data['file_name']=$file_name;
          $data['file_path']=$full_path;

     
          if($status=="add")
            {
            try{

            $maxsno=0;
            $query=$this->db->query("select max(won_no) as maxsno from tbl_trans1");
            $result=$query->result();
            if($query->num_rows()>0)
            {
              foreach($result as $row)
              {
                $maxsno = intval($row->maxsno)+1;
              }
            }
            $data['won_no']=$maxsno;
            $maxsno1='';
            if(strlen($maxsno)==1){
              $maxsno1="00".$maxsno;
            }elseif (strlen($maxsno)==2) {
              $maxsno1="0".$maxsno;
            }else{
              $maxsno1=$maxsno;
            }
            $data['workorder_no']='WON/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;

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



            $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit);
            foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
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
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
            }//End if
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
          $zipped = array_map(null, $itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit);
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


      public function invoices_save($tableName,$data,$id,$full_path,$file_name)
        {
          date_default_timezone_set('Asia/Kolkata');

          $tableName1='tbl_invoice1';
          $tableName2='tbl_invoice2';
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

          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          // $specification=$this->input->post("specification");
          $rate=$this->input->post("rate");
          $discountrs=$this->input->post("discountrs");
          $discountper=$this->input->post("discountper");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
          $item_remark=$this->input->post("item_remark");
          $unit=$this->input->post("unit");
          $ledger_id=$this->input->post("ledger_id");
          $item_name=$this->input->post("item_name");
          $persentage=$this->input->post("persentage");
          $hson_no=$this->input->post("hson_no");


          $data['file_name']=$file_name;
          $data['file_path']=$full_path;

     
          if($status=="add")
            {
            try{

            $maxsno=0;
            $query=$this->db->query("select max(inv_no) as maxsno from tbl_invoice1");
            $result=$query->result();
            if($query->num_rows()>0)
            {
              foreach($result as $row)
              {
                $maxsno = intval($row->maxsno)+1;
              }
            }
            $data['inv_no']=$maxsno;
            $maxsno1='';
            if(strlen($maxsno)==1){
              $maxsno1="00".$maxsno;
            }elseif (strlen($maxsno)==2) {
              $maxsno1="0".$maxsno;
            }else{
              $maxsno1=$maxsno;
            }
            $data['invoice_no']='INV/'.substr(get_cookie("ae_fnyear_name"),3,2)."-".substr(get_cookie("ae_fnyear_name"),8,2)."/".$maxsno1;

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
              
              $data['created_by'] = get_cookie('ae_username');
              $data['created_datetime'] = date('Y-m-d h:i:s');

            $this->db->trans_begin();
            $this->db->insert($tableName1,$data); // insert trans1
            $id=$this->db->insert_id();

            $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$item_name,$persentage,$hson_no);
            foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "discount"=>$tuple[3],
                "percent"=>$tuple[6],
                "freight"=>$tuple[4],
                "orderid_gen"=>$tuple[5],
                "remark"=>$tuple[7],
                "unit"=>$tuple[8],
                "item_name"=>$tuple[9],
                "persentage"=>$tuple[10],
                "hson_no"=>$tuple[11],
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
          $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark,$unit,$item_name,$persentage,$hson_no);
            foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "discount"=>$tuple[3],
                "percent"=>$tuple[6],
                "freight"=>$tuple[4],
                "orderid_gen"=>$tuple[5],
                "remark"=>$tuple[7],
                "unit"=>$tuple[8],
                "item_name"=>$tuple[9],
                "persentage"=>$tuple[10],
                "hson_no"=>$tuple[11],
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


////////////

      public function order_save()
      {
          date_default_timezone_set('Asia/Kolkata');

          $tableName1='tbl_order1';
          $tableName2='tbl_order2';
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
          $data['vamount'] = ($this->input->post('tol_freight'))*-1;
          $data['cdate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['edate'] = date('Y-m-d',strtotime($this->input->post('cdate')));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          //$qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $discountrs=$this->input->post("discountrs");
          $discountper=$this->input->post("discountper");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
          $ledger_id=$this->input->post("ledger_id");
          $item_remark=$this->input->post("item_remark");
          
         /* $itemcode=array(12,3,4);
          $qtymt=array(2,13,41);
          $qtybag=array(21,3,14);
          $rate=array(21,31,41);
          $freight=array(12,31,14);*/
          if($status=="add")
          {
            try{
              $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_order1 where cdate='".date('Y-m-d',strtotime($this->input->post('cdate')))."' and vtype='".$data["vtype"]."' and company_id=".get_cookie("ae_company_id"));
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

            //order bal 
            $zipped_b = array_map(null,$itemcode,$qtymt);
            foreach($zipped_b as $tuple_b) 
            {
              if($tuple_b[0]!='' && ($tuple_b[1]!=0 || $tuple_b[1]!=''))
              {
                  $where=array(
                                "ledger_id"=>$ledger_id,
                                "item_id"=>$tuple_b[0],
                                "company_id"=>get_cookie('ae_company_id')
                              );
                  $this->db->where($where);
                  $q=$this->db->get($tableName3);
                  if($q->num_rows()>0)
                  {
                      $oldata=$q->result();
                      $old_bal=$oldata[0]->bal;
                      $old_id=$oldata[0]->id;
                      $newbal=$old_bal+$tuple_b[1];

                      $where1=array(
                                "id"=>$old_id
                              );
                      $data_b=array(
                          "bal"=>$newbal
                      );
                      $this->db->where($where1);
                      $this->db->update($tableName3,$data_b);                  
                  }
                  else
                  {
                    $data_b=array(
                          "ledger_id"=>$ledger_id,
                          "item_id"=>$tuple_b[0],
                          "bal"=>$tuple_b[1],
                          "company_id"=>get_cookie('ae_company_id')
                      );
                    $this->db->insert($tableName3,$data_b);
                  }
              }
            }

            //
            $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark);
            foreach($zipped as $tuple) 
            {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
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
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
            }//End if
          }
            $this->db->trans_commit();
            echo $id;       
          }
          catch(Exception $e)
          {
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

          $zipped_b = $this->db->query("select itemcode,qtymt from tbl_order2 where billno=".$id);
          foreach($zipped_b->result() as $tuple_b) 
          {             
                  $where=array(
                                "ledger_id"=>$ledger_id,
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

          $this->db->where('billno',$id);
          $this->db->delete($tableName2); // delete trans 2
          $zipped = array_map(null, $itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper,$item_remark);
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
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);

              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }


              //order bal 
            $zipped_b1 = array_map(null,$itemcode,$qtymt);
            foreach($zipped_b1 as $tuple_b1) 
            {
              if($tuple_b1[0]!='' && ($tuple_b1[1]!=0 || $tuple_b1[1]!=''))
              {
                  $where=array(
                                "ledger_id"=>$ledger_id,
                                "item_id"=>$tuple_b1[0],
                                "company_id"=>get_cookie('ae_company_id')
                              );
                  $this->db->where($where);
                  $q=$this->db->get($tableName3);
                  if($q->num_rows()>0)
                  {
                      $oldata=$q->result();
                      $old_bal=$oldata[0]->bal;
                      $old_id=$oldata[0]->id;
                      $newbal=$old_bal+$tuple_b1[1];

                      $where1=array(
                                "id"=>$old_id
                              );
                      $data_b=array(
                          "bal"=>$newbal
                      );
                      $this->db->where($where1);
                      $this->db->update($tableName3,$data_b);                  
                  }
                  else
                  {
                    $data_b=array(
                          "ledger_id"=>$ledger_id,
                          "item_id"=>$tuple_b1[0],
                          "bal"=>$tuple_b1[1],
                          "company_id"=>get_cookie('ae_company_id')
                      );
                    $this->db->insert($tableName3,$data_b);
                  }
              }
            }

            $this->db->trans_commit();
            echo $id;       
          }
          catch(Exception $e)
          {
            $this->db->trans_rollback();
            echo "0";       
          }
        }
      }


////////////      
      public function sales_return_save()
        {
          ini_set('post_max_size', '200M');  
          date_default_timezone_set('Asia/Kolkata');

          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
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
          $data['vamount'] = ($this->input->post('tol_freight'));
          $data['cdate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['edate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          //$qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $discountrs=$this->input->post("discountrs");
          $discountper=$this->input->post("discountper");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");

         /* $itemcode=array(12,3,4);
          $qtymt=array(2,13,41);
          $qtybag=array(21,3,14);
          $rate=array(21,31,41);
          $freight=array(12,31,14);*/
          if($status=="add")
            {
            try{

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




            $zipped = array_map(null,$itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper);
            foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
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
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
            }//End if
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

          $data['vamount'] = ($this->input->post('tol_freight'));
          $data['modified_by'] = get_cookie('ae_username');
          $data['modi_datetime'] = date('Y-m-d h:i:s');

          $this->db->where('id',$id);
          $this->db->update($tableName1,$data); // update trans 1
          $this->db->where('billno',$id);
          $this->db->delete($tableName2); // delete trans 2
          $zipped = array_map(null, $itemcode,$qtymt,$rate,$discountrs,$freight,$orderid_gen,$discountper);
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
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }
          $this->db->trans_commit();
          echo $id;       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "0";       
            }
        }
      }


////////////      
public function purchase_save($tableName,$data,$id,$full_path,$file_name)
        {
          date_default_timezone_set('Asia/Kolkata');

          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
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

          $data['file_name']=$file_name;
          $data['file_path']=$full_path;

          $cat_id=$this->input->post('cat_id');
          $data['cdate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['edate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['vamount'] = ($this->input->post('tol_freight'));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          //$qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
         /* $itemcode=array(12,3,4);
          $qtymt=array(2,13,41);
          $qtybag=array(21,3,14);
          $rate=array(21,31,41);
          $freight=array(12,31,14);*/
          if($status=="add")
            {
            try{

              $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_trans1 where vtype='".$data["vtype"]."' and company_id=".get_cookie("ae_company_id"));
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
            $zipped = array_map(null,$itemcode,$qtymt,$rate,$freight,$orderid_gen);
            foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
                $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "freight"=>$tuple[3],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[4],
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
            }//End if
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
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
          $zipped = array_map(null, $itemcode,$qtymt,$rate,$freight,$orderid_gen);
          foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "freight"=>$tuple[3],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[4],
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
        }
      }


      public function purchase_save_old()
        {
          date_default_timezone_set('Asia/Kolkata');

          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
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

          // $data['file_name']=$file_name;
          // $data['file_path']=$full_path;

          $cat_id=$this->input->post('cat_id');
          $data['cdate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['edate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['vamount'] = ($this->input->post('tol_freight'));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          //$qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
         /* $itemcode=array(12,3,4);
          $qtymt=array(2,13,41);
          $qtybag=array(21,3,14);
          $rate=array(21,31,41);
          $freight=array(12,31,14);*/
          if($status=="add")
            {
            try{

              $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_trans1 where vtype='".$data["vtype"]."' and company_id=".get_cookie("ae_company_id"));
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
            $zipped = array_map(null,$itemcode,$qtymt,$rate,$freight,$orderid_gen);
            foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
                $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "freight"=>$tuple[3],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[4],
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
            }//End if
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
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
          $zipped = array_map(null, $itemcode,$qtymt,$rate,$freight,$orderid_gen);
          foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "freight"=>$tuple[3],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[4],
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
        }
      }
////////////      
public function purchase_return_save()
        {
          date_default_timezone_set('Asia/Kolkata');

          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
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
          $data['cdate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['edate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['vamount'] = ($this->input->post('tol_freight'))*-1;
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          //$qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $freight=$this->input->post("freight");
          $orderid_gen=$this->input->post("orderid_gen");
         /* $itemcode=array(12,3,4);
          $qtymt=array(2,13,41);
          $qtybag=array(21,3,14);
          $rate=array(21,31,41);
          $freight=array(12,31,14);*/
          if($status=="add")
            {
            try{

              $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_trans1 where vtype='".$data["vtype"]."' and company_id=".get_cookie("ae_company_id"));
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
            $zipped = array_map(null,$itemcode,$qtymt,$rate,$freight,$orderid_gen);
            foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
                $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "freight"=>$tuple[3],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[4],
                "company_id"=>get_cookie('ae_company_id')
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
            }//End if
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
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
          $zipped = array_map(null, $itemcode,$qtymt,$rate,$freight,$orderid_gen);
          foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "rate"=>$tuple[2],
                "freight"=>$tuple[3],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[4],
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[2]) || $tuple[2]==0.00 || $tuple[2]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
        }
      }

///////////////////
      public function receipt_save()
        {
          date_default_timezone_set('Asia/Kolkata');

          $tableName1='tbl_trans1';
          $status = $this->input->post("status");
          $vtype = $this->input->post("vtype");


          $cdate=$this->input->post('cdate');
          $cdate=date('Y-m-d',strtotime($cdate));
          $salesman=$this->input->post('salesman');
          $tol_amount=$this->input->post('tol_amount');

          $ledger_id=$this->input->post("ledger_id");
          $vdate=$this->input->post("vdate");
          $tol_freight=$this->input->post("tol_freight");
          $lessadv=$this->input->post("less_adv");
          $mode_id=$this->input->post("mode_id");
          $remark=$this->input->post("remark");
          $cleardate=$this->input->post("cleardate");

          if($status=="add")
            {
            try{
            $this->db->trans_begin();
            $builtyno=0;
            $query=$this->db->query("select max(cast(builtyno as UNSIGNED)) as builtyno from tbl_trans1 where vtype='".$vtype."' and company_id=".get_cookie("ae_company_id"));
            $result=$query->result();
            if($query->num_rows()>0)
            {
              foreach($result as $row)
              {
                $builtyno = $row->builtyno;
              }
            }
            $builtyno++;


            $zipped = array_map(null,$ledger_id,$tol_freight,$mode_id,$remark,$cleardate,$lessadv,$vdate);
            foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
              $lessamt=0;
              $vamount=0;
              if($tuple[5]=="")
              {
                $lessamt=0;
              }
              else
              {
                $lessamt=$tuple[5];
              }
              $vamount=$tuple[1]-$lessamt;

          $data['pos_id'] = 
          $data['company_id'] = get_cookie("ae_company_id");
              $data=array(
                "pos_id"=>get_cookie("ae_pos_id"),
                "company_id"=>get_cookie("ae_company_id"),
                "cdate"=>date('Y-m-d',strtotime($tuple[6])),
                "edate"=>$cdate,
                "builtyno"=>$builtyno,
                "salesman"=>$salesman,
                "tol_amount"=>$tol_amount,

                "vtype"=>$vtype,
                "ledger_id"=>$tuple[0],
                "tol_freight"=>$tuple[1],
                "ref_ledger_id"=>$tuple[2],
                "lessadv"=>$lessamt,
                "remark"=>$tuple[3],
                "vamount"=>$vamount,
                "cleardate"=>date('Y-m-d',strtotime($tuple[4]))
                );

              $data['created_by'] = get_cookie('ae_username');
              $data['created_datetime'] = date('Y-m-d h:i:s');

              $this->db->insert("tbl_trans1",$data);
            }//End if
          }
          $this->db->trans_commit();
          echo $builtyno;       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "0";       
            }
        }
        if($status=="edit")
          {
          try{
          $this->db->trans_begin();  
          $sno1=$this->input->post('sno');
          $builtyno=$this->input->post('sno');
          $query=$this->db->query('delete from tbl_trans1 where vtype="receipt" and builtyno='.$builtyno . ' and company_id='.get_cookie("ae_company_id"));

            $zipped = array_map(null,$ledger_id,$tol_freight,$mode_id,$remark,$cleardate,$lessadv,$vdate);
            foreach($zipped as $tuple) {
            if($tuple[0]!='' && ($tuple[1]!=0 || $tuple[1]!=''))
            {
              $lessamt=0;
              $vamount=0;
              if($tuple[5]=="")
              {
                $lessamt=0;
              }
              else
              {
                $lessamt=$tuple[5];
              }
              $vamount=$tuple[1]-$lessamt;

              $data=array(
                "pos_id"=>get_cookie("ae_pos_id"),
                "company_id"=>get_cookie("ae_company_id"),
                "cdate"=>date('Y-m-d',strtotime($tuple[6])),
                "edate"=>$cdate,
                "builtyno"=>$builtyno,
                "salesman"=>$salesman,
                "tol_amount"=>$tol_amount,

                "vtype"=>$vtype,
                "ledger_id"=>$tuple[0],
                "tol_freight"=>$tuple[1],
                "ref_ledger_id"=>$tuple[2],
                "lessadv"=>$lessamt,
                "remark"=>$tuple[3],
                "vamount"=>$vamount,
                "cleardate"=>date('Y-m-d',strtotime($tuple[4]))
                );

              $data['modified_by'] = get_cookie('ae_username');
              $data['modi_datetime'] = date('Y-m-d h:i:s');

              $this->db->insert("tbl_trans1",$data);
            }//End if
            
          }
          echo $builtyno;
          $this->db->trans_commit();
//          echo $id;       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "0";       
            }
        }
      }


////////////


      /////////

      public function dispatch_save_modify()
        {
          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
          
          $cat=$this->input->post('cat');
          $vat=$this->input->post('cat_vat'); 
          $billdate=$this->input->post('billdate');
          $dispdate=$this->input->post("dispdate");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          $qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $auth_rate=$this->input->post("auth_rate");
          $freight=$this->input->post("freight");        
          $orderid_gen=$this->input->post("orderid_gen");        
          $billno=$this->input->post("billno");
          $billid=$this->input->post("billid");
          $actual_rate=$this->input->post("actual_rate");
          try{     
          $this->db->trans_begin();   
          $zipped = array_map(null, $itemcode,$qtymt,$qtybag,$rate,$freight,$billno,$billid,$actual_rate,$dispdate,$auth_rate,$orderid_gen);
          foreach($zipped as $tuple) {
              if($tuple[9]<>0)
              {
                //$actual_rate=$tuple[3]*100/(100+$vat);  // get actual_rate
                $amt=bcmul($tuple[2],$tuple[7],2);               // get amount
                $this->db->where('id',$tuple[6]);
                $this->db->delete($tableName2); // delete trans 2 billno
                $data2=array(
                  "billno"=>$tuple[5],
                  "itemcode"=>$tuple[0],
                  "qtymt"=>$tuple[1],
                  "qtybag"=>$tuple[2],
                  "rate"=>$tuple[3],
                  "auth_rate"=>$tuple[9],
                  "freight"=>$tuple[4],
                  "actual_rate"=>$tuple[7],
                  "amt"=>$amt,
                  "cat_id"=>$cat,
                  "orderid_gen"=>$tuple[10],
                  "company_id"=>get_cookie('ae_company_id')
                  );
                $this->db->insert($tableName2,$data2);

                $bdate=$billdate;
                if(strtotime($billdate) > strtotime($tuple[8])){
                    $bdate=$billdate;
                }else{
                    $bdate=$tuple[8];
                 }              
                //Update Bill Date
                $tolfreight=get_tol_freight_by_billno($tuple[5]);
                $tolamt=get_tol_rate_by_billno($tuple[5]);
                $vat_amt = ($vat / 100) * $tolamt;
                $net_tol=$tolamt + $vat_amt;
                $t1=array(
                  'billdate'=>date('Y-m-d',strtotime($bdate)),
                  'tol_amt'=>$tolamt,
                  'vat_percent'=>$vat,
                  'vat_amt'=>$vat_amt,
                  'net_tol'=>$net_tol,
                  'billstatus'=>'clear'
                  );

                if($tuple[9]>0){
                  $this->db->where('id',$tuple[5]);
                  $this->db->update($tableName1,$t1);
                }
              }
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
      }

       public function sales_save_modify()
        {
          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
          
          $cat=$this->input->post('cat');
          $vat=$this->input->post('cat_vat'); 
          $billdate=$this->input->post('billdate');
          $dispdate=$this->input->post("dispdate");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          $qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $discount=$this->input->post("discount");
          $auth_rate=$this->input->post("auth_rate");
          $freight=$this->input->post("freight");        
          $orderid_gen=$this->input->post("orderid_gen");        
          $billno=$this->input->post("billno");
          $billid=$this->input->post("billid");
          $actual_rate=$this->input->post("actual_rate");
          try{     
          $this->db->trans_begin();   
          $zipped = array_map(null, $itemcode,$qtymt,$qtybag,$rate,$discount,$freight,$billno,$billid,$actual_rate,$dispdate,$auth_rate,$orderid_gen);
          foreach($zipped as $tuple) {
              if($tuple[10]<>0)
              {
                //$actual_rate=$tuple[3]*100/(100+$vat);  // get actual_rate
                $amt=bcmul($tuple[2],$tuple[7],2);               // get amount
                $this->db->where('id',$tuple[6]);
                $this->db->delete($tableName2); // delete trans 2 billno
                $data2=array(
                  "billno"=>$tuple[6],
                  "itemcode"=>$tuple[0],
                  "qtymt"=>$tuple[1],
                  "qtybag"=>$tuple[2],
                  "rate"=>$tuple[3],
                  "auth_rate"=>$tuple[10],
                  "freight"=>$tuple[5],
                  "discount"=>$tuple[4],
                  "actual_rate"=>$tuple[8],
                  "amt"=>$amt,
                  "cat_id"=>$cat,
                  "orderid_gen"=>$tuple[11],
                  "company_id"=>get_cookie('ae_company_id')
                  );
                $this->db->insert($tableName2,$data2);

                $bdate=$billdate;
                if(strtotime($billdate) > strtotime($tuple[9])){
                    $bdate=$billdate;
                }else{
                    $bdate=$tuple[9];
                 }              
                //Update Bill Date
                $tolfreight=get_tol_freight_by_billno($tuple[6]);
                $tolamt=get_tol_rate_by_billno($tuple[6]);
                $vat_amt = ($vat / 100) * $tolamt;
                $net_tol=$tolamt + $vat_amt;
                $t1=array(
                  'billdate'=>date('Y-m-d',strtotime($bdate)),
                  'tol_amt'=>$tolamt,
                  'vat_percent'=>$vat,
                  'vat_amt'=>$vat_amt,
                  'net_tol'=>$net_tol,
                  'billstatus'=>'clear'
                  );

                if($tuple[10]>0){
                  $this->db->where('id',$tuple[6]);
                  $this->db->update($tableName1,$t1);
                }
              }
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
      }

       public function sales_return_save_modify()
        {
          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
          
          $cat=$this->input->post('cat');
          $vat=$this->input->post('cat_vat'); 
          $billdate=$this->input->post('billdate');
          $dispdate=$this->input->post("dispdate");
          $itemcode=$this->input->post("itemcode");
          $qtymt=$this->input->post("qtymt");
          $qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $discount=$this->input->post("discount");
          $auth_rate=$this->input->post("auth_rate");
          $freight=$this->input->post("freight");        
          $orderid_gen=$this->input->post("orderid_gen");        
          $billno=$this->input->post("billno");
          $billid=$this->input->post("billid");
          $actual_rate=$this->input->post("actual_rate");
          try{     
          $this->db->trans_begin();   
          $zipped = array_map(null, $itemcode,$qtymt,$qtybag,$rate,$discount,$freight,$billno,$billid,$actual_rate,$dispdate,$auth_rate,$orderid_gen);
          foreach($zipped as $tuple) {
              if($tuple[10]<>0)
              {
                //$actual_rate=$tuple[3]*100/(100+$vat);  // get actual_rate
                $amt=bcmul($tuple[2],$tuple[7],2);               // get amount
                $this->db->where('id',$tuple[6]);
                $this->db->delete($tableName2); // delete trans 2 billno
                $data2=array(
                  "billno"=>$tuple[6],
                  "itemcode"=>$tuple[0],
                  "qtymt"=>$tuple[1],
                  "qtybag"=>$tuple[2],
                  "rate"=>$tuple[3],
                  "auth_rate"=>$tuple[10],
                  "freight"=>$tuple[5],
                  "discount"=>$tuple[4],
                  "actual_rate"=>$tuple[8],
                  "amt"=>$amt,
                  "cat_id"=>$cat,
                  "orderid_gen"=>$tuple[11],
                  "company_id"=>get_cookie('ae_company_id')
                  );
                $this->db->insert($tableName2,$data2);

                $bdate=$billdate;
                if(strtotime($billdate) > strtotime($tuple[9])){
                    $bdate=$billdate;
                }else{
                    $bdate=$tuple[9];
                 }              
                //Update Bill Date
                $tolfreight=get_tol_freight_by_billno($tuple[6]);
                $tolamt=get_tol_rate_by_billno($tuple[6]);
                $vat_amt = ($vat / 100) * $tolamt;
                $net_tol=$tolamt + $vat_amt;
                $t1=array(
                  'billdate'=>date('Y-m-d',strtotime($bdate)),
                  'tol_amt'=>$tolamt,
                  'vat_percent'=>$vat,
                  'vat_amt'=>$vat_amt,
                  'net_tol'=>$net_tol,
                  'billstatus'=>'clear'
                  );

                if($tuple[10]>0){
                  $this->db->where('id',$tuple[6]);
                  $this->db->update($tableName1,$t1);
                }
              }
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
      }
      public function dispatch_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select * from tbl_trans1 where id=".$id." and company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>$row->cdate,
                "builtyno"=>$row->builtyno,
                "truckno"=>$row->truckno,
                "type"=>$row->type,
                "source_id"=>$row->source_id,
                "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                "sub_dealer_id"=>$row->sub_dealer_id,
                "consignee_name"=>$row->consignee_name,
                "consignee_mobno"=>$row->consignee_mobno,
                "destination_id"=>$row->destination_id,
                "cat_id"=>$row->cat_id,
                "stop_builty"=>$row->stop_builty,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "remark"=>$row->remark,
                "vtype"=>$row->vtype,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by
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


      public function requisition_get()
      {
        $id = $this->input->get("id");
        $previd=0;
        $nextid=0;

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select max(id) as id from tbl_trans1 where id<".$id." and vtype='requisition' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select max(id) as id from tbl_trans1 where billstatus!='clear' and id<".$id." and vtype='requisition' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $previd=$row->id;
          }
        }

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select min(id) as id from tbl_trans1 where id>".$id." and vtype='quatation' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select min(id) as id from tbl_trans1 where billstatus!='clear' and id>".$id." and vtype='quatation' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $nextid=$row->id;
          }
        }

        $query=$this->db->query("select t1.*,l.state,l.name as partyname from tbl_trans1 t1, m_ledger l  where t1.ledger_id=l.id and t1.id=".$id." and t1.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "builtyno"=>$row->builtyno,
                 "truckno"=>$row->truckno,
                "ledger_state"=>$row->state,
                 "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                "lr_no"=>$row->lr_no,
                "transport"=>$row->transport,
                "ref_details"=>$row->ref_details,
                "sub_details"=>$row->sub_details,
                "consignee_mobno"=>$row->pakking_forwerding,
                "pakking_forwerding"=>$row->pakking_forwerding,
                "delivery_period"=>$row->delivery_period,
                "payment_terms"=>$row->payment_terms,
                "warranty_guarantee"=>$row->warranty_guarantee,
                "ld_clause"=>$row->ld_clause,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "lr_freight"=>$row->lr_freight,
                "remark"=>$row->remark,
                "loading_person_name"=>$row->loading_person_name,
                "vtype"=>$row->vtype,
                "previd"=>$previd,
                "nextid"=>$nextid,
                "transport_narration"=>$row->transport_narration,
                "f1_amount"=>$row->f1_amount,
                "f2_amount"=>$row->f2_amount,
                "checked_by"=>$row->checked_by,
                "dispatch_through"=>$row->dispatch_through,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by,
                "paid_build"=>$row->paid_build,
                "lname"=>$row->partyname,
                "file_name"=>$row->file_name,
                "semi_formal"=>$row->semi_formal,
                "header"=>$row->header,
                "taxes"=>$row->taxes,
                "scope_of_work"=>$row->scope_of_work,
                "design_criteria"=>$row->design_criteria,
                "validity_of_offer"=>$row->validity_of_offer,
                "note"=>$row->note,
                "performance_warranty"=>$row->performance_warranty,
                "equipment_acceptance"=>$row->equipment_acceptance,
                "supervision_commissioning"=>$row->supervision_commissioning,
                "training"=>$row->training,
                "general_safety"=>$row->general_safety,
                "spare_parts"=>$row->spare_parts,
                "chassis_equipment"=>$row->chassis_equipment,
                "designation"=>$row->designation,
                "approve_by"=>$row->approve_by,
                "pon"=>$row->pon,
                "jobwork"=>$row->jobwork,
                "price"=>$row->price,
                "jobcard"=>$row->jobcard,
                

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

      public function jobcard_get()
      {
        $id = $this->input->get("id");
        $previd=0;
        $nextid=0;

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select max(id) as id from tbl_trans1 where id<".$id." and vtype='jobcard' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select max(id) as id from tbl_trans1 where billstatus!='clear' and id<".$id." and vtype='jobcard' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $previd=$row->id;
          }
        }

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select min(id) as id from tbl_trans1 where id>".$id." and vtype='quatation' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select min(id) as id from tbl_trans1 where billstatus!='clear' and id>".$id." and vtype='quatation' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $nextid=$row->id;
          }
        }

        $query=$this->db->query("select t1.*,l.state,l.name as partyname from tbl_trans1 t1, m_ledger l  where t1.ledger_id=l.id and t1.id=".$id." and t1.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "builtyno"=>$row->builtyno,
                 "truckno"=>$row->truckno,
                "ledger_state"=>$row->state,
                 "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                "lr_no"=>$row->lr_no,
                "transport"=>$row->transport,
                "ref_details"=>$row->ref_details,
                "sub_details"=>$row->sub_details,
                "consignee_mobno"=>$row->pakking_forwerding,
                "pakking_forwerding"=>$row->pakking_forwerding,
                "delivery_period"=>$row->delivery_period,
                "payment_terms"=>$row->payment_terms,
                "warranty_guarantee"=>$row->warranty_guarantee,
                "ld_clause"=>$row->ld_clause,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "lr_freight"=>$row->lr_freight,
                "remark"=>$row->remark,
                "loading_person_name"=>$row->loading_person_name,
                "vtype"=>$row->vtype,
                "previd"=>$previd,
                "nextid"=>$nextid,
                "transport_narration"=>$row->transport_narration,
                "f1_amount"=>$row->f1_amount,
                "f2_amount"=>$row->f2_amount,
                "checked_by"=>$row->checked_by,
                "dispatch_through"=>$row->dispatch_through,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by,
                "paid_build"=>$row->paid_build,
                "lname"=>$row->partyname,
                "file_name"=>$row->file_name,
                "semi_formal"=>$row->semi_formal,
                "header"=>$row->header,
                "taxes"=>$row->taxes,
                "scope_of_work"=>$row->scope_of_work,
                "design_criteria"=>$row->design_criteria,
                "validity_of_offer"=>$row->validity_of_offer,
                "note"=>$row->note,
                "performance_warranty"=>$row->performance_warranty,
                "equipment_acceptance"=>$row->equipment_acceptance,
                "supervision_commissioning"=>$row->supervision_commissioning,
                "training"=>$row->training,
                "general_safety"=>$row->general_safety,
                "spare_parts"=>$row->spare_parts,
                "chassis_equipment"=>$row->chassis_equipment,
                "designation"=>$row->designation,
                "approve_by"=>$row->approve_by,
                "pon"=>$row->pon,
                "jobwork"=>$row->jobwork,
                "price"=>$row->price,
                "jobcard"=>$row->jobcard,
                

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


      public function cpo_get()
      {
        $id = $this->input->get("id");
        $previd=0;
        $nextid=0;


        $query=$this->db->query("select t1.* from tbl_trans3 t1 where t1.id='".$id."' and t1.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "sno"=>$row->sno,
                "vtype"=>$row->vtype,
                "q_number"=>$row->q_number,
                "filename"=>$row->filename,
                "fullpath"=>$row->fullpath,
                "cpo"=>$row->cpo,
                "cpo_sno"=>$row->cpo_sno,
                "cpoapp_no"=>$row->cpoapp_no,
                "lname"=>$row->lname,
                "ledger_id"=>$row->ledger_id,
                "delevery_preiod"=>$row->delevery_preiod,
                "remark"=>$row->remark,

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

       public function sales_get()
      {
        $id = $this->input->get("id");
        $previd=0;
        $nextid=0;

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select max(id) as id from tbl_trans1 where id<".$id." and vtype='quatation' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select max(id) as id from tbl_trans1 where billstatus!='clear' and id<".$id." and vtype='quatation' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $previd=$row->id;
          }
        }

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select min(id) as id from tbl_trans1 where id>".$id." and vtype='quatation' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select min(id) as id from tbl_trans1 where billstatus!='clear' and id>".$id." and vtype='quatation' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $nextid=$row->id;
          }
        }

        $query=$this->db->query("select t1.*,l.state,l.name as partyname from tbl_trans1 t1, m_ledger l  where t1.ledger_id=l.id and t1.id=".$id." and t1.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "builtyno"=>$row->builtyno,
                 "truckno"=>$row->truckno,
                "ledger_state"=>$row->state,
                 "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                "lr_no"=>$row->lr_no,
                "transport"=>$row->transport,
                "ref_details"=>$row->ref_details,
                "sub_details"=>$row->sub_details,
                "consignee_mobno"=>$row->pakking_forwerding,
                "pakking_forwerding"=>$row->pakking_forwerding,
                "delivery_period"=>$row->delivery_period,
                "payment_terms"=>$row->payment_terms,
                "warranty_guarantee"=>$row->warranty_guarantee,
                "ld_clause"=>$row->ld_clause,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "lr_freight"=>$row->lr_freight,
                "remark"=>$row->remark,
                "loading_person_name"=>$row->loading_person_name,
                "vtype"=>$row->vtype,
                "previd"=>$previd,
                "nextid"=>$nextid,
                "transport_narration"=>$row->transport_narration,
                "f1_amount"=>$row->f1_amount,
                "f2_amount"=>$row->f2_amount,
                "checked_by"=>$row->checked_by,
                "dispatch_through"=>$row->dispatch_through,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by,
                "paid_build"=>$row->paid_build,
                "lname"=>$row->partyname,
                "file_name"=>$row->file_name,
                "semi_formal"=>$row->semi_formal,
                "header"=>$row->header,
                "taxes"=>$row->taxes,
                "scope_of_work"=>$row->scope_of_work,
                "design_criteria"=>$row->design_criteria,
                "validity_of_offer"=>$row->validity_of_offer,
                "note"=>$row->note,
                "performance_warranty"=>$row->performance_warranty,
                "equipment_acceptance"=>$row->equipment_acceptance,
                "supervision_commissioning"=>$row->supervision_commissioning,
                "training"=>$row->training,
                "general_safety"=>$row->general_safety,
                "spare_parts"=>$row->spare_parts,
                "chassis_equipment"=>$row->chassis_equipment,
                "price"=>$row->price,
                "gst_tax"=>$row->gst_tax,
                "mobile_crane"=>$row->mobile_crane,
                "scope_of_unloading"=>$row->scope_of_unloading,
                "intrest_charge"=>$row->intrest_charge,
                "cancellation"=>$row->cancellation,
                "jurisdication"=>$row->jurisdication,
                "documents_provided"=>$row->documents_provided,
                "load_test"=>$row->load_test,
                "quatation_selected"=>$row->quatation_selected,
                "prepare_by"=>$row->prepare_by,
                
                
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


       public function order_get()
      {
        $id = $this->input->get("id");
        $previd=0;
        $nextid=0;

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select max(id) as id from tbl_order1 where id<".$id." and vtype='sales' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select max(id) as id from tbl_order1 where billstatus!='clear' and id<".$id." and vtype='sales' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $previd=$row->id;
          }
        }

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select min(id) as id from tbl_order1 where id>".$id." and vtype='sales' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select min(id) as id from tbl_order1 where billstatus!='clear' and id>".$id." and vtype='sales' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $nextid=$row->id;
          }
        }

        $query=$this->db->query("select t1.*,l.state,l.name as partyname from tbl_order1 t1, m_ledger l  where t1.ledger_id=l.id and t1.id=".$id." and t1.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "builtyno"=>$row->builtyno,
                 "truckno"=>$row->truckno,
                // "type"=>$row->type,
                // "source_id"=>$row->source_id,
                "ledger_state"=>$row->state,
                 "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                // "sub_dealer_id"=>$row->sub_dealer_id,
                // "consignee_name"=>$row->consignee_name,
                // "consignee_mobno"=>$row->consignee_mobno,
                // "destination_id"=>$row->destination_id,
                // "cat_id"=>$row->cat_id,
                // "stop_builty"=>$row->stop_builty,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "lr_freight"=>$row->lr_freight,
                "remark"=>$row->remark,
                 "loading_person_name"=>$row->loading_person_name,
                "vtype"=>$row->vtype,
                "previd"=>$previd,
                "nextid"=>$nextid,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by,
                "lname"=>$row->partyname,
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
       public function sales_return_get()
      {
        $id = $this->input->get("id");
        $previd=0;
        $nextid=0;

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select max(id) as id from tbl_trans1 where id<".$id." and vtype='sales' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select max(id) as id from tbl_trans1 where billstatus!='clear' and id<".$id." and vtype='sales' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $previd=$row->id;
          }
        }

        if(get_cookie('ae_user_id')==1)
        {
          $query=$this->db->query("select min(id) as id from tbl_trans1 where id>".$id." and vtype='sales' and company_id=".get_cookie("ae_company_id"));
        }else{
          $query=$this->db->query("select min(id) as id from tbl_trans1 where billstatus!='clear' and id>".$id." and vtype='sales' and company_id=".get_cookie("ae_company_id"));
        }
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $nextid=$row->id;
          }
        }

        $query=$this->db->query("select t1.*,l.state,l.name as partyname from tbl_trans1 t1, m_ledger l  where t1.ledger_id=l.id and t1.id=".$id." and t1.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "builtyno"=>$row->builtyno,
                 "truckno"=>$row->truckno,
                // "type"=>$row->type,
                // "source_id"=>$row->source_id,
                "ledger_state"=>$row->state,
                 "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                 "item_type"=>$row->item_type,
                // "sub_dealer_id"=>$row->sub_dealer_id,
                // "consignee_name"=>$row->consignee_name,
                // "consignee_mobno"=>$row->consignee_mobno,
                // "destination_id"=>$row->destination_id,
                // "cat_id"=>$row->cat_id,
                // "stop_builty"=>$row->stop_builty,
                "lr_freight"=>$row->lr_freight,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "remark"=>$row->remark,
                 "loading_person_name"=>$row->loading_person_name,
                "vtype"=>$row->vtype,
                "previd"=>$previd,
                "nextid"=>$nextid,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by,
                "checked_by"=>$row->checked_by,
                "dispatch_through"=>$row->dispatch_through,
                "f1_amount"=>$row->f1_amount,
                "f2_amount"=>$row->f2_amount,
                "lname"=>$row->partyname,
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

        public function receipt_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select * from tbl_trans1 where vtype='receipt' and builtyno=".$id." and company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->edate)),
                 "salesman"=>$row->salesman,
                 "tol_amount"=>$row->tol_amount,
                "vtype"=>$row->vtype
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


 public function payment_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select t.*,l.name as partyname from tbl_trans1 t left join m_ledger l on t.ledger_id=l.id where t.id=".$id." and t.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                 "tol_freight"=>$row->tol_freight,
                 "ledger_id"=>$row->ledger_id,
                "remark"=>$row->remark,
                "vtype"=>$row->vtype,
                "lname"=>$row->partyname,
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

 public function crnote_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select t.*,l.name as partyname from tbl_trans1 t left join m_ledger l on t.ledger_id=l.id where t.id=".$id." and t.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                 "tol_freight"=>$row->tol_freight,
                 "ledger_id"=>$row->ledger_id,
                "remark"=>$row->remark,
                "vtype"=>$row->vtype
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

 public function drnote_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select t.*,l.name as partyname from tbl_trans1 t left join m_ledger l on t.ledger_id=l.id where t.id=".$id." and t.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                 "tol_freight"=>$row->tol_freight,
                 "ledger_id"=>$row->ledger_id,
                "remark"=>$row->remark,
                "vtype"=>$row->vtype
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

      public function purchase_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select t.*,l.name as partyname from tbl_trans1 t left join m_ledger l on t.ledger_id=l.id where t.id=".$id." and t.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "builtyno"=>$row->builtyno,
                // "truckno"=>$row->truckno,
                // "type"=>$row->type,
                // "source_id"=>$row->source_id,
                 "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                // "sub_dealer_id"=>$row->sub_dealer_id,
                // "consignee_name"=>$row->consignee_name,
                // "consignee_mobno"=>$row->consignee_mobno,
                // "destination_id"=>$row->destination_id,
                // "cat_id"=>$row->cat_id,
                // "stop_builty"=>$row->stop_builty,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "remark"=>$row->remark,
                "vtype"=>$row->vtype,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by,
                "f1_amount"=>$row->f1_amount,
                "f2_amount"=>$row->f2_amount,
                "checked_by"=>$row->checked_by,
                "dispatch_through"=>$row->dispatch_through,

                "lname"=>$row->partyname,
                "file_name"=>$row->file_name,
                "file_path"=>$row->file_path,
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

      public function purchase_return_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select t.*,l.name as partyname from tbl_trans1 t left join m_ledger l on t.ledger_id=l.id where t.id=".$id." and t.company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "builtyno"=>$row->builtyno,
                // "truckno"=>$row->truckno,
                // "type"=>$row->type,
                // "source_id"=>$row->source_id,
                 "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                "item_type"=>$row->item_type,
                // "sub_dealer_id"=>$row->sub_dealer_id,
                // "consignee_name"=>$row->consignee_name,
                // "consignee_mobno"=>$row->consignee_mobno,
                // "destination_id"=>$row->destination_id,
                // "cat_id"=>$row->cat_id,
                // "stop_builty"=>$row->stop_builty,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "remark"=>$row->remark,
                "vtype"=>$row->vtype,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by,
                "f1_amount"=>$row->f1_amount,
                "f2_amount"=>$row->f2_amount,
                "checked_by"=>$row->checked_by,
                "dispatch_through"=>$row->dispatch_through,
                "lname"=>$row->partyname,
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

      public function dispatch_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.*,i.name iname from tbl_trans2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id . ' order by t2.id');
          $result=$query->result();
          return $result;
        }

      public function sales_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.*,i.name iname from tbl_trans2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id . ' order by t2.id');
          // echo 'select t2.*,i.name iname from tbl_trans2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id . ' order by t2.id';
          $result=$query->result();
          return $result;
        }

        public function invoices_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.* from tbl_invoice2 t2  where t2.billno='.$id . ' order by t2.id');
          $result=$query->result();
          return $result;
        }

        public function sales_get_item1(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.* from tbl_trans2 t2 where t2.billno='.$id . ' order by t2.id');
          $result=$query->result();
          return $result;
        }

        public function jobcard_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.* from tbl_trans2 t2 where t2.billno='.$id . ' order by t2.id');
          $result=$query->result();
          return $result;
        }

      public function inv_get()
      {
        $id = $this->input->get("id");
        $previd=0;
        $nextid=0;

        $query=$this->db->query("select t1.*,l.state,l.name as partyname from tbl_invoice1 t1, m_ledger l  where t1.ledger_id=l.id and t1.id=".$id." and t1.company_id=".get_cookie("ae_company_id")." ");
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                "orderno"=>$row->orderno,
                 "ledger_id"=>$row->ledger_id,
                "vtype"=>$row->vtype,
                "edate"=>date('d-m-Y',strtotime($row->edate)),
                "lname"=>$row->lname,
                "invoice_no"=>$row->invoice_no,
                "quatation"=>$row->quatation,
                "gstin_no"=>$row->gstin_no,
                "wo_no"=>$row->wo_no,
                "reg_address"=>$row->reg_address,
                "con_address"=>$row->con_address,
                "dispatch_detail"=>$row->dispatch_detail,
                "tol_qtymt"=>$row->tol_qtymt,
                "tol_freight"=>$row->tol_freight,
                "vtype"=>'invoice',
                "previd"=>$previd,
                "nextid"=>$nextid,
                "total_before_tax"=>$row->total_before_tax,
                "cgst_per"=>$row->cgst_per,
                "cgst_amt"=>$row->cgst_amt,
                "sgst_per"=>$row->sgst_per,
                "sgst_amt"=>$row->sgst_amt,
                "igst_per"=>$row->igst_per,
                "igst_amt"=>$row->igst_amt,
                "total_gst"=>$row->total_gst,
                "lname"=>$row->partyname,
                "grand_total"=>$row->grand_total,
                "round_off_amt"=>$row->round_off_amt,
                "pos_id"=>$row->pos_id,
                "modi_datetime"=>$row->modi_datetime,
                "created_by"=>$row->created_by,
                "created_datetime"=>$row->created_datetime,
                "modified_by"=>$row->modified_by,
                "company_id"=>$row->company_id,
                "file_name"=>$row->file_name,
                "file_path"=>$row->file_path
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


      public function order_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.*,i.name iname from tbl_order2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id . ' order by t2.id');
          $result=$query->result();
          return $result;
        }

      public function sales_return_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.*,i.name iname from tbl_trans2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id  . ' order by t2.id');
          $result=$query->result();
          return $result;
        }

         public function purchase_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.*,i.name iname from tbl_trans2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id  . ' order by t2.id');
          $result=$query->result();
          return $result;
        }

         public function purchase_return_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.*,i.name iname from tbl_trans2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id  . ' order by t2.id');
          $result=$query->result();
          return $result;
        }
      public function dispatch_delete($tableName1,$tableName2,$id1,$id2){
        try{
          $this->db->trans_begin();
          $id=$this->input->post('ID');
          $this->db->where($id1,$id);
          $this->db->delete($tableName1);
          $this->db->where($id2,$id);
          $this->db->delete($tableName2);
          $this->db->trans_commit();
          echo "1";
        }catch(Exception $e){
          $this->db->trans_rollback();
          echo "2";
        }
      }
        function dispatch_print_preview(){
            $from=date('Y-m-d',strtotime($this->input->post('from')));
            $to=date('Y-m-d',strtotime($this->input->post('to')));
            $query=$this->db->query('select t.qtymt,t.qtybag,t.appr_freight,t.buityno,p.name pname,l.name lname from tbl_trans t inner join m_master p on t.pos_id=p.id inner join m_master l on t.ledger_id=l.id where t.company_id='.get_cookie('ae_company_id').' and (t.vtype="DISPATCH" or t.vtype="transfer") and(t.cdate between "'.$from.'" and "'.$to.'")');
            return $query->result();
        }
        public function sendMail(){
        try{
        $email=$this->input->post('email');
        $filename=$this->input->post('filename');
        $this->load->library('encrypt');
        $ci = get_instance();
        $ci->load->library('email');
        $msg='Please Check Invoice .';
        $sub='Invoice';
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "ramsona89@gmail.com"; 
        $config['smtp_pass'] = "user pwd";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);        
        $ci->email->from('ramsona2010@gmail.com', 'Atul Enterprise');
        $list = array($email);
        $ci->email->to($list); 
        $this->email->reply_to('ramsona2010@gmail.com', 'Atul Enterprise');
        $ci->email->subject($sub);
        $ci->email->message($msg);
        $path = set_realpath('PDF/');
        $path=$path.$filename;
        $this->email->attach($path);
        //$ci->email->attach('http://192.168.0.70/atul_entp/PDF/20150305055203.pdf');
        $ci->email->send();
        return true;
       }catch(Exception $e){
        return false;
        }
    }
    function dispatch_query(){
       $subsql='';
       $pos_id=$this->input->post('pos_id');
       $cat_id=$this->input->post('cat_id');
       $item_id=$this->input->post('item_id');
       $item_st=$this->input->post('item_st');
       $godown_id=$this->input->post('godown_id');
       $godown_st=$this->input->post('godown_st');
       $ledger_id=$this->input->post('ledger_id');
       $ledger_st=$this->input->post('ledger_st');
       $builtyno=$this->input->post('builtyno');
       $truckno=$this->input->post('truckno');
       $trucksort=$this->input->post('trucksort');       
       $type=$this->input->post('type');
       if($pos_id!='-'){
       $subsql=' and t1.pos_id='.$pos_id;
       }
       if($cat_id!='-'){
       $subsql=' and t1.cat_id='.$cat_id;
       }
       if($ledger_st!='-'){
        $subsql=$subsql.' and t1.ledger_id<>'.$ledger_id;
       }else{
        if($ledger_id!='-'){
         $subsql=' and t1.ledger_id='.$ledger_id;
        }
       }
       if($item_st!='-'){
        $subsql=$subsql.' and t2.itemcode<>'.$item_id;
       }else{
        if($item_id!='-'){
         $subsql=' and t2.itemcode='.$item_id;
        }
       }
       echo 'select i.name iname,t2.qtymt,t2.qtybag,t2.type,t2.freight,d.name dname,l.name lname,t1.consignee_name,t1.truckno,t1.cdate,t1.builtyno,p.name pname,l.name lname from tbl_trans1 t1 inner join m_master p on t1.pos_id=p.id inner join tbl_trans2 t2 on t1.id=t2.billno inner join m_item i on t2.itemcode=i.id inner join m_ledger l on t1.ledger_id=l.id inner join m_master d on t1.destination_id=d.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="DISPATCH" '.$subsql.'';
    }
    function dispatch_excel(){
        $this->load->library('PHPExcel/IOFactory');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")->setDescription("description");

        // Assign cell values
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'cell value here');

        // Save it as an excel 2003 file
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("nameoffile.xls");
    }
    //Dispatch End
    //Order
    public function order_list_get(){
        $vtype=$this->input->get('vtype');
        $query=$this->db->query('select p.name posname,t1.cdate,t1.id,t1.qtymt,t1.qtybag,t1.appr_freight,l.name lname from tbl_trans t1 inner join m_ledger l on t1.ledger_id=l.id inner join m_master p on t1.pos_id=p.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and cdate="'.date('Y-m-d').'"');
        return $query->result();
    }
    public function order_list_by_search(){
            $from=date('Y-m-d',strtotime($this->input->post('from')));
            $to=date('Y-m-d',strtotime($this->input->post('to')));
            $ledger_id=$this->input->post('ledger_id');
            $vtype='ORDER';
            if($ledger_id=='-'){
            $query=$this->db->query('select p.name posname,t1.cdate,t1.id,t1.qtymt,t1.qtybag,t1.appr_freight,l.name lname from tbl_trans t1 inner join m_ledger l on t1.ledger_id=l.id inner join m_master p on t1.pos_id=p.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.$from.'" and "'.$to.'")');
            return $query->result();
            }else{
            $query=$this->db->query('select p.name posname,t1.cdate,t1.id,t1.qtymt,t1.qtybag,t1.appr_freight,l.name lname from tbl_trans t1 inner join m_ledger l on t1.ledger_id=l.id inner join m_master p on t1.pos_id=p.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and  ledger_id='.$ledger_id.' and (t1.cdate between "'.$from.'" and "'.$to.'")');
            return $query->result();
            }
        }
    //Order End
    //Arrival
    public function arrival_list(){
        $vtype=$this->input->get('vtype');
    	$query=$this->db->query('select p.name posname,s.name sname,i.name iname,t1.cdate,t1.id,t1.gpno,t1.gpdate,t1.source_id,t1.item_id from tbl_trans t1 inner join m_master p on t1.pos_id=p.id inner join m_master s on t1.source_id=s.id inner join m_item i on t1.item_id=i.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'"');
    	return $query->result();
    }
    function arrival_query(){
       $subsql='';
       $item_id=$this->input->post('item_id');
       $item_st=$this->input->post('item_st');
       $source_id=$this->input->post('source_id');
       $source_st=$this->input->post('source_st');
       $transporter_id=$this->input->post('transporter_id');
       $transporter_st=$this->input->post('transporter_st');
       $godown_id=$this->input->post('godown_id');
       $godown_st=$this->input->post('godown_st');
       $ledger_id=$this->input->post('ledger_id');
       $ledger_st=$this->input->post('ledger_st');
       $truckno=$this->input->post('truckno');
       $trucksort=$this->input->post('trucksort');       
       $type=$this->input->post('type');
       if($source_st!='-'){
        $subsql=$subsql.' and t.source_id<>'.$source_id;
       }else{
        if($source_id!='-'){
         $subsql=' and t.source_id='.$source_id;
        }
       }
       if($transporter_st!='-'){
        $subsql=$subsql.' and t.transporter_id<>'.$transporter_id;
       }else{
        if($transporter_id!='-'){
         $subsql=' and t.transporter_id='.$transporter_id;
        }
       }
       if($item_st!='-'){
        $subsql=$subsql.' and t.item_id<>'.$item_id;
       }else{
        if($item_id!='-'){
         $subsql=' and t.item_id='.$item_id;
        }
       }
      if($ledger_st!='-'){
        $subsql=$subsql.' and t.ledger_id<>'.$ledger_id;
       }else{
        if($ledger_id!='-'){
         $subsql=' and t.ledger_id='.$ledger_id;
        }
       }
       if($godown_st!='-'){
        $subsql=$subsql.' and t.godown_id<>'.$godown_id;
       }else{
        if($godown_id!='-'){
         $subsql=' and t.godown_id='.$godown_id;
        }
       }
       if(!empty($truckno)){
       $subsql=$subsql.' and t.truckno="'.$truckno.'"';
       }
       echo 'select t.cdate,t.qtymt,t.qtybag,t.truckno,t.l_qty,t.c_qty,t.d_qty,s.name sname,i.name iname,trans.name tname from tbl_trans t inner join m_master s on t.source_id=s.id inner join m_item i on t.item_id=i.id inner join m_ledger trans on t.transporter_id=trans.id where t.company_id='.get_cookie('ae_company_id').' and t.vtype="ARRIVAL" '.$subsql.'';
    }
    //End Arrival
    //Pending Order List
    public function pending_order_list(){
        $vtype=$this->input->get('vtype');
        $query=$this->db->query('select p.name posname,t1.cdate,t1.id,(t1.qtymt+t1.dispatchqty) qtymt,((t1.qtymt+t1.dispatchqty)*20) qtybag,l.name lname,i.name iname  from tbl_trans t1 inner join m_ledger l on t1.ledger_id=l.id inner join m_master p on t1.pos_id=p.id inner join m_item i on t1.item_id=i.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'"');
        return $query->result();
    }
    public function pending_order_get()
        { 
            $id = $this->input->get("id");
            $query=$this->db->query("select id,pos_id,cdate,consignee_name,ledger_id,sub_dealer_id,destination_id,item_id,(qtymt+dispatchqty) qtymt,((qtymt+dispatchqty)*20) qtybag,appr_freight,mobileno,remark,created_by,modified_by from tbl_trans where company_id=".get_cookie('ae_company_id')." and id=$id");
            $result=$query->result();
            if($query->num_rows()>0)
            {
                foreach($result as $row)
                {
                    $data = array(
                            "Message"=>"Success",
                            "id"=>$row->id,
                            "pos_id"=>$row->pos_id,
                            "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                            "consignee_name"=>$row->consignee_name,
                            "ledger_id"=>$row->ledger_id,
                            "sub_dealer_id"=>$row->sub_dealer_id,
                            "destination_id"=>$row->destination_id,
                            "item_id"=>$row->item_id,
                            "qtymt"=>$row->qtymt,
                            "qtybag"=>$row->qtybag,
                            "appr_freight"=>$row->appr_freight,
                            "mobileno"=>$row->mobileno,
                            "remark"=>$row->remark,
                            "created_by"=>$row->created_by,
                            "modified_by"=>$row->modified_by
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
    // Pending Order List End
public function trans_get()
	    { 
	    	$id = $this->input->get("id");
	    	$query=$this->db->query("select * from tbl_trans where company_id=".get_cookie('ae_company_id')." and id=$id");
	    	$result=$query->result();
	    	if($query->num_rows()>0)
	    	{
	    		foreach($result as $row)
	    		{
		    		$data = array(
		    				"Message"=>"Success",
		    				"id"=>$row->id,
		    				"pos_id"=>$row->pos_id,
		    				"cdate"=>date('d-m-Y',strtotime($row->cdate)),
		    				"consignee_name"=>$row->consignee_name,
                "consignee_mobno"=>$row->consignee_mobno,
		    				"challan_no"=>$row->challan_no,
                            "so_no"=>$row->so_no,
		    				"ledger_id"=>$row->ledger_id,
                            "ledger_mobno"=>$row->ledger_mobno,
                            "destination_id"=>$row->destination_id,
                            "item_id"=>$row->item_id,
                            "qtymt"=>$row->qtymt,
                            "qtybag"=>$row->qtybag,
                            "truckno"=>$row->truckno,
                            "buityno"=>$row->buityno,
                            "transporter_id"=>$row->transporter_id,
                            "freight_type"=>$row->freight_type,
                            "appr_freight"=>$row->appr_freight,
                            "act_freight"=>$row->act_freight,
                            "difference"=>$row->difference,
                            "freight_rate"=>$row->freight_rate,
                            "act_rate"=>$row->act_rate,
                            "load"=>$row->load,
                            "cross"=>$row->cross,
                            "direct"=>$row->direct,
                            "l_qty"=>$row->l_qty,
                            "l_godown_id"=>$row->l_godown_id,
                            "c_qty"=>$row->c_qty,
                            "c_truckno"=>$row->c_truckno,
                            "d_qty"=>$row->d_qty,
                            "d_ledger_id"=>$row->d_ledger_id,
                            "source_id"=>$row->source_id,
                            "shortage"=>$row->shortage,
                            "damage"=>$row->damage,
                            "gpno"=>$row->gpno,
                            "gpdate"=>date('d-m-Y',strtotime($row->gpdate)),
                            "invoiceno"=>$row->invoiceno,
                            "invoicedate"=>date('d-m-Y',strtotime($row->invoicedate)),
                            "adv_freight"=>$row->adv_freight,
                            "mobileno"=>$row->mobileno,
                            "remark"=>$row->remark,
                            "orderno"=>$row->orderno,
                            "stop_builty"=>$row->stop_builty,
                            "created_by"=>$row->created_by,
                            "modified_by"=>$row->modified_by

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
        //Payment Freight
        public function destination_freight_get()
        { 
            $id = $this->input->get("id");
            $query=$this->db->query("select freight from m_master where company_id=".get_cookie('ae_company_id')." and type='destination' and id=$id");
            $result=$query->result();
            if($query->num_rows()>0)
            {
                foreach($result as $row)
                {
                    $data = array(
                            "Message"=>"Success",
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
        public function builty_detail_get()
        { 
            $id = $this->input->get("id");
            $query=$this->db->query("select t.*,l.name lname,d.name dname from tbl_trans t inner join m_ledger l on t.ledger_id=l.id inner join m_master d on t.destination_id=d.id where t.company_id=".get_cookie('ae_company_id')." and t. vtype='dispatch' and t.buityno=$id and t.freight_type='TBB'");
            $result=$query->result();
            if($query->num_rows()>0)
            {
                foreach($result as $row)
                {
                    $data = array(
                            "Message"=>"Success",
                            "sub_dealer_id"=>$row->sub_dealer_id,
                            "lname"=>$row->lname,
                            "dname"=>$row->dname,
                            //"freightamt"=>$row->act_freight,
                            "freightamt"=>$row->freight_rate,
                            "truckno"=>$row->truckno,
                            "qtymt"=>$row->qtymt,
                            "destination_id"=>$row->destination_id,
                            "stop_builty"=>$row->stop_builty,
                            "adv_freight"=>$row->adv_freight
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
        function paymentFreight_save(){
            $tableName1='tbl_payment_freight';
            $tableName2='tbl_payment_freight_detail';
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
                $data['cdate'] = date('Y-m-d',strtotime($data['cdate']));
                $data['company_id'] = get_cookie("ae_company_id");
                $desc=$this->input->post("builtyno");
                $munit=$this->input->post("sub_dealer_id");
                $qty=$this->input->post("freightamt");
                $rate=$this->input->post("truckno");
                $amount=$this->input->post("qtymt");
                $vatper=$this->input->post("destination_id");
                $vatamount=$this->input->post("advamt");
                $amt=$this->input->post("amtpaid");
                if($status=="add")
                {
                try{
                $this->db->insert($tableName1,$data); // insert trans1
                $id=$this->db->insert_id();
                $zipped = array_map(null, $desc,$munit,$qty,$rate,$amount,$vatper,$vatamount,$amt);
                foreach($zipped as $tuple) {
                    $data2=array(
                        "billno"=>$id,
                        "builtyno"=>$tuple[0],
                        "sub_dealer_id"=>$tuple[1],
                        "freightamt"=>$tuple[2],
                        "truckno"=>$tuple[3],
                        "qtymt"=>$tuple[4],
                        "destination_id"=>$tuple[5],
                        "advamt"=>$tuple[6],
                        "amtpaid"=>$tuple[7]
                        );
                    $this->db->insert($tableName2,$data2);
                }
                $this->db->trans_commit();
                echo "1";           
                }catch(Exception $e){
                $this->db->trans_rollback();
                echo "2";           
                }
            }
            if($status=="edit")
                {
                try{
                $id=$this->input->post('sno');
                $this->db->where('id',$id);
                $this->db->update($tableName1,$data); // update trans 1
                $this->db->where('billno',$id);
                $this->db->delete($tableName2); // delete trans 2
                $zipped = array_map(null, $desc,$munit,$qty,$rate,$amount,$vatper,$vatamount,$amt);
                foreach($zipped as $tuple) {
                    $data2=array(
                        "billno"=>$id,
                        "builtyno"=>$tuple[0],
                        "sub_dealer_id"=>$tuple[1],
                        "freightamt"=>$tuple[2],
                        "truckno"=>$tuple[3],
                        "qtymt"=>$tuple[4],
                        "destination_id"=>$tuple[5],
                        "advamt"=>$tuple[6],
                        "amtpaid"=>$tuple[7]
                        );
                    $this->db->insert($tableName2,$data2);
                }
                $this->db->trans_commit();
                echo "1";           
                }catch(Exception $e){
                $this->db->trans_rollback();
                echo "2";           
                }
            }
        }
        public function paymentFreight_list(){
            $query=$this->db->query('select t.cdate,t.id,t.pos_id,t.achead_id,a.name aname,t.payhead_id ,p.name pname,pos.name posname,t.netamt ,t.remark from tbl_payment_freight t inner join m_ledger a on t.achead_id=a.id inner join m_ledger p on t.payhead_id=p.id inner join m_master pos on t.pos_id=pos.id where t.company_id='.get_cookie('ae_company_id').' and t.cdate="'.date('Y-m-d').'"');
            return $query->result();
        }
        public function paymentFreight_list_by_search(){
            $from=date('Y-m-d',strtotime($this->input->post('from')));
            $to=date('Y-m-d',strtotime($this->input->post('to')));
            $ledger_id=$this->input->post('ledger_id');
            if($ledger_id=='-'){
            $query=$this->db->query('select t.cdate,t.id,t.pos_id,t.achead_id,a.name aname,t.payhead_id ,p.name pname,pos.name posname,t.netamt ,t.remark from tbl_payment_freight t inner join m_ledger a on t.achead_id=a.id inner join m_ledger p on t.payhead_id=p.id inner join m_master pos on t.pos_id=pos.id where t.company_id='.get_cookie('ae_company_id').' and (t.cdate between "'.$from.'" and "'.$to.'")');
            return $query->result();
            }else{
            $query=$this->db->query('select t.cdate,t.id,t.pos_id,t.achead_id,a.name aname,t.payhead_id ,p.name pname,pos.name posname,t.netamt ,t.remark from tbl_payment_freight t inner join m_ledger a on t.achead_id=a.id inner join m_ledger p on t.payhead_id=p.id inner join m_master pos on t.pos_id=pos.id where t.company_id='.get_cookie('ae_company_id').' and a.id='.$ledger_id.' and (t.cdate between "'.$from.'" and "'.$to.'")');
            return $query->result();
            }
        }
        public function paymentFreight_get()
        {
            $id = $this->input->get("id");
            $query=$this->db->query('select * from tbl_payment_freight where company_id='.get_cookie('ae_company_id').' and id='.$id);            
            $result=$query->result();
            if($query->num_rows()>0)
            {
                foreach($result as $row)
                {
                    $data = array(
                            "Message"=>"Success",
                            "id"=>$row->id,
                            "cdate"=>date('d-m-Y',strtotime($row->cdate)),
                            "achead_id"=>$row->achead_id,
                            "remark"=>$row->remark,
                            "tds"=>$row->tds,
                            "tdsamt"=>$row->tdsamt,
                            "payhead_id"=>$row->payhead_id,
                            "less_id"=>$row->less_id,
                            "lessamt"=>$row->lessamt,
                            "add_id"=>$row->add_id,
                            "addamt"=>$row->addamt,
                            "tolamt"=>$row->tolamt,
                            "netamt"=>$row->netamt,
                            "created_by"=>$row->created_by,
                            "modified_by"=>$row->modified_by
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
        public function paymentFreight_get_item(){
            $id = $this->input->post("id");
            $query=$this->db->query("select * from tbl_payment_freight_detail where billno=$id");
            $result=$query->result();
            return $result;
        }
        //End Payment Freight
        //Pending Bill Rate
        public function pending_bill_rate_list(){
          $vtype=$this->input->get('vtype');
          $query=$this->db->query('select t1.id,t1.cdate,t1.builtyno,t1.consignee_name,p.name pname,l.name lname,d.name dname,cat.name catname,s.name as godownname from tbl_trans1 t1 inner join m_master p on t1.pos_id=p.id inner join m_ledger l on t1.ledger_id=l.id inner join m_master d on t1.destination_id=d.id inner join m_master cat on t1.cat_id=cat.id inner join m_master s on t1.source_id=s.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and t1.billstatus="pending" ORDER BY STR_TO_DATE(t1.cdate, "%d-%m-%y")');
          return $query->result();
        }
        //End Pending Bil Rate
        //Start By Ram(11-04-2015)
        //Ledger Mob No
        public function ledger_mobno_get()
        { 
            $id = $this->input->get("id");
            $query=$this->db->query("select mobileno from m_ledger where company_id=".get_cookie('ae_company_id')." and id=$id");
            $result=$query->result();
            if($query->num_rows()>0)
            {
                foreach($result as $row)
                {
                    $data = array(
                            "Message"=>"Success",
                            "mobileno"=>$row->mobileno
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
        //End By Ram(11-04-2015)
        //Start By Ram(13-04-2015)
        public function dispatch_pending_item_get(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.*,i.name iname from tbl_trans2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id);
          $result=$query->result();
          return $result;
        }
        //End By Ram(13-04-2015)
        //Start By Ram(23-04-2015)
        //Pending Bill Rate
        public function pending_bill_rate_list_by_category(){
          $vtype=$this->input->get('vtype');
          $cat=$this->input->get('cat');
          $query=$this->db->query('select t1.cdate,t1.builtyno,t1.ledger_id,t1.destination_id,t1.consignee_name cname,t.id billid,t.itemcode,t.billno,t.cat_id,t.qtymt,t.qtybag,t.rate,t.auth_rate,t.freight,i.name iname,t.orderid_gen,s.name godownname from tbl_trans2 t inner join m_item i on t.itemcode=i.id inner join tbl_trans1 t1 on t.billno=t1.id inner join m_master s on t1.source_id=s.id where t1.company_id='.get_cookie('ae_company_id').' and t1.billstatus="pending" and t1.cat_id='.$cat.' and t1.vtype="dispatch" ORDER BY t1.cdate,t1.builtyno');
          return $query->result();
        }
        //End Pending Bil Rate
        //End By Ram(23-04-2015)
        //Start By Ram(27-04-2015)
        //Generate Bill
        public function generate_bill()
         {
          $usertype=get_cookie('ae_usertype');            
          $srch = "";
          if($usertype=="CEMENT")
          {
            $srch = " and cat_id=25";
          }
          if($usertype=="FERTILIZERS")
          {
            $srch = " and cat_id=1";
          }

          $tableName1='tbl_trans1';

          try{     
          $this->db->trans_begin();   
          //Generate Bill
              $query=$this->db->query('select id,serialno,cat_id from tbl_trans1 where company_id='.get_cookie('ae_company_id').' and serialno=0 and billstatus="clear" ' . $srch .' order by cdate,id');
              if($query->num_rows()>0){
                $substr='';
                foreach($query->result() as $row){
                    $sno=get_max_sno($row->cat_id);
                    $prefix=get_prefix_by_category($row->cat_id);
                    $billno=$prefix.'/'.$sno;
                    $data=array(
                    "serialno"=>$sno,
                    "billno"=>$billno
                    );
                    $this->db->where("id",$row->id);
                    $this->db->update($tableName1,$data);
                    $substr.='t1.id='.$row->id.' or ';
                }
                $this->db->trans_commit();
                echo "1".$substr;
              }else{
                echo "2";
              }
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "3";       
            }
        }
        //Generate Bill
        public function generate_bill_list(){
          $from=date('Y-m-d',strtotime($this->input->get('from')));
          $to=date('Y-m-d',strtotime($this->input->get('to')));
          $cat_id=$this->input->get('cat_id');
          $query=$this->db->query('select t1.id,t1.cdate,t1.billdate,t1.billno,t1.tol_amt,t1.vat_amt,t1.tol_freight,t1.net_tol,cat.name catname,p.name pname from tbl_trans1 t1 inner join m_master cat on t1.cat_id=cat.id inner join m_ledger p on t1.ledger_id=p.id where t1.company_id='.get_cookie('ae_company_id').' and (t1.billdate between "'.$from.'" and "'.$to.'") and cat_id='.$cat_id.' and t1.billstatus="clear" order by t1.cat_id,t1.cdate,t1.id');
          return $query->result();
        }
        //End By Ram(27-04-2015)
        //Start By Ram(27-05-2015)
        //Generate Last Bill
        public function generate_bill_last_list(){
          $cond=$this->input->get('cond'); //t1.id=9
          $query=$this->db->query('select t1.id,t1.cdate,t1.billno,t1.tol_amt,t1.vat_amt,t1.tol_freight,t1.net_tol,cat.name catname,p.name pname from tbl_trans1 t1 inner join m_master cat on t1.cat_id=cat.id inner join m_ledger p on t1.ledger_id=p.id where t1.company_id='.get_cookie('ae_company_id').' and ('.$cond.') and t1.billstatus="clear" order by t1.cat_id,t1.cdate,t1.id');
          return $query->result();
        }
        //End By Ram(21-05-2015)


    // Invoice
    public function invoice_list(){
      $vtype=$this->input->get('vtype');
      $usertype=get_cookie('ae_usertype');            
      $srch = "";
      if($usertype=="CEMENT")
      {
        $srch = " and cat.name='CEMENT'";
      }
      if($usertype=="FERTILIZERS")
      {
        $srch = " and cat.name='FERTILIZERS'";
      }
      $query=$this->db->query('select t1.id,t1.cdate,t1.billno,t1.builtyno,t1.remark,p.name pname,l.name lname,d.name dname,cat.name catname, t1.net_tol from tbl_trans1 t1 inner join m_master p on t1.pos_id=p.id inner join m_ledger l on t1.ledger_id=l.id inner join m_master d on t1.destination_id=d.id inner join m_master cat on t1.cat_id=cat.id where t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" ' . $srch . ' and t1.billstatus="clear" and t1.serialno<>0 order by t1.cdate desc,t1.id desc');
      return $query->result();
    }
      public function invoice_get()
      {
        $id = $this->input->get("id");
        $query=$this->db->query("select * from tbl_trans1 where id=".$id." and company_id=".get_cookie("ae_company_id"));
        $result=$query->result();
        if($query->num_rows()>0)
        {
          foreach($result as $row)
          {
            $data = array(
                "Message"=>"Success",
                "id"=>$row->id,
                "billno"=>$row->billno,
                "cdate"=>$row->cdate,
                "builtyno"=>$row->builtyno,
                "truckno"=>$row->truckno,
                "type"=>$row->type,
                "source_id"=>$row->source_id,
                "ledger_id"=>$row->ledger_id,
                "ledger_mobno"=>$row->ledger_mobno,
                "sub_dealer_id"=>$row->sub_dealer_id,
                "consignee_name"=>$row->consignee_name,
                "consignee_mobno"=>$row->consignee_mobno,
                "destination_id"=>$row->destination_id,
                "cat_id"=>$row->cat_id,
                "stop_builty"=>$row->stop_builty,
                "lessadv"=>$row->lessadv,
                "balfreight"=>$row->balfreight,
                "tol_amt"=>$row->tol_amt,
                "vat_percent"=>$row->vat_percent,
                "vat_amt"=>$row->vat_amt,
                "net_tol"=>$row->net_tol,
                "remark"=>$row->remark,
                "vtype"=>$row->vtype,
                "created_by"=>$row->created_by,
                "modified_by"=>$row->modified_by
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
      public function invoice_get_item(){
          $id = $this->input->get("id");
          $query=$this->db->query('select t2.*,i.name iname from tbl_trans2 t2  inner join m_item i on t2.itemcode=i.id where t2.billno='.$id); // Check By Ram Add Cat greather than zero
          $result=$query->result();
          return $result;
        }
    public function invoice_save()
        {
          $tableName1='tbl_trans1';
          $tableName2='tbl_trans2';
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
          $data['cdate'] = date('Y-m-d',strtotime($data['cdate']));
          $data['pos_id'] = get_cookie("ae_pos_id");
          $data['company_id'] = get_cookie("ae_company_id");
          $itemcode=$this->input->post("itemcode");
          $orderid_gen=$this->input->post("orderid_gen");
          $qtymt=$this->input->post("qtymt");
          $qtybag=$this->input->post("qtybag");
          $rate=$this->input->post("rate");
          $freight=$this->input->post("freight");
          $auth_rate=$this->input->post("auth_rate");
          $actual_rate=$this->input->post("actual_rate");
          $amt=$this->input->post("amt");

          try{
          $this->db->trans_begin();  
          $id=$this->input->post('sno');
          $this->db->where('id',$id);
          $this->db->update($tableName1,$data); // update trans 1
          $this->db->where('billno',$id);
          $this->db->delete($tableName2); // delete trans 2
          $zipped = array_map(null, $itemcode,$qtymt,$qtybag, $rate,$freight,$auth_rate,$actual_rate,$amt,$orderid_gen);
          foreach($zipped as $tuple) {
              $data2=array(
                "billno"=>$id,
                "itemcode"=>$tuple[0],
                "qtymt"=>$tuple[1],
                "qtybag"=>$tuple[2],
                "rate"=>$tuple[3],
                "freight"=>$tuple[4],
                "auth_rate"=>$tuple[5],
                "actual_rate"=>$tuple[6],
                "amt"=>$tuple[7],
                "cat_id"=>$cat_id,
                "orderid_gen"=>$tuple[8],
                "company_id"=>get_cookie('ae_company_id')            
                );
              $this->db->insert($tableName2,$data2);
              //Update Status
              if(empty($tuple[3]) || $tuple[3]==0.00 || $tuple[3]==0){
                $updata=array(
                  'tstatus'=>'pending'
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }else{
                $updata=array(
                  'tstatus'=>''
                  );
                $this->db->where('id',$id);
                $this->db->update($tableName1,$updata);
              }
              //End Update Status
          }
          $this->db->trans_commit();
          echo "1";       
            }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";       
            }
      }

      //Start By Ram(01-06-2015)
      function summary_report_party_wise(){
        $cat_id=0;
        $from=date('Y-m-d',strtotime($this->input->post('from')));
        $to=date('Y-m-d',strtotime($this->input->post('to')));
        // $usertype=get_cookie('ae_usertype');
        $cat_id=$this->input->post('cat_id');
        $ledger_id=$this->input->post('ledger_id');
        $company_id=$this->input->post('company_id');
        $report_on=$this->input->post('report_on');
        if($report_on=="billdate")
        {
          $sql = "CALL PartyItemSummaryBillDate('$cat_id','$company_id','$ledger_id','$from','$to')";
        }        
        else{
          $sql = "CALL PartyItemSummary('$cat_id','$company_id','$ledger_id','$from','$to')";
        }
        $query = $this->db->query($sql);
        if($query->num_rows>0){
            $tmpl = array (
                                'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" id="mytable" class="mytable table table-bordered">',

                                'heading_row_start'   => '<tr>',
                                'heading_row_end'     => '</tr>',
                                'heading_cell_start'  => '<th>',
                                'heading_cell_end'    => '</th>',

                                'row_start'           => '<tr>',
                                'row_end'             => '</tr>',
                                'cell_start'          => '<td>',
                                'cell_end'            => '</td>',

                                'row_alt_start'       => '<tr>',
                                'row_alt_end'         => '</tr>',
                                'cell_alt_start'      => '<td>',
                                'cell_alt_end'        => '</td>',

                                'table_close'         => '</table>'
                          );

            $this->table->set_template($tmpl);

//           $tmpl = array ( 'table_open'  => '<table  cellpadding="0" cellspacing="0" class="mytable table table-bordered">' );

           $this->table->set_template($tmpl); 
           echo $this->table->generate($query);         
        }else{
           echo 'No Record Found !';
        }
        // $query = $this->db->query($sql,$params);
        // $this->table->set_caption('Table Of Content');
      }
      //End By Ram(01-06-2015)
      //Start By Ram(02-06-2015)
      function summary_report_godown_wise(){
        $from=date('Y-m-d',strtotime($this->input->post('from')));
        $to=date('Y-m-d',strtotime($this->input->post('to')));
        $cat_id=$this->input->post('cat_id');
        $source_id=$this->input->post('source_id');
        $sql = "CALL GodownItemSummary('$cat_id','$source_id','$from','$to')";
        $query = $this->db->query($sql);
        if($query->num_rows>0){
           $tmpl = array ( 'table_open'  => '<table cellpadding="0" cellspacing="0" id="mytable" class="table table-bordered">' );
           $this->table->set_template($tmpl); 
           echo $this->table->generate($query); 
        }else{
            echo 'No Record Found !';
       }
      }
      //End By Ram(02-06-2015)
      //Start By Ram(10-06-2015)
      public function invoice_cancel_by_id(){
        $id=$this->input->post('ID');
        $remark=$this->input->post('Remark');
        try{
            $this->db->trans_begin();
            $data=array(
              'ledger_id'=>2444,
              'tol_freight'=>0.00,
              'lessadv'=>0.00,
              'balfreight'=>0.00,
              'tol_amt'=>0.00,
              'vat_amt'=>0.00,
              'net_tol'=>0.00,
              'remark'=>$remark
              );
            $this->db->where('id',$id); // Table 1 Update
            $this->db->update('tbl_trans1',$data);
            $this->db->where('billno',$id); // Table 2 Delete
            $this->db->delete('tbl_trans2');
            $this->db->trans_commit();
            echo "1";
        }catch(Exception $e){
            $this->db->trans_rollback();
            echo "2";
        }
      }
      //End By Ram(10-06-2015)
        public function take_order_list(){
          //$query=$this->db->query('select t1.*,t2.*,l.name lname,i.name iname,u.name uname from tbl_trans1 t1 inner join tbl_trans2 t2 on t1.id=t2.billno inner join m_ledger l on t1.ledger_id=l.id inner join m_item i on t2.itemcode=i.id inner join m_executive u on t1.user_id=u.id order by t1.id');
          $godown=$this->input->get('godown');
          $itemname=$this->input->get('itemname');
          $username=$this->input->get('username');
          $company=$this->input->get('company');

          $srch=" ";
          if($godown!='-')
          {
            $srch = $srch . " and o.godown='" . $godown . "'";
          }
          if($itemname!='-')
          {
            $srch = $srch . " and o.itemname ='" . $itemname . "'";
          }
          if($company!='-')
          {
            $srch = $srch . " and c.name ='" . $company . "'";
          }
          if($username!='-')
          {
            $srch = $srch . " and o.name ='" . $username . "'";
          }
          $query=$this->db->query('select o.*, (select sum(qtymt) from tbl_trans2,m_item,tbl_trans1  where tbl_trans1.id=tbl_trans2.billno and tbl_trans2.itemcode=m_item.id and  tbl_trans2.orderid_gen=o.orderid_gen and o.itemname=m_item.name and tbl_trans1.vtype="Dispatch") as dispqty from orders o, m_item i, m_master c where o.itemname=i.name and i.itemcompany_id=c.id  '.$srch.' order by o.timestamp desc');
        return $query->result();
        }



}