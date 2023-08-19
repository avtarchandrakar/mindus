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
    .modal{
     position: fixed;
     top:10%;
     left:35%;
     width: 900px;
     height: 100%;
     overflow-x: hidden;
     overflow-y: hidden;
    }
    .voucherform{
        overflow: hidden;
    }
    .tb_col
    {
        padding:2px;
        /*border:1px solid black;*/
    }

     table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 3px; 
    }

    </style>   
</head>
<body>
    <? 
    echo '<table border="0" style="width:100%;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:1px; solid black">';
    echo '<center>';
      $from=date('Y-m-d',strtotime($from));
      $from1=date('Y-m-d',strtotime($from));
      $to=date('Y-m-d',strtotime($to));

      $opb=0;
      if($clear_date=="Yes")
      {
        $query=$this->db->query("select max(cleardate) as cdate from tbl_trans1 where ledger_id=".$l_id . " and hide='no'");
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
    echo '<h4 style="margin-top:0px;">Ledger Report</h4>';
    echo '<h5 style="margin-top:-20px;">'.urldecode($lname).'<br>';
    echo 'From : '.date('d-m-y',strtotime($from1)).' To : '.date('d-m-y',strtotime($to)) .'';
    echo '</h5>';
    echo '</center>';


      $opb=0;
      $ledgername="";
      $opbalancermk="";
      $query=$this->db->query("select l.name ledgername,l.opbalance,l.opbalancermk from m_ledger l where l.id=".$l_id);
      $result=$query->result();
      if($query->num_rows()>0)
      {
          foreach($result as $row)
          {
            $opb=$row->opbalance;
            $ledgername=$row->ledgername;
            $opbalancermk=$row->opbalancermk;
          }
      }


      echo '<table border=0 cellpadding=0 cellspacing=0 style="width:100%;font-size:10px;margin-top:-20px;">';
      echo '    <thead>';
      echo '        <tr>';
      echo '            <th class="tb_col" style="width:80px;">Date</th>';
      echo '            <th class="tb_col" style="width:80px;">Type</th>';
      echo '            <th class="tb_col" style="width:230px;">Item</th>';
      echo '            <th class="tb_col" style="width:50px;">Qty</th>';
      echo '            <th class="tb_col" style="width:50px;">Rate</th>';
      echo '            <th class="tb_col" style="width:50px;">Disc.</th>';
      echo '            <th class="tb_col" style="width:80px;">Amount</th>';
      echo '            <th class="tb_col" style="width:50px;">Freight</th>';
      echo '            <th class="tb_col" style="width:100px;">Bill Amt.</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Debit</th>';
      echo '            <th  style="width:90px;" class="tb_col right">RG</th>';
      echo '            <th  style="width:90px;" class="tb_col right">Credit</th>';
      echo '        </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      $dr=0;
      $cr=0;
      $rg=0;
      $tqty=0;
      $trgqty=0;
      $tfreight=0;
      $tlr_freight=0;
      $bill_amt=0;

      $query=$this->db->query("select sum(v.vamount) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate <="'.$to.'") and v.ledger_id='.$l_id.' and hide="yes" order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
      }

      $query=$this->db->query("select sum(v.lessadv) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.vtype='receipt' and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate>="'.$from.'" and v.cdate <="'.$to.'") and v.ledger_id='.$l_id.' and hide="yes" order by v.cdate');
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

      $query=$this->db->query("select sum(v.lessadv) as amount from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.vtype='receipt' and v.company_id=" . get_cookie("ae_company_id").' and (v.cdate <"'.$from.'") and v.ledger_id='.$l_id.' order by v.cdate');
      $res1 = $query->result();
      foreach($res1 as $row1)
      {
          $opb = bcadd($opb,($row1->amount)*-1);
          $opb = bcadd($opb,($row1->amount)*-1);
      }

              if($opb>0){
              $bill_amt=$bill_amt+$opb;
              }else{
              $bill_amt=$bill_amt-$opb;
              }
            if($opb<>0){
              echo '<tr class="">';
              echo '    <td class="tb_col">' . date('d-m-y',strtotime($from1)) . '</td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col">OpBal</td>';
              echo '    <td class="tb_col"> '.$opbalancermk.'</td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col"> </td>';
              echo '    <td class="tb_col"> </td>';
               echo '    <td class="tb_col">' . number_format($bill_amt,2) . '</td>';
              if($opb>0){
               echo '    <td class="tb_col dr right">' . number_format($opb,2) . '</td>';
               echo '    <td class="tb_col cr right">&nbsp;</td>'; // addtional
               echo '    <td class="tb_col cr right">&nbsp;</td>'; // addtional
               // echo '    <td class="cr right">&nbsp;</td>'; // addtional
               $dr=bcadd($dr,$opb,2);
              }else{
               echo '    <td class="tb_col dr right">&nbsp;</td>';
               echo '    <td class="tb_col cr right">&nbsp</td>'; // addtional
               echo '    <td class="tb_col cr right">' . number_format(bcmul($opb,-1,2),2) . '</td>';
               // echo '    <td class="cr right">&nbsp</td>'; // addtional
               $cr=bcadd($cr,bcmul($opb,-1,2),2);
              }
              $bill_amt=$dr-$cr;
              echo '</tr>';
            }

      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,v.lr_freight,l.name ledgername,v.remark,v.lessadv,v.lr_no,v.transport from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.ledger_id='.$l_id.' and v.hide="no" order by v.cdate,v.id');
      $result=$query->result();


      if($query->num_rows()>0)
      {

          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                $dt = $row->cdate;
                $showdt=date('d-m-y',strtotime($row->cdate));
                $amount = $row->amount*-1;
                if($amount==0)
                {
                  echo '<tr class="" style="background-color:#ffcccc;padding:0px;height:5px;">';
                }                
                else
                {
                  echo '<tr class="" style="background-color:#F2F2F2;padding:0px;height:5px;">';
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

                echo '    <td style="width:80px;" colspan="5">' . $showdt . '&nbsp;&nbsp; / &nbsp;&nbsp;' . $parti . "/".$row->builtyno . '&nbsp;&nbsp;&nbsp;&nbsp;';
                  echo "<span style='font-weight:bold;'>" . $row->remark . "</span>";
                 if($row->lr_no!='')
                {
                  echo "<span style='font-weight:bold;margin-left:20px;'>LR: " . $row->lr_no . " TR:" . $row->transport. "</span>";
                }  

                echo '</td>';

                echo '    <td class="tb_col">&nbsp;</td>';
                echo '    <td class="tb_col">&nbsp;</td>';
                
                $lr_freight_amount=$row->lr_freight;
                if($lr_freight_amount=="")
                {
                  $lr_freight_amount=0;
                }

                if($row->vtype=="sales" || $row->vtype=="purchase")
                {
                  $tlr_freight=$tlr_freight+$lr_freight_amount;
                  $bill_amt=$bill_amt+$lr_freight_amount;
                }
                if($row->vtype=="sales return" || $row->vtype=="purchase return")
                {
                  $bill_amt=$bill_amt+$lr_freight_amount;
                }
                $amount = $row->amount*-1;
                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $amount = ($row->amount+$row->lessadv)*-1;
                }

                if(strtoupper($row->vtype)=="RECEIPT")
                {
                  $bill_amt=$bill_amt+$amount;
                  $bill_amt=$bill_amt-$row->lessadv;
                }
                if(strtoupper($row->vtype)=="PAYMENT")
                {
                  $bill_amt=$bill_amt+$amount;
                }

                echo '    <td class="tb_col">' . $row->lr_freight.'</td>';
                echo '    <td class="tb_col">'.number_format($bill_amt,2).'</td>';

                if($amount>0){
                 echo '    <td class="tb_col dr right">' . number_format($amount,2) . '</td>';
                 echo '    <td class="tb_col cr right"></td>';
                 echo '    <td class="tb_col cr right">';
                  if(strtoupper($row->vtype)=="RECEIPT" && $row->lessadv!=0)
                  {
                   echo '   <br><span style="font-size:9px;">CD : </span>' . number_format($row->lessadv,2) . '';
                   $cr=bcadd($cr,$row->lessadv,2);
                  }
                 echo '</td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                  if($row->vtype=="sales return")
                  {
                   echo '    <td class="tb_col dr right"></td>';
                   echo '    <td class="tb_col cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   echo '    <td class="tb_col cr right"></td>';
                   $rg=bcadd($rg,bcmul($amount,-1,2),2);
                  }
                  else
                  {
                   echo '    <td class="tb_col dr right"></td>';
                   echo '    <td class="tb_col cr right"></td>';
                   echo '    <td class="tb_col cr right">' . number_format(bcmul($amount,-1,2),2) . '';
                    if(strtoupper($row->vtype)=="RECEIPT" && $row->lessadv!=0)
                    {
                     echo '   <br><span style="font-size:9px;">CD : </span>' . number_format($row->lessadv,2) . '';
                     $cr=bcadd($cr,$row->lessadv,2);
                    }
                   echo '</td>';
                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                  }
                }

                echo '</tr>';


                if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight="";
                   $discount="";
                   if($report_type=="Color Wise")
                   {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 0,1000");
                    }
                    else
                    {
                      $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i,m_master g where t2.itemcode=i.id and i.group_id=g.id and  t2.billno=".$row->id." order by t2.id limit 0,1000");
                    }
                    $result1=$query1->result();
                    if($query1->num_rows()>0)
                    {
                      foreach($result1 as $row1)
                      {
                         $party_name=$row1->itemname;
                         $qty=$row1->qtymt;
                         $rate=$row1->rate;
                         $freight=$row1->freight;
                         $discount="";
                         if($row->vtype=="sales" || $row->vtype=="purchase")
                         {
                             $tqty=$tqty+$qty;
                             $tfreight=$tfreight+$freight;
                         }
                         if($row->vtype=="sales return" || $row->vtype=="purchase return")
                         {
                             $trgqty=$trgqty+$qty;
//                             $tfreight=$tfreight-$freight;
                        }

                         if($row1->percent<>0)
                         {
                           $discount=$discount.$row1->percent."% ";
                         }
                         if($row1->discount<>0)
                         {
                            if($discount=="")
                            {
                               $discount=$discount.$row1->discount." ";
                            }
                            else {
                               $discount=$discount." + " .$row1->discount." ";
                            }
                         }

                        echo '<tr>';
                        echo '    <td class="tb_col" colspan="3" style="margin-left:30px;font-size:10px;">' . $party_name.'</td>';
                        echo '    <td class="tb_col">' . number_format($qty,0).'</td>';
                        echo '    <td class="tb_col">' . number_format($rate,2).'</td>';
                        echo '    <td class="tb_col">' . $discount.'</td>';
                        echo '    <td class="tb_col">' . $freight.'</td>';
                        if($row->vtype=="sales" || $row->vtype=="purchase")
                        {
                          $bill_amt=$bill_amt+$freight;
                        }
                        if($row->vtype=="sales return" || $row->vtype=="purchase return")
                        {
                          $bill_amt=$bill_amt-$freight;
                        }


                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">' . number_format($bill_amt,2).'</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '    <td class="tb_col">&nbsp;</td>';
                        echo '</tr>';

                      }
                    
                    }
                }

                $showdt='';
          }
          echo '</tbody>';
                        echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                        echo '<td  class="tb_col" style="font-weight:bold;color:#000000;" colspan="3">Total</td>';
                        echo '<td class="tb_col">'.$tqty.' / '.$trgqty.'</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col">'.number_format($tfreight,2).'</td>';
                        echo '<td class="tb_col">'.number_format($tlr_freight,2).'</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col right">'.$dr.'</td>';
                        echo '<td class="tb_col right">'.$rg.'</td>';
                        echo '<td class="tb_col right">'.$cr.'</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td  class="tb_col" style="font-weight:bold;color:#000000;" colspan="3">Balance</td>';
                        $bal=bcsub($dr,$cr,2);
                        $bal=bcsub($bal,$rg,2);
                        echo '<td class="tb_col">'.bcsub($tqty-$trgqty,0).'</td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col right"></td>';
                        echo '<td class="tb_col right"></td>';
                        echo '<td class="tb_col right"></td>';
                        echo '<td class="tb_col right"></td>';
                        if($bal>0){
                        echo '<td class="tb_col right"></td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        echo '<td class="tb_col right">'.$bal.' Dr</td>';
                        }else{
                        echo '<td class="tb_col right">'.bcmul($bal,-1,2).' Cr</td>';
                        echo '<td class="tb_col right"></td>';
                        echo '<td class="tb_col">&nbsp;</td>';
                        }
                        echo '</tr>';
          echo '</table>';
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