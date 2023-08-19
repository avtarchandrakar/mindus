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
      $line_name=$line_id;
      // $query=$this->db->query("select m.name from m_master m where m.id=".$line_id);
      // $result=$query->result();
      // if($query->num_rows()>0)
      // {
      //     foreach($result as $row)
      //     {
      //       $line_name=$row->name;
      //     }
      //   }


      $line_name= str_replace('%20', ' ', $line_name);
      echo date('d-m-Y')."<br>";
    echo '<table border="0"  style="width:100%;font-size:10px;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:1px; solid black">';
    echo '<center>';
    echo '<h3 style="font-size:13px">Salesman Summary Report</h3>';
    echo '<p style="font-size:12px">Salesman : '.$line_name.', Date : '.$to.'</p>';
    echo '</h4>';
    echo '</center>';

      $to=date('Y-m-d',strtotime($to));

      
        $query=$this->db->query("select m.id,m.name,m.opbalance,m.mobilenosms,m.climit,
                  (select sum(v.vamount) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$to."') and v.ledger_id=m.id) as balance,
                  (select sum(v.lessadv) as amount from tbl_trans1 v  where  v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$to."') and v.ledger_id=m.id) as lessadv
                  from m_ledger m where  m.salesman='".$line_id."' group by m.id,m.name,m.mobilenosms order by m.name");
      $result=$query->result();

      if($query->num_rows()>0)
      {
          echo '<table style="width:100%;font-size:10px;" cellpadding="0" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;width:40%;">Party Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;width:10%;"> </th>';
          echo '            <th style="border:1px solid black;padding:5px;width:10%;">Mobile No.</th>';
          echo '            <th style="border:1px solid black;padding:5px;width:12%;">Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;width:12%;">Less</th>';
          echo '            <th style="border:1px solid black;padding:5px;width:12%;">Received</th>';
          echo '            <th style="border:1px solid black;padding:5px;width:12%;">Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $clbalance_total=0;
          foreach($result as $row)
          {
              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->balance)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);
              $clbalance=bcadd($clbalance,($row->lessadv)*-1,2);

              $clbalance_total=bcadd($clbalance_total,$clbalance,2);

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name .'</td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$row->climit.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$row->mobilenosms.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">  </td>';
                echo '</tr>';

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL :</td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance_total.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
            
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