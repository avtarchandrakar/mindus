<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <style>
    /*@page { size: A5 }*/
    body {
    /* A5 dimensions */
    /*height: 210mm;
    width: 148.5mm;

    margin: 0;*/
    text-align: justify;text-justify: inter-word;
}

@media print {
       body{
        /*border-top: 8px solid #74a74b;
        border-left: 8px solid #74a74b;
        border-right: 8px solid #74a74b;*/
       }
}

@page {
  size: A4;
}

/*table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 4px;
}*/
th, td {
    padding: 3px;
}
</style>

</head>
<body style="padding-left:50px;padding-right:50px;padding-bottom:50px;background-color: white;">
    <?php 
      $query=$this->db->query('select t.*,t.cdate,l.name as lname,l.mobileno as mobileno,l.emailid as emailid,l.state as state,l.district as district,t.reg_address as partyadd from tbl_invoice1 t inner join m_ledger l on t.ledger_id=l.id  where t.company_id='.get_cookie('ae_company_id').' and t.id='.$id);
      $partyname="";
      $partymobile="";
      $partyemail="";
      $quatation_no='';
      $cdate="";
      $tol_freight=0;
      $checked_by='';
      $dispatch_through='';
      $paid_build='';
      $partyadd='';
      $district='';
      $state='';
      $invoice_no='';
      $gstin_no='';
      $wo_no='';
      $reg_address='';
      $con_address='';
      $dispatch_detail='';
      $tol_qtymt='';
      $total_before_tax='';
      $cgst_per='';
      $cgst_amt='';
      $sgst_per='';
      $sgst_amt='';
      $igst_per='';
      $igst_amt='';
      $total_gst='';
      $grand_total='';
      $round_off_amt='';
      $file_path='';
      $acc_details='';
      $invoice_type='';
      $proforma_no='';




      foreach($query->result() as $row)
      {
        $invoice_no=$row->invoice_no;
        $gstin_no=$row->gstin_no;
        $wo_no=$row->wo_no;
        $reg_address=$row->reg_address;
        $con_address=$row->con_address;
        $dispatch_detail=$row->dispatch_detail;
        $tol_qtymt=$row->tol_qtymt;
        $total_before_tax=$row->total_before_tax;
        $cgst_per=$row->cgst_per;
        $cgst_amt=$row->cgst_amt;
        $sgst_per=$row->sgst_per;
        $sgst_amt=$row->sgst_amt;
        $igst_per=$row->igst_per;
        $igst_amt=$row->igst_amt;
        $total_gst=$row->total_gst;
        $grand_total=$row->grand_total;
        $round_off_amt=$row->round_off_amt;
        $partyname=$row->lname;
        $partymobile=$row->mobileno;
        $partyemail=$row->emailid;
        $partyadd=$row->partyadd;
        $district=$row->district;
        $state=$row->state;
        $cdate=$row->cdate;
        $tol_freight=$row->tol_freight;
        $quatation_no=$row->quatation;
        $file_path=$row->file_path;
        $acc_details=$row->acc_details;
        $invoice_type=$row->invoice_type;
        $proforma_no=$row->proforma_no;

      }
    ?>

     <?php 
      $query1=$this->db->query('select * from m_company where company_id='.get_cookie('ae_company_id').' ');
      $gstn="";
      $cin="";
      $gmail="";
      $website='';
      $ac_holder="";
      $bankname='';
      $ac_no='';
      $ifsccode='';

      $ac_holder2="";
      $bankname2='';
      $ac_no2='';
      $ifsccode2='';
      $bank_address2='';
      $bank_address='';

      foreach($query1->result() as $row1)
      {
        $gstn=$row1->gstn;
        $cin=$row1->cin;
        $gmail=$row1->gmail;
        $website=$row1->website;
        $ac_holder=$row1->ac_holder;
        $bankname=$row1->bankname;
        $ac_no=$row1->ac_no;
        $ifsccode=$row1->ifsccode;

        $ac_holder2=$row1->ac_holder2;
        $bankname2=$row1->bankname2;
        $ac_no2=$row1->ac_no2;
        $ifsccode2=$row1->ifsccode2;
        $bank_address2=$row1->bank_address2;
        $bank_address=$row1->bank_address;

      }
      ?>

<table style="width:100%;">
<thead><tr><th>
  <header style="margin-top:50px;">
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
<table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" style="width:100%;text-align:center;font-size:15px;font-weight:bold;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
      <?php if ($invoice_type=='Proforma Invoice') {
        echo "PROFORMA INVOICE";
      } ?>
      <?php if ($invoice_type=='Invoice') {
        echo "TAX INVOICE";
      } ?>
    </td>
  </tr>

  <tr>
    <td style="width:33%;text-align:left;font-size:12px;font-weight:bold;border-left: 1px solid;border-top:1px solid black;">
      Udyog Aadhaar Number : <span style="font-weight: normal;"> <?=$cin?></span>
    </td>
    <td style="width:33%;text-align:left;font-size:12px;font-weight:bold;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
      Company GSTIN : <span style="font-weight: normal;"> <?=$gstn?></span>
    </td>
    <td style="width:34%;text-align:left;font-size:12px;font-weight:bold;border-right: 1px solid;border-top:1px solid black;">
      <?php if ($invoice_type=='Proforma Invoice') { ?>
        Proforma Invoice No : <span style="font-weight: normal;"><?=$proforma_no?></span>
      <?php } ?>
      <?php if ($invoice_type=='Invoice') { ?>
        Invoice No : <span style="font-weight: normal;"><?=$invoice_no?></span>
      <?php } ?>
    </td>
  </tr>
  <tr>
    <td style="width:33%;text-align:left;font-size:12px;font-weight:bold;border-left: 1px solid;border-top:1px solid black;">
      Website : <span style="font-weight: normal;"><?=$website?></span>
    </td>
    <td style="width:33%;text-align:left;font-size:12px;font-weight:bold;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
      Email : <span style="font-weight: normal;"><?=$gmail?></span>
    </td>
    <td style="width:34%;text-align:left;font-size:12px;font-weight:bold;border-right: 1px solid;border-top:1px solid black;">
      Date : <span style="font-weight: normal;"><?=date('d-m-Y',strtotime($cdate))?></span>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="width:100%;text-align:left;font-size:14px;font-weight:bold;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
      Client Detail :
    </td>
  </tr>
  <tr>
    <td style="width:20%;text-align:left;font-size:11px;font-weight: bold;border-left: 1px solid;border-top:1px solid black;">
      Organization Name :
    </td>
    <td colspan="2" style="width:80%;text-align:left;font-size:13px;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
       <?php echo $partyname;?>
    </td>
  </tr>
  <tr>
    <td style="width:20%;text-align:left;font-size:11px;font-weight: bold;border-left: 1px solid;border-top:1px solid black;">
      Registered Address :
    </td>
    <td colspan="2" style="width:80%;text-align:left;font-size:13px;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
       <?php echo $partyadd;?>
    </td>
  </tr>
  <tr>
    <td style="width:20%;text-align:left;font-size:11px;font-weight: bold;border-left: 1px solid;border-top:1px solid black;">
      Consignee Name & Address :
    </td>
    <td  colspan="2" style="width:80%;text-align:left;font-size:13px;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
       <?php echo $con_address;?>
    </td>
  </tr>

  <tr>
    <td style="width:20%;text-align:left;font-size:11px;font-weight: bold;border-left: 1px solid;border-top:1px solid black;">
      GSTIN :
    </td>
    <td  colspan="2" style="width:80%;text-align:left;font-size:13px;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
       <?php echo $gstin_no;?>
    </td>
  </tr>

  <tr>
    <td style="width:20%;text-align:left;font-size:11px;font-weight: bold;border-left: 1px solid;border-top:1px solid black;">
      W. O. No. :
    </td>
    <td  colspan="2" style="width:80%;text-align:left;font-size:13px;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;">
       <?php echo $wo_no;?>
    </td>
  </tr>

  <tr>
    <td style="width:20%;text-align:left;font-size:11px;font-weight: bold;border-left: 1px solid;border-top:1px solid black;border-bottom:1px solid black;">
      Dispatch Details :
    </td>
    <td  colspan="2" style="width:80%;text-align:left;font-size:13px;border-left: 1px solid;border-top:1px solid black;border-right: 1px solid;border-bottom:1px solid black;">
       <?php echo $dispatch_detail;?>
    </td>
  </tr>

</table>


<table style="width:100%;margin-top: 20px;" cellpadding="0" cellspacing="0">
  <tr>
    <th style="border-left: 1px solid;border-top:1px solid black;border-bottom:1px solid black;width:5%;text-align:left;font-size:13px;">
      SNo.
    </th>
    <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:55%;text-align:center;font-size:13px;">
      Item
    </th>
    <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:10%;text-align:left;font-size:13px;">
      HSN Code
    </th>
    <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:10%;text-align:left;font-size:13px;">
      QTY.(in NOS)
    </th>
    <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:10%;text-align:left;font-size:13px;">
      QTY.(in KG)
    </th>
    <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:left;font-size:13px;">
      UOM 
    </th>
    <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:left;font-size:13px;">
      Unit Rate 
    </th>
    <!-- <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:left;font-size:13px;">
      %age
    </th> -->
    <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:left;font-size:13px;border-right: 1px solid;">
      Amount 
    </th>
  </tr>
  </thead>
  <tbody>
  <? 
    $query=$this->db->query('select t.item_name as item,t.persentage, t.qtymt,t.hson_no, t.moc,t.rate, t.freight, t.percent,t.discount,t.remark,t.unit,t.qtykg from tbl_invoice2 t where  t.billno='.$id.' order by t.id');
    $totqty=0;
    $totbox=0;
    $totamt=0;

    $i=0;
    foreach($query->result() as $row)
    {?>
      <tr>
        <td style="border-left: 1px solid;width:5%;text-align:left;font-size:13px;padding:2px;">
          <?php echo $i+1;?>
        </td>
        <td style="border-left:1px solid;width:55%;text-align:left;font-size:13px;padding:2px;">
          <?php echo ucwords(strtolower($row->item));?>
        </td>   
        <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
          <?php echo ucwords(strtolower($row->hson_no));?>
        </td>    
        <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
          <?php echo $row->qtymt;?>
        </td>                
        <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
          <?php echo $row->qtykg;?>
        </td>
        <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
          <?php echo $row->unit;?>
        </td>
        <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
          <?php echo number_format($row->rate,2);?>
        </td>
        <!-- <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
          <?php echo number_format($row->persentage,2);?>
        </td> -->
        <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;border-right: 1px solid;">
          <?php echo number_format($row->freight,2);?>
        </td>
      </tr>
      
  <?$i++;
    }
    if($i<4)
    {
      for($c=0;$c<4-$i;$c++)
      {?>
        <tr>
          <td style="width:5%;text-align:left;font-size:13px;padding:2px;border-left:1px solid;">
            &nbsp;
          </td>
          <td style="border-left:1px solid;width:55%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td>
          <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td>
          <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td>
          <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td>
          <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td>
          <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td>
          <!-- <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td> -->
          <td style="border-left:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;border-right:1px solid;">
            &nbsp;
          </td>
        </tr>
      <?}
    }
  ?>
        <tr>
          <!-- <td colspan="5" style="border-top:1px solid;width:80%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td> -->
          <td  colspan="7" style="border-top:1px solid;border-left:1px solid;border-left:1px solid;width:90%;text-align:right;font-size:13px;padding:2px;">
            Total Amount in (INR)
          </td>
          <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            <?php echo number_format($tol_freight,2);?>
          </td>
        </tr>

        <tr>
          <td colspan="4" rowspan="2" style="border-top:1px solid;border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            &nbsp;
          </td>
          <td  colspan="3" style="border-top:1px solid;border-left:1px solid;width:30%;text-align:right;font-size:13px;padding:2px;">
            Total Amount Befor Tax :                        
          </td>
          <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            <?php echo number_format($total_before_tax,2);?>
          </td>
        </tr>
        <tr>
          <td  colspan="3" style="border-top:1px solid;border-left:1px solid;width:30%;text-align:right;font-size:13px;padding:2px;">
            Add CGST Tax <?php echo number_format($cgst_per,0);?>% :                        
          </td>
          <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            <?php echo number_format($cgst_amt,2);?>
          </td>
        </tr>

        <tr>
          <td colspan="4" style="border-top:1px solid;border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            <b>Bank Details :</b>
          </td>
          <td  colspan="3" style="border-top:1px solid;border-left:1px solid;width:30%;text-align:right;font-size:13px;padding:2px;">
            Add SGST Tax <?php echo number_format($sgst_per,0);?>% :                        
          </td>
          <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            <?php echo number_format($sgst_amt,2);?>
          </td>
        </tr>

        <tr>
        <?php if ($acc_details==2) { ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            Account Holder : <?=$ac_holder2?>
          </td>
        <?php }else{  ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            Account Holder : <?=$ac_holder?>
          </td>
        <?php } ?>
          <td  colspan="3" style="border-top:1px solid;border-left:1px solid;width:30%;text-align:right;font-size:13px;padding:2px;">
            Add IGST Tax <?php echo number_format($igst_per,0);?>% :                        
          </td>
          <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            <?php echo number_format($igst_amt,2);?>
          </td>
        </tr>

        <tr>
          <?php if ($acc_details==2) { ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            Bank Name : <?=$bankname2?>
          </td>
        <?php }else{  ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            Bank Name : <?=$bankname?>
          </td>
        <?php } ?>
          
          <td  colspan="3" style="border-top:1px solid;border-left:1px solid;width:30%;text-align:right;font-size:13px;padding:2px;">
            Total GST (1+2+3) :                        
          </td>
          <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            <?php echo number_format($total_gst,2);?>
          </td>
        </tr>

        <tr>
          <?php if ($acc_details==2) { ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            Account No. : <?=$ac_no2?>
          </td>
        <?php }else{  ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            Account No. : <?=$ac_no?>
          </td>
        <?php } ?>
          
          <td  colspan="3" style="border-top:1px solid;border-left:1px solid;width:30%;text-align:right;font-size:13px;padding:2px;">
            Grand Total :                        
          </td>
          <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            <?php echo number_format($grand_total,2);?>
          </td>
        </tr>

        <tr>
          <?php if ($acc_details==2) { ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            IFSC Code : <?=$ifsccode2?>
          </td>
        <?php }else{  ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            IFSC Code : <?=$ifsccode?>
          </td>
        <?php } ?>
          
          <td  colspan="3" style="border-top:1px solid;border-left:1px solid;width:30%;text-align:right;font-size:13px;padding:2px;">
            Round Off Amount :                          
          </td>
          <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;width:10%;text-align:left;font-size:13px;padding:2px;">
            <?php echo number_format($round_off_amt,2);?>
          </td>
        </tr>

        <tr>
          <?php if ($acc_details==2) { ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            Bank Address : <?=$bank_address?>
          </td>
        <?php }else{  ?>
          <td colspan="4" style="border-left:1px solid;width:60%;text-align:left;font-size:13px;padding:2px;">
            Bank Address : <?=$bank_address2?>
          </td>
        <?php } ?>
          
          <td  colspan="4" style="border-top:1px solid;border-right:1px solid;border-left:1px solid;width:30%;text-align:right;font-size:13px;padding:2px;">
                                   
          </td>
        </tr>

        <?php if ($file_path!='') { ?>
        <tr>
        <td colspan="5" style="border-top:1px solid;border-left:1px solid;width:5%;text-align:left;font-size:13px;padding:2px;">
          
        </td>
        <td colspan="3" style="border-top:1px solid;border-right:1px solid;width:30%;text-align:centert;font-size:11px;padding:2px;">
          <img src="<?=$file_path?>" style="height: 100px;width: 100px;">  
        </td>
      </tr>
      <?php }else{ ?>
        <tr>
        <td colspan="5" style="border-top:1px solid;border-left:1px solid;width:5%;text-align:left;font-size:13px;padding:2px;">
          <br><br><br><br><br>  
        </td>
        <td colspan="3" style="border-top:1px solid;border-right:1px solid;width:30%;text-align:centert;font-size:11px;padding:2px;">
          <br><br><br><br><br>
        </td>
      </tr>
      <?php } ?>

      <tr>
        <td colspan="5" style="border-bottom:1px solid;border-left:1px solid;width:5%;text-align:left;font-size:13px;padding:2px;">
                
        </td>
        <td colspan="3" style="border-bottom:1px solid;border-right:1px solid;width:30%;text-align:centert;font-size:11px;padding:2px;">
          <span style="text-align: center;">Authorized Signature</span>
        </td>
      </tr>
  </tbody>
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
          // window.print();
        });
      </script>
</body>
</html>