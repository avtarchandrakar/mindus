<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
    @media screen and projection {
        a {
            display:inline;
        }
    }

    font{
        margin-left:12px; 
        font-weight: bold;
        font-size: 8px;
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
    </style>   
</head>
<body>

    <? 

    echo '<table border="0" style="width:100%;font-size:8px;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:0px; solid black">';
    echo '<center>';
    echo '<h3>Daily Report</h3>';
    echo 'From : '.$from.' To : '.$to .'';
    echo '</h4>';
    echo '</center>';
      $from=date('Y-m-d',strtotime($from));
      $to=date('Y-m-d',strtotime($to));

      $query=$this->db->query("select v.id,v.builtyno,v.edate,v.vtype,v.vamount as amount,l.name ledgername,v.remark,v.lr_freight,v.lr_no,v.transport from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.edate between "'.$from.'" and "'.$to.'") and v.hide="no" order by v.edate,v.vtype,v.id');
      $result=$query->result();


      if($query->num_rows()>0)
      {
          echo '<table style="width:100%;font-size:10px;" border=0 cellspacing="0" cellpadding="2" >';
          echo '    <thead>';
          echo '        <tr>';
        echo '            <th style="width:10%;">Date</th>';
        echo '            <th>Particulars</th>';
        echo '            <th>Qty</th>';
        echo '            <th>Rate</th>';
        echo '            <th>Disc.</th>';
        echo '            <th>Amount</th>';
        echo '            <th>Freight</th>';
        echo '            <th style="width:10%;" class="right">Debit</th>';
        echo '            <th style="width:10%;" class="right">RG</th>';
        echo '            <th style="width:10%;" class="right">Credit</th>';
//          echo '            <th   style="width:130px">Action</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $rg=0;
          $showdt='';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          $tqty=0;
          $tlr_freight=0;
          foreach($result as $row)
          {
                $dt = $row->edate;
                $showdt=date('d-m-Y',strtotime($row->edate));
                if($row->amount==0){
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }
                else
                {
                  echo '<tr class="">';
                }
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
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
                echo '    <td>' . $showdt . '<br>'. $parti . '</td>';
                echo '    <td>' . '' . $row->ledgername . '<br>' . $row->builtyno;
                 if($row->remark!='')
                {
                  echo "<br><span style='font-size:8px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }  
                 if($row->lr_no!='')
                {
                  echo "<br><span style='font-size:8px; font-weight:bold;margin-left:20px;'>LR: " . $row->lr_no . " TR:" . $row->transport. "</span>";
                }  
                echo '</td>';

                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                  echo '    <td>&nbsp;</td>';
                
                $amount = $row->amount*-1;

                 echo '    <td class="right">' . number_format($row->lr_freight,2) . '</td>';
                 $tlr_freight=$tlr_freight+$row->lr_freight;

                if($amount>0){
                 echo '    <td class="dr right">' . number_format($amount,2) . '</td>';
                 echo '    <td class="cr right"></td>';
                 echo '    <td class="cr right"></td>';
                 $dr=bcadd($dr,$amount,2);
                }else{
                  if($row->vtype=="sales return")
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   echo '    <td class="cr right"></td>';
                   $rg=bcadd($rg,bcmul($amount,-1,2),2);
                  }
                  else
                  {
                   echo '    <td class="dr right"></td>';
                   echo '    <td class="cr right"></td>';
                   echo '    <td class="cr right">' . number_format(bcmul($amount,-1,2),2) . '</td>';
                   $cr=bcadd($cr,bcmul($amount,-1,2),2);
                  }
                }
                echo '</tr>';


                if($row->vtype=="sales" || $row->vtype=="purchase"  || $row->vtype=="sales return")
                {
                   $party_name="";
                   $qty=0;
                   $rate=0;
                   $freight=0;
                   $discount=0;
                    $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname,t2.discount,t2.percent,t2.freight from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id." order by t2.id limit 0,1000");
                    $result1=$query1->result();
                    if($query->num_rows()>0)
                    {
                      foreach($result1 as $row1)
                      {
                         $party_name=$row1->itemname;
                         $qty=$row1->qtymt;
                         $rate=$row1->rate;
                         $freight=$row1->freight;
                         $discount="";
                         $tqty=$tqty+$qty;
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
                        echo '    <td>&nbsp;</td>';
                        echo '    <td style="padding-left:40px;">' . $party_name.'</td>';
                        echo '    <td>' . number_format($qty,0).'</td>';
                        echo '    <td>' . number_format($rate,2).'</td>';
                        echo '    <td>' . $discount.'</td>';
                        echo '    <td>' . $freight.'</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '    <td>&nbsp;</td>';
                        echo '</tr>';

                      }
                    
                    }
                }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<td>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td>'.$tqty.'</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td class="right">'.number_format($tlr_freight,2).'</td>';
            echo '<td class="right">'.$dr.'</td>';
            echo '<td class="right">'.$rg.'</td>';
            echo '<td class="right">'.$cr.'</td>';
            echo '</tr>';
          echo '</table>';
      }

    echo '</td>';
    echo '  </tr>';
    echo '</table>';

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