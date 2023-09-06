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
      $query=$this->db->query('select t.cdate,t.quatation_no,l.name as lname,t.ledger_mobno,t.jobcard,t.id,t.tol_freight,t.builtyno,t.purchase_no,t.loading_person_name,t.remark,t.lr_freight,t.paid_build,t.checked_by,t.dispatch_through,t.ref_details,t.sub_details,t.pakking_forwerding,t.delivery_period,t.payment_terms,t.warranty_guarantee,t.ld_clause,t.designation,t.file_path,t.prepared_name from tbl_trans1 t inner join m_ledger l on t.ledger_id=l.id  where t.company_id='.get_cookie('ae_company_id').' and t.id='.$id);
      $partyname="";
      $cdate="";
      $tol_freight=0;
      $builtyno=0;
      $loading_person_name="";
      $remark="";
      $ledger_mobno="";
      $ref_details="";
      $sub_details="";
      $pakking_forwerding="";
      $delivery_period="";
      $payment_terms="";
      $warranty_guarantee="";
      $ld_clause="";
      $jobcard='';
      $lr_freight=0;
      $checked_by='';
      $dispatch_through='';
      $paid_build='';
      $purchase_no='';
      $file_path='';
      $designation='';
      $prepared_name='';
      $quatation_no='';


      foreach($query->result() as $row)
      {
        $partyname=$row->lname;
        $cdate=$row->cdate;
        $tol_freight=$row->tol_freight;
        $builtyno=$row->builtyno;
        $loading_person_name=$row->loading_person_name;
        $remark=$row->remark;
        $ledger_mobno=$row->ledger_mobno;
        $pakking_forwerding=$row->pakking_forwerding;
        $ref_details=$row->ref_details;
        $sub_details=$row->sub_details;
        $pakking_forwerding=$row->pakking_forwerding;
        $delivery_period=$row->delivery_period;
        $payment_terms=$row->payment_terms;
        $warranty_guarantee=$row->warranty_guarantee;
        $ld_clause=$row->ld_clause;
        $lr_freight=$row->lr_freight;
        $checked_by=$row->checked_by;
        $dispatch_through=$row->dispatch_through;
        $paid_build=$row->paid_build;
        $jobcard=$row->jobcard;
        $purchase_no=$row->purchase_no;
        $file_path=$row->file_path;
        $designation=$row->designation;
        $prepared_name=$row->prepared_name;
        $quatation_no=$row->quatation_no;



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
                    Quotation
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
                    No. : <? echo $builtyno;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    Date : <? echo date('d-m-Y',strtotime($row->cdate));?>
                  </td>
                </tr>
                <tr>
                  <td style="width:50%;text-align:left;font-size:13px;">
                    Supplier Name : <? echo $partyname;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    Quotation : <? echo $quatation_no;?>
                  </td>
                </tr>
                <tr>
                  <td style="width:50%;text-align:left;font-size:13px;">
                    Ref: <? echo $ref_details;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    <!-- Purchase NO. : <? echo $purchase_no;?> -->
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:13px;">
                    Sub: <? echo $sub_details;?>
                  </td>
                </tr>
              </table>
              <br>
            </td>
          </tr>

          <tr>
            <td style="width:100%;">
              <table style="width:100%;" cellpadding="0" cellspacing="0">
                
                <tr>
                  <th style="border-top:1px solid black;border-bottom:1px solid black;width:5%;text-align:center;font-size:13px;">
                    Sr. No.
                  </th>
                  <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:25%;text-align:center;font-size:13px;">
                    Item
                  </th>
                  <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:50%;text-align:center;font-size:13px;">
                    Specification
                  </th>
                  <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:11%;text-align:center;font-size:13px;">
                    Quantity
                  </th>
                  <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:11%;text-align:center;font-size:13px;">
                    UOM
                  </th>
                  <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:17%;text-align:center;font-size:13px;">
                    Unit Rate (In Rs.)
                  </th>
                  <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:20%;text-align:center;font-size:13px;">
                    Total Amount (In Rs.)
                  </th>
                </tr>
                <? 
                  $query=$this->db->query('select t.item_name as item, t.qtymt,t.rate,t.freight,t.percent,t.discount,t.remark,t.unit from tbl_trans2 t where  t.billno='.$id  . ' order by t.id');
                  $totqty=0;
                  $totbox=0;
                  $i=0;
                  foreach($query->result() as $row)
                  {?>
                    <tr>
                      <td style="width:5%;text-align:left;font-size:13px;padding:5px;">
                        <? echo $i+1;?>
                      </td>
                      <td style="border-left:1px solid;width:25%;text-align:left;font-size:13px;padding:5px;">
                        <? echo $row->item;?>
                      </td>
                      <td style="border-left:1px solid;width:50%;text-align:left;font-size:13px;padding:5px;">
                        <? echo $row->remark;?>
                      </td>                      
                      <td style="border-left:1px solid;width:11%;text-align:center;font-size:13px;padding:5px;">
                        <? echo number_format($row->qtymt,0);?>
                        
                      </td>
                      <td style="border-left:1px solid;width:11%;text-align:center;font-size:13px;padding:5px;">
                        <? echo $row->unit;?>
                      </td>

                      <td style="border-left:1px solid;width:17%;text-align:center;font-size:13px;padding:5px;">
                        <? echo number_format($row->rate,2);?>
                      </td>
                      <td style="border-left:1px solid;width:20%;text-align:center;font-size:13px;padding:5px;">
                        <? echo number_format($row->freight,2);?>
                      </td>
                    </tr>
                <?$i++;
                  }
                  if($i<8)
                  {
                    for($c=0;$c<8-$i;$c++)
                    {?>
                      <tr>
                        <td style="width:5%;text-align:left;font-size:13px;padding:5px;">
                          &nbsp;
                        </td>
                        <td style="border-left:1px solid;width:25%;text-align:left;font-size:13px;padding:5px;">
                          &nbsp;
                        </td>
                        <td style="border-left:1px solid;width:50%;text-align:left;font-size:13px;padding:5px;">
                          &nbsp;
                        </td>
                        <td style="border-left:1px solid;width:11%;text-align:center;font-size:13px;padding:5px;"> &nbsp;
                      </td>
                      <td style="border-left:1px solid;width:11%;text-align:center;font-size:13px;padding:5px;">
                          &nbsp;
                        </td>
                      <td style="border-left:1px solid;width:17%;text-align:center;font-size:13px;padding:5px;">
                          &nbsp;
                        </td>
                      <td style="border-left:1px solid;width:20%;text-align:center;font-size:13px;padding:5px;">
                          &nbsp;
                        </td>
                      </tr>
                    <?}
                  }
                ?>
                

                <tr>
                  <td colspan="3" style="border-top:1px solid;width:5%;text-align:left;font-size:13px;padding:5px;">
                    <? echo $i ." Items ";?>
                  </td>
                  <td style="border-top:1px solid;width:11%;text-align:center;font-size:13px;padding:5px;">
                    <? echo number_format($totqty,0);?>
                    <?
                        // echo "/ ".$totbox;
                    ?>
                  </td>
                  <td style="border-top:1px solid;width:11%;text-align:center;font-size:13px;padding:5px;">
                    &nbsp;
                  </td>
                  <td style="border-top:1px solid;width:17%;text-align:center;font-size:13px;padding:5px;">
                    &nbsp;
                  </td>
                  <td style="border-top:1px solid;width:20%;text-align:center;font-size:13px;padding:5px;">
                    <? echo number_format($tol_freight,2);?>
                  </td>
                </tr>
                <tr>
                  <td colspan="7" style="border-top:1px solid;width:5%;text-align:left;padding:5px;font-size:13px;">
                    <span style="color: black;font-weight: bold;font-size: 14px;">Scope of Work for Contractor </span>  : <? echo $pakking_forwerding;?><br>
                    <span style="color: black;font-weight: bold;font-size: 14px;">Scope of Metalite Industries: </span>  <? echo $ld_clause;?><br>
                    <span style="color: black;font-weight: bold;font-size: 14px;">Delivery Period : </span>  <? echo $delivery_period;?><br>
                    <span style="color: black;font-weight: bold;font-size: 14px;">Payment Terms : </span>  <? echo $payment_terms;?><br>
                  </td>
                </tr>
                <tr>  
                  <td colspan="4" style="font-size:13px;text-align:left;padding:5px;">
                  </td>
                  <td colspan="3" style="font-size:13px;text-align:left;padding:5px;">
                    Authorised Signatory
                  </td>
                </tr>
                <?php if ($file_path!='') { ?>
                  <tr>  
                  <td colspan="4" style="font-size:13px;text-align:left;padding:5px;">
                  </td>
                  <td colspan="3" style="font-size:13px;text-align:left;padding:5px;">
                    <img src="<?=$file_path?>" style="height: 90px;width: 90px;">
                  </td>
                </tr>
                <?php  }else{ ?>
                <tr>  
                  <td colspan="4" style="font-size:13px;text-align:left;padding:5px;">&nbsp;
                  </td>
                  <td colspan="3" style="font-size:13px;text-align:left;padding:5px;">&nbsp;
                  </td>
                </tr>
              <?php } ?>
                <tr>  
                  <td colspan="4" style="font-size:13px;text-align:left;padding:5px;">
                  
                  </td>
                  <td colspan="3" style="font-size:13px;text-align:left;padding:5px;">
                    <?=$prepared_name?>,<?=$designation?><br>
                    Procurement Manager
                  </td>
                </tr>

              </table>
            </td>
          </tr>


        </table>  
      </td>
    </tr>
  </table>
<!--   <footer>
    <img src="<?php echo base_url();?>assets/images/footer.jpg" style="height:auto;width: 100%;margin-bottom: 0px;position: fixed;left: 0;bottom: 0;">
  </footer> -->
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