<?
function get_max_id($tablename, $id){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query("select $id FROM $tablename ORDER BY $id DESC LIMIT 1");
    if($query->num_rows()>0){
        foreach($query->result() as $row){
            return $row->$id+1;
        }
    }
    else
    {
           return 1;   
    }
}
function pos_list(){
	$ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and type="POS"');
    return $query->result();    
}


function state_list(){
  $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and type="state"');
    return $query->result();    
}

function source_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and type="Source"');
    return $query->result();    
}
function ledger_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_ledger where company_id='.get_cookie('ae_company_id').' and (group_id>=29 or group_id=22 or group_id=25 or group_id=18) order by name');
    return $query->result();    
}
function mode_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_ledger where company_id='.get_cookie('ae_company_id').' and (group_id=17 or group_id=18) order by name');
    return $query->result();    
}
function sub_dealer_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_ledger where company_id='.get_cookie('ae_company_id').' and (group_id>=29 or group_id=30 or group_id=22) order by name');
    return $query->result();    
}

function customes_list()
{
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query("select * from m_custome where company_id=" . get_cookie("ae_company_id") ." ");
    return $query->result();
}

function transporter_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_ledger where company_id='.get_cookie('ae_company_id').' and (group_id=31) order by name');
    return $query->result();    
}
function destination_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and type="Destination" order by name');
    return $query->result();    
}
function godown_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and type="Godown" order by name');
    return $query->result();    
}
function item_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name,specification from m_item where company_id='.get_cookie('ae_company_id').' order by name');
    return $query->result();    
}
function cash_in_hand_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_ledger where company_id='.get_cookie('ae_company_id').' and group_id=18');
    return $query->result();    
}
function indirect_expenses_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_ledger where company_id='.get_cookie('ae_company_id').' and group_id=8');
    return $query->result();    
}
function consignee_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $query=$ci->db->query('select id,name from m_ledger where company_id='.get_cookie('ae_company_id').' and group_id=32');
    return $query->result();    
}
function getMaxPaymentFreight(){
    $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select id from tbl_payment_freight where company_id='.get_cookie('ae_company_id').' order by id desc limit 0,1');
    if($query->num_rows()>0){
        foreach($query->result() as $row){
          return $row->id;
        }
    }
}
function getDispatchId(){
    $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select id from tbl_trans where company_id='.get_cookie('ae_company_id').'  and vtype="DISPATCH" order by id desc limit 0,1');
    if($query->num_rows()>0){
        foreach($query->result() as $row){
          return $row->id;
        }
    }
}
function category_list(){
    $ci=& get_instance();
    $ci->load->database(); 

    $usertype=get_cookie('ae_usertype');            
    $srch = "";
    if($usertype=="CEMENT")
    {
      $srch = " and name='CEMENT'";
    }
    if($usertype=="FERTILIZERS")
    {
      $srch = " and name='FERTILIZERS'";
    }

    $query=$ci->db->query('select id,name from m_master where company_id='.get_cookie('ae_company_id').' and type="Item Group"' . $srch . '');
    return $query->result();    
}
function getLedgerNameById($lid){
    $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select name from m_ledger where company_id='.get_cookie('ae_company_id').'  and id='.$lid);
    if($query->num_rows()>0){
        foreach($query->result() as $row){
          return $row->name;
        }
    }
}
function getDestinationNameById($did){
    $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select name from m_master where company_id='.get_cookie('ae_company_id').' and type="Destination"  and id='.$did);
    if($query->num_rows()>0){
        foreach($query->result() as $row){
          return $row->name;
        }
    }
}
function get_category_vat($cid){
    $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select vat from m_master where company_id='.get_cookie('ae_company_id').' and type="Item Group"  and id='.$cid);
    if($query->num_rows()>0){
        foreach($query->result() as $row){
          return $row->vat;
        }
    }
}
function get_tol_rate_by_billno($bid){
   $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select sum(amt) tolamt from tbl_trans2 where company_id='.get_cookie('ae_company_id').' and billno='.$bid);
    if($query->num_rows()>0){
        foreach($query->result() as $row){
          return $row->tolamt;
        }
    }
}
function get_tol_freight_by_billno($bid){
   $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select tol_freight tolfreight from tbl_trans1 where company_id='.get_cookie('ae_company_id').' and id='.$bid);
    if($query->num_rows()>0){
        foreach($query->result() as $row){
          return $row->tolfreight;
        }
    }
}
function get_max_sno($cid){
    $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select max(serialno) maxsno from tbl_trans1 where company_id='.get_cookie('ae_company_id').' and cat_id='.$cid);
    if($query->num_rows()>0){
        foreach($query->result() as $row){
          return $row->maxsno+1;
        }
    }else{
        return 1;
    }
}

///////////////////SMS

    function sendsms($message,$mobileno)
    {
          $ci=& get_instance();
          $ci->load->database(); 
          $api="";
          $query=$ci->db->query('select sms_value  from m_sms');
          if($query->num_rows()>0){
              foreach($query->result() as $row){
                $api= $row->sms_value;
              }
          }


            $msg=$message;
            $message=urlencode($message);
            $mobileno=urlencode($mobileno);
            $api=str_replace("(0)",$mobileno,$api);
            $api=str_replace("(1)",$message,$api);
//            $api_key="1868AoS2vvQSBjQ6581d997c";
          // create a new cURL resource
          $ch = curl_init();

          // set URL and other appropriate options
//          curl_setopt($ch, CURLOPT_URL, "http://login.bulksms.bz/api/sendhttp.php?authkey=".$api_key."&mobiles=".$mobileno."&message=".$message."&sender=GDRWLA&route=4&country=0");
          curl_setopt($ch, CURLOPT_URL, $api);
         // curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_HEADER,0);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
          // grab URL and pass it to the browser
          curl_exec($ch);

          // close cURL resource, and free up system resources
          curl_close($ch);
    }  

function get_prefix_by_category($cid){
    $ci=& get_instance();
    $ci->load->database(); 
    $query=$ci->db->query('select prefix from m_master where company_id='.get_cookie('ae_company_id').' and type="Item Group" and id='.$cid);
    if($query->num_rows()()>0){
        foreach($query->result() as $row){
          return $row->prefix;
        }
    }else{
        return '';
    }
}

/////////////
    function take_order_data($result,$type,$dtype="")
    {
      $return_string="";
      if(count($result)>0)
      {
          if($dtype=="Adjustment")
          {
              $return_string=$return_string . '<form id="adjust_form">';
          }

          $return_string=$return_string . '<table id="TblList" class="table table-bordered">';
          $return_string=$return_string . '    <thead>';
          $return_string=$return_string . '        <tr>';
          $return_string=$return_string . '            <th>Date</th>';
          $return_string=$return_string . '            <th>User</th>';
          $return_string=$return_string . '            <th>Order ID</th>';
          $return_string=$return_string . '            <th>Party Name</th>';
          $return_string=$return_string . '            <th>Godown</th>';
          $return_string=$return_string . '            <th>Item Name</th>';
          if($dtype=="Adjustment")
          {
            $return_string=$return_string . '            <th colspan="3">Pending Qty</th>';
          }
          else
          {
            $return_string=$return_string . '            <th colspan="2">Pending Qty</th>';
          }
          if($type!="mail")
          {
            $return_string=$return_string . '            <th colspan="2">Order Qty</th>';
            $return_string=$return_string . '            <th>Rate</th>';
            $return_string=$return_string . '            <th>Amount</th>';
          }
          $return_string=$return_string . '            <th>Remarks</th>';
          $return_string=$return_string . '            <th>Del.Date</th>';
          if($type=="display")
          {
              $return_string=$return_string . '            <th class="hidecol">Time Stamp</th>';
          }
          if($dtype=="Modify")
          {
              $return_string=$return_string . '            <th>Action</th>';
          }
          if($dtype=="Adjustment")
          {
              $return_string=$return_string . '            <th>Action</th>';
          }
          $return_string=$return_string .  '        </tr>';
          $return_string=$return_string . '        <tr>';
          $return_string=$return_string . '            <th>&nbsp;</th>';
          $return_string=$return_string . '            <th>&nbsp;</th>';
          $return_string=$return_string . '            <th>&nbsp;</th>';
          $return_string=$return_string . '            <th>&nbsp;</th>';
          $return_string=$return_string . '            <th>&nbsp;</th>';
          $return_string=$return_string . '            <th>&nbsp;</th>';
          $return_string=$return_string . '            <th>M.T.</th>';
          if($dtype=="Adjustment")
          {
            $return_string=$return_string . '            <th>A</th>';
          }          
          $return_string=$return_string . '            <th>Bags</th>';
          if($type!="mail")
          {
            $return_string=$return_string . '            <th>M.T.</th>';
            $return_string=$return_string . '            <th>Bags</th>';
            $return_string=$return_string . '            <th>&nbsp;</th>';
            $return_string=$return_string . '            <th>&nbsp;</th>';
          }
          $return_string=$return_string . '            <th>&nbsp;</th>';
          $return_string=$return_string . '            <th>&nbsp;</th>';
          if($type=="display")
          {
              $return_string=$return_string . '            <th class="hidecol">&nbsp;</th>';
          }
          if($dtype=="Modify")
          {
              $return_string=$return_string . '            <th>&nbsp;</th>';
          }
          if($dtype=="Adjustment")
          {
              $return_string=$return_string . '            <th>&nbsp;</th>';
          }
          $return_string=$return_string .  '        </tr>';
          $return_string=$return_string .  '    </thead>';
          $return_string=$return_string .  '    <tbody>';

          $orderid_gen="";
          $timestamp="";
          $totqty=0;
          $totpqty=0;

          foreach($result as $row)
          {
              $pending_qty = (int)($row->qty)- (int)($row->dispqty);
              $pending_qty = (int)($pending_qty)- (int)($row->adjustmentqty);
              if($pending_qty!=0)
              {
                if($timestamp=="")
                {
                  $timestamp=$row->timestamp;
                }
                if($orderid_gen!=$row->orderid_gen)
                {
                  if($row->modified==1 && $dtype=="Modify")
                  {
                    $return_string=$return_string .  '<tr class="" style="background-color:#FDB8B8;">';
                  }else
                  {
                    if($row->adjustment==1 && $dtype=="Adjustment")
                    {
                      $return_string=$return_string .  '<tr class="" style="background-color:#ABEF00;">';
                    }else
                    {
                      $return_string=$return_string .  '<tr class="">';
                    }
                  }
                  $return_string=$return_string .  '<td>'.$row->date.'</td>';
                  $return_string=$return_string .  "<td>".$row->name." ";
                  $return_string=$return_string .  "<td><span style='float:left;'>".$row->orderid."</span> ";
                  if($type=="display")
                  {
                      if($row->partyname=="ATUL ENTERPRISES")
                      {
                        $return_string=$return_string .  "<span style='float:right;'><button type='button' id='btn_order' class='btn btn-xs btn-info' onclick=TransferOrder('". $row->orderid_gen ."');return false;>T</button></span>";
                      }else{
                        $return_string=$return_string .  "<span style='float:right;'><button type='button' id='btn_order' class='btn btn-xs btn-info' onclick=DispatchOrder('". $row->orderid_gen ."');return false;>D</button></span>";
                      }
                  }
                  $return_string=$return_string .  "</td>";
                  $return_string=$return_string .  '<td>'.$row->partyname.'</td>';
                  $return_string=$return_string .  '<td>'.$row->godown.'</td>';
                  $return_string=$return_string .  '<td>'.$row->itemname.'</td>';
                  $return_string=$return_string .  '<td style="background-color:#ffcccc;">'.$pending_qty.'</td>';
                  if($dtype=="Adjustment")
                  {
                    $return_string=$return_string .  "<td><input name='checkbox[]' class='chk' type='checkbox' value='".$row->id . '/' . $pending_qty ."'><input name='aqty[]' type='hidden' value='".$pending_qty."'></td>";
                  }          

                  $return_string=$return_string .  '<td style="background-color:#ffcccc;">'.($pending_qty*20).'</td>';
                  if($type!="mail")
                  {
                    $return_string=$return_string . '<td style="background-color:#ABEFAB;">'.$row->qty.'</td>';
                    $return_string=$return_string . '<td style="background-color:#ABEFAB;">'.($row->qty*20).'</td>';
                    $return_string=$return_string . '<td>'.$row->rate.'</td>';
                    $return_string=$return_string . '<td>'.$row->amount.'</td>';
                  }
                  $return_string=$return_string . '<td>'.$row->remarks.'</td>';
                  $return_string=$return_string . '<td>'.$row->deldate.'</td>';

                  $totqty=$totqty+$row->qty;
                  $totpqty=$totpqty+$pending_qty;

                  if($type=="display")
                  {
                      $return_string=$return_string .  '<td class="hidecol">'.$row->timestamp.'</td>';
                  }
                  if($dtype=="Modify")
                  {
//                      $return_string=$return_string .  "<td><button type='button' id='btn_order' class='btn btn-xs btn-info' onclick=OrderModify('". $row->id ."');return false;>MODIFY</button></td>";
                      $return_string=$return_string .  "<td><button type='button' id='btn_order' class='btn btn-xs btn-info' onclick=LoadEditForm('Order','edit','". $row->orderid_gen ."');return false;>MODIFY</button></td>";
                  }
                  if($dtype=="Adjustment")
                  {
                      $return_string=$return_string .  "<td><button type='button' id='btn_order' class='btn btn-xs btn-info' onclick=OrderAdjustment('". $row->id ."','".$pending_qty."');return false;>ADJUST</button></td>";
                  }
                  $return_string=$return_string . '</tr>';

                  $orderid_gen=$row->orderid_gen;                  
                }
                else{
                  if($row->modified==1 && $dtype=="Modify")
                  {
                    $return_string=$return_string .  '<tr class="" style="background-color:#FDB8B8;">';
                  }else
                  {
                    if($row->adjustment==1 && $dtype=="Adjustment")
                    {
                      $return_string=$return_string .  '<tr class="" style="background-color:#ABEF00;">';
                    }else
                    {
                      $return_string=$return_string .  '<tr class="">';
                    }
                  }
                  $return_string=$return_string .  '<td>&nbsp;</td>';
                  $return_string=$return_string .  '<td>&nbsp;</td>';
                  $return_string=$return_string .  '<td>&nbsp;</td>';
                  $return_string=$return_string .  '<td>&nbsp;</td>';
                  $return_string=$return_string . '<td>&nbsp;</td>';
                  $return_string=$return_string . '<td>'.$row->itemname.'</td>';
                  $return_string=$return_string . '<td style="background-color:#ffcccc;">'.$pending_qty.'</td>';
                if($dtype=="Adjustment")
                  {
                    $return_string=$return_string .  "<td><input name='checkbox[]' class='chk' type='checkbox' value='".$row->id . '/' . $pending_qty ."'><input name='aqty[]' type='hidden' value='".$pending_qty."'></td>";
                  }          

                  $return_string=$return_string . '<td style="background-color:#ffcccc;">'.($pending_qty*20).'</td>';
                  if($type!="mail")
                  {
                    $return_string=$return_string . '<td style="background-color:#ABEFAB;">'.$row->qty.'</td>';
                    $return_string=$return_string . '<td style="background-color:#ABEFAB;">'.($row->qty*20).'</td>';
                    $return_string=$return_string . '<td>'.$row->rate.'</td>';
                    $return_string=$return_string .  '<td>'.$row->amount.'</td>';
                  }
                  $return_string=$return_string . '<td>&nbsp;</td>';
                  $return_string=$return_string . '<td>&nbsp;</td>';
                  if($type=="display")
                  {
                      $return_string=$return_string . '<td class="hidecol">&nbsp;</td>';
                  }
                  if($dtype=="Modify")
                  {
                      $return_string=$return_string .  "<td><button type='button' id='btn_order' class='btn btn-xs btn-info' onclick=OrderModify('". $row->id ."');return false;>MODIFY</button></td>";
                  }
                  if($dtype=="Adjustment")
                  {
                      $return_string=$return_string .  "<td><button type='button' id='btn_order' class='btn btn-xs btn-info' onclick=OrderAdjustment('". $row->id ."');return false;>ADJUST</button></td>";
                  }
                  $return_string=$return_string .  '</tr>';

                  $totqty=$totqty+$row->qty;
                  $totpqty=$totpqty+$pending_qty;

                }
              }
          }
          $return_string=$return_string .  '<tr class="">';
          $return_string=$return_string .  '<td>&nbsp;</td>';
          $return_string=$return_string .  '<td>&nbsp;</td>';
          $return_string=$return_string .  '<td>&nbsp;</td>';
          $return_string=$return_string .  '<td>TOTAL :</td>';
          $return_string=$return_string . '<td>&nbsp;</td>';
          $return_string=$return_string . '<td>&nbsp;</td>';
          $return_string=$return_string . '<td style="background-color:#ffcc00;">'.$totpqty.'</td>';
          if($dtype=="Adjustment")
            {
              $return_string=$return_string .  "<td>&nbsp;</td>";
            }          
          $return_string=$return_string . '<td style="background-color:#ffcc00;">'.($totpqty*20).'</td>';
          if($type!="mail")
          {
            $return_string=$return_string . '<td style="background-color:#AB0000;color:white;">'.$totqty.'</td>';
            $return_string=$return_string . '<td style="background-color:#AB0000;color:white;">'.($totqty*20).'</td>';
            $return_string=$return_string . '<td>&nbsp;</td>';
            $return_string=$return_string . '<td>&nbsp;</td>';
          }
          $return_string=$return_string . '<td>&nbsp;</td>';
          $return_string=$return_string . '<td>&nbsp;</td>';
          if($type=="display")
          {
              $return_string=$return_string . '<td class="hidecol">&nbsp;</td>';
          }
          $return_string=$return_string .  '</tr>';

          $return_string=$return_string . '</table>';
         if($dtype=="Adjustment")
          {
              $return_string=$return_string . '</form>';
          }

      } 
      return $return_string;     
    }
///////////////