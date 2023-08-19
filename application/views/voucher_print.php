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
      $query=$this->db->query('select t.cdate,t.lname as lname,t.ledger_mobno,t.jobcard,t.id,t.tol_freight,t.builtyno,t.purchase_no,t.loading_person_name,t.remark,t.lr_freight,t.paid_build,t.checked_by,t.dispatch_through,t.ref_details,t.sub_details,t.pakking_forwerding,t.delivery_period,t.payment_terms,t.warranty_guarantee,t.ld_clause,t.refno,t.ledger_state,t.typeofpayment,t.ledger_district,t.ledger_address,t.payable_amount,t.cash,t.card,t.bank,t.upi,t.total_amt from tbl_trans1 t  where t.company_id='.get_cookie('ae_company_id').' and t.id='.$id);
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
      $refno='';
      $ledger_state='';
      $typeofpayment='';
      $ledger_district='';
      $ledger_address='';
      $payable_amount='';
      $cash='';
      $card='';
      $bank='';
      $upi='';
      $total_amt='';



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
        $refno=$row->refno;;
        $ledger_state=$row->ledger_state;;
        $typeofpayment=$row->typeofpayment;;
        $ledger_district=$row->ledger_district;;
        $ledger_address=$row->ledger_address;;
        $payable_amount=$row->payable_amount;;
        $cash=$row->cash;;
        $card=$row->card;;
        $bank=$row->bank;;
        $upi=$row->upi;;
        $total_amt=$row->total_amt;;

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
                    VOUCHER
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
                    Payable To : <? echo $partyname;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    Date : <? echo date('d-m-Y',strtotime($cdate));?>
                  </td>
                </tr>
                <tr>
                  <td style="width:50%;text-align:left;font-size:13px;">
                    State : <? echo $ledger_state;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    Type Of Payment : <? echo $typeofpayment;?>
                  </td>
                </tr>
                <tr>
                  <td style="width:50%;text-align:left;font-size:13px;">
                    District : <? echo $ledger_district;?>
                  </td>
                  <td style="width:50%;text-align:right;font-size:13px;">
                    
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="width:100%;text-align:left;font-size:13px;">
                    Address : <? echo $ledger_address;?>
                  </td>
                </tr>
              </table>
              <br>
            </td>
          </tr>
        </table>  
      </td>
    </tr>
     <tr>
        <td style="width:100%;" >
          <table border="0" style="width:100%;font-family:verdana;" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="2" style="width:100%;text-align:center;font-size:16px;">
                Payment
              </td>
            </tr>
            <tr>
              <td style="width:50%;text-align:left;font-size:13px;">
                Payable Amount : <? echo $payable_amount;?>
              </td>
              <td style="width:50%;text-align:right;font-size:13px;">
              </td>
            </tr>
            <tr>
              <td style="width:50%;text-align:left;font-size:13px;">
                Cash : <? echo $cash;?>
              </td>
              <td style="width:50%;text-align:right;font-size:13px;">
              </td>
            </tr>
            <tr>
              <td style="width:50%;text-align:left;font-size:13px;">
                Card : <? echo $card;?>
              </td>
              <td style="width:50%;text-align:right;font-size:13px;">
                
              </td>
            </tr>
            <tr>
              <td colspan="2" style="width:100%;text-align:left;font-size:13px;">
                Bank : <? echo $bank;?>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="width:100%;text-align:left;font-size:13px;">
                UPI : <? echo $upi;?>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="width:100%;text-align:left;font-size:13px;">
                Remark : <? echo $remark;?>
              </td>
            </tr>
          </table>
          <br>
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