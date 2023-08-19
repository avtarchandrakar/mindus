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
table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 3px; 
    }
    
    </style>   
</head>
<body>

    <? 
      $state= str_replace('%20', ' ', $state);
    echo '<table border="1"  style="width:100%;font-size:12px;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:1px; solid black">';
    echo '<center>';
    echo '<h3 style="font-size:15px">Ageing State Wise Report</h3>';
    echo '<p style="font-size:14px">State : '.$state.', Date : '.$to.'</p>';
    echo '</h4>';
    echo '</center>';
      $to=date('Y-m-d',strtotime($to));
      $d30=date('Y-m-d', strtotime($to.' -30 days'));
      $d60=date('Y-m-d', strtotime($to.' -60 days'));
      $d90=date('Y-m-d', strtotime($to.' -90 days'));
      $d120=date('Y-m-d', strtotime($to.' -120 days'));

      
      $query=$this->db->query("select m.id,m.name,m.opbalance,
                (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d30."' and v.cdate<='".$to."') and v.ledger_id=m.id) as d30,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d60."' and v.cdate<='".$d30."') and v.ledger_id=m.id) as d60,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d90."' and v.cdate<='".$d60."') and v.ledger_id=m.id) as d90,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate>'".$d120."' and v.cdate<='".$d90."') and v.ledger_id=m.id) as d120,
                (select sum(v.vamount) as amount from tbl_trans1 v  where  v.vamount<0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate<='".$d120."') and v.ledger_id=m.id) as dabove,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.vamount>0 and v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <'".$to."') and v.ledger_id=m.id) as receipt,
                (select sum(v.vamount) as amount from tbl_trans1 v  where v.company_id=" . get_cookie("ae_company_id") ." and (v.cdate <='".$to."') and v.ledger_id=m.id) as vamount
                from m_ledger m where m.state='$state' group by m.id,m.name order by m.name");
      $result=$query->result();

      if($query->num_rows()>0)
      {
          echo '<table style="width:100%;font-size:12px;" cellpadding="0" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;">0-30</th>';
          echo '            <th style="border:1px solid black;padding:5px;">31-60</th>';
          echo '            <th style="border:1px solid black;padding:5px;">61-90</th>';
          echo '            <th style="border:1px solid black;padding:5px;">91-120</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Above 120</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Closing Balance</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $clbalance_total=0;
          foreach($result as $row)
          {
              $d30=$row->d30*-1;
              $d60=$row->d60*-1;
              $d90=$row->d90*-1;
              $d120=$row->d120*-1;
              $dabove=$row->dabove*-1;
              $receipt=$row->receipt;

              if($d30>0)
              {
                if($d30>$receipt)
                {
                  $d30=$d30-$receipt;
                }
                else
                {
                  $d30=0;
                  $receipt=$receipt-$d30;
                }
              }
              if($d60>0)
              {
                if($d60>$receipt)
                {
                  $d60=$d60-$receipt;
                }
                else
                {
                  $d60=0;
                  $receipt=$receipt-$d60;
                }
              }
              if($d90>0)
              {
                if($d90>$receipt)
                {
                  $d90=$d90-$receipt;
                }
                else
                {
                  $d90=0;
                  $receipt=$receipt-$d90;
                }
              }
              if($d120>0)
              {
                if($d120>$receipt)
                {
                  $d120=$d120-$receipt;
                }
                else
                {
                  $d120=0;
                  $receipt=$receipt-$d120;
                }
              }
              if($dabove>0)
              {
                if($dabove>$receipt)
                {
                  $dabove=$dabove-$receipt;
                }
                else
                {
                  $dabove=0;
                  $receipt=$receipt-$dabove;
                }
              }


              $clbalance=0;
              $clbalance=$row->opbalance;
              $clbalance=bcadd($clbalance,($row->vamount)*-1,2);

              $clbalance_total=bcadd($clbalance_total,$clbalance,2);

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . ($row->vamount).'</td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d30.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d60.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d90.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$d120.' </td>';
                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$dabove.'  </td>';

                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance.' </td>';
                echo '</tr>';

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL :</td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';
                echo '    <td style="border:1px solid black;padding:5px;"> </td>';

                echo '    <td style="border:1px solid black;padding:5px;" class="right">'.$clbalance_total.' </td>';
            
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