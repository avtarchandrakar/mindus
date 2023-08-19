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
     $search_by=$search_by;
    echo '<table  style="width:100%;font-size:12px;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:1px; solid black">';
    echo '<center>';
    echo '<h3 style="font-size:15px">Pending Report '.$search_by.' Wise</h3>';
    
  
   

      if($search_by=='Party')
      {      
          
          echo '<br>';
          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">S.no.</th>';      
          echo '            <th style="border:1px solid black;padding:5px;">Party Name</th>';  
          echo '            <th style="border:1px solid black;padding:5px;">Item Name</th>';
          // echo '            <th style="border:1px solid black;padding:5px;">Order Qty</th>';
          // echo '            <th style="border:1px solid black;padding:5px;">Dispatch</th>';   
          echo '            <th style="border:1px solid black;padding:5px;">Balance Qty</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          $totat_order_qty=0;
          $order_qty=0;
          $bal_qty=0;
          $itemname='';
          $query=$this->db->query('select b.bal,i.name as itemname, i.id as itemcode, m.name as party_name,m.id as ledger_id from tbl_order_bal b, m_item i, m_ledger m where  b.item_id=i.id  and b.company_id='. get_cookie('ae_company_id') .' and  b.ledger_id=m.id order by m.name'); 
          $j=1;
          foreach($query->result() as $row)
          {                

                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">'.$j++.'</td>';
                echo '    <td style="border:1px solid black;padding:5px;">'.$row->party_name.'</td>';      
                echo '    <td style="border:1px solid black;padding:5px;">'.$row->itemname.'</td>';
                echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($row->bal,2,'.','').'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
      }
      if($search_by=='Item')
      {      
          
          echo '<br>';
          echo '<table id="TblList" style="border:1px solid black;" cellspacing="0">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="border:1px solid black;padding:5px;">S.no.</th>';      
          echo '            <th style="border:1px solid black;padding:5px;">Item Name</th>';
          echo '            <th style="border:1px solid black;padding:5px;">Balance Qty</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';

          $totat_order_qty=0;
          $order_qty=0;
          $bal_qty=0;
          $itemname='';
          $query=$this->db->query('select sum(b.bal) bal,i.name as itemname from tbl_order_bal b, m_item i where b.item_id=i.id  and b.company_id='. get_cookie('ae_company_id').' group by b.item_id order by i.name ');
          $j=1;
          foreach($query->result() as $row)
          {           
                echo '<tr class="">';
                echo '    <td style="border:1px solid black;padding:5px;">'.$j++.'</td>';
                echo '    <td style="border:1px solid black;padding:5px;">'.$row->itemname.'</td>';   
                echo ' <td style="border:1px solid black;padding:5px;text-align:right;">'  . number_format($row->bal,2,'.','').'</td>';
                echo '</tr>';
          }
          echo '</tbody>';
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