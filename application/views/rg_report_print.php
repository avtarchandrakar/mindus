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
        font-size: 12px;
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

    echo '<table border="1" style="width:100%;font-size:10px;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:1px; solid black">';
    echo '<center>';
    echo '<h3 style="font-size:15px">Day Report</h3>';
    echo '<p style="font-size:14px">Date : '.$from.' To '.$to.'</p>';
    echo '</h4>';
    echo '</center>';
      $from=date('Y-m-d',strtotime($from));
      $to=date('Y-m-d',strtotime($to));
      
      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.vamount as amount,l.name ledgername,v.remark from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate between "'.$from.'" and "'.$to.'") and v.hide="no" and v.vtype="sales return" order by v.cdate');
      $result=$query->result();


      if($query->num_rows()>0)
      {
          echo '<table style="width:100%;font-size:13px;" border=1 cellspacing="0" cellpadding="5" >';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>Particulars</th>';
          echo '            <th>Type</th>';
          echo '            <th style="width:10%;" class="right">Debit</th>';
          echo '            <th style="width:10%;" class="right">Credit</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
           $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                if($row->amount==0){
                  echo '<tr class="" style="background-color:#ffcccc;">';
                }
                else
                {
                  echo '<tr class="">';
                }
                echo '    <td>' . $showdt . '</td>';
                $parti="";
                if($row->vtype=="sales")
                {
                  $parti="Sales";
                }
                if($row->vtype=="sales return")
                {
                  $parti="Sales Return";
                }
                if($row->vtype=="RECEIPT")
                {
                  $parti="Receipt";
                }
                if($row->vtype=="purchase")
                {
                  $parti="Purchase";
                }
                if($row->vtype=="payment")
                {
                  $parti="Payment";
                }
                echo '    <td>' . $row->ledgername;
                if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }
                if($row->vtype=="sales")
                {
                  $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id."");
                  $result1=$query1->result();
                  foreach($result1 as $row1)
                  {
                      echo "<br><div style='margin-left:30px;width:200px;display:inline;float:left;'>".$row1->itemname."</div>";
                      echo "<div style='margin-left:30px;width:100px;display:inline;float:left;'>".number_format($row1->qtymt,0)." @ ".number_format($row1->rate,2)."</div>";
                  }
                }
                if($row->vtype=="sales return")
                {
                  $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id."");
                  $result1=$query1->result();
                  foreach($result1 as $row1)
                  {
                      echo "<br><div style='margin-left:30px;width:200px;display:inline;float:left;'>".$row1->itemname."</div>";
                      echo "<div style='margin-left:30px;width:100px;display:inline;float:left;'>".number_format($row1->qtymt,0)." @ ".number_format($row1->rate,2)."</div>";
                  }
                }
                if($row->vtype=="purchase")
                {
                  $query1=$this->db->query("select t2.qtymt,t2.rate,i.name as itemname from tbl_trans2 t2, m_item i where t2.itemcode=i.id and t2.billno=".$row->id."");
                  $result1=$query1->result();
                  foreach($result1 as $row1)
                  {
                      echo "<br><div style='margin-left:30px;width:200px;display:inline;float:left;'>".$row1->itemname."</div>";
                      echo "<div style='margin-left:30px;width:100px;display:inline;float:left;'>".number_format($row1->qtymt,0)." @ ".number_format($row1->rate,2)."</div>";
                  }
                }
                echo '</td>';
                echo '    <td>' . $parti . '</td>'; 
                if($row->amount>0){
                 echo '    <td class="dr right">' . number_format($row->amount,2) . '</td>';
                 echo '    <td class="cr right"></td>';
                 $dr=bcadd($dr,$row->amount,2);
                }else{
                 echo '    <td class="dr right"></td>';
                 echo '    <td class="cr right">' . number_format(bcmul($row->amount,-1,2),2) . '</td>';
                 $cr=bcadd($cr,bcmul($row->amount,-1,2),2);
                }
                
                echo '</tr>';

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=2>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td class="right">'.$dr.'</td>';
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