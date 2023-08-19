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
      $state_id= str_replace('%20', ' ', $state);
    echo '<table border="1"  style="width:100%;font-size:12px;" cellpadding="0" cellspacing="0">';
    echo '  <tr>';
    echo '    <td style="border:1px; solid black">';
    echo '<center>';
    echo '<h3 style="font-size:15px">Party</h3>';
    echo '<p style="font-size:14px">State : '.$state_id.'</p>';
    echo '</h4>';
    echo '</center>';
      $state_array = array();
          $state_array_id = array();
          $state_rate=array();
        $query=$this->db->query('select m.id,m.name from m_master m where m.prefix="YES" and m.company_id='.get_cookie('ae_company_id').' and m.type="Master Category"  group by m.name,m.id order by m.name'); 
      if($query->num_rows()>0){
       foreach($query->result() as $row){
        $state_array[] = $row->name;
        $state_array_id[] = $row->id;
        $state_rate[] = 0;
       }
      }

      $query=$this->db->query("select m.id,m.name from m_ledger m where  m.company_id=".get_cookie('ae_company_id')." and m.state='$state_id'   group by m.id,m.name order by m.name");
        $result=$query->result();
        if($query->num_rows()>0)
        {
          echo'<center>';
            echo '<table style="width:50%;font-size:13px;" border=1 cellspacing="0" cellpadding="5">';
            echo '    <thead>';
            echo '        <tr>';
            echo '            <th style="width:200px;">Name</th>';
            foreach($state_array as $item)
            {
              echo '<th style="width:50px;text-align:center; ">'.$item.'</td>';
            }
            echo '        </tr>';
            echo '    </thead>';
            echo '    <tbody>';

            foreach($result as $row)
            {
                  echo '<tr class="">';
                  echo '    <td>' . $row->name . '</td>';
                  $i=0;
              foreach($state_rate as $item)
              {
                $rate=0;
            $query_rate=$this->db->query("select percent from m_party_discount where item_id=".$state_array_id[$i]." and party_id=".$row->id . "");
              $result_rate=$query_rate->result();
              if($query_rate->num_rows()>0)
              {
                  foreach($result_rate as $row_rate)
                  {
                    $rate=$row_rate->percent;
                  }

            }
                    echo '    <td>';
                    echo $rate;
                    echo '    </td>';
                    $i++;
              }
                  echo '</tr>';
            }
      }
  

    echo '</td>';
    echo '  </tr>';
    echo '</table>';
    echo'</center>';


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