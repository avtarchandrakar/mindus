<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <style>
    body {
    text-align: justify;text-justify: inter-word;
    background:none;
}

@page { 
   @bottom-left { 
     content: "Department of Strategy"; 
   } 
   @bottom-right { 
     content: counter(page) " of " counter(pages); 
  }
}

@media print {
       body{
        background:none;
       }
}

@page { margin-left: 10px;margin-left: 10px;margin-top: 60px;margin-bottom: 50px; }
      body {  padding: 0.52em; }
      .header { position: fixed; top: -50px; left: 0px; right: 0px; padding: -0.5em; text-align: center; }
      .footer { position: fixed; bottom: -20px; left: 0px; right: 0px; padding: -0.5em; text-align: center; }
</style>

</head>
<body style="">

<table style="width:100%;">
<thead><tr><th>
  <header style="">
    <img src="<?php echo base_url();?>assets/images/header.jpg" style="height:auto;width: 100%;">
    <table border="0" style="width:98%;border-top:2px solid green;padding-bottom: 20px;font-family:poppins;margin-top: 2px;">
    <tr>
      <td >
      </td>
    </tr>
  </table>
  </header>
</th></tr></thead>
<tbody><tr><td>
<?php
      $usertype=get_cookie('ae_usertype');

      $query=$this->db->query('select t1.id,t1.cdate,t1.price,t1.kindattn,ledger_mobno,l.name lname,GROUP_CONCAT(CONCAT(t2.item_name," - (",round(t2.qtymt,0),")") order by t2.id SEPARATOR "<br>") as items from tbl_trans1 t1, m_ledger l,tbl_trans2 t2 where t1.ledger_id=l.id and t1.id=t2.billno  and t1.company_id='.get_cookie('ae_company_id').' and t1.vtype="'.$vtype.'" and (t1.cdate between "'.date('Y-m-d',strtotime($from)).'" and  "'.date('Y-m-d',strtotime($to)).'")  group by t1.cdate,t1.id,t1.builtyno,ledger_mobno,l.name order by t1.cdate,t1.id');

      $result=$query->result();

      if(count($result)>0)
      {
          echo '<br>';
          echo '<table class="table table-bordered table-hover" id="TblList">';
          echo '    <thead>';
          echo '        <tr>';
          echo '            <th style="width:10%;">Date</th>';
          echo '            <th>PartyName</th>';
          echo '            <th>Kind Attn</th>';
          echo '            <th>Price</th>';
          echo '            <th>Items</th>';
          echo '        </tr>';
          echo '    </thead>';
          echo '    <tbody>';
          $dr=0;
          $cr=0;
          $dt='';
          $showdt='';
          $total = 0;
          foreach($result as $row)
          {
                if($dt<>$row->cdate)
                {
                  $dt = $row->cdate;
                  $showdt=date('d-m-Y',strtotime($row->cdate));
                }
                echo '<tr class="">';
                echo '    <td>' . $showdt . '</td>';
                echo '    <td>' . $row->lname.'</td>';
                echo '    <td>' . $row->kindattn.'</td>';
                echo '    <td class="dr right">' . number_format($row->price,2) . '</td>';
                echo '    <td>' . $row->items.'</td>';
                echo '</tr>';
                $total+=$row->price;

          }
          echo '</tbody>';
            echo '<tfoot style="background:#CCD5DE;font-weight:bold;color:#000000;">';
            echo '<tr>';
            echo '<td colspan=2>&nbsp;</td>';
            echo '<td style="font-weight:bold;color:#000000;">Total</td>';
            echo '<td>'.number_format($total,2).'</td>';
            echo '<td colspan=1>&nbsp;</td>';
            echo '</tr>';
          echo '</tfoot>';
          echo '</table>';
      }


      ?>





</td></tr></tbody>
<tfoot><tr><td>
  <div style="padding-top:70px;padding-left:50px;padding-right:50px;">
    <img src="<?php echo base_url();?>assets/images/footer.jpg" style="height:auto;width: 88%;margin-bottom: 2px;margin-top: 5px;position: fixed;left: 0;bottom: 0;margin-top:50px;margin-left:50px;margin-right:50px;">
  </div>
</td></tr></tfoot>
</table>
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