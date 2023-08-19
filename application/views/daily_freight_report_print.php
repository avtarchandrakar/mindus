<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
    font{
        margin-left:12px; 
        font-weight: bold;
        font-size: 14px;
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

    echo '<table border="1" style="width:100%;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:1px; solid black">';
    echo '<center>';
    echo '<h3>Daily Freight  Report</h3>';
    echo 'Date : '.$from.'';
    echo '</h4>';
    echo '</center>';
      $from=date('Y-m-d',strtotime($from));
      

      $query=$this->db->query("select v.id,v.builtyno,v.cdate,v.vtype,v.ledger_mobno as vehicle,l.name ledgername, v.transport,v.lr_freight,v.remark,v.lr_no from tbl_trans1 v inner join m_ledger l on v.ledger_id=l.id where v.company_id=" . get_cookie("ae_company_id").' and (v.cdate="'.$from.'") and v.billstatus="pending" order by v.cdate');
      $result=$query->result();


      if($query->num_rows()>0)
      {
          echo '<table style="width:100%;font-size:16px;" border=1 cellspacing="0" cellpadding="5" >';
           echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>Party Name</th>';
          echo '            <th>Vehicle No</th>';
          echo '            <th>LR No</th>';
          echo '            <th style="width:10%;">Transporter</th>';
          echo '            <th style="width:10%;" class="right">Freight</th>';
          
          
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $total_freight='0';
          $dt='';
          $showdt='';
          foreach($result as $row)
          {
              $total_freight=$total_freight+$row->lr_freight;
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                
                echo '    <td>' . $row->ledgername;
                if($row->remark!='')
                {
                  echo "<br><span style='font-size:10px; font-weight:bold;margin-left:20px;'>" . $row->remark . "</span>";
                }
                
                echo '</td>';
                echo '    <td>' . $row->vehicle . '</td>'; 
                echo '    <td>' . $row->lr_no . '</td>'; 
                echo '    <td>' . $row->transport . '</td>'; 
                echo '    <td style="text-align:right">' . $row->lr_freight . '</td>'; 
                echo '</tr>';

                $showdt='';
          }
         echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan="5" style="font-weight:bold;color:#000000; text-align:right;">Total</td>';
            echo '<td class="right">'.number_format($total_freight,2).'</td>';
            
            echo '</tr>';
          echo '</tfoot>';
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