<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <style>
    /*@page { size: A5 }*/
    body {
    /* A5 dimensions */
    /*height: 210mm;
    width: 148.5mm;

    margin: 0;*/
}
</style>

</head>
<body style="padding-left:50px;padding-right:50px;padding-bottom:50px;">
    <?php 
      $query=$this->db->query('select t3.* from tbl_trans3 t3 left join tbl_trans1 t1 on t1.id=t3.q_number where t3.company_id='.get_cookie('ae_company_id').' and t3.id='.$id);
      $partyname="";
      $cdate="";
      $cpoapp_no='';
      $delevery_preiod='';
      $fullpath="";
      $remark="";



      foreach($query->result() as $row)
      {
        $partyname=$row->lname;
        $cdate=$row->cdate;
        $cpoapp_no=$row->cpoapp_no;
        $delevery_preiod=$row->delevery_preiod;
        $fullpath=$row->fullpath;
        $remark=$row->remark;
      }
    ?>
<table style="width:100%;">
<thead><tr><th>
  <header style="margin-top:50px;">
    <img src="<?php echo base_url();?>assets/images/header.jpg" style="height:auto;width: 100%;">
    <table border="0" style="width:98%;border-top:2px solid green;padding-bottom: 20px;font-family:poppins;margin-top: 2px;">
    <tr>
      <td>
      </td>
    </tr>
  </table>
  </header>
</th></tr></thead>
<tbody><tr><td>
  <div style="">
     <table border="0" style="width:100%;font-family:verdana">
          <tr>
            <td style="border:0px;">
              <table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="width:33%;text-align:left;font-size:13px;">
                    &nbsp;
                  </td>
                  <td style="width:33%;text-align:center;font-size:15px;font-weight:bold;">
                    Customer Purchase Order
                  </td>
                  <td style="width:33%;text-align:right;font-size:13px;">
                    &nbsp;
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
  </div>
  <table border="1" style="width:100%;border: 1px solid;" cellpadding="0" cellspacing="0" >
    <tr>
      <td style="border:1px; solid black">
        <table border="0" style="width:100%;font-family:verdana">
          <tr>
            <td style="width:100%;" >
              <table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="width:50%;text-align:left;font-size:13px;">
                    Date : <? echo date('d-m-Y',strtotime($cdate));?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    CPO No : <?php $cpoapp_no;?>
                  </td>
                </tr>
                <tr>
                  <td style="width:50%;text-align:left;font-size:13px;">
                    Party Name : <? echo $partyname;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    Delivery Period : <? echo $partyname;?>
                  </td>
                </tr>
                <tr>
                  <td style="width:50%;text-align:left;font-size:13px;">
                    Remark : <? echo $remark;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    <?php if ($fullpath!='') {  ?>
                    <a href="<? echo $fullpath;?>">View</a>
                    <?php } ?>
                  </td>
                </tr>
              </table>
              <br>
            </td>
          </tr>
        </table>  
      </td>
    </tr>
  </table>
  </td></tr></tbody>
<tfoot><tr><td>
  <div style="padding-top:70px;padding-left:50px;padding-right:50px;">
    <img src="<?php echo base_url();?>assets/images/footer.jpg" style="height:auto;width: 88%;margin-bottom: 20px;margin-top: 5px;position: fixed;left: 0;bottom: 0;margin-top:50px;margin-left:50px;margin-right:50px;">
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