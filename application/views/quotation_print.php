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
    background:none;
}
/*
header {top: 0; position: fixed;padding-left:50px;padding-right:50px;padding-top:30px;width:93%;}
footer {bottom: 0px; position: fixed;padding-left:50px;padding-right:50px;padding-top:30px;width:93%;}
.container {margin: 0 auto; overflow: auto;}*/

@page { 
    /* switch to landscape */ 
/*   size: landscape; */
   /* set page margins */ 
/*   margin: 0.5cm; */
   /* Default footers */ 
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

        /*border-top: 8px solid #74a74b;
        border-left: 8px solid #74a74b;
        border-right: 8px solid #74a74b;*/
       }
}
/*margin-top: 100px;margin-bottom: 100px;*/

@page {  }
      body {  padding: 2em;margin-left: 50px;margin-left: 50px;margin-top: 120px;margin-bottom: 50px; }
      .header { position: fixed; top: 50px; left: 30px; right: 10px; padding: -0.5em; text-align: center; }
      .footer { position: fixed; bottom: -20px; left: 30px; right: 10px; padding: -0.5em; text-align: center; }
</style>

</head>
<!-- padding-left:50px;padding-right:50px;padding-top:30px;width:93%; -->
<body style="">
    <?php 
      $query=$this->db->query('select t.cdate,l.name as lname,l.mobileno as mobileno,l.emailid as emailid,l.state as state,l.district as district,l.address as partyadd,t.ledger_mobno,t.id,t.tol_freight,t.builtyno,t.loading_person_name,t.remark,t.lr_freight,t.paid_build,t.quatation_no,t.semi_formal,t.header,t.taxes,t.scope_of_work,t.design_criteria,t.validity_of_offer,t.gst_tax,t.mobile_crane,t.scope_of_unloading,t.intrest_charge,t.cancellation,t.jurisdication,t.documents_provided,t.load_test,t.note,t.price,t.kindattn,t.performance_warranty,t.equipment_acceptance,t.supervision_commissioning,t.training,t.general_safety,t.spare_parts,t.chassis_equipment,t.checked_by,t.dispatch_through,t.ref_details,t.sub_details,t.pakking_forwerding,t.delivery_period,t.payment_terms,t.warranty_guarantee,t.ld_clause,t.prepare_by from tbl_trans1 t inner join m_ledger l on t.ledger_id=l.id  where t.company_id='.get_cookie('ae_company_id').' and t.id='.$id);
      $partyname="";
      $partymobile="";
      $partyemail="";
      $quatation_no='';
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
      $lr_freight=0;
      $checked_by='';
      $dispatch_through='';
      $paid_build='';
      $partyadd='';
      $district='';
      $state='';
      $semi_formal='';
      $header='';
      $taxes='';
      $scope_of_work='';
      $design_criteria='';
      $validity_of_offer='';
      $note='';
      $performance_warranty='';
      $equipment_acceptance='';
      $supervision_commissioning='';
      $training='';
      $general_safety='';
      $spare_parts='';
      $chassis_equipment='';
      $price='';
      $kindattn='';
      $gst_tax='';
      $mobile_crane='';
      $scope_of_unloading='';
      $intrest_charge='';
      $cancellation='';
      $jurisdication='';
      $documents_provided='';
      $load_test='';
      $prepare_by='';

      foreach($query->result() as $row)
      {
        $partyname=$row->lname;
        $partymobile=$row->mobileno;
        $partyemail=$row->emailid;

        $partyadd=$row->partyadd;
        $district=$row->district;
        $state=$row->state;
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
        $quatation_no=$row->quatation_no;
        $semi_formal=$row->semi_formal;
        $header=$row->header;
        $taxes=$row->taxes;
        $scope_of_work=$row->scope_of_work;
        $design_criteria=$row->design_criteria;
        $validity_of_offer=$row->validity_of_offer;
        $note=$row->note;
        $performance_warranty=$row->performance_warranty;
        $equipment_acceptance=$row->equipment_acceptance;
        $supervision_commissioning=$row->supervision_commissioning;
        $training=$row->training;
        $general_safety=$row->general_safety;
        $spare_parts=$row->spare_parts;
        $chassis_equipment=$row->chassis_equipment;
        $price=$row->price;
        $kindattn=$row->kindattn;
        $gst_tax=$row->gst_tax;
        $mobile_crane=$row->mobile_crane;
        $scope_of_unloading=$row->scope_of_unloading;
        $intrest_charge=$row->intrest_charge;
        $cancellation=$row->cancellation;
        $jurisdication=$row->jurisdication;
        $documents_provided=$row->documents_provided;
        $load_test=$row->load_test;
        $prepare_by=$row->prepare_by;



      }
    ?>
<!--   <header style="margin-top:10px;">
    <img src="<?php echo base_url();?>assets/images/header.jpg" style="height:auto;width: 95%;">
  </header>
 -->
<div class="header">
  <img src="<?php echo base_url();?>assets/images/header.jpg" style="height:auto;width: 92%;padding-bottom: 5px;padding-top: 5px;">
  <table border="0" style="width:92%;border-top:2px solid green;padding-bottom: 20px;margin-left: 30px;font-family:poppins;margin-top: 2px;">
    <tr>
      <td >
      </td>
    </tr>
  </table>
</div>

<div class="footer">
  <img src="<?php echo base_url();?>assets/images/footer.jpg" style="padding-left: 10px;height:auto;width: 92%;padding-bottom: 30px;">
</div>

  <div class="container">
  

  <table border="0" style="width:100%; font-family:poppins;" cellpadding="0" cellspacing="0">
    <tr style="display: none;">
      <td style="width:60%;text-align:left;font-size:12px;font-weight: bold;">
         <?php echo $quatation_no;?>
      </td>
      <td style="width:40%;text-align:right;font-size:12px;font-weight: bold;">
        Date : <?php echo date('d-m-Y',strtotime($row->cdate));?>
      </td>
    </tr>
    <tr>
      <td style="width:60%;text-align:left;font-size:13px;font-weight: bold;">
        <i>To</i>,
      </td>
      <td style="width:40%;text-align:left;font-size:12px;font-weight: bold;">
         Offer Date:- <?php echo date('d-m-Y',strtotime($row->cdate));?>
      </td>

    </tr>
    <tr>
      <td style="width:60%;text-align:left;font-size:12px;font-weight: bold;">
          <?php echo $partyname;?>
      </td>
      <td style="width:40%;text-align:left;font-size:12px;font-weight: bold;">
        Offer No.:- <?php echo $quatation_no;?>
      </td>
    </tr>

    <tr>
      <td style="width:60%;text-align:left;font-size:12px;font-weight: bold;">
         <?php echo $partyadd;?>,<?php echo $district;?>,<?php echo $state;?>
      </td>
      <td style="width:40%;text-align:left;font-size:12px;font-weight: bold;">
        <?php if ($ref_details!='') { ?>
        Reference:- <?php echo $ref_details;?>
        <?php } ?>
      </td>
    </tr>

    <tr>
      <td style="width:60%;text-align:left;font-size:12px;font-weight: bold;">
        <!-- Customer -->
      </td>
      <td style="width:40%;text-align:left;font-size:12px;font-weight: bold;">
        <?php if ($sub_details!='') { ?>
        Subject:- <?php echo $sub_details;?>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td style="width:60%;text-align:left;font-size:12px;font-weight: bold;">
         <?php if ($kindattn!='') { ?>
         Kind Att:- <?php echo $kindattn;?><br>
         <?php } ?>
         Mo. No.:- +91 <?php echo $partymobile;?><br>
         Email I.D.:- <?php echo $partyemail;?>
      </td>
      <td style="width:40%;text-align:left;font-size:12px;font-weight: bold;">
      </td>
    </tr>

    <tr>
      <td colspan="2" style="width:100%;text-align:left;font-size:12px;font-weight: bold;">
        <br>
      </td>
    </tr>
    <?php if ($semi_formal!='') { ?>
    <tr>
      <td colspan="2" style="width:100%;text-align:left;font-size:12px;">
        Dear <?php echo ucwords(strtolower($semi_formal));?>,<br><br>
      </td>
    </tr>
    <?php } ?>
    <?php if ($header!='') { ?>
    <tr>
      <td colspan="2" style="width:100%;text-align:left;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($header))?><br><br>
      </td>
    </tr>
    <?php } ?>
    <?php if ($scope_of_work!='') { ?>
    <tr>
      <td colspan="2" style="width:100%;text-align:left;font-size:12px;text-align: justify;text-justify: inter-word;">
        <b><u>Scope of Work</u></b>: <br><?php echo ucwords(strtolower($scope_of_work));?><br><br>
      </td>
    </tr>
    <?php } ?>
    <?php if ($design_criteria!='') { ?>
    <tr>
      <td colspan="2" style="width:100%;text-align:left;font-size:12px;text-align: justify;text-justify: inter-word;">
        <b><u>Design Criteria</u></b>: <?php echo ucwords(strtolower($design_criteria));?><br><br>
      </td>
    </tr>
  <?php } ?>
  </table>

  <table style="width:100%; font-family:poppins;" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" style="border-left: 1px solid;border-right: 1px solid;border-top:1px solid black;width:100%;text-align:center;font-size:12px;font-weight: bold;">
      Technical Specification of ANFO Unit
    </td>
  </tr>
  <thead>
  <tr>
    <th style="border-left: 1px solid;border-top:1px solid black;border-bottom:1px solid black;width:5%;text-align:center;font-size:12px;">
      Sr. No.
    </th>
    <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:25%;text-align:center;font-size:12px;">
      Item
    </th>
    <th style="border-top:1px solid black;border-left:1px solid;border-bottom:1px solid black;width:50%;text-align:center;font-size:12px;">
      Specification
    </th>
    <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;font-size:12px;">
      MOC
    </th>
    <th style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid;width:10%;text-align:center;font-size:12px;border-right: 1px solid;">
      Quantity
    </th>
  </tr>
  </thead>
  <tbody>
  <? 
    $query=$this->db->query('select t.item_name as item, t.qtymt, t.moc,t.rate, t.freight, t.percent,t.discount,t.remark,t.unit from tbl_trans2 t where  t.billno='.$id  . ' order by t.id');
    $totqty=0;
    $totbox=0;
    $i=0;
    foreach($query->result() as $row)
    {?>
      <tr>
        <td style="border-bottom:1px solid;border-left: 1px solid;width:5%;text-align:left;font-size:12px;padding:5px;">
          <?php echo $i+1;?>
        </td>
        <td style="border-bottom:1px solid;border-left:1px solid;width:10%;text-align:left;font-size:12px;padding:5px;">
          <?php echo ucwords(strtolower($row->item));?>
        </td>   
        <td style="border-bottom:1px solid;border-left:1px solid;width:50%;text-align:left;font-size:12px;padding:5px;">
          <?php echo ucwords(strtolower($row->remark));?>
        </td>    
        <td style="border-bottom:1px solid;border-left:1px solid;width:10%;text-align:left;font-size:12px;padding:5px;">
          <?php echo ucwords(strtolower($row->moc));?>
        </td>                
        <td style="border-bottom:1px solid;border-left:1px solid;width:10%;text-align:center;font-size:12px;padding:5px;border-right: 1px solid;">
          <?php echo number_format($row->qtymt,0);?>
        </td>
          
      </tr>
      
  <?$i++;
    }
    if($i<8)
    {
      for($c=0;$c<8-$i;$c++)
      {?>
        
      <?}
    }
  ?>
      <tr>
        <td style="border-top:1px solid;width:5%;text-align:left;font-size:12px;padding:5px;">
          &nbsp;
        </td>
        <td style="border-top:1px solid;width:10%;text-align:left;font-size:12px;padding:5px;">
          &nbsp;
        </td>
        <td style="border-top:1px solid;width:50%;text-align:left;font-size:12px;padding:5px;">
          &nbsp;
        </td>
        <td style="border-top:1px solid;width:10%;text-align:left;font-size:12px;padding:5px;">
          &nbsp;
        </td>
        <td style="border-top:1px solid;width:10%;text-align:left;font-size:12px;padding:5px;">
          &nbsp;
        </td>
      </tr>
  
    </tbody>
  </table>
  <table style="width:98%; font-family:poppins;border: 1px solid; margin-top: 3px;" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
      <th style="width:20%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;margin-top: 30px;">
        Item
      </th>
      <th style="width:70%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;margin-top: 30px;">
        Commercial Terms & Conditions
      </th>
    </tr>
    </thead>
    <tbody>
    <?php if ($price!='0') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;margin-top: 30px;">
        <b>Price</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;margin-top: 30px;text-align: justify;text-justify: inter-word;">
        <b><?php echo ucwords(strtolower($price))?>/-</b>
      </td>
    </tr>
    <?php } ?>
    <?php if ($performance_warranty!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Performance Warranty</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($performance_warranty))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($equipment_acceptance!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Equipment Acceptance</b>
      </td>
      <td style="width:40%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($equipment_acceptance))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($supervision_commissioning!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Supervision of Erection & Commissioning</b>:
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($supervision_commissioning))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($training!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Training</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($training))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($general_safety!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>General Safety</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($general_safety))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($spare_parts!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Spare Parts</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($spare_parts))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($chassis_equipment!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Transportation of chassis & equipment</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($chassis_equipment))?>
      </td>
    </tr>
    <?php } ?>

    <?php if ($gst_tax!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>GST Tax</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($gst_tax))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($mobile_crane!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Mobile Crane</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($mobile_crane))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($scope_of_unloading!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Scope Of Unloading</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($scope_of_unloading))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($intrest_charge!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Overdue Intrest & Wherehousing Charge</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($intrest_charge))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($cancellation!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Cancellation</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($cancellation))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($jurisdication!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Jurisdication</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($jurisdication))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($documents_provided!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Documents Provided During Delivery</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($documents_provided))?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($load_test!='') { ?>
    <tr>
      <td style="width:30%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;">
        <b>Load Test</b>
      </td>
      <td style="width:60%;text-align:center;padding:5px;border: 0.1px solid grey;font-size:12px;text-align: justify;text-justify: inter-word;">
        <?php echo ucwords(strtolower($load_test))?>
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="2" style="width:90%;text-align:left;padding:5px;border: 0.1px solid grey;font-size:12px;">
        Warm Regards,<br>
        <?= $prepare_by; ?>
      </td>
    </tr>
  </tbody>
  </table>
  <h3 style="text-align:left;">Documents</h3> 
  <?php $query22=$this->db->query('select t.* from tbl_docs t where t.parent_id='.$id);
      $name="";
      $file_path="";
      $file_name=""; 
      ?>
<table class="table table-bordered" >
<?php  foreach($query22->result() as $row22)
      {
        $name=$row22->name;
        $file_path=$row22->file_path;
        $file_name=$row22->file_name; ?>
    <tr>
      <td colspan="1" style="text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
        <?php echo $name;?>
      </td>
      <td colspan="1" style="text-align:left;font-size:15px;text-align: justify;text-justify: inter-word;">
      :  <a href="<?php echo $file_path;?>" target="_blank"><img src="<?=base_url()?>/assets/img/logo2.png" style="height:30px;width:30px;" ></a>
      </td>
    </tr>
    <?php } ?>
  </table>
  <h3 style="text-align:center;">XXXXXXXXXX</h3> 
</div>
<!--   <footer>
    <img src="<?php echo base_url();?>assets/images/footer.jpg" style="height:auto;width: 88%;margin-bottom: 0px;position: fixed;left: 0;bottom: 0;margin-top:50px;margin-left:50px;margin-right:50px;">
  </footer> -->
<!--  <footer>
    <img src="<?php echo base_url();?>assets/images/footer.jpg" style="height:auto;width: 98%;margin-bottom: 0px;position: fixed;left: 0;bottom: 0;padding: 10px;">
  </footer>  -->
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