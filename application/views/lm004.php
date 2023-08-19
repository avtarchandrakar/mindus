<!DOCTYPE html>
<html style="margin:0px;">
<head>
    <style type="text/css">
    font{
        margin-left:12px; 
        font-weight: bold;
        font-size: 10px;
    }
    .right{
        text-align: right;
    }
    .tb_col
    {
        padding:2px;
        /*border:1px solid black;*/
    }
    table, th, td {
      border: 1px solid grey;
      border-collapse: collapse;
      padding: 1px; 
    }
    </style>   
</head>
    <? 

    $ledger_ids=explode(",",$l_id);
//    $ledger_id=$l_id;
    $pfrom=$from;
//    echo $ledger_ids;
//    $from=date('Y-m-d',strtotime($from));
//    $to=date('Y-m-d',strtotime($to));

    foreach($ledger_ids as $ledger_id)
    {
      $l_id=0;
      $lname="";
      $query=$this->db->query("select l.*,
      (select sum(v.vamount) as amount from tbl_trans1 v  where   (v.cdate<='".date('Y-m-d',strtotime($to))."') and v.ledger_id=l.id) as balance,
      (select sum(v.lessadv) as amount from tbl_trans1 v  where   (v.cdate<='".date('Y-m-d',strtotime($to))."') and v.ledger_id=l.id) as lessadv
       from m_ledger l where l.line_id=".$ledger_id . " order by l.name");
      $result=$query->result();
      if($query->num_rows()>0)
      {
        
          foreach($result as $row)
          {
              $from=date('Y-m-d',strtotime($pfrom));
              $to=date('Y-m-d',strtotime($to));
//              $from=$pfrom;
              $lname = $row->name;
              $l_id=$row->id;
              $balance=$row->opbalance+($row->balance*-1);
              $balance = bcadd($balance,($row->lessadv)*-1);
              $balance = bcadd($balance,($row->lessadv)*-1);

//              echo $l_id.'  '.$lname.' Op. '.$row->opbalance.' Bal. '.$row->balance*-1 . '  Less Adv : ' . $row->lessadv .' V: '.$balance.' to '.$to."<br>";
//              $balance=1;
              if($balance<>0)
              {
                echo '<div style="page-break-after: always !important;">';
              echo '<table border="0" style="width:100%;" cellpadding="0" cellspacing="0" class="phpToPDF-page-break" >';
                echo '  <tr>';
                echo '    <td style="border:0px; solid black">';
                echo '<center>';
                echo '<h4>Ledger Report</h4>';
                echo '<h5 style="margin-top:-20px;">'.urldecode($lname).'<br>';
                echo 'From : '.date('d-m-Y',strtotime($from)).' To : '.date('d-m-Y',strtotime($to)) .'';
                echo '</h5>';
                echo '</center>';

                  $opb=0;
                  if($clear_date=="Yes")
                  {
                    $query=$this->db->query("select max(cleardate) as cdate from tbl_trans1 where ledger_id=".$row->id . " and hide='no'");
                    $result=$query->result();
                    if($query->num_rows()>0)
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

                  if($from=="")
                  {
                    $from=date('Y-m-d',strtotime($pfrom));
                  }

                  $opb=0;
                  $ledgername="";
                  $query=$this->db->query("select l.name ledgername,l.opbalance from m_ledger l where l.id=".$l_id);
                  $result=$query->result();
                  if($query->num_rows()>0)
                  {
                      foreach($result as $row)
                      {
                        $opb=$row->opbalance;
                        $ledgername=$row->ledgername;
                      }
                  }


                  echo '<table border=1 cellpadding=0 cellspacing=0 style="width:100%;font-size:10px;margin-top:-20px;">';
      echo '    <thead>';
      echo '        <tr>';
      echo '            <th class="tb_col" style="width:50px;">Date</th>';
      echo '            <th class="tb_col" style="width:50px;">No.</th>';
      echo '            <th class="tb_col" style="width:80px;">Type</th>';
      echo '            <th class="tb_col" style="width:80px;">Remark</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Debit</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Credit</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Balance</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;

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
              echo '    <td class="tb_col">' . date('d/m/Y',strtotime($from)) . '</td>';
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

      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,v.lr_freight,l.name ledgername,v.remark,v.lessadv from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' and v.hide="no" order by v.cdate');
      $result=$query->result();


      if($query->num_rows()>0)
      {

          $dt='';
          $showdt='';
          $bill_amt=0;
          foreach($result as $row)
          {
                $dt = $row->cdate;
                $showdt=date('d/m/y',strtotime($row->cdate));
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }                
                else
                {
                  echo '<tr class="" style="background-color:#F2F2F2;">';
                }
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
                echo '    <td class="tb_col">' . $showdt . '</td>';
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
          echo '</table>';
                  }
                  echo '</table>';
                  echo'</div>';
                }
                
            }

            
  
          }
      }
      ?>
 <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery.min.js'>" + "<" + "/script>");
    </script>

      <script type="text/javascript">
        $(document).ready(function(){
          window.print();
        });
      </script>

    </body>
</html>