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
    echo '<h3 style="font-size:15px">Sales Category Wise</h3>';
    echo '<p style="font-size:14px">Date : '.$from.' To '.$to.'</p>';
    echo '</h4>';
    echo '</center>';
      $from=date('Y-m-d',strtotime($from));
      $to=date('Y-m-d',strtotime($to));
      $ledger_id=$ledger_id;
      //echo $ledger_id;die;
      $master_category_id=0;
      $srch="";
      if($master_category_id!=0)
      {
        $srch = " and m.parent_id=".$master_category_id;
      }
      if($ledger_id==0)
      {
        $query=$this->db->query("select m.id,m.name,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where t1.hide='no' and t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m.id) as saleamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and i.category_id=m.id) as saleretamt 
                  from m_master m where m.type='ITEM CATEGORY' ".$srch."  group by m.id,m.name order by m.name");
      }
      else
      {
        $query=$this->db->query("select m.id,m.name,
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where t1.hide='no' and t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleamt, 
                  (select sum(t2.qtymt) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleretqty, 
                  (select sum(t2.freight) from tbl_trans1 t1, tbl_trans2 t2,m_item i where  t1.hide='no' and  t1.vtype='sales return' and t1.id=t2.billno and t2.itemcode=i.id and (t1.cdate>='$from' and t1.cdate<='$to') and t1.ledger_id=".$ledger_id." and i.category_id=m.id) as saleretamt 
                  from m_master m where m.type='ITEM CATEGORY' ".$srch." group by m.id,m.name order by m.name");
      }
      $result=$query->result();

      if($query->num_rows()>0)
      {
        if($master_category_id!=0)
        {
            echo '
      <button class="btn btn-primary" onClick ="GetRpt();">
            Back
          </button>';
            echo '<br>';
        }
          echo '<table  style="width:100%;font-size:12px;" cellpadding="0" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">Category</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Sale Amount</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Qty.</th>';
          echo '            <th style="border:1px solid black;padding:5px;">RG Amount</th>';
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
          foreach($result as $row)
          {
              $sale_qty=0;
              $sale_amount=0;
              $sale_ret_qty=0;
              $sale_ret_amount=0;
              $net_qty=0;
              $net_amount=0;
              $sale_qty = $row->saleqty;
              $sale_amount = $row->saleamt;
              $sale_ret_qty = $row->saleretqty;
              $sale_ret_amount = $row->saleretamt;

              $net_qty = $sale_qty-$sale_ret_qty;
              $net_amount = number_format($sale_amount-$sale_ret_amount,2);

              $t_sale_qty=$t_sale_qty+$sale_qty;
              $t_sale_amount=$t_sale_amount+$sale_amount;
              $t_sale_ret_qty=$t_sale_ret_qty+$sale_ret_qty;
              $t_sale_ret_amount=$t_sale_ret_amount+$sale_ret_amount;
              $t_net_qty=$t_net_qty+$net_qty;
              $t_net_amount=$t_net_amount+($sale_amount-$sale_ret_amount);

              if($net_qty!=0)
              {
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">' . $row->name . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $net_amount . '</td>';
                echo '</tr>';
              }

                $showdt='';
          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
                echo '    <td style="border:1px solid black;padding:5px;">TOTAL</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_sale_ret_amount . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . $t_net_qty . '</td>';
                echo '    <td style="border:1px solid black;padding:5px;">' . number_format($t_net_amount,2) . '</td>';
            
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