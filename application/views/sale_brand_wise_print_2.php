<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
    @media screen and projection {
        a {
            display:inline;
        }
    }

    
    </style>   
</head>
<body>

    <? 

    echo '<table  style="width:100%;font-size:12px;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:1px; solid black">';
    echo '<center>';
    echo '<h3 style="font-size:15px">Sales Brand Wise</h3>';
    echo '<p style="font-size:14px">Date : '.$from.' To '.$to.'</p>';
    echo '</h4>';
    echo '</center>';
      $from=date('Y-m-d',strtotime($from));
      $to=date('Y-m-d',strtotime($to));
      $ledger_id=$ledger_id;
      if($ledger_id==0)
      {
        $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as saleretamt ,
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as lessamtret, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.group_id=m.id) as cdamtret 
                  from m_master m,m_item i,m_master mc where i.group_id=m.id and i.itemcompany_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")."   group by m.id,m.name,mc.name order by mc.name,m.name");


      }
      else
      {
        $query=$this->db->query("select m.id,m.name,mc.name as mastercategory,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as saleretamt, 
                  (select sum(t2.discount) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as lessamtret, 
                  (select sum((t2.qtymt*t2.rate)*percent/100) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.group_id=m.id) as cdamtret 
                  from m_master m,m_item i,m_master mc where i.group_id=m.id and i.itemcompany_id=mc.id and m.type='ITEM GROUP'  and m.company_id=" . get_cookie("ae_company_id")." and i.company_id=" . get_cookie("ae_company_id")."   group by m.id,m.name,mc.name order by mc.name,m.name");
      }
      $result=$query->result();

      if($query->num_rows()>0)
      {
          echo '<table  style="border:1px solid black; width:100%; font-size:10px" cellspacing="0" cellpadding="2">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Group</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Avg.Rate</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Less Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">CD Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Nett Amount</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $t_sale_qty=0;
          $t_sale_amount=0;
          $t_sale_ret_qty=0;
          $t_sale_ret_amount=0;
          $t_net_qty=0;
          $t_net_amount=0;
          $t_lessamt=0;
          $t_cdamt=0;
          $t_lessamtret=0;
          $t_cdamtret=0;

          $g_sale_qty=0;
          $g_sale_amount=0;
          $g_sale_ret_qty=0;
          $g_sale_ret_amount=0;
          $g_net_qty=0;
          $g_net_amount=0;
          $g_lessamt=0;
          $g_cdamt=0;
          $g_lessamtret=0;
          $g_cdamtret=0;

          $mastercategory="";
          foreach($result as $row)
          {
              $avg_rate=0;
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = 0;
              $sale_amount = 0;
              $sale_ret_qty = number_format($row->saleretqty,0,'.','');
              $sale_ret_amount = number_format($row->saleretamt,2,'.','');
              $lessamt=0;
              $cdamt=0;
              $lessamtret=number_format($row->lessamtret,2,'.','');
              $cdamtret=number_format($row->cdamtret,2,'.','');

              $net_qty = number_format($sale_qty-$sale_ret_qty,0,'.','');
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);


              if($mastercategory<>$row->mastercategory && $net_qty!=0)
              {
                if($mastercategory<>"")
                {
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_net_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . number_format($g_net_amount,2) . '</td>';
                  echo '</tr>';
                  $g_sale_qty=0;
                  $g_sale_amount=0;
                  $g_sale_ret_qty=0;
                  $g_sale_ret_amount=0;
                  $g_net_qty=0;
                  $g_net_amount=0;
                  $g_lessamt=0;
                  $g_cdamt=0;
                  $g_lessamtret=0;
                  $g_cdamtret=0;

                }
                $mastercategory=$row->mastercategory;
                echo '<tr class="" style="font-weight:bold;background-color:#ffcccc;">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $mastercategory . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '</tr>';
              }



              if($sale_qty!=0)
              {
                $avg_rate=number_format(($row->saleamt+$row->lessamt+$row->cdamt)/$sale_qty,2);
              }
              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              $t_lessamt=$t_lessamt+$lessamt;
              $t_lessamtret=$t_lessamtret+$lessamtret;
              $t_cdamt=$t_cdamt+$cdamt;
              $t_cdamtret=$t_cdamtret+$cdamtret;



              $g_sale_qty=$g_sale_qty+$sale_qty;
              $g_sale_amount=$g_sale_amount+$sale_amount;
              $g_sale_ret_qty=$g_sale_ret_qty+$sale_ret_qty;
              $g_sale_ret_amount=$g_sale_ret_amount+$sale_ret_amount;
              $g_net_qty=$g_net_qty+$net_qty;
              $g_net_amount=$g_net_amount+($sale_amount-$sale_ret_amount);

              $g_lessamt=$g_lessamt+$lessamt;
              $g_lessamtret=$g_lessamtret+$lessamtret;
              $g_cdamt=$g_cdamt+$cdamt;
              $g_cdamtret=$g_cdamtret+$cdamtret;

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $avg_rate . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
                  echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                      echo '    <td style="border:1px solid black;padding:5px;">TOTAL OF '.$mastercategory.'</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_sale_ret_amount . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_lessamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_cdamtret . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . $g_net_qty . '</td>';
                      echo '    <td style="border:1px solid black;padding:5px;">' . number_format($g_net_amount,2) . '</td>';
                  echo '</tr>';
            echo '<tr style="background:#CCD5DE;font-weight:bold;color:#000000;">';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">&nbsp;</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_lessamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_cdamtret . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
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